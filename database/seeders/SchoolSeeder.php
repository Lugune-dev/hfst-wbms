<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        $schoolsData = [
            [
                'name'             => 'Arusha Secondary School',
                'code'             => 'SCH-ARU-001',
                'education_level'  => 'Secondary',
                'region'           => 'Arusha',
                'district'         => 'Arusha City',
                'ward'             => 'Kikwakwaru B',
                'address'          => 'P.O. Box 2798, Arusha',
                'contact_person'   => 'Mwl. Grace Mollel (Headmistress)',
                'contact_phone'    => '+255613005293',
                'contact_email'    => 'arushasec@hfst.co.tz',
                'student_capacity' => 120,
                'is_active'        => true,
                'notes'            => 'Key partner school hosting over 25 sponsored secondary students in science and arts streams.',
            ],
            [
                'name'             => 'Kikwakwaru Primary School',
                'code'             => 'SCH-ARU-002',
                'education_level'  => 'Primary',
                'region'           => 'Arusha',
                'district'         => 'Arusha City',
                'ward'             => 'Kikwakwaru B',
                'address'          => 'Kikwakwaru B, Arusha',
                'contact_person'   => 'Mwl. Peter Temu (Headteacher)',
                'contact_phone'    => '+255747413379',
                'contact_email'    => 'kikwakwaru@hfst.co.tz',
                'student_capacity' => 80,
                'is_active'        => true,
                'notes'            => 'Community primary school near HFST headquarters focusing on foundational literacy and numeracy.',
            ],
            [
                'name'             => 'Ilboru High School',
                'code'             => 'SCH-ARU-003',
                'education_level'  => 'High School',
                'region'           => 'Arusha',
                'district'         => 'Arusha Rural',
                'ward'             => 'Ilboru',
                'address'          => 'Ilboru Hills, Arusha',
                'contact_person'   => 'Dr. Joseph Kimaro (Principal)',
                'contact_phone'    => '+255700000003',
                'contact_email'    => 'ilboru@hfst.co.tz',
                'student_capacity' => 60,
                'is_active'        => true,
                'notes'            => 'Special talent and national science high school with sponsored high-achieving beneficiaries.',
            ],
            [
                'name'             => 'Moshi Technical Vocational Training Centre',
                'code'             => 'SCH-KLM-004',
                'education_level'  => 'Vocational',
                'region'           => 'Kilimanjaro',
                'district'         => 'Moshi Urban',
                'ward'             => 'Shanty Town',
                'address'          => 'Moshi, Kilimanjaro',
                'contact_person'   => 'Eng. Fatuma Mchome (Director)',
                'contact_phone'    => '+255755123456',
                'contact_email'    => 'moshi.vocation@hfst.co.tz',
                'student_capacity' => 50,
                'is_active'        => true,
                'notes'            => 'Vocational hub offering carpentry, electrical engineering, plumbing and IT skills to youth.',
            ],
        ];

        $createdSchools = [];
        foreach ($schoolsData as $data) {
            $createdSchools[] = School::firstOrCreate(['code' => $data['code']], $data);
        }

        // Assign existing students to schools
        $defaultSchool = $createdSchools[0];
        Student::whereNull('school_id')->update([
            'school_id' => $defaultSchool->id,
            'school'    => $defaultSchool->name,
        ]);

        // Create a dedicated Teacher user if not existing
        $teacherUser = User::firstOrCreate(
            ['email' => 'teacher@hfst.co.tz'],
            [
                'name'      => 'Mwl. Daudi Mtei',
                'password'  => Hash::make('Teacher@HFST2024'),
                'phone'     => '+255788000001',
                'is_active' => true,
            ]
        );
        $teacherUser->assignRole('teacher');

        // Associate teacher with schools
        if (!$teacherUser->schools()->where('school_id', $defaultSchool->id)->exists()) {
            $teacherUser->schools()->attach([
                $createdSchools[0]->id => ['role_in_school' => 'Senior Teacher'],
                $createdSchools[1]->id => ['role_in_school' => 'School Coordinator'],
            ]);
        }

        // Associate staff user with schools
        $staffUser = User::where('email', 'staff@hfst.co.tz')->first();
        if ($staffUser) {
            foreach ($createdSchools as $sch) {
                if (!$staffUser->schools()->where('school_id', $sch->id)->exists()) {
                    $staffUser->schools()->attach($sch->id, ['role_in_school' => 'Liaison Officer']);
                }
            }
        }

        $this->command->info('Schools and school tenancy associations seeded successfully.');
    }
}
