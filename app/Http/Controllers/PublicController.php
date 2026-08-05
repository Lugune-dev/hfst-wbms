<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Donor;
use App\Models\Post;
use App\Models\Project;
use App\Models\Highlight;
use App\Models\Student;
use App\Models\NewsletterSubscription;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        $featuredProjects = Project::where('status', 'Active')->latest()->take(3)->get();
        $latestNews = Post::where('status', 'published')->latest('published_at')->take(3)->get();

        // Dynamic stats
        $studentsCount = Student::count();
        $projectsCount = Project::where('status', 'Active')->count();
        $donorsCount = Donor::count();

        // Featured testimonials
        $testimonials = Testimonial::where('is_featured', true)->latest()->take(5)->get();

        // Highlights (managed via admin)
        $highlights = Highlight::where('is_active', true)->orderBy('sort_order')->get();

        $totalRaised = Donation::sum('amount') ?? 0;

        return view('pages.home', compact(
            'featuredProjects',
            'latestNews',
            'studentsCount',
            'projectsCount',
            'donorsCount',
            'testimonials',
            'highlights',
            'totalRaised'
        ));
    }

    public function subscribe(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|unique:newsletter_subscriptions,email',
            'name' => 'nullable|string|max:255',
        ]);

        NewsletterSubscription::create([
            'email' => $data['email'],
            'name' => $data['name'] ?? null,
        ]);

        return back()->with('success', 'Thanks for subscribing — check your inbox.');
    }

    public function about()
    {
        return view('pages.about');
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
        return view('pages.donate');
    }

    public function setLanguage(string $locale)
    {
        $supported = ['en', 'sw', 'fr'];
        if (in_array($locale, $supported)) {
            session(['locale' => $locale]);
        }
        return redirect()->back();
    }
}
