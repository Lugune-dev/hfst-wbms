<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first() ?? User::factory()->create([
            'name' => 'HFST Admin',
            'email' => 'admin@hfst.co.tz',
        ]);

        $posts = [
            [
                'title' => 'Usambazaji wa Vitabu vya Mtaala wa NECTA Shule za Sekondari',
                'slug' => Str::slug('Usambazaji wa Vitabu vya Mtaala wa NECTA Shule za Sekondari'),
                'type' => 'report',
                'status' => 'published',
                'author_id' => $admin->id,
                'image' => 'images/hope1.jpeg',
                'published_at' => now()->subDays(2),
                'content' => '<p>Timu ya <strong>Hope for Students Tanzania (HFST)</strong> imekamilisha zoezi la kukabidhi vitabu zaidi ya 450 vya sayansi (Fizikia, Kemia, na Biolojia) na Hisabati kusaidia wanafunzi wa kidato cha pili na nne kujiandaa na mitihani ya kitaifa.</p><p>Zoezi hili limenufaisha shule 4 washirika mkoani Arusha, likilenga kupunguza uwiano wa vitabu na kuongeza motisha kwa wanafunzi wa mazingira magumu kufanya vyema kwenye masomo ya sayansi.</p>',
            ],
            [
                'title' => 'Mpango wa Ufadhili wa Masomo kwa Watoto wa Mazingira Magumu 2026/2027',
                'slug' => Str::slug('Mpango wa Ufadhili wa Masomo kwa Watoto wa Mazingira Magumu 2026 2027'),
                'type' => 'news',
                'status' => 'published',
                'author_id' => $admin->id,
                'image' => 'images/hope.jpeg',
                'published_at' => now()->subDays(5),
                'content' => '<p>Tunayo furaha kutangaza kufunguliwa rasmi kwa awamu mpya ya maombi ya ufadhili wa karo, sare, na vifaa vya shule kwa watoto wanaotoka katika mazingira magumu kwa mwaka wa masomo 2026/2027.</p><p>Kupitia ushirikiano dhabiti na wafadhili wetu wa ndani na nje ya nchi, HFST inatarajia kuongeza idadi ya wanafunzi wanaofadhiliwa kufikia zaidi ya vijana 150.</p>',
            ],
            [
                'title' => 'Ripoti ya Uwazi na Maendeleo ya Wanafunzi Robo ya Kwanza',
                'slug' => Str::slug('Ripoti ya Uwazi na Maendeleo ya Wanafunzi Robo ya Kwanza'),
                'type' => 'report',
                'status' => 'published',
                'author_id' => $admin->id,
                'image' => 'images/meet.jpeg',
                'published_at' => now()->subDays(10),
                'content' => '<p>Kama nguzo kuu ya thamani yetu ya <strong>Uaminifu na Uwazi</strong>, HFST inajivunia kutoa ripoti ya robo ya kwanza inayoonyesha maendeleo ya kitaaluma ya wanafunzi wote wanaofadhiliwa pamoja na mchanganuo kamili wa matumizi ya michango.</p><p>Asilimia 94 ya wanafunzi wamefaulu mitihani yao ya katikati ya muhula kwa alama za juu (Grade A & B), jambo linalothibitisha kuwa msaada wa wafadhili unaleta matokeo halisi na ya kudumu.</p>',
            ],
            [
                'title' => 'Utoaji wa Sare na Vifaa vya Kujifunzia kwa Wanafunzi 100',
                'slug' => Str::slug('Utoaji wa Sare na Vifaa vya Kujifunzia kwa Wanafunzi 100'),
                'type' => 'event',
                'status' => 'published',
                'author_id' => $admin->id,
                'image' => 'images/hope2.jpeg',
                'published_at' => now()->subDays(14),
                'content' => '<p>HFST imekamilisha ugawaji wa sare za shule, madaftari, mikoba, na vifaa vya hisabati kwa wanafunzi 100 wa shule za msingi na sekondari mkoani Arusha kuanza muhula mpya kwa ari na furaha.</p><p>Mpango huu umepunguza mzigo wa kifedha kwa wazazi na walezi wasiojiweza na kuhakikisha hakuna mtoto anayeacha shule kwa kukosa sare stahiki.</p>',
            ],
            [
                'title' => 'Ukarabati wa Maabara ya Sayansi na Maktaba Shuleni',
                'slug' => Str::slug('Ukarabati wa Maabara ya Sayansi na Maktaba Shuleni'),
                'type' => 'report',
                'status' => 'published',
                'author_id' => $admin->id,
                'image' => 'images/hope3.jpeg',
                'published_at' => now()->subDays(20),
                'content' => '<p>Kupitia mchango maalum wa wadau wetu wa maendeleo, mradi wa kuboresha maabara ya sayansi na maktaba ya shule washirika umekamilika kwa asilimia 100.</p><p>Wanafunzi zaidi ya 600 sasa wanapata fursa ya kufanya majaribio halisi ya sayansi kwa vitendo na kujisomea vitabu vya kisasa vya mitaala ya NECTA.</p>',
            ],
            [
                'title' => 'Kongamano la Wafadhili na Wadau wa Elimu Tanzania 2026',
                'slug' => Str::slug('Kongamano la Wafadhili na Wadau wa Elimu Tanzania 2026'),
                'type' => 'news',
                'status' => 'published',
                'author_id' => $admin->id,
                'image' => 'images/new.jpeg',
                'published_at' => now()->subDays(25),
                'content' => '<p>Wafadhili, viongozi wa shule, na wawakilishi wa jamii walikutana jijini Arusha katika kongamano la mwaka kujadili mbinu endelevu za kupanua wigo wa ufadhili wa elimu nchini Tanzania.</p><p>Mkutano uliazimia kuongeza ufadhili kwa wasichana wanaosoma masomo ya STEM na kutoa mafunzo ya stadi za ujasiriamali kwa vijana wa vyuo vya ufundi.</p>',
            ],
        ];

        foreach ($posts as $postData) {
            Post::updateOrCreate(
                ['slug' => $postData['slug']],
                $postData
            );
        }
    }
}
