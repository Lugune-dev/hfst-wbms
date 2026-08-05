<?php

namespace App\Filament\Donor\Pages;

use App\Models\Donor;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;

class DonorProfilePage extends Page
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-circle';
    protected string $view = 'filament.donor.pages.donor-profile-page';
    protected static ?string $navigationLabel = 'My Profile';
    protected static ?string $title = 'My Profile & Privacy (Wasifu Wangu)';
    protected static string|\UnitEnum|null $navigationGroup = 'Account';
    protected static ?int $navigationSort = 1;

    public ?array $data = [];

    public function mount(): void
    {
        $donor = auth()->user()->donor;
        $user  = auth()->user();

        $this->form->fill([
            'name'              => $user->name,
            'email'             => $user->email,
            'phone'             => $donor?->phone ?? $user->phone,
            'address'           => $donor?->address,
            'country'           => $donor?->country ?? 'Tanzania',
            'organization_name' => $donor?->organization_name,
            'donor_type'        => $donor?->donor_type ?? 'Individual',
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Full Name')
                    ->required(),

                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->disabled(),

                TextInput::make('phone')
                    ->label('Phone Number')
                    ->tel()
                    ->required(),

                Select::make('donor_type')
                    ->label('Donor Type')
                    ->options([
                        'Individual' => 'Individual (Mtu Binafsi)',
                        'Corporate'  => 'Corporate (Kampuni)',
                        'NGO'        => 'NGO / Organization',
                    ])
                    ->required(),

                TextInput::make('organization_name')
                    ->label('Organization Name (if applicable)')
                    ->placeholder('Leave blank if individual'),

                TextInput::make('address')
                    ->label('Address')
                    ->placeholder('Your physical address'),

                Select::make('country')
                    ->label('Country')
                    ->options([
                        'Tanzania'       => 'Tanzania',
                        'Kenya'          => 'Kenya',
                        'Uganda'         => 'Uganda',
                        'USA'            => 'USA',
                        'UK'             => 'United Kingdom',
                        'Germany'        => 'Germany',
                        'Canada'         => 'Canada',
                        'Other'          => 'Other',
                    ])
                    ->searchable()
                    ->default('Tanzania'),
            ])
            ->statePath('data')
            ->columns(2);
    }

    public function save(): void
    {
        $data  = $this->form->getState();
        $user  = auth()->user();
        $donor = $user->donor;

        $user->update(['name' => $data['name']]);

        if ($donor) {
            $donor->update([
                'phone'             => $data['phone'],
                'address'           => $data['address'],
                'country'           => $data['country'],
                'organization_name' => $data['organization_name'],
                'donor_type'        => $data['donor_type'],
            ]);
        }

        Notification::make()
            ->title('Profile updated successfully!')
            ->success()
            ->send();
    }
}
