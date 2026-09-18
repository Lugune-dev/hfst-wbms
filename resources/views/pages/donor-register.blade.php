@extends('layouts.app')

@section('title', 'Jisajili Kama Mfadhili — Hope for Students Tanzania')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8" style="background: var(--surface-bg);">
    <div class="max-w-2xl w-full space-y-8 glass-card p-8 sm:p-12 rounded-3xl" style="background: var(--surface-card); box-shadow: 0 20px 40px rgba(0,0,0,0.08);">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold" style="color: var(--brand-blue);">Jisajili Kama Mfadhili</h2>
            <p class="mt-2 text-sm" style="color: var(--text-muted);">Jiunge nasi kuwasaidia wanafunzi wa Tanzania kupitia elimu.</p>
        </div>

        @if ($errors->any())
            <div class="rounded-lg p-4" style="background: rgba(220,38,38,0.08); border: 1px solid rgba(220,38,38,0.3);">
                <ul class="text-sm space-y-1" style="color: #DC2626;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('donor.register.store') }}" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold mb-1" style="color: var(--text-primary);">Jina Kamili (Full Name)</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full rounded-lg px-4 py-2.5 border" style="border-color: var(--border-light);">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1" style="color: var(--text-primary);">Barua Pepe (Email)</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full rounded-lg px-4 py-2.5 border" style="border-color: var(--border-light);">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1" style="color: var(--text-primary);">Namba ya Simu (Phone)</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" required
                        class="w-full rounded-lg px-4 py-2.5 border" style="border-color: var(--border-light);">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1" style="color: var(--text-primary);">Aina ya Mfadhili (Donor Type)</label>
                    <select name="donor_type" required class="w-full rounded-lg px-4 py-2.5 border" style="border-color: var(--border-light);">
                        <option value="Individual" {{ old('donor_type') === 'Individual' ? 'selected' : '' }}>Mtu Binafsi (Individual)</option>
                        <option value="Corporate" {{ old('donor_type') === 'Corporate' ? 'selected' : '' }}>Kampuni (Corporate)</option>
                        <option value="NGO" {{ old('donor_type') === 'NGO' ? 'selected' : '' }}>Taasisi Isiyo ya Kiserikali (NGO)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1" style="color: var(--text-primary);">Jina la Taasisi (Optional)</label>
                    <input type="text" name="organization_name" value="{{ old('organization_name') }}"
                        class="w-full rounded-lg px-4 py-2.5 border" style="border-color: var(--border-light);">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1" style="color: var(--text-primary);">Nchi (Country)</label>
                    <input type="text" name="country" value="{{ old('country', 'Tanzania') }}"
                        class="w-full rounded-lg px-4 py-2.5 border" style="border-color: var(--border-light);">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-semibold mb-1" style="color: var(--text-primary);">Anwani (Address)</label>
                    <input type="text" name="address" value="{{ old('address') }}" required
                        class="w-full rounded-lg px-4 py-2.5 border" style="border-color: var(--border-light);">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1" style="color: var(--text-primary);">Nenosiri (Password)</label>
                    <input type="password" name="password" required minlength="8"
                        class="w-full rounded-lg px-4 py-2.5 border" style="border-color: var(--border-light);">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1" style="color: var(--text-primary);">Thibitisha Nenosiri (Confirm)</label>
                    <input type="password" name="password_confirmation" required minlength="8"
                        class="w-full rounded-lg px-4 py-2.5 border" style="border-color: var(--border-light);">
                </div>
            </div>

            <button type="submit"
                class="w-full py-3 rounded-lg font-bold text-white transition hover:opacity-90"
                style="background: var(--brand-green);">
                Jisajili Sasa (Register Now)
            </button>
        </form>

        <p class="text-center text-sm" style="color: var(--text-muted);">
            Una akaunti tayari? <a href="/donor/login" class="font-semibold hover:underline" style="color: var(--brand-blue);">Ingia Hapa (Login)</a>
        </p>
    </div>
</div>
@endsection
