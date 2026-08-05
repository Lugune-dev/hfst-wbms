<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Donation;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentDonationsWidget extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Donation::query()
                    ->with(['donor.user', 'student', 'project'])
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('donor.user.name')
                    ->label('Donor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Amount (TZS)')
                    ->formatStateUsing(fn ($state) => 'TZS ' . number_format($state, 0))
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Method')
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Confirmed' => 'success',
                        'Failed'    => 'danger',
                        default     => 'warning',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d M Y')
                    ->sortable(),
            ]);
    }
}
