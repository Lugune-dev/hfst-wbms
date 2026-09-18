<?php

namespace Database\Seeders;

use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@hfst.co.tz')->first();
        $staff = User::where('email', 'staff@hfst.co.tz')->first();
        $donor = User::where('email', 'donor@example.com')->first();
        $student = User::where('email', 'student@example.com')->first();
        $teacher = User::where('email', 'teacher@hfst.co.tz')->first();

        if ($admin) {
            Notification::make()
                ->title('Mchango Mpya Umethibitishwa')
                ->body('Mfadhili Mama Maria Nyerere Foundation amechangia TZS 2,500,000 kwa ajili ya mradi wa maabara ya sayansi.')
                ->icon('heroicon-o-currency-dollar')
                ->iconColor('success')
                ->sendToDatabase($admin);

            Notification::make()
                ->title('Maombi Mapya ya Msaada wa Karo')
                ->body('Mwanafunzi Amina Hassan ametuma maombi mapya ya ufadhili wa masomo kwa muhula wa 2.')
                ->icon('heroicon-o-academic-cap')
                ->iconColor('warning')
                ->sendToDatabase($admin);

            Notification::make()
                ->title('Kumbukumbu ya Usalama (Security Notice)')
                ->body('Mtumiaji mpya wa jopo la Mwalimu ameingia kwenye mfumo kutoka anwani ya IP 102.214.75.9.')
                ->icon('heroicon-o-shield-check')
                ->iconColor('info')
                ->sendToDatabase($admin);
        }

        if ($staff) {
            Notification::make()
                ->title('Wanafunzi Wapya Wanahitaji Uhakiki')
                ->body('Wanafunzi 4 kutoka Shule ya Sekondari Arusha wamesajiliwa na wanahitaji kukaguliwa na afisa wa HFST.')
                ->icon('heroicon-o-user-group')
                ->iconColor('info')
                ->sendToDatabase($staff);
        }

        if ($donor) {
            Notification::make()
                ->title('Risiti Rasmi ya Mchango Wako Iko Tayari')
                ->body('Asante sana kwa mchango wako! Risiti rasmi yenye msamaha wa kodi imetolewa na inapatikana kwenye jopo lako.')
                ->icon('heroicon-o-document-check')
                ->iconColor('success')
                ->sendToDatabase($donor);

            Notification::make()
                ->title('Taarifa ya Maendeleo ya Wanafunzi')
                ->body('Ripoti ya robo mwaka kuhusu maendeleo ya wanafunzi unaowafadhili imechapishwa.')
                ->icon('heroicon-o-chart-bar')
                ->iconColor('info')
                ->sendToDatabase($donor);
        }

        if ($student) {
            Notification::make()
                ->title('Maombi Yako ya Ufadhili Yameidhinishwa!')
                ->body('Hongera! Bodi ya HFST imeidhinisha maombi yako ya vifaa vya shule na karo ya muhula ujao.')
                ->icon('heroicon-o-check-badge')
                ->iconColor('success')
                ->sendToDatabase($student);
        }

        if ($teacher) {
            Notification::make()
                ->title('Kikumbusho cha Uwasilishaji Matokeo')
                ->body('Tafadhali kamilisha kuingiza mahudhurio na matokeo ya masomo ya wanafunzi wanaofadhiliwa na HFST kabla ya mwisho wa juma.')
                ->icon('heroicon-o-clipboard-document-check')
                ->iconColor('warning')
                ->sendToDatabase($teacher);
        }
    }
}
