<?php

namespace App\Filament\Donor\Pages;

use App\Models\Donation;
use App\Models\Student;
use Filament\Pages\Page;

class SponsoredStudentsPage extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';
    protected string $view = 'filament.donor.pages.sponsored-students-page';
    protected static ?string $navigationLabel = 'Sponsored Students';
    protected static ?string $title = 'My Sponsored Students (Wanafunzi Wanaofadhiliwa)';
    protected static string|\UnitEnum|null $navigationGroup = 'My Donations';
    protected static ?int $navigationSort = 3;

    public function getSponsoredStudents(): \Illuminate\Support\Collection
    {
        $donor = auth()->user()->donor;

        if (!$donor) {
            return collect();
        }

        $studentIds = Donation::where('donor_id', $donor->id)
            ->where('status', 'Confirmed')
            ->whereNotNull('student_id')
            ->pluck('student_id')
            ->unique();

        return Student::whereIn('id', $studentIds)->get();
    }
}
