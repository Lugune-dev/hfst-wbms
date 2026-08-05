<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    // protected static string | \BackedEnum | null $navigationIcon = null;
    protected static string | \UnitEnum | null $navigationGroup = 'Projects';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Section::make('Project Details')->components([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('thumb_url')
                    ->label('Image URL')
                    ->url()
                    ->helperText('Optional: provide a full image URL to use instead of uploading a file.'),
                Forms\Components\Select::make('status')
                    ->options([
                        'Planning' => 'Planning',
                        'Active' => 'Active',
                        'Completed' => 'Completed',
                        'OnHold' => 'OnHold',
                    ])
                    ->default('Planning')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('thumb')
                    ->image()
                    ->directory('projects')
                    ->imagePreviewHeight(160)
                    ->required()
                    ->columnSpanFull(),
            ])->columns(2),

            \Filament\Schemas\Components\Section::make('Financials & Timeline')->components([
                Forms\Components\TextInput::make('budget')
                    ->numeric()
                    ->required()
                    ->prefix('TZS'),
                Forms\Components\TextInput::make('current_funding')
                    ->numeric()
                    ->default(0)
                    ->prefix('TZS'),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date'),
            ])->columns(2),

            \Filament\Schemas\Components\Section::make('Beneficiaries')->components([
                Forms\Components\Select::make('students')
                    ->relationship('students', 'first_name')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->first_name . ' ' . $record->last_name)
                    ->multiple()
                    ->preload()
                    ->label('Assigned Students'),
            ])->columns(1),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('budget')
                    ->money('TZS')
                    ->sortable(),
                Tables\Columns\TextColumn::make('current_funding')
                    ->money('TZS')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Active' => 'success',
                        'Planning' => 'info',
                        'Completed' => 'gray',
                        'OnHold' => 'warning',
                        default => 'primary',
                    }),
                Tables\Columns\TextColumn::make('start_date')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Planning' => 'Planning',
                        'Active' => 'Active',
                        'Completed' => 'Completed',
                        'OnHold' => 'OnHold',
                    ]),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'view' => Pages\ViewProject::route('/{record}'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
