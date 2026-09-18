<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Database\Seeder;

class ActivityLogSeeder extends Seeder
{
    public function run(): void
    {
        $logs = [
            ['user_id' => 1, 'action' => 'LOGIN', 'desc' => 'Admin ameingia kwenye jopo kuu la usimamizi (Admin Dashboard)', 'role' => 'admin', 'ip' => '196.249.102.14', 'ago' => 12],
            ['user_id' => 1, 'action' => 'AID_APPROVED', 'desc' => 'Admin ameidhinisha maombi ya msaada wa karo kwa mwanafunzi Amina Hassan (TZS 450,000)', 'role' => 'admin', 'ip' => '196.249.102.14', 'ago' => 25],
            ['user_id' => 12, 'action' => 'DONATION', 'desc' => 'Mfadhili Mama Maria Nyerere Foundation ametoa mchango wa TZS 2,500,000 kwa Mradi wa Maabara', 'role' => 'donor', 'ip' => '41.59.88.21', 'ago' => 48],
            ['user_id' => 2, 'action' => 'STUDENT_UPDATE', 'desc' => 'Afisa wa HFST (Staff) amesajili mahitaji mapya ya sare na vitabu vya kiada kwa Shule ya Sekondari Arusha', 'role' => 'staff', 'ip' => '197.250.32.18', 'ago' => 75],
            ['user_id' => 5, 'action' => 'ACADEMIC_REPORT', 'desc' => 'Mwalimu John Simoni amewasilisha matokeo ya muhula wa kwanza ya wanafunzi 18', 'role' => 'teacher', 'ip' => '102.214.75.9', 'ago' => 110],
            ['user_id' => 3, 'action' => 'RECEIPT_DOWNLOAD', 'desc' => 'Mfadhili John Mwangi amepakua risiti rasmi ya kodi (Receipt #TXN-HFST-9821)', 'role' => 'donor', 'ip' => '197.186.22.4', 'ago' => 140],
            ['user_id' => 4, 'action' => 'APPLICATION_SUBMITTED', 'desc' => 'Mwanafunzi Amina Hassan amewasilisha maombi mapya ya msaada wa vifaa vya kujifunzia', 'role' => 'student', 'ip' => '196.192.81.5', 'ago' => 190],
            ['user_id' => 1, 'action' => 'SYSTEM_CONFIG', 'desc' => 'Admin ameboresha mipangilio ya arifa za mfumo na hifadhi ya kumbukumbu ya Redis', 'role' => 'admin', 'ip' => '196.249.102.14', 'ago' => 240],
        ];

        foreach ($logs as $l) {
            $u = User::find($l['user_id']);
            ActivityLog::create([
                'user_id' => $u?->id,
                'user_name' => $u?->name ?? 'System Officer',
                'user_email' => $u?->email,
                'role' => $l['role'],
                'action' => $l['action'],
                'description' => $l['desc'],
                'ip_address' => $l['ip'],
                'user_agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36',
                'created_at' => now()->subMinutes($l['ago']),
                'updated_at' => now()->subMinutes($l['ago']),
            ]);
        }
    }
}
