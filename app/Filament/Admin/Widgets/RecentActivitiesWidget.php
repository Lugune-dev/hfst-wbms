<?php

namespace App\Filament\Admin\Widgets;

use App\Models\AidApplication;
use App\Models\Donation;
use App\Models\Message;
use App\Models\Student;
use Filament\Widgets\Widget;

class RecentActivitiesWidget extends Widget
{
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 2;
    protected string $view = 'filament.admin.widgets.recent-activities';

    public function getActivities(): array
    {
        $activities = [];

        // Recent student registrations
        $students = Student::latest()->take(5)->get();
        foreach ($students as $s) {
            $activities[] = [
                'type'  => 'student',
                'icon'  => 'heroicon-o-user-plus',
                'color' => 'text-blue-500',
                'bg'    => 'bg-blue-100 dark:bg-blue-900/30',
                'title' => 'New student registered: ' . $s->first_name . ' ' . $s->last_name,
                'sub'   => $s->school . ' · ' . $s->education_level,
                'time'  => $s->created_at->diffForHumans(),
            ];
        }

        // Recent donations
        $donations = Donation::with('donor')->latest()->take(5)->get();
        foreach ($donations as $d) {
            $activities[] = [
                'type'  => 'donation',
                'icon'  => 'heroicon-o-currency-dollar',
                'color' => 'text-green-500',
                'bg'    => 'bg-green-100 dark:bg-green-900/30',
                'title' => 'Donation received: TZS ' . number_format($d->amount, 0),
                'sub'   => 'Status: ' . $d->status . ' · ' . ($d->payment_method ?? 'N/A'),
                'time'  => $d->created_at->diffForHumans(),
            ];
        }

        // Recent aid applications
        $apps = AidApplication::latest()->take(3)->get();
        foreach ($apps as $app) {
            $activities[] = [
                'type'  => 'aid',
                'icon'  => 'heroicon-o-hand-raised',
                'color' => 'text-yellow-500',
                'bg'    => 'bg-yellow-100 dark:bg-yellow-900/30',
                'title' => 'Aid application submitted',
                'sub'   => 'Status: ' . $app->status,
                'time'  => $app->created_at->diffForHumans(),
            ];
        }

        // Recent messages
        $messages = Message::latest()->take(3)->get();
        foreach ($messages as $msg) {
            $activities[] = [
                'type'  => 'message',
                'icon'  => 'heroicon-o-envelope',
                'color' => 'text-purple-500',
                'bg'    => 'bg-purple-100 dark:bg-purple-900/30',
                'title' => 'New message: ' . $msg->subject,
                'sub'   => 'From: ' . $msg->name,
                'time'  => $msg->created_at->diffForHumans(),
            ];
        }

        // Sort by most recent via time comparison isn't possible here without actual timestamps,
        // so we just return them all; blade will render them in order
        return array_slice($activities, 0, 10);
    }
}
