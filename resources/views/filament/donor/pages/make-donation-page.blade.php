<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Header --}}
        <div class="rounded-xl bg-gradient-to-r from-green-600 to-teal-700 p-6 text-white">
            <h2 class="text-xl font-bold">💚 Make a Donation (Toa Mchango)</h2>
            <p class="mt-1 text-green-100">Fill in the details below to submit your contribution. Our team will verify and confirm your transaction.</p>
        </div>

        {{-- Form --}}
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <form wire:submit="submit">
                {{ $this->form }}
                <div class="mt-6 flex justify-end">
                    <x-filament::button type="submit" color="success" size="lg" icon="heroicon-m-heart">
                        Submit Donation
                    </x-filament::button>
                </div>
            </form>
        </div>

        {{-- Information Box --}}
        <div class="rounded-lg border border-blue-200 bg-blue-50 p-4 dark:border-blue-800 dark:bg-blue-900/20">
            <h4 class="font-semibold text-blue-800 dark:text-blue-300">📌 Payment Instructions</h4>
            <ul class="mt-2 space-y-1 text-sm text-blue-700 dark:text-blue-400">
                <li>• <strong>Mobile Money:</strong> Send to <strong>+255 XXX XXX XXX</strong> (M-Pesa / Tigo Pesa / Airtel Money)</li>
                <li>• <strong>Bank Transfer:</strong> Account Name: Hope for Students Tanzania | Bank: CRDB | Account No: XXXX-XXX-XXX</li>
                <li>• Enter your transaction reference number exactly as shown in your SMS/receipt.</li>
                <li>• A team member will confirm your donation within 24 hours.</li>
            </ul>
        </div>
    </div>
</x-filament-panels::page>
