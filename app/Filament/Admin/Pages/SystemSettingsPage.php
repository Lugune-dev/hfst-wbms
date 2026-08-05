<?php

namespace App\Filament\Admin\Pages;

use App\Models\User;
use App\Models\Student;
use App\Models\Donation;
use App\Models\Project;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class SystemSettingsPage extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected string $view = 'filament.admin.pages.system-settings-page';
    protected static ?string $navigationLabel = 'System Settings';
    protected static ?string $title = 'System Settings & Security';
    protected static string|\UnitEnum|null $navigationGroup = 'System';
    protected static ?int $navigationSort = 5;

    public function getSystemStats(): array
    {
        return [
            'laravel_version'   => app()->version(),
            'php_version'       => PHP_VERSION,
            'total_users'       => User::count(),
            'total_students'    => Student::count(),
            'total_donations'   => Donation::count(),
            'total_projects'    => Project::count(),
            'storage_path'      => storage_path(),
            'app_env'           => config('app.env'),
            'app_debug'         => config('app.debug') ? 'Enabled' : 'Disabled',
        ];
    }

    public function getSystemLogs(): string
    {
        $logPath = storage_path('logs/laravel.log');
        if (!file_exists($logPath)) {
            return 'No logs found.';
        }

        $content = @file_get_contents($logPath, false, null, max(0, filesize($logPath) - 5000));
        return $content ?: 'Log file is empty.';
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('run_backup')
                ->label('Run Automated Backup')
                ->icon('heroicon-o-circle-stack')
                ->color('primary')
                ->requiresConfirmation()
                ->action(function () {
                    try {
                        Artisan::call('backup:run');
                        \Filament\Notifications\Notification::make()
                            ->title('Backup completed successfully.')
                            ->success()
                            ->send();
                    } catch (\Exception $e) {
                        \Filament\Notifications\Notification::make()
                            ->title('Backup failed.')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}
