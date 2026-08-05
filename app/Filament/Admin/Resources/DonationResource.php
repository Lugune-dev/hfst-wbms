<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DonationResource\Pages;
use App\Models\Donation;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DonationResource extends Resource
{
    protected static ?string $model = Donation::class;
    // protected static string | \BackedEnum | null $navigationIcon = 'null';
    protected static string | \UnitEnum | null $navigationGroup = 'Finance';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Section::make('Donation Details')->components([
                Forms\Components\Select::make('donor_id')
                    ->relationship('donor.user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'first_name')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->first_name . ' ' . $record->last_name)
                    ->searchable()
                    ->preload()
                    ->label('Allocate to Student (Optional)'),
                Forms\Components\Select::make('project_id')
                    ->relationship('project', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Allocate to Project (Optional)'),
                Forms\Components\TextInput::make('amount')
                    ->numeric()
                    ->required()
                    ->minValue(1)
                    ->prefix('TZS'),
                Forms\Components\Select::make('payment_method')
                    ->options([
                        'Mobile Money' => 'Mobile Money',
                        'Bank Transfer' => 'Bank Transfer',
                        'Cash' => 'Cash',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('transaction_id')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\Select::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Confirmed' => 'Confirmed',
                        'Failed' => 'Failed',
                    ])
                    ->default('Pending')
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('donor.user.name')
                    ->label('Donor')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->money('TZS')
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->badge(),
                Tables\Columns\TextColumn::make('transaction_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Confirmed' => 'success',
                        'Failed' => 'danger',
                        default => 'warning',
                    }),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['Pending' => 'Pending', 'Confirmed' => 'Confirmed', 'Failed' => 'Failed']),
                Tables\Filters\SelectFilter::make('payment_method')
                    ->options(['Mobile Money' => 'Mobile Money', 'Bank Transfer' => 'Bank Transfer', 'Cash' => 'Cash']),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('from')->label('From Date'),
                        \Filament\Forms\Components\DatePicker::make('until')->label('Until Date'),
                    ])
                    ->query(function (\Illuminate\Database\Eloquent\Builder $query, array $data) {
                        return $query
                            ->when($data['from'], fn ($q) => $q->whereDate('created_at', '>=', $data['from']))
                            ->when($data['until'], fn ($q) => $q->whereDate('created_at', '<=', $data['until']));
                    }),
            ])
            ->headerActions([
                \Filament\Actions\Action::make('export_csv')
                    ->label('Export CSV Report')
                    ->icon('heroicon-m-arrow-down-tray')
                    ->color('success')
                    ->action(function () {
                        $donations = \App\Models\Donation::with(['donor.user', 'student', 'project'])->get();
                        $csvData   = "ID,Donor,Amount (TZS),Payment Method,Transaction ID,Student,Project,Status,Date\n";
                        foreach ($donations as $d) {
                            $csvData .= implode(',', [
                                $d->id,
                                '"' . ($d->donor->user->name ?? '') . '"',
                                $d->amount,
                                $d->payment_method,
                                $d->transaction_id,
                                '"' . ($d->student ? $d->student->first_name . ' ' . $d->student->last_name : '') . '"',
                                '"' . ($d->project->name ?? '') . '"',
                                $d->status,
                                $d->created_at->format('Y-m-d'),
                            ]) . "\n";
                        }
                        return response()->streamDownload(
                            fn () => print($csvData),
                            'hfst-donations-' . now()->format('Y-m-d') . '.csv',
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
            'index' => Pages\ListDonations::route('/'),
            'create' => Pages\CreateDonation::route('/create'),
            'view' => Pages\ViewDonation::route('/{record}'),
            'edit' => Pages\EditDonation::route('/{record}/edit'),
        ];
    }
}
