<?php

namespace App\Filament\Donor\Resources;

use App\Filament\Donor\Resources\DonationHistoryResource\Pages;
use App\Models\Donation;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DonationHistoryResource extends Resource
{
    protected static ?string $model = Donation::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'My Donations';
    protected static ?string $pluralModelLabel = 'My Donations';
    protected static string|\UnitEnum|null $navigationGroup = 'My Donations';
    protected static ?int $navigationSort = 2;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('donor_id', auth()->user()->donor?->id);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            // read-only; donors create donations via MakeDonationPage
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('amount')
                    ->money('TZS')
                    ->sortable(),
                Tables\Columns\TextColumn::make('project.name')
                    ->label('Project')
                    ->default('General Donation'),
                Tables\Columns\TextColumn::make('student.first_name')
                    ->label('Sponsored Student')
                    ->formatStateUsing(fn ($record) => $record->student ? $record->student->first_name . ' ' . $record->student->last_name : '—'),
                Tables\Columns\TextColumn::make('payment_method')
                    ->badge(),
                Tables\Columns\TextColumn::make('transaction_id')
                    ->label('Ref. No.')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Confirmed' => 'success',
                        'Failed'    => 'danger',
                        default     => 'warning',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->label('Date')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                \Filament\Actions\ViewAction::make(),
                \Filament\Actions\Action::make('download_receipt')
                    ->label('Receipt')
                    ->icon('heroicon-m-document-arrow-down')
                    ->color('success')
                    ->url(fn ($record) => route('donor.receipt', $record->id))
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => $record->status === 'Confirmed'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDonationHistories::route('/'),
        ];
    }
}
