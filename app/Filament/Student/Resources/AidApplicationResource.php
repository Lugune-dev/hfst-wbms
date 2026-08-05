<?php

namespace App\Filament\Student\Resources;

use App\Filament\Student\Resources\AidApplicationResource\Pages;
use App\Models\AidApplication;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AidApplicationResource extends Resource
{
    protected static ?string $model = AidApplication::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-hand-raised';
    protected static ?string $navigationLabel = 'Aid Applications';
    protected static ?string $pluralModelLabel = 'My Aid Applications';
    protected static string|\UnitEnum|null $navigationGroup = 'Support';
    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('student_id', auth()->user()->student?->id);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Section::make('Aid Request Details')->components([
                Forms\Components\CheckboxList::make('types')
                    ->label('Type of Aid Needed')
                    ->options([
                        'fees'    => '🎓 School Fees (Ada)',
                        'books'   => '📚 Books & Stationery (Vitabu)',
                        'uniform' => '👕 School Uniform (Sare)',
                        'food'    => '🍽️ Food / Nutrition (Chakula)',
                        'housing' => '🏠 Housing (Makazi)',
                    ])
                    ->columns(2)
                    ->required(),

                Forms\Components\Textarea::make('description')
                    ->label('Describe Your Situation (Eleza Hali Yako)')
                    ->placeholder('Please explain why you need this support...')
                    ->rows(4)
                    ->required()
                    ->columnSpanFull(),
            ]),

            \Filament\Schemas\Components\Section::make('Supporting Documents (Nyaraka za Uthibitisho)')->components([
                Forms\Components\FileUpload::make('documents')
                    ->label('Upload Documents')
                    ->multiple()
                    ->directory('aid-documents')
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->helperText('Upload any supporting documents (school letter, birth certificate, etc.)')
                    ->columnSpanFull(),
            ]),

            \Filament\Schemas\Components\Section::make('Application Status (Hali ya Ombi)')->components([
                Forms\Components\Placeholder::make('status')
                    ->label('Current Status')
                    ->content(fn ($record) => $record ? $record->status : 'Pending')
                    ->visible(fn (string $operation) => $operation === 'view' || $operation === 'edit'),

                Forms\Components\Placeholder::make('reviewer_notes')
                    ->label('Reviewer Notes')
                    ->content(fn ($record) => $record?->reviewer_notes ?? 'No notes yet.')
                    ->visible(fn (string $operation) => $operation === 'view' || $operation === 'edit'),
            ])->visible(fn (string $operation) => $operation !== 'create'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
                    ->label('Submitted On')
                    ->dateTime('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('reviewed_at')
                    ->label('Reviewed On')
                    ->dateTime('d M Y')
                    ->placeholder('Not yet reviewed'),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                \Filament\Actions\ViewAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListAidApplications::route('/'),
            'create' => Pages\CreateAidApplication::route('/create'),
            'view'   => Pages\ViewAidApplication::route('/{record}'),
        ];
    }
}
