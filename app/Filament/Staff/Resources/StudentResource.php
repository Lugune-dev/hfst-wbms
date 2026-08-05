<?php

namespace App\Filament\Staff\Resources;

use App\Filament\Staff\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class StudentResource extends Resource
{
    protected static ?string $model = Student::class;
    public static function getNavigationItems(): array
    {
        return [
            \Filament\Navigation\NavigationItem::make('Kusajili Wanafunzi')
                ->url(fn (): string => static::getUrl('create'))
                ->icon('heroicon-o-user-plus')
                ->group('1. Usimamizi wa Wanafunzi')
                ->isActiveWhen(fn () => request()->routeIs(static::getRouteBaseName() . '.create')),
            \Filament\Navigation\NavigationItem::make('Kuhifadhi Taarifa')
                ->url(fn (): string => static::getUrl('index'))
                ->icon('heroicon-o-pencil-square')
                ->group('1. Usimamizi wa Wanafunzi')
                ->isActiveWhen(fn () => request()->routeIs(static::getRouteBaseName() . '.index')),
            \Filament\Navigation\NavigationItem::make('Kupokea Nyaraka')
                ->url(fn (): string => static::getUrl('index'))
                ->icon('heroicon-o-document-arrow-up')
                ->group('1. Usimamizi wa Wanafunzi'),
            \Filament\Navigation\NavigationItem::make('Kufuatilia Maendeleo')
                ->url(fn (): string => static::getUrl('index'))
                ->icon('heroicon-o-chart-bar')
                ->group('1. Usimamizi wa Wanafunzi'),
            \Filament\Navigation\NavigationItem::make('Kuangalia Hali (Status)')
                ->url(fn (): string => static::getUrl('index'))
                ->icon('heroicon-o-check-badge')
                ->group('1. Usimamizi wa Wanafunzi'),
        ];
    }
    protected static ?string $recordTitleAttribute = 'first_name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Section::make('Personal Information')->components([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Linked User Account'),
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(100),
                Forms\Components\Select::make('gender')
                    ->options(['Male' => 'Male', 'Female' => 'Female'])
                    ->required(),
                Forms\Components\TextInput::make('age')
                    ->numeric()
                    ->required()
                    ->minValue(5)
                    ->maxValue(35),
            ])->columns(2),

            \Filament\Schemas\Components\Section::make('Education Details')->components([
                Forms\Components\TextInput::make('school')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('education_level')
                    ->options([
                        'Primary'    => 'Primary',
                        'Secondary'  => 'Secondary',
                        'University' => 'University',
                    ])
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'Active'    => 'Active',
                        'Graduated' => 'Graduated',
                        'Dropped'   => 'Dropped',
                    ])
                    ->default('Active')
                    ->required(),
            ])->columns(3),

            \Filament\Schemas\Components\Section::make('Requirements')->components([
                Forms\Components\CheckboxList::make('requirements')
                    ->options([
                        'fees'    => 'School Fees',
                        'books'   => 'Books & Stationery',
                        'uniform' => 'Uniform',
                        'food'    => 'Food / Nutrition',
                        'housing' => 'Housing',
                    ])
                    ->columns(3),
            ]),

            \Filament\Schemas\Components\Section::make('Documents & Progress')->components([
                Forms\Components\FileUpload::make('documents')
                    ->multiple()
                    ->directory('student-documents')
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->label('Upload Documents (Birth Cert, School Letter, etc.)'),
                Forms\Components\Textarea::make('progress_notes')
                    ->rows(4)
                    ->maxLength(2000),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('First Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Last Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('school')->searchable()->limit(30),
                Tables\Columns\TextColumn::make('education_level')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'University' => 'success',
                        'Secondary'  => 'warning',
                        default      => 'info',
                    }),
                Tables\Columns\TextColumn::make('gender')->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'Active'    => 'success',
                        'Graduated' => 'info',
                        'Dropped'   => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['Active' => 'Active', 'Graduated' => 'Graduated', 'Dropped' => 'Dropped']),
                Tables\Filters\SelectFilter::make('education_level')
                    ->options(['Primary' => 'Primary', 'Secondary' => 'Secondary', 'University' => 'University']),
                Tables\Filters\SelectFilter::make('gender')
                    ->options(['Male' => 'Male', 'Female' => 'Female']),
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
            'index'  => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'view'   => Pages\ViewStudent::route('/{record}'),
            'edit'   => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
