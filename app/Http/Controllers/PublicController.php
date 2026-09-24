<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\AidApplication;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Highlight;
use App\Models\NewsletterSubscription;
use App\Models\Post;
use App\Models\Project;
use App\Models\School;
use App\Models\Student;
use App\Models\Testimonial;
use App\Models\User;
use App\Notifications\NewDonationNotification;
use Filament\Actions\Action as FilamentAction;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    public function home()
    {
        // Cache high-level statistics in Redis
        $stats = Cache::remember('hfst_home_stats', 300, function () {
            return [
                'studentsCount' => Student::where('status', 'Active')->count(),
                'projectsCount' => Project::where('status', 'Active')->count(),
                'donorsCount'   => Donor::count(),
                'schoolsCount'  => School::where('is_active', true)->count(),
                'totalRaised'   => (float) Donation::where('status', 'Confirmed')->sum('amount') ?: (float) Donation::sum('amount') ?: 0,
            ];
        });

        $featuredProjects = Project::where('status', 'Active')->latest()->take(3)->get();
        $latestNews       = Post::where('status', 'published')->latest('published_at')->take(10)->get();
        $testimonials     = Testimonial::where('is_featured', true)->latest()->take(3)->get();
        $highlights       = Highlight::where('is_active', true)->orderBy('sort_order')->get();
        $partnerSchools   = School::where('is_active', true)->take(4)->get();

        return view('pages.home', array_merge($stats, compact(
            'featuredProjects',
            'latestNews',
            'testimonials',
            'highlights',
            'partnerSchools'
        )));
    }

    public function subscribe(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|unique:newsletter_subscriptions,email',
            'name'  => 'nullable|string|max:255',
        ]);

        NewsletterSubscription::create([
            'email' => $data['email'],
            'name'  => $data['name'] ?? null,
        ]);

        return back()->with('success', app()->getLocale() === 'sw' 
            ? 'Asante kwa kujiunga na jarida letu!' 
            : 'Thanks for subscribing — check your inbox.');
    }

    public function about()
    {
        $schoolsCount = Cache::remember('hfst_schools_count', 600, fn () => School::where('is_active', true)->count());
        $studentsCount = Cache::remember('hfst_active_students_count', 600, fn () => Student::where('status', 'Active')->count());
        return view('pages.about', compact('schoolsCount', 'studentsCount'));
    }

    public function programs()
    {
        $programs = Project::latest()->get();
        return view('pages.programs', compact('programs'));
    }

    public function news()
    {
        $posts = Post::where('status', 'published')->latest('published_at')->paginate(9);
        return view('pages.news', compact('posts'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function donate()
    {
        $projects = Project::where('status', 'Active')->get();
        $students = Student::where('status', 'Active')->with('school')->get();
        return view('pages.donate', compact('projects', 'students'));
    }

    public function processDonation(Request $request)
    {
        $validated = $request->validate([
            'donor_name'     => 'required|string|min:3|max:120',
            'email'          => 'required|email|max:150',
            'phone'          => 'required|string|max:30',
            'amount'         => 'required|numeric|min:1000',
            'payment_method' => 'required|string',
            'transaction_id' => 'nullable|string|max:100',
            'target_type'    => 'required|in:general,project,student',
            'project_id'     => 'nullable|exists:projects,id',
            'student_id'     => 'nullable|exists:students,id',
            'notes'          => 'nullable|string|max:500',
        ]);

        // 1. Find or create donor user
        $user = User::firstOrCreate(
            ['email' => $validated['email']],
            [
                'name'      => $validated['donor_name'],
                'password'  => Hash::make(Str::random(16)),
                'phone'     => $validated['phone'],
                'is_active' => true,
            ]
        );

        if (!$user->hasRole('donor')) {
            $user->assignRole('donor');
        }

        // 2. Find or create donor profile
        $donor = Donor::firstOrCreate(
            ['user_id' => $user->id],
            [
                'phone'      => $validated['phone'],
                'address'    => 'Tanzania',
                'country'    => 'Tanzania',
                'donor_type' => 'Individual',
            ]
        );

        // 3. Generate reference if not provided
        $reference = !empty($validated['transaction_id'])
            ? strtoupper(trim($validated['transaction_id']))
            : 'TXN-' . strtoupper(Str::random(4)) . '-' . rand(1000, 9999);

        // Determine destination
        $projectId = ($validated['target_type'] === 'project') ? $validated['project_id'] : null;
        $studentId = ($validated['target_type'] === 'student') ? $validated['student_id'] : null;

        // 4. Create donation record
        $donation = Donation::create([
            'donor_id'       => $donor->id,
            'student_id'     => $studentId,
            'project_id'     => $projectId,
            'amount'         => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'transaction_id' => $reference,
            'status'         => 'Confirmed', // Automatically confirmed for instant receipt generation
            'notes'          => $validated['notes'] ?? 'Public Online Donation',
            'confirmed_at'   => now(),
            'confirmed_by'   => User::role('admin')->first()?->id,
        ]);

        // 5. If project donation, update project funding
        if ($projectId) {
            $project = Project::find($projectId);
            if ($project) {
                $project->increment('current_funding', $validated['amount']);
            }
        }

        // Notify Admins & Staff via Filament Database Notifications
        try {
            $admins = User::role(['admin', 'staff'])->get();
            if ($admins->isNotEmpty()) {
                FilamentNotification::make()
                    ->title(app()->getLocale() === 'sw' ? 'Mchango Mpya Umepokelewa!' : 'New Donation Received!')
                    ->body(app()->getLocale() === 'sw' 
                        ? "Mchango wa TZS " . number_format($donation->amount) . " kutoka kwa " . $validated['donor_name'] . " umethibitishwa." 
                        : "Donation of TZS " . number_format($donation->amount) . " received from " . $validated['donor_name'] . ".")
                    ->icon('heroicon-o-currency-dollar')
                    ->iconColor('success')
                    ->actions([
                        FilamentAction::make('view')
                            ->button()
                            ->label(app()->getLocale() === 'sw' ? 'Tazama Mchango' : 'View Donation')
                            ->url('/admin/donations'),
                    ])
                    ->sendToDatabase($admins);
            }

            // Also notify the donor
            FilamentNotification::make()
                ->title(app()->getLocale() === 'sw' ? 'Asante kwa Mchango Wako!' : 'Thank You for Your Donation!')
                ->body(app()->getLocale() === 'sw'
                    ? "Mchango wako wa TZS " . number_format($donation->amount) . " umepokelewa na kuthibitishwa. Risiti yako rasmi iko tayari."
                    : "Your donation of TZS " . number_format($donation->amount) . " is confirmed. Your tax receipt is ready.")
                ->icon('heroicon-o-heart')
                ->iconColor('success')
                ->sendToDatabase($user);
        } catch (\Throwable $e) {
            // Notification dispatch handled safely
        }

        // Record Audit Activity Log
        ActivityLog::record(
            'DONATION',
            "Mchango wa TZS " . number_format($donation->amount) . " umepokelewa kutoka kwa {$validated['donor_name']} kupitia {$validated['payment_method']}",
            $user
        );

        // Invalidate Redis home payload cache so stats reflect immediately
        Cache::forget('hfst_home_payload');

        session(['recent_donation_id' => $donation->id]);

        return redirect()->route('donate.success', ['donation' => $donation->id, 'ref' => $donation->transaction_id]);
    }

    public function donationSuccess(Request $request, Donation $donation)
    {
        $donation->load(['donor.user', 'project', 'student']);
        return view('pages.donate-success', compact('donation'));
    }

    public function schools()
    {
        $schools = School::where('is_active', true)
            ->withCount(['students' => fn ($q) => $q->where('status', 'Active')])
            ->orderBy('region')
            ->orderBy('name')
            ->get();

        return view('pages.schools', compact('schools'));
    }

    public function apply()
    {
        $schools = School::where('is_active', true)->orderBy('name')->get();
        return view('pages.apply', compact('schools'));
    }

    public function submitApplication(Request $request)
    {
        $validated = $request->validate([
            'first_name'      => 'required|string|max:100',
            'last_name'       => 'required|string|max:100',
            'gender'          => 'required|in:Male,Female',
            'age'             => 'required|integer|min:5|max:35',
            'school_id'       => 'nullable|exists:schools,id',
            'school_name'     => 'nullable|string|max:200',
            'education_level' => 'required|in:Primary,Secondary,High School,Vocational,University',
            'parent_name'     => 'required|string|max:150',
            'parent_phone'    => 'required|string|max:30',
            'email'           => 'nullable|email|max:150',
            'types'           => 'required|array|min:1',
            'description'     => 'required|string|min:20|max:3000',
            'document'        => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // 1. Create or find linked user account for the student
        $studentEmail = !empty($validated['email']) 
            ? $validated['email'] 
            : 'student.' . Str::slug($validated['first_name'] . '.' . $validated['last_name']) . '.' . rand(100, 999) . '@applicant.hfst.co.tz';

        $user = User::firstOrCreate(
            ['email' => $studentEmail],
            [
                'name'      => $validated['first_name'] . ' ' . $validated['last_name'],
                'password'  => Hash::make(Str::random(12)),
                'phone'     => $validated['parent_phone'],
                'is_active' => true,
            ]
        );

        if (!$user->hasRole('student')) {
            $user->assignRole('student');
        }

        // Determine school
        $school = $validated['school_id'] ? School::find($validated['school_id']) : null;
        $schoolName = $school ? $school->name : ($validated['school_name'] ?? 'Other School');

        // 2. Create student profile
        $student = Student::firstOrCreate(
            ['user_id' => $user->id],
            [
                'first_name'      => $validated['first_name'],
                'last_name'       => $validated['last_name'],
                'gender'          => $validated['gender'],
                'age'             => $validated['age'],
                'school_id'       => $validated['school_id'] ?? null,
                'school'          => $schoolName,
                'education_level' => in_array($validated['education_level'], ['Primary', 'Secondary', 'University']) ? $validated['education_level'] : 'Secondary',
                'requirements'    => array_fill_keys($validated['types'], true),
                'status'          => 'Active',
                'progress_notes'  => 'Beneficiary application submitted on ' . now()->format('d M Y') . '. Guardian: ' . $validated['parent_name'] . ' (' . $validated['parent_phone'] . ')',
            ]
        );

        // 3. Handle document upload
        $docs = [];
        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('aid-applications', 'public');
            $docs[] = $path;
        }

        // 4. Create Aid Application
        $application = AidApplication::create([
            'student_id'  => $student->id,
            'types'       => $validated['types'],
            'description' => $validated['description'] . "\n\nGuardian: " . $validated['parent_name'] . " | Contact: " . $validated['parent_phone'],
            'documents'   => $docs,
            'status'      => 'Pending',
        ]);

        // Notify Admins & Staff via Filament Database Notifications
        try {
            $admins = User::role(['admin', 'staff'])->get();
            if ($admins->isNotEmpty()) {
                FilamentNotification::make()
                    ->title(app()->getLocale() === 'sw' ? 'Ombi Jipya la Ufadhili wa Wanafunzi' : 'New Aid Application Received')
                    ->body(app()->getLocale() === 'sw'
                        ? "Mwanafunzi {$validated['first_name']} {$validated['last_name']} ({$schoolName}) ametuma maombi mapya ya msaada."
                        : "Student {$validated['first_name']} {$validated['last_name']} ({$schoolName}) submitted an aid application.")
                    ->icon('heroicon-o-academic-cap')
                    ->iconColor('info')
                    ->actions([
                        FilamentAction::make('review')
                            ->button()
                            ->label(app()->getLocale() === 'sw' ? 'Kagua Maombi' : 'Review Application')
                            ->url('/admin/aid-applications'),
                    ])
                    ->sendToDatabase($admins);
            }

            // Also notify the student user
            FilamentNotification::make()
                ->title(app()->getLocale() === 'sw' ? 'Maombi Yako Yamepokelewa!' : 'Application Received!')
                ->body(app()->getLocale() === 'sw'
                    ? 'Maombi yako ya msaada wa masomo yamepokelewa kikamilifu na yanafanyiwa kazi na bodi ya HFST.'
                    : 'Your student aid application has been received and is being processed by HFST.')
                ->icon('heroicon-o-check-circle')
                ->iconColor('success')
                ->sendToDatabase($user);
        } catch (\Throwable $e) {
            // Handled safely
        }

        // Record Audit Activity Log
        ActivityLog::record(
            'AID_APPLICATION_SUBMITTED',
            "Mwanafunzi {$validated['first_name']} {$validated['last_name']} ametuma maombi ya ufadhili wa masomo ({$schoolName}).",
            $user
        );

        return redirect()->route('apply.success', ['application' => $application->id]);
    }

    public function applicationSuccess(AidApplication $application)
    {
        $application->load(['student.school']);
        return view('pages.apply-success', compact('application'));
    }

    public function privacyPolicy()
    {
        return view('pages.privacy-policy');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function setLanguage(string $locale)
    {
        $supported = ['en', 'sw', 'fr'];
        if (in_array($locale, $supported)) {
            session(['locale' => $locale]);
            cookie()->queue('hfst_locale', $locale, 60 * 24 * 365);
            \Illuminate\Support\Facades\App::setLocale($locale);
        }
        return redirect()->back();
    }
}
