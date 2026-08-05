<?php

namespace App\Filament\Donor\Pages;

use App\Models\Donation;
use App\Models\Project;
use App\Models\Student;
use App\Models\Donor;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;

class MakeDonationPage extends Page
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-banknotes';
    protected string $view = 'filament.donor.pages.make-donation-page';
    protected static ?string $navigationLabel = 'Make a Donation';
    protected static ?string $title = 'Make a Donation (Toa Mchango)';
    protected static string|\UnitEnum|null $navigationGroup = 'My Donations';
    protected static ?int $navigationSort = 1;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('amount')
                    ->label('Amount (Kiasi) – TZS')
                    ->numeric()
                    ->required()
                    ->minValue(1000)
                    ->prefix('TZS')
                    ->placeholder('e.g. 50000'),

                Select::make('payment_method')
                    ->label('Payment Method (Njia ya Malipo)')
                    ->options([
                        'Mobile Money'  => '📱 Mobile Money (M-Pesa / Tigo Pesa / Airtel Money)',
                        'Bank Transfer' => '🏦 Bank Transfer',
                        'Cash'          => '💵 Cash',
                    ])
                    ->required(),

                TextInput::make('transaction_id')
                    ->label('Transaction Reference / Receipt No.')
                    ->required()
                    ->placeholder('e.g. MP123456789'),

                Select::make('student_id')
                    ->label('Sponsor a Specific Student (Optional)')
                    ->options(
                        Student::where('status', 'Active')
                            ->get()
                            ->mapWithKeys(fn ($s) => [$s->id => $s->first_name . ' ' . $s->last_name . ' – ' . $s->school])
                    )
                    ->searchable()
                    ->placeholder('— General donation —'),

                Select::make('project_id')
                    ->label('Donate to a Specific Project (Optional)')
                    ->options(
                        Project::where('status', 'Active')
                            ->pluck('name', 'id')
                    )
                    ->searchable()
                    ->placeholder('— General donation —'),

                Textarea::make('notes')
                    ->label('Additional Notes (Maelezo)')
                    ->rows(3)
                    ->placeholder('Any special instructions or message...'),
            ])
            ->statePath('data')
            ->columns(2);
    }

    public function submit(): void
    {
        $donor = auth()->user()->donor;

        if (!$donor) {
            Notification::make()
                ->title('No donor profile found. Please contact admin.')
                ->danger()
                ->send();
            return;
        }

        $validated = $this->form->getState();

        Donation::create([
            'donor_id'       => $donor->id,
            'student_id'     => $validated['student_id'] ?? null,
            'project_id'     => $validated['project_id'] ?? null,
            'amount'         => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'transaction_id' => $validated['transaction_id'],
            'notes'          => $validated['notes'] ?? null,
            'status'         => 'Pending',
        ]);

        $this->form->fill();

        Notification::make()
            ->title('Thank you! Your donation has been submitted for confirmation.')
            ->body('Our team will verify your transaction and confirm it shortly.')
            ->success()
            ->send();
    }
}
