<?php

namespace App\Filament\Student\Pages;

use App\Models\Student;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Notifications\Notification;


class MyProgressReportPage extends Page
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-chart-bar';
    protected string $view = 'filament.student.pages.my-progress-report-page';
    protected static ?string $navigationLabel = 'Progress Reports';
    protected static ?string $title = 'My Progress Reports (Ripoti za Maendeleo)';
    protected static string|\UnitEnum|null $navigationGroup = 'Education';
    protected static ?int $navigationSort = 2;

    public ?array $data = [];

    public function mount(): void
    {
        $student = auth()->user()->student;
        $this->form->fill([
            'documents' => $student?->documents ?? [],
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('documents')
                    ->label('Upload Report Cards & Progress Documents')
                    ->helperText('Upload your school report forms (PDF or image). These will be reviewed by your sponsoring staff.')
                    ->multiple()
                    ->directory('student-progress-reports')
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->maxSize(5120)
                    ->downloadable()
                    ->openable()
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $student = auth()->user()->student;

        if (!$student) {
            Notification::make()
                ->title('No student profile found.')
                ->danger()
                ->send();
            return;
        }

        $docs = $this->data['documents'] ?? [];
        if (is_array($docs)) {
            $docs = array_values(array_filter($docs, fn($d) => is_string($d)));
        } else {
            $docs = [];
        }

        $student->update([
            'documents' => $docs,
        ]);

        Notification::make()
            ->title('Progress reports uploaded successfully!')
            ->success()
            ->send();
    }

    public function getStudent(): ?Student
    {
        return auth()->user()->student;
    }
}
