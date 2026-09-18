@extends('layouts.app')

@section('title', (app()->getLocale() === 'sw' ? 'Sera ya Faragha & Ulinzi wa Data' : 'Privacy Policy & Data Protection') . ' — Hope for Students Tanzania')

@section('content')
<div class="py-16 sm:py-24" style="background: var(--surface-bg);">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="glass-card rounded-3xl p-8 sm:p-14 shadow-xl"
             style="background: var(--surface-card); border: 1px solid var(--border-light);">
            
            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-4"
                  style="background: rgba(19,56,94,0.1); color: var(--brand-blue);">
                Compliance: Tanzania Data Protection Act (2022)
            </span>

            <h1 class="text-3xl sm:text-4xl font-black mb-4" style="color: var(--brand-blue);">
                {{ app()->getLocale() === 'sw' ? 'Sera ya Faragha na Ulinzi wa Taarifa Binafsi' : 'Privacy Policy & Data Protection' }}
            </h1>

            <p class="text-xs sm:text-sm text-gray-500 mb-8 pb-4 border-b" style="border-color: var(--border-light);">
                {{ app()->getLocale() === 'sw' ? 'Ilirekebishwa Mwisho: Septemba 2026' : 'Last Updated: September 2026' }} | Hope for Students Tanzania (HFST-WBMS)
            </p>

            <div class="prose dark:prose-invert max-w-none text-sm sm:text-base leading-relaxed space-y-6" style="color: var(--text-primary);">
                
                <section>
                    <h2 class="text-xl font-bold mb-2" style="color: var(--brand-blue);">1. Utangulizi na Msingi wa Kisheria (Introduction)</h2>
                    <p>
                        Shirika lisilo la kiserikali la <strong>Hope for Students Tanzania (HFST)</strong> limejitolea kulinda haki ya faragha na taarifa binafsi za watumiaji wote wa mfumo wetu wa wavuti (HFST-WBMS), wakiwemo wanafunzi, wazazi/walezi, wafadhili (donors), walimu, na wafanyakazi.
                    </p>
                    <p>
                        Sera hii inatekelezwa kwa kuzingatia kikamilifu <strong>Sheria ya Ulinzi wa Taarifa Binafsi ya Tanzania ya Mwaka 2022 (Personal Data Protection Act, 2022 - Act No. 11 of 2022)</strong> na kanuni zake zote za usimamizi wa data nchini Tanzania.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold mb-2" style="color: var(--brand-blue);">2. Data Tunazokusanya (Information We Collect)</h2>
                    <p>Tunakusanya taarifa zifuatazo kwa madhumuni maalum ya kutoa na kusimamia misaada ya elimu:</p>
                    <ul class="list-disc list-inside space-y-1 text-sm">
                        <li><strong>Wanafunzi & Waombaji:</strong> Majina kamili, umri, jinsia, shule anayosoma, ngazi ya elimu, mahitaji ya masomo, na nyaraka (vyeti vya kuzaliwa, barua za udahili).</li>
                        <li><strong>Wazazi & Walezi:</strong> Majina, nambari za simu, eneo la makazi, na hali ya kipato/uhitaji.</li>
                        <li><strong>Wafadhili (Donors):</strong> Jina, barua pepe, simu, nchi, shirika (kama lipo), na rekodi za miamala ya michango (bila kuhifadhi namba za siri za benki au simu).</li>
                        <li><strong>Watumiaji wa Umma:</strong> Maulizo yanayotumwa kupitia fomu ya mawasiliano na anwani za barua pepe kwa wanaojiunga na jarida.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold mb-2" style="color: var(--brand-blue);">3. Ulinzi wa Taarifa za Watoto (Child Data Protection)</h2>
                    <p>
                        Kwa kuwa wengi wa wanufaika wetu ni watoto walio chini ya umri wa miaka 18, HFST inazingatia viwango vya juu zaidi vya ulinzi wa watoto. Hatutoi, hatuuzi, wala hatutangazi hadharani picha au taarifa zinazoweza kumweka mtoto hatarini bila ridhaa rasmi ya maandishi kutoka kwa mzazi au mlezi halali.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold mb-2" style="color: var(--brand-blue);">4. Madhumuni ya Kuchakata Data (Purposes of Processing)</h2>
                    <p>Taarifa zako zinatumika tu kwa ajili ya:</p>
                    <ul class="list-disc list-inside space-y-1 text-sm">
                        <li>Uthibitishaji wa maombi ya ufadhili wa masomo na mawasiliano na shule husika.</li>
                        <li>Kutoa risiti rasmi za michango na ripoti za uwazi kwa wafadhili.</li>
                        <li>Usimamizi wa usalama wa mfumo na kuzuia vitendo vya ulaghai au uingiliaji usioidhinishwa.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold mb-2" style="color: var(--brand-blue);">5. Haki za Mwenye Data (Your Legal Rights)</h2>
                    <p>Chini ya Sheria ya Ulinzi wa Taarifa Binafsi ya Tanzania, una haki ya:</p>
                    <ul class="list-disc list-inside space-y-1 text-sm">
                        <li>Kupata taarifa (Access) kuhusu data zako zilizohifadhiwa.</li>
                        <li>Kusahihisha (Rectification) taarifa zozote zisizo sahihi.</li>
                        <li>Kufuta au kuzuia uchakataji (Erasure / Restriction) pale panapostahili kisheria.</li>
                    </ul>
                </section>

                <section class="p-6 rounded-2xl bg-blue-50 dark:bg-blue-950/30 border border-blue-200 dark:border-blue-900">
                    <h3 class="text-base font-bold mb-1 text-blue-900 dark:text-blue-200">Mawasiliano ya Afisa Ulinzi wa Data (Data Protection Officer)</h3>
                    <p class="text-xs text-blue-800 dark:text-blue-300">
                        Kwa maombi, maswali au maoni yoyote kuhusu faragha yako, tafadhali wasiliana nasi moja kwa moja:<br>
                        <strong>ALL COMMUNICATION TO BE ADDRESSED TO ICT OFFICERS</strong><br>
                        Hope for Students Tanzania (HFST)<br>
                        P.O. Box 2798, Arusha, Kikwakwaru B, Tanzania<br>
                        Simu: +255 613 005 293 / +255 747 413 379<br>
                        Barua Pepe: hopeforstudentsTanzania25@gmail.com
                    </p>
                </section>

            </div>

        </div>

    </div>
</div>
@endsection
