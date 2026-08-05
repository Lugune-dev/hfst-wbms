<x-filament-panels::page>
    @php $stats = $this->getSystemStats(); @endphp

    <div class="space-y-6">
        {{-- Header --}}
        <div class="rounded-xl bg-gradient-to-r from-gray-800 to-gray-900 p-6 text-white">
            <h2 class="text-xl font-bold">⚙️ System Settings & Security</h2>
            <p class="mt-1 text-gray-300">Monitor system health, environment settings, and operational statistics.</p>
        </div>

        {{-- System Info Cards --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-lg border bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <p class="text-xs font-medium uppercase text-gray-500 dark:text-gray-400">Laravel Version</p>
                <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['laravel_version'] }}</p>
            </div>
            <div class="rounded-lg border bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <p class="text-xs font-medium uppercase text-gray-500 dark:text-gray-400">PHP Version</p>
                <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['php_version'] }}</p>
            </div>
            <div class="rounded-lg border bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <p class="text-xs font-medium uppercase text-gray-500 dark:text-gray-400">Environment</p>
                <p class="mt-1 text-2xl font-bold {{ $stats['app_env'] === 'production' ? 'text-green-600' : 'text-yellow-500' }}">
                    {{ ucfirst($stats['app_env']) }}
                </p>
            </div>
            <div class="rounded-lg border bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <p class="text-xs font-medium uppercase text-gray-500 dark:text-gray-400">Debug Mode</p>
                <p class="mt-1 text-2xl font-bold {{ $stats['app_debug'] === 'Enabled' ? 'text-red-500' : 'text-green-600' }}">
                    {{ $stats['app_debug'] }}
                </p>
            </div>
        </div>

        {{-- Database Stats --}}
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <h3 class="mb-4 text-base font-semibold text-gray-900 dark:text-white">📊 Database Overview</h3>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                <div class="rounded-lg bg-blue-50 p-4 text-center dark:bg-blue-900/20">
                    <p class="text-3xl font-bold text-blue-700 dark:text-blue-300">{{ $stats['total_users'] }}</p>
                    <p class="text-sm text-blue-600 dark:text-blue-400">Total Users</p>
                </div>
                <div class="rounded-lg bg-green-50 p-4 text-center dark:bg-green-900/20">
                    <p class="text-3xl font-bold text-green-700 dark:text-green-300">{{ $stats['total_students'] }}</p>
                    <p class="text-sm text-green-600 dark:text-green-400">Students</p>
                </div>
                <div class="rounded-lg bg-yellow-50 p-4 text-center dark:bg-yellow-900/20">
                    <p class="text-3xl font-bold text-yellow-700 dark:text-yellow-300">{{ $stats['total_donations'] }}</p>
                    <p class="text-sm text-yellow-600 dark:text-yellow-400">Donations</p>
                </div>
                <div class="rounded-lg bg-purple-50 p-4 text-center dark:bg-purple-900/20">
                    <p class="text-3xl font-bold text-purple-700 dark:text-purple-300">{{ $stats['total_projects'] }}</p>
                    <p class="text-sm text-purple-600 dark:text-purple-400">Projects</p>
                </div>
            </div>
        </div>

        {{-- Security Actions --}}
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <h3 class="mb-4 text-base font-semibold text-gray-900 dark:text-white">🔐 Security & Maintenance</h3>
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                <div class="flex items-start gap-3 rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <span class="text-2xl">🛡️</span>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Role-Based Access Control</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Manage user roles via the Users resource under People navigation.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <span class="text-2xl">📦</span>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Storage Path</p>
                        <p class="text-sm font-mono text-gray-500 dark:text-gray-400">{{ $stats['storage_path'] }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <span class="text-2xl">📋</span>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Error Logs</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Check <code>storage/logs/laravel.log</code> for application errors.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                    <span class="text-2xl">💾</span>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Database Backups</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Use <code>php artisan backup:run</code> or schedule automated backups via cron.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- System Logs --}}
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <h3 class="mb-4 text-base font-semibold text-gray-900 dark:text-white">📋 Recent Error Logs</h3>
            <div class="rounded bg-gray-900 p-4 text-xs text-green-400 overflow-x-auto" style="max-height: 400px; overflow-y: auto; white-space: pre-wrap; word-wrap: break-word;">
                <pre><code>{{ $this->getSystemLogs() }}</code></pre>
            </div>
        </div>
    </div>
</x-filament-panels::page>
