<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Amina Hassan',
                'role' => 'Mwanafunzi Mnufaika (Form IV, Arusha Secondary)',
                'message' => 'HFST ilibadilisha maisha yangu kabisa. Nilipokuwa karibu kuacha masomo kutokana na ukosefu wa karo na vitabu vya sayansi, ufadhili wa HFST ulininusuru na kunipa matumaini mapya. Sasa ninaongoza darasani nikielekea ndoto yangu ya udaktari.',
                'photo' => 'images/hope.jpeg',
                'is_featured' => true,
            ],
            [
                'name' => 'Mwl. John Simoni',
                'role' => 'Mwalimu wa Taaluma (Shule ya Sekondari Arusha)',
                'message' => 'Ushirikiano wetu na Hope for Students Tanzania umeleta mageuzi makubwa. Wanafunzi waliokuwa wakikosa vipindi sasa wanahudhuria asilimia 100 na maendeleo yao kitaaluma yameongezeka kwa kiasi kikubwa sana.',
                'photo' => 'images/hope2.jpeg',
                'is_featured' => true,
            ],
            [
                'name' => 'John Mwangi',
                'role' => 'Mfadhili Binafsi (Arusha)',
                'message' => 'Uwazi wa mfumo wa HFST na urahisi wa kupata risiti rasmi za kodi na taarifa za maendeleo ya mwanafunzi ninayemfadhili unanipa imani na furaha kubwa ya kuendelea kusaidia elimu ya watoto wa Kitanzania.',
                'photo' => 'images/hope3.jpeg',
                'is_featured' => true,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::create($t);
        }
    }
}
