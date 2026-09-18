@extends('layouts.app')

@section('title', (app()->getLocale() === 'sw' ? 'Vigezo na Masharti' : 'Terms & Conditions') . ' — Hope for Students Tanzania')

@section('content')
<div class="py-16 sm:py-24" style="background: var(--surface-bg);">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="glass-card rounded-3xl p-8 sm:p-14 shadow-xl"
             style="background: var(--surface-card); border: 1px solid var(--border-light);">
            
            <h1 class="text-3xl sm:text-4xl font-black mb-4" style="color: var(--brand-blue);">
                {{ app()->getLocale() === 'sw' ? 'Vigezo na Masharti ya Mfumo' : 'Terms & Conditions' }}
            </h1>

            <p class="text-xs sm:text-sm text-gray-500 mb-8 pb-4 border-b" style="border-color: var(--border-light);">
                Hope for Students Tanzania (HFST-WBMS) | Arusha, Tanzania
            </p>

            <div class="prose dark:prose-invert max-w-none text-sm sm:text-base leading-relaxed space-y-6" style="color: var(--text-primary);">
                <section>
                    <h2 class="text-xl font-bold mb-2" style="color: var(--brand-blue);">1. Kukubaliana na Masharti (Agreement to Terms)</h2>
                    <p>
                        Kwa kutumia mfumo huu wa wavuti wa <strong>Hope for Students Tanzania (HFST)</strong>, unakubali kufuata na kufungwa na vigezo na masharti haya yaliyowekwa kwa mujibu wa sheria za Jamhuri ya Muungano wa Tanzania.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold mb-2" style="color: var(--brand-blue);">2. Michango na Uwazi wa NGO (Donations & Accountability)</h2>
                    <p>
                        Michango yote inayotolewa kupitia mfumo huu kwa njia ya mitandao ya simu (M-Pesa, Tigo Pesa, Airtel Money, Halopesa) au benki (CRDB, NMB) inatumika madhubuti kugharamia miradi ya elimu, ada za shule, na vifaa vya wanafunzi wanaofadhiliwa.
                    </p>
                    <p>
                        HFST inatoa risiti rasmi ya kielektroniki kwa kila muamala na inawajibika kutoa ripoti za mara kwa mara za matumizi kwa wafadhili na mamlaka husika za serikali.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold mb-2" style="color: var(--brand-blue);">3. Usajili wa Wanafunzi na Maombi ya Msaada</h2>
                    <p>
                        Wanafunzi au walezi wanaoomba msaada lazima watoe taarifa sahihi na nyaraka halali. Utoaji wa taarifa za uongo utasababisha kufutwa kwa maombi au kusitishwa kwa ufadhili mara moja.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold mb-2" style="color: var(--brand-blue);">4. Sheria Zinazosimamia (Governing Law)</h2>
                    <p>
                        Masharti haya yanasimamiwa na kufasiriwa kulingana na sheria za Jamhuri ya Muungano wa Tanzania. Mizozo yoyote itakayojitokeza itasuluhishwa chini ya mamlaka ya mahakama za Tanzania.
                    </p>
                </section>
            </div>

        </div>

    </div>
</div>
@endsection
