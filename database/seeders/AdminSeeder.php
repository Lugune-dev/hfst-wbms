<?php

namespace Database\Seeders;

use App\Models\Donation;
use App\Models\Donor;
use App\Models\Post;
use App\Models\Project;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@hfst.co.tz'],
            [
                'name'      => 'HFST Administrator',
                'password'  => Hash::make('Admin@HFST2024'),
                'phone'     => '+255700000001',
                'is_active' => true,
            ]
        );
        $admin->assignRole('admin');
        $this->command->info("Admin created: admin@hfst.co.tz / Admin@HFST2024");

        // Create Staff user
        $staff = User::firstOrCreate(
            ['email' => 'staff@hfst.co.tz'],
            [
                'name'      => 'HFST Staff Member',
                'password'  => Hash::make('Staff@HFST2024'),
                'phone'     => '+255700000002',
                'is_active' => true,
            ]
        );
        $staff->assignRole('staff');

        // Create demo Donor user
        $donorUser = User::firstOrCreate(
            ['email' => 'donor@example.com'],
            [
                'name'      => 'John Mwangi',
                'password'  => Hash::make('Donor@2024'),
                'phone'     => '+255711000001',
                'is_active' => true,
            ]
        );
        $donorUser->assignRole('donor');

        $donor = Donor::firstOrCreate(
            ['user_id' => $donorUser->id],
            [
                'organization_name' => null,
                'phone'             => '+255711000001',
                'address'           => 'Dar es Salaam, Tanzania',
                'country'           => 'Tanzania',
                'donor_type'        => 'Individual',
            ]
        );

        // Create demo Student user
        $studentUser = User::firstOrCreate(
            ['email' => 'student@example.com'],
            [
                'name'      => 'Amina Hassan',
                'password'  => Hash::make('Student@2024'),
                'phone'     => '+255722000001',
                'is_active' => true,
            ]
        );
        $studentUser->assignRole('student');

        $student = Student::firstOrCreate(
            ['user_id' => $studentUser->id],
            [
                'first_name'      => 'Amina',
                'last_name'       => 'Hassan',
                'gender'          => 'Female',
                'age'             => 16,
                'school'          => 'Dar es Salaam Secondary School',
                'education_level' => 'Secondary',
                'requirements'    => ['fees' => true, 'books' => true, 'uniform' => false],
                'status'          => 'Active',
                'progress_notes'  => 'Performing well in sciences. Top 5 in class.',
            ]
        );

        // Create demo Project
        $project = Project::firstOrCreate(
            ['name' => 'Secondary Education Support 2024'],
            [
                'description'     => 'Supporting 50 students in secondary schools with school fees, books, and uniforms.',
                'budget'          => 50000000.00,
                'current_funding' => 15000000.00,
                'start_date'      => '2024-01-01',
                'end_date'        => '2024-12-31',
                'status'          => 'Active',
                'created_by'      => $admin->id,
            ]
        );

        // Attach student to project
        if (!$project->students()->where('student_id', $student->id)->exists()) {
            $project->students()->attach($student->id, [
                'assigned_date' => now()->toDateString(),
                'status'        => 'Active',
            ]);
        }

        // Create demo Donation
        Donation::firstOrCreate(
            ['transaction_id' => 'TXN-DEMO-001'],
            [
                'donor_id'       => $donor->id,
                'student_id'     => $student->id,
                'project_id'     => $project->id,
                'amount'         => 500000.00,
                'payment_method' => 'Mobile Money',
                'status'         => 'Confirmed',
                'notes'          => 'Support for school fees',
                'confirmed_at'   => now(),
                'confirmed_by'   => $admin->id,
            ]
        );

        // Create sample news post
        Post::firstOrCreate(
            ['slug' => 'hfst-launches-2024-program'],
            [
                'title'        => 'Hope for Students Tanzania Launches 2024 Education Program',
                'content'      => '<p>Hope for Students Tanzania is proud to announce the launch of our 2024 Education Support Program. This initiative aims to provide comprehensive support to 50 students across Tanzania, covering school fees, educational materials, and uniforms.</p><p>Our dedicated team has worked tirelessly to identify students in need and connect them with generous donors who believe in the power of education.</p><p>Together, we can transform lives and build a brighter future for Tanzania.</p>',
                'image'        => null,
                'type'         => 'news',
                'status'       => 'published',
                'author_id'    => $admin->id,
                'published_at' => now(),
            ]
        );

        $this->command->info('Demo data seeded successfully.');
    }
}
