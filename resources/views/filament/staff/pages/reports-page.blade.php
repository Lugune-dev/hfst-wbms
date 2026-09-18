<x-filament-panels::page>
    @php
        $students = $this->getStudentSummary();
        $projects = $this->getProjectSummary();
        $aid      = $this->getAidSummary();
    @endphp

    <div class="space-y-6">
        <div class="rounded-2xl p-6 text-white relative overflow-hidden"
             style="background: linear-gradient(135deg, #2E7D32 0%, #196c34 55%, #13385E 100%);">
            <h2 class="text-xl font-black">📊 Ripoti za Wanafunzi na Miradi</h2>
            <p class="mt-1 text-white/80">Muhtasari wa haraka na upakuaji wa taarifa kwa Excel.</p>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="rounded-xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 p-6 shadow-sm">
                <h3 class="mb-4 text-base font-bold text-gray-900 dark:text-white">🎓 Wanafunzi</h3>
                <dl class="space-y-2 text-sm">
                    <div class="flex justify-between"><dt class="text-gray-500">Wote</dt><dd class="font-bold text-gray-900 dark:text-white">{{ $students['total'] }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Hai</dt><dd class="font-bold text-green-600">{{ $students['active'] }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Wahitimu</dt><dd class="font-bold text-blue-600">{{ $students['graduated'] }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Walioacha</dt><dd class="font-bold text-red-600">{{ $students['dropped'] }}</dd></div>
                </dl>
            </div>

            <div class="rounded-xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 p-6 shadow-sm">
                <h3 class="mb-4 text-base font-bold text-gray-900 dark:text-white">📁 Miradi</h3>
                <dl class="space-y-2 text-sm">
                    <div class="flex justify-between"><dt class="text-gray-500">Miradi Yote</dt><dd class="font-bold text-gray-900 dark:text-white">{{ $projects['total'] }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Hai</dt><dd class="font-bold text-green-600">{{ $projects['active'] }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Bajeti Jumla</dt><dd class="font-bold text-gray-900 dark:text-white">TZS {{ number_format($projects['budget'], 0) }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Kilichopatikana</dt><dd class="font-bold text-blue-600">TZS {{ number_format($projects['funded'], 0) }}</dd></div>
                </dl>
            </div>

            <div class="rounded-xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 p-6 shadow-sm">
                <h3 class="mb-4 text-base font-bold text-gray-900 dark:text-white">🤝 Maombi ya Msaada</h3>
                <dl class="space-y-2 text-sm">
                    <div class="flex justify-between"><dt class="text-gray-500">Yanayosubiri</dt><dd class="font-bold text-yellow-600">{{ $aid['pending'] }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Yaliyoidhinishwa</dt><dd class="font-bold text-green-600">{{ $aid['approved'] }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Yaliyokataliwa</dt><dd class="font-bold text-red-600">{{ $aid['rejected'] }}</dd></div>
                </dl>
            </div>
        </div>
    </div>
</x-filament-panels::page>
