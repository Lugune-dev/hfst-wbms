<?php

namespace App\Filament\Staff\Resources;

use App\Filament\Staff\Resources\AidApplicationResource\Pages;
use App\Models\AidApplication;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AidApplicationResource extends Resource
{
    protected static ?string $model = AidApplication::class;
    public static function getNavigationLabel(): string
    {
        return app()->getLocale() === 'sw' ? 'Maombi ya Ufadhili' : 'Aid Applications';
    }

    public static function getPluralModelLabel(): string
    {
        return app()->getLocale() === 'sw' ? 'Maombi ya Ufadhili' : 'Aid Applications';
    }

    public static function getModelLabel(): string
    {
        return app()->getLocale() === 'sw' ? 'Ombi la Ufadhili' : 'Aid Application';
    }

    public static function getNavigationGroup(): ?string
    {
        return app()->getLocale() === 'sw' ? '1. Usimamizi wa Wanafunzi' : '1. Student Management';
    }

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Section::make('Student & Request')->components([
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'first_name')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->first_name . ' ' . $record->last_name)
                    ->required()
                    ->searchable()
                    ->preload()
                    ->disabled(),

                Forms\Components\CheckboxList::make('types')
                    ->label('Aid Types Requested')
                    ->options([
                        'fees'    => 'School Fees',
                        'books'   => 'Books & Stationery',
                        'uniform' => 'School Uniform',
                        'food'    => 'Food / Nutrition',
                        'housing' => 'Housing',
                    ])
                    ->columns(3)
                    ->disabled(),

                Forms\Components\Textarea::make('description')
                    ->label('Student Description')
                    ->rows(3)
                    ->disabled()
                    ->columnSpanFull(),
            ])->columns(2),

            \Filament\Schemas\Components\Section::make('Staff Review Notes')->components([
                Forms\Components\Select::make('status')
                    ->options([
                        'Pending'  => 'Pending',
                        'Approved' => '✅ Approved',
                        'Rejected' => '❌ Rejected',
                    ])
                    ->required(),

                Forms\Components\Textarea::make('reviewer_notes')
                    ->label('Notes for Student')
                    ->rows(3)
                    ->placeholder('Explain your decision to the student...')
                    ->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.first_name')
                    ->label('Student')
                    ->formatStateUsing(fn ($record) => $record->student->first_name . ' ' . $record->student->last_name)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('types')
                    ->label('Aid Types')
                    ->formatStateUsing(fn ($state) => is_array($state) ? implode(', ', array_map('ucfirst', $state)) : $state)
                    ->wrap(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Approved' => 'success',
                        'Rejected' => 'danger',
                        default    => 'warning',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['Pending' => 'Pending', 'Approved' => 'Approved', 'Rejected' => 'Rejected']),
            ])
            ->actions([
                \Filament\Actions\ViewAction::make(),
                \Filament\Actions\EditAction::make()->label('Review'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAidApplications::route('/'),
            'view'  => Pages\ViewAidApplication::route('/{record}'),
            'edit'  => Pages\EditAidApplication::route('/{record}/edit'),
        ];
    }
}
