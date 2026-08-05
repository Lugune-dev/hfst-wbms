<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Header --}}
        <div class="rounded-xl bg-gradient-to-r from-slate-700 to-slate-900 p-6 text-white">
            <h2 class="text-xl font-bold">👤 My Profile & Privacy</h2>
            <p class="mt-1 text-slate-300">Update your personal information and contact details.</p>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <form wire:submit="save">
                {{ $this->form }}
                <div class="mt-6 flex justify-end">
                    <x-filament::button type="submit" color="primary" size="lg" icon="heroicon-m-check">
                        Save Profile
                    </x-filament::button>
                </div>
            </form>
        </div>

        {{-- Privacy Note --}}
        <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4 dark:border-yellow-800 dark:bg-yellow-900/20">
            <h4 class="font-semibold text-yellow-800 dark:text-yellow-300">🔒 Your Privacy</h4>
            <p class="mt-1 text-sm text-yellow-700 dark:text-yellow-400">
                Your personal information is kept confidential and is only used for donation management purposes.
                We comply with data protection regulations and will never share your data with third parties without your consent.
            </p>
        </div>
    </div>
</x-filament-panels::page>
