<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DonorResource\Pages;
use App\Models\Donor;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DonorResource extends Resource
{
    protected static ?string $model = Donor::class;
    // protected static string | \BackedEnum | null $navigationIcon = null;
    protected static string | \UnitEnum | null $navigationGroup = 'People';
    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'user.name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Section::make('Donor Account')->components([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Linked User Account'),
                Forms\Components\Select::make('donor_type')
                    ->options([
                        'Individual' => 'Individual',
                        'Corporate'  => 'Corporate',
                        'NGO'        => 'NGO',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('organization_name')
                    ->label('Organization Name (if applicable)')
                    ->maxLength(255),
            ])->columns(3),

            \Filament\Schemas\Components\Section::make('Contact Information')->components([
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(20),
                Forms\Components\Textarea::make('address')
                    ->required()
                    ->rows(2),
                Forms\Components\TextInput::make('country')
                    ->required()
                    ->default('Tanzania'),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('organization_name')
                    ->label('Organization')
                    ->searchable(),
                Tables\Columns\TextColumn::make('donor_type')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'Corporate' => 'warning',
                        'NGO'       => 'info',
                        default     => 'success',
                    }),
                Tables\Columns\TextColumn::make('country'),
                Tables\Columns\TextColumn::make('donations_count')
                    ->counts('donations')
                    ->label('Donations'),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('donor_type')
                    ->options(['Individual' => 'Individual', 'Corporate' => 'Corporate', 'NGO' => 'NGO']),
                Tables\Filters\SelectFilter::make('country'),
            ])
            ->headerActions([
                \Filament\Actions\Action::make('export_csv')
                    ->label('Export CSV Report')
                    ->icon('heroicon-m-arrow-down-tray')
                    ->color('success')
                    ->action(function () {
                        $donors = \App\Models\Donor::with('user')->withCount('donations')->get();
                        $csvData  = "ID,Name,Email,Organization,Donor Type,Country,Phone,Donations Count\n";
                        foreach ($donors as $d) {
                            $csvData .= implode(',', [
                                $d->id,
                                '"' . ($d->user->name ?? '') . '"',
                                '"' . ($d->user->email ?? '') . '"',
                                '"' . $d->organization_name . '"',
                                $d->donor_type,
                                '"' . $d->country . '"',
                                '"' . $d->phone . '"',
                                $d->donations_count,
                            ]) . "\n";
                        }
                        return response()->streamDownload(
                            fn () => print($csvData),
                            'hfst-donors-' . now()->format('Y-m-d') . '.csv',
                            ['Content-Type' => 'text/csv']
                        );
                    }),
            ])
            ->actions([
                \Filament\Actions\ViewAction::make(),
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListDonors::route('/'),
            'create' => Pages\CreateDonor::route('/create'),
            'view'   => Pages\ViewDonor::route('/{record}'),
            'edit'   => Pages\EditDonor::route('/{record}/edit'),
        ];
    }
}
