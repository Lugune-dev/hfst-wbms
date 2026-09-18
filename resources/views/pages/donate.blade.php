@extends('layouts.app')

@section('title', (app()->getLocale() === 'sw' ? 'Toa Mchango' : 'Donate Now') . ' — Hope for Students Tanzania')
@section('description', 'Support vulnerable students across Tanzania with school fees, books, and uniforms through secure Mobile Money and Bank transfer.')

@section('content')

{{-- ======================================================
     HERO SECTION
====================================================== --}}
<div class="relative overflow-hidden" style="background: linear-gradient(135deg, var(--brand-blue-dark) 0%, var(--brand-blue) 60%, var(--brand-blue-light) 100%);">
    <div class="absolute inset-0" style="background: radial-gradient(circle at 20% 80%, rgba(246,178,25,0.18) 0%, transparent 50%), radial-gradient(circle at 80% 20%, rgba(46,125,50,0.2) 0%, transparent 50%);"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 text-center text-white">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider mb-4"
              style="background: rgba(246,178,25,0.2); color: var(--brand-yellow); border: 1px solid rgba(246,178,25,0.35);">
            💛 {{ app()->getLocale() === 'sw' ? 'Badilisha Maisha ya Mtoto' : 'Transform a Child\'s Future' }}
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight max-w-3xl mx-auto">
            {{ app()->getLocale() === 'sw' ? 'Toa Mchango Wako Leo' : 'Make an Impact: Donate Today' }}
        </h1>
        <p class="mt-4 text-base sm:text-lg text-blue-100 max-w-2xl mx-auto leading-relaxed">
            {{ app()->getLocale() === 'sw' 
                ? 'Mchango wako unawezesha watoto na vijana nchini Tanzania kupata elimu bora, sare, vitabu, na mahitaji ya shule kwa uwazi wa 100%.' 
                : 'Your support provides vulnerable students in Tanzania with tuition, uniforms, books, and learning essentials with full transparency.' }}
        </p>
    </div>
</div>

{{-- ======================================================
     MAIN DONATION CONTAINER
====================================================== --}}
<div class="py-12 sm:py-16" style="background: var(--surface-bg);">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        @if ($errors->any())
        <div class="mb-8 p-5 rounded-2xl bg-red-50 border border-red-200 text-red-700 dark:bg-red-950/40 dark:border-red-800 dark:text-red-300">
            <h4 class="font-bold mb-2 text-sm">{{ app()->getLocale() === 'sw' ? 'Tafadhali rekebisha makosa yafuatayo:' : 'Please correct the following errors:' }}</h4>
            <ul class="list-disc list-inside text-xs space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            
            {{-- Left Column: Interactive Donation Form (7 cols) --}}
            <div class="lg:col-span-7 glass-card rounded-3xl p-6 sm:p-10 shadow-xl"
                 style="background: var(--surface-card); border: 1px solid var(--border-light);">
                
                <div class="flex items-center justify-between pb-6 mb-6 border-b" style="border-color: var(--border-light);">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-black" style="color: var(--brand-blue);">
                            {{ app()->getLocale() === 'sw' ? 'Taarifa za Mchango' : 'Donation Details' }}
                        </h2>
                        <p class="text-xs sm:text-sm mt-1" style="color: var(--text-muted);">
                            {{ app()->getLocale() === 'sw' ? 'Lipa kwa urahisi kupitia Simu au Benki' : 'Pay securely via Mobile Money or Bank' }}
                        </p>
                    </div>
                    <span class="text-2xl">🇹🇿</span>
                </div>

                <form method="POST" action="{{ route('donate.process') }}" id="donation-form" class="space-y-6">
                    @csrf

                    {{-- 1. Amount Selection --}}
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider mb-2" style="color: var(--text-primary);">
                            {{ app()->getLocale() === 'sw' ? '1. Chagua Kiasi (TZS)' : '1. Choose Amount (TZS)' }}
                        </label>
                        
                        <div class="grid grid-cols-3 sm:grid-cols-3 gap-2.5 mb-3">
                            @foreach([10000, 25000, 50000, 100000, 250000, 500000] as $preset)
                            <button type="button" onclick="setPresetAmount({{ $preset }})"
                                    class="preset-amt-btn py-3 px-2 rounded-xl text-center font-bold text-xs sm:text-sm transition-all duration-200 border"
                                    style="background: var(--surface-bg); border-color: var(--border-light); color: var(--text-primary);"
                                    data-amount="{{ $preset }}">
                                {{ number_format($preset) }}
                            </button>
                            @endforeach
                        </div>

                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-sm" style="color: var(--brand-blue);">TZS</span>
                            <input type="number" name="amount" id="custom-amount" required min="1000" step="500"
                                   placeholder="Or enter custom amount (e.g. 50000)"
                                   value="{{ old('amount', 50000) }}"
                                   class="w-full pl-14 pr-4 py-3.5 rounded-xl font-bold text-base transition-all"
                                   style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;">
                        </div>
                        <p class="text-[11px] mt-1.5" style="color: var(--text-muted);">
                            {{ app()->getLocale() === 'sw' ? 'Kiwango cha chini ni TZS 1,000.' : 'Minimum donation is TZS 1,000.' }}
                        </p>
                    </div>

                    {{-- 2. Destination / Allocation --}}
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider mb-2" style="color: var(--text-primary);">
                            {{ app()->getLocale() === 'sw' ? '2. Mchango Huu Uende Wapi?' : '2. Where should your donation go?' }}
                        </label>
                        <div class="grid grid-cols-3 gap-2 mb-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="target_type" value="general" checked onchange="toggleTarget(this.value)" class="sr-only peer">
                                <div class="p-3 text-center rounded-xl border transition-all text-xs font-bold peer-checked:border-blue-600 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/30 dark:peer-checked:text-blue-300"
                                     style="border-color: var(--border-light); color: var(--text-primary);">
                                    📚 {{ app()->getLocale() === 'sw' ? 'Mfuko Mkuu' : 'General Fund' }}
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="target_type" value="project" onchange="toggleTarget(this.value)" class="sr-only peer">
                                <div class="p-3 text-center rounded-xl border transition-all text-xs font-bold peer-checked:border-blue-600 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/30 dark:peer-checked:text-blue-300"
                                     style="border-color: var(--border-light); color: var(--text-primary);">
                                    🎯 {{ app()->getLocale() === 'sw' ? 'Mradi Maalum' : 'Specific Project' }}
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="target_type" value="student" onchange="toggleTarget(this.value)" class="sr-only peer">
                                <div class="p-3 text-center rounded-xl border transition-all text-xs font-bold peer-checked:border-blue-600 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/30 dark:peer-checked:text-blue-300"
                                     style="border-color: var(--border-light); color: var(--text-primary);">
                                    🎓 {{ app()->getLocale() === 'sw' ? 'Mwanafunzi' : 'Sponsor Student' }}
                                </div>
                            </label>
                        </div>

                        {{-- Project dropdown --}}
                        <div id="target-project-wrapper" class="hidden mt-3">
                            <select name="project_id" class="w-full px-4 py-3 rounded-xl text-sm font-medium"
                                    style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;">
                                <option value="">— {{ app()->getLocale() === 'sw' ? 'Chagua Mradi wa Elimu' : 'Select an Education Project' }} —</option>
                                @foreach($projects as $p)
                                <option value="{{ $p->id }}">{{ $p->name }} (Budget: TZS {{ number_format($p->budget) }})</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Student dropdown --}}
                        <div id="target-student-wrapper" class="hidden mt-3">
                            <select name="student_id" class="w-full px-4 py-3 rounded-xl text-sm font-medium"
                                    style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;">
                                <option value="">— {{ app()->getLocale() === 'sw' ? 'Chagua Mwanafunzi wa Kufadhili' : 'Select a Student to Sponsor' }} —</option>
                                @foreach($students as $s)
                                <option value="{{ $s->id }}">{{ $s->first_name }} {{ $s->last_name }} ({{ $s->school_name ?? $s->school }} – {{ $s->education_level }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- 3. Payment Method --}}
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider mb-2" style="color: var(--text-primary);">
                            {{ app()->getLocale() === 'sw' ? '3. Njia ya Malipo (Payment Method)' : '3. Payment Method' }}
                        </label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                            @foreach([
                                ['id' => 'M-Pesa',        'name' => 'Vodacom M-Pesa',  'icon' => '🔴', 'type' => 'mobile'],
                                ['id' => 'Tigo Pesa',     'name' => 'Tigo Pesa / Mixx','icon' => '🔵', 'type' => 'mobile'],
                                ['id' => 'Airtel Money',  'name' => 'Airtel Money',    'icon' => '🔴', 'type' => 'mobile'],
                                ['id' => 'Halopesa',      'name' => 'Halopesa',        'icon' => '🟠', 'type' => 'mobile'],
                                ['id' => 'CRDB Bank',     'name' => 'CRDB Bank',       'icon' => '🟢', 'type' => 'bank'],
                                ['id' => 'NMB Bank',      'name' => 'NMB Bank',        'icon' => '🟡', 'type' => 'bank'],
                            ] as $method)
                            <label class="cursor-pointer">
                                <input type="radio" name="payment_method" value="{{ $method['id'] }}" {{ $loop->first ? 'checked' : '' }}
                                       onchange="selectPaymentMethod('{{ $method['id'] }}', '{{ $method['type'] }}')" class="sr-only peer">
                                <div class="p-3 rounded-xl border text-center transition-all peer-checked:border-emerald-600 peer-checked:bg-emerald-50 dark:peer-checked:bg-emerald-950/40"
                                     style="border-color: var(--border-light);">
                                    <div class="text-base">{{ $method['icon'] }}</div>
                                    <div class="text-xs font-bold mt-1" style="color: var(--text-primary);">{{ $method['name'] }}</div>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- 4. Donor Personal Information --}}
                    <div class="space-y-4 pt-2">
                        <label class="block text-xs font-bold uppercase tracking-wider" style="color: var(--text-primary);">
                            {{ app()->getLocale() === 'sw' ? '4. Taarifa Zako (Donor Info)' : '4. Your Details (For Receipt)' }}
                        </label>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <input type="text" name="donor_name" required placeholder="{{ app()->getLocale() === 'sw' ? 'Jina Kamili (Full Name)' : 'Full Name' }}"
                                       value="{{ old('donor_name', auth()->user()?->name) }}"
                                       class="w-full px-4 py-3 rounded-xl text-sm font-medium"
                                       style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;">
                            </div>
                            <div>
                                <input type="email" name="email" required placeholder="{{ app()->getLocale() === 'sw' ? 'Barua Pepe (Email Address)' : 'Email Address' }}"
                                       value="{{ old('email', auth()->user()?->email) }}"
                                       class="w-full px-4 py-3 rounded-xl text-sm font-medium"
                                       style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <input type="text" name="phone" required placeholder="{{ app()->getLocale() === 'sw' ? 'Nambari ya Simu (+255...)' : 'Phone Number (+255...)' }}"
                                       value="{{ old('phone', auth()->user()?->phone) }}"
                                       class="w-full px-4 py-3 rounded-xl text-sm font-medium"
                                       style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;">
                            </div>
                            <div>
                                <input type="text" name="transaction_id" placeholder="{{ app()->getLocale() === 'sw' ? 'Ref/SMS Namba ya Muamala (hiari)' : 'SMS Transaction Ref (optional)' }}"
                                       value="{{ old('transaction_id') }}"
                                       class="w-full px-4 py-3 rounded-xl text-sm font-medium"
                                       style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;">
                            </div>
                        </div>

                        <div>
                            <textarea name="notes" rows="2" placeholder="{{ app()->getLocale() === 'sw' ? 'Ujumbe au maoni ya hiari...' : 'Optional message or encouragement...' }}"
                                      class="w-full px-4 py-3 rounded-xl text-sm font-medium resize-none"
                                      style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit"
                            class="w-full py-4 rounded-2xl font-bold text-base text-white flex items-center justify-center gap-2 transition-all duration-300 shadow-xl hover:scale-[1.02]"
                            style="background: linear-gradient(135deg, var(--brand-green), #1b5e20); box-shadow: 0 8px 24px rgba(46,125,50,0.35);">
                        <span>💛 {{ app()->getLocale() === 'sw' ? 'Thibitisha & Kamilisha Mchango' : 'Confirm & Complete Donation' }}</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                    
                    <p class="text-center text-xs" style="color: var(--text-muted);">
                        🔒 {{ app()->getLocale() === 'sw' ? 'Malipo yanalindwa na utapokea risiti rasmi ya PDF papo hapo.' : 'Secure payment. You will receive an official PDF receipt immediately.' }}
                    </p>
                </form>
            </div>

            {{-- Right Column: Live Payment Instruction Card (5 cols) --}}
            <div class="lg:col-span-5 space-y-6">
                
                {{-- Dynamic USSD / Bank Instructions Card --}}
                <div class="glass-card rounded-3xl p-6 sm:p-8 shadow-xl"
                     style="background: var(--surface-card); border: 1px solid var(--border-light);">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-xl font-bold" style="background: rgba(246,178,25,0.2); color: var(--brand-yellow);">
                            📱
                        </div>
                        <div>
                            <h3 class="font-bold text-base" style="color: var(--text-primary);" id="instruction-title">
                                Vodacom M-Pesa Instructions
                            </h3>
                            <p class="text-xs" style="color: var(--text-muted);">Lipa kwa Namba / Merchant Till</p>
                        </div>
                    </div>

                    <div id="instruction-body" class="space-y-3 text-xs sm:text-sm leading-relaxed" style="color: var(--text-primary);">
                        {{-- M-Pesa default content --}}
                        <div class="p-3.5 rounded-xl flex items-center justify-between" style="background: var(--surface-bg); border: 1px solid var(--border-light);">
                            <span class="font-medium text-xs text-gray-500">Lipa Namba (Till No.):</span>
                            <span class="font-mono font-black text-base text-emerald-600">5544321</span>
                        </div>
                        <div class="p-3.5 rounded-xl flex items-center justify-between" style="background: var(--surface-bg); border: 1px solid var(--border-light);">
                            <span class="font-medium text-xs text-gray-500">Jina la Usajili:</span>
                            <span class="font-bold text-xs" style="color: var(--brand-blue);">HOPE FOR STUDENTS TZ</span>
                        </div>

                        <ol class="list-decimal list-inside space-y-1.5 pt-2 text-xs" style="color: var(--text-muted);">
                            <li>Piga <strong>*150*00#</strong> kwenye simu yako ya Vodacom</li>
                            <li>Chagua <strong>4 (Lipa kwa M-Pesa)</strong> kisha <strong>Lipa Namba</strong></li>
                            <li>Weka namba ya biashara: <strong>5544321</strong></li>
                            <li>Weka kiasi unachochangia</li>
                            <li>Weka neno lako la siri na thibitisha jina <em>HOPE FOR STUDENTS TZ</em></li>
                        </ol>
                    </div>

                    <div class="mt-6 pt-4 border-t text-xs flex items-center gap-2" style="border-color: var(--border-light); color: var(--text-muted);">
                        <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span>{{ app()->getLocale() === 'sw' ? 'Risiti rasmi ya kielektroniki inatolewa mara baada ya kuwasilisha.' : 'Official electronic receipt is issued immediately after submission.' }}</span>
                    </div>
                </div>

                {{-- Bank Accounts Reference Card --}}
                <div class="rounded-3xl p-6 sm:p-8 text-white relative overflow-hidden shadow-xl"
                     style="background: linear-gradient(135deg, var(--brand-blue-dark), var(--brand-blue));">
                    <div class="relative z-10 space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-amber-300">🏦 Official Bank Accounts</span>
                            <span class="text-xs font-semibold px-2 py-0.5 rounded bg-white/20">Arusha, Tanzania</span>
                        </div>

                        <div class="p-3.5 rounded-xl bg-white/10 backdrop-blur-sm border border-white/15">
                            <div class="text-xs font-bold text-emerald-300">CRDB BANK PLC</div>
                            <div class="text-sm font-mono font-black tracking-wide mt-0.5">0150234567800</div>
                            <div class="text-[11px] text-blue-200 mt-1">A/C Name: Hope for Students Tanzania | Branch: Arusha</div>
                        </div>

                        <div class="p-3.5 rounded-xl bg-white/10 backdrop-blur-sm border border-white/15">
                            <div class="text-xs font-bold text-amber-300">NMB BANK PLC</div>
                            <div class="text-sm font-mono font-black tracking-wide mt-0.5">20110023456</div>
                            <div class="text-[11px] text-blue-200 mt-1">A/C Name: Hope for Students Tanzania | Branch: Clock Tower</div>
                        </div>

                        <div class="text-[11px] text-blue-200 pt-1">
                            Swift Code: <strong>CORUTZTZ</strong> (CRDB) | <strong>NMBLTZTZ</strong> (NMB)
                        </div>
                    </div>
                </div>

                {{-- Transparency Pledge --}}
                <div class="p-5 rounded-2xl border text-xs leading-relaxed"
                     style="background: var(--surface-bg); border-color: var(--border-light); color: var(--text-muted);">
                    <strong style="color: var(--text-primary);">🤝 {{ app()->getLocale() === 'sw' ? 'Ahadi ya Uwazi:' : 'Transparency Pledge:' }}</strong>
                    {{ app()->getLocale() === 'sw' 
                        ? 'Asilimia 100 ya michango ya masomo inaelekezwa moja kwa moja kwenye ada za shule za wanafunzi na ununuzi wa vifaa vya kujifunzia.' 
                        : '100% of educational donations are directly directed to students\' verified school fees and learning materials.' }}
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function setPresetAmount(amt) {
    document.getElementById('custom-amount').value = amt;
    document.querySelectorAll('.preset-amt-btn').forEach(btn => {
        if (parseInt(btn.getAttribute('data-amount')) === amt) {
            btn.style.borderColor = 'var(--brand-green)';
            btn.style.backgroundColor = 'rgba(46,125,50,0.1)';
            btn.style.color = 'var(--brand-green)';
        } else {
            btn.style.borderColor = 'var(--border-light)';
            btn.style.backgroundColor = 'var(--surface-bg)';
            btn.style.color = 'var(--text-primary)';
        }
    });
}

function toggleTarget(val) {
    document.getElementById('target-project-wrapper').classList.toggle('hidden', val !== 'project');
    document.getElementById('target-student-wrapper').classList.toggle('hidden', val !== 'student');
}

const paymentInstructions = {
    'M-Pesa': {
        title: 'Vodacom M-Pesa Instructions',
        subtitle: 'Lipa kwa Namba / Merchant Till',
        till: '5544321',
        name: 'HOPE FOR STUDENTS TZ',
        steps: [
            'Piga *150*00# kwenye simu yako ya Vodacom',
            'Chagua 4 (Lipa kwa M-Pesa) kisha Lipa Namba',
            'Weka namba ya biashara: 5544321',
            'Weka kiasi na neno la siri kuthibitisha'
        ]
    },
    'Tigo Pesa': {
        title: 'Tigo Pesa / Mixx Instructions',
        subtitle: 'Lipa kwa Simu / Merchant Till',
        till: '6655443',
        name: 'HOPE FOR STUDENTS TZ',
        steps: [
            'Piga *150*01# kwenye simu yako ya Tigo',
            'Chagua 5 (Lipa kwa Simu)',
            'Weka namba ya mfanyabiashara: 6655443',
            'Weka kiasi na neno la siri kuthibitisha'
        ]
    },
    'Airtel Money': {
        title: 'Airtel Money Instructions',
        subtitle: 'Lipa na Airtel Money',
        till: '7788990',
        name: 'HOPE FOR STUDENTS TZ',
        steps: [
            'Piga *150*60# kwenye simu yako ya Airtel',
            'Chagua 5 (Lipa Bili / Huduma)',
            'Weka namba ya biashara: 7788990',
            'Weka kiasi na neno la siri kuthibitisha'
        ]
    },
    'Halopesa': {
        title: 'Halopesa Instructions',
        subtitle: 'Lipa kwa Halopesa',
        till: '3322110',
        name: 'HOPE FOR STUDENTS TZ',
        steps: [
            'Piga *150*88# kwenye simu yako ya Halotel',
            'Chagua 4 (Lipa kwa Halopesa)',
            'Weka namba ya biashara: 3322110',
            'Weka kiasi na neno la siri kuthibitisha'
        ]
    },
    'CRDB Bank': {
        title: 'CRDB Bank Direct Transfer',
        subtitle: 'SimBanking, Internet Banking au Tawi',
        till: 'A/C: 0150234567800',
        name: 'HOPE FOR STUDENTS TANZANIA',
        steps: [
            'Fungua SimBanking App au piga *150*03#',
            'Chagua Uhamisho wa Fedha (Fund Transfer)',
            'Weka nambari ya Akaunti: 0150234567800',
            'Tawi: Arusha Main Branch | Swift: CORUTZTZ'
        ]
    },
    'NMB Bank': {
        title: 'NMB Bank Direct Transfer',
        subtitle: 'NMB Mkononi, Internet Banking au Tawi',
        till: 'A/C: 20110023456',
        name: 'HOPE FOR STUDENTS TANZANIA',
        steps: [
            'Fungua NMB Mkononi App au piga *150*66#',
            'Chagua Tuma Fedha (Transfer)',
            'Weka nambari ya Akaunti: 20110023456',
            'Tawi: Clock Tower Arusha | Swift: NMBLTZTZ'
        ]
    }
};

function selectPaymentMethod(method, type) {
    const info = paymentInstructions[method];
    if (!info) return;

    document.getElementById('instruction-title').innerText = info.title;
    
    let html = `
        <div class="p-3.5 rounded-xl flex items-center justify-between" style="background: var(--surface-bg); border: 1px solid var(--border-light);">
            <span class="font-medium text-xs text-gray-500">${info.subtitle}:</span>
            <span class="font-mono font-black text-base text-emerald-600">${info.till}</span>
        </div>
        <div class="p-3.5 rounded-xl flex items-center justify-between" style="background: var(--surface-bg); border: 1px solid var(--border-light);">
            <span class="font-medium text-xs text-gray-500">Jina la Akaunti:</span>
            <span class="font-bold text-xs" style="color: var(--brand-blue);">${info.name}</span>
        </div>
        <ol class="list-decimal list-inside space-y-1.5 pt-2 text-xs" style="color: var(--text-muted);">
            ${info.steps.map(s => `<li>${s}</li>`).join('')}
        </ol>
    `;

    document.getElementById('instruction-body').innerHTML = html;
}

document.addEventListener('DOMContentLoaded', () => {
    setPresetAmount(50000);
});
</script>
@endpush
