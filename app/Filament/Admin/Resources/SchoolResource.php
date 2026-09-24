<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SchoolResource\Pages;
use App\Models\School;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SchoolResource extends Resource
{
    protected static ?string $model = School::class;
    protected static ?int $navigationSort = 3;
    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return app()->getLocale() === 'sw' ? 'Wanafunzi & Shule' : 'Students & Schools';
    }

    public static function getNavigationLabel(): string
    {
        return app()->getLocale() === 'sw' ? 'Shule Washirika' : 'Partner Schools';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Section::make('School Profile & Location')->components([
                Forms\Components\TextInput::make('name')
                    ->label('School Name (Jina la Shule)')
                    ->required()
                    ->maxLength(150),
                Forms\Components\TextInput::make('code')
                    ->label('Registration / Code (Nambari ya Usajili)')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(50),
                Forms\Components\Select::make('education_level')
                    ->label('Education Level (Ngazi ya Elimu)')
                    ->options([
                        'Primary'     => 'Primary School (Msingi)',
                        'Secondary'   => 'Secondary School (Sekondari)',
                        'High School' => 'High School (Kidato cha 5 & 6)',
                        'Vocational'  => 'Vocational / Technical (VETA)',
                        'College'     => 'College / Chuo',
                        'University'  => 'University (Chuo Kikuu)',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('region')
                    ->label('Region (Mkoa)')
                    ->default('Arusha')
                    ->required(),
                Forms\Components\TextInput::make('district')
                    ->label('District (Wilaya)')
                    ->placeholder('e.g. Arusha City'),
                Forms\Components\TextInput::make('ward')
                    ->label('Ward / Street (Kata / Mtaa)')
                    ->placeholder('e.g. Kikwakwaru B'),
                Forms\Components\TextInput::make('address')
                    ->label('Postal / Physical Address (Anwani)')
                    ->placeholder('P.O. Box 2798, Arusha'),
                Forms\Components\FileUpload::make('image')
                    ->label('School Photo / Banner (Picha ya Shule)')
                    ->image()
                    ->directory('schools')
                    ->disk('public')
                    ->columnSpanFull(),
            ])->columns(2),

            \Filament\Schemas\Components\Section::make('Administration & Contacts')->components([
                Forms\Components\TextInput::make('contact_person')
                    ->label('Headteacher / Principal (Mkuu wa Shule)')
                    ->placeholder('e.g. Mwl. Grace Mollel'),
                Forms\Components\TextInput::make('contact_phone')
                    ->label('Phone Number (Simu)')
                    ->tel()
                    ->placeholder('+255...'),
                Forms\Components\TextInput::make('contact_email')
                    ->label('Email Address (Barua Pepe)')
                    ->email(),
                Forms\Components\TextInput::make('student_capacity')
                    ->label('Target Capacity (Uwezo wa Wanafunzi)')
                    ->numeric()
                    ->default(100),
                Forms\Components\Toggle::make('is_active')
                    ->label('Active Partner School (Inashirikiana Nasi)')
                    ->default(true),
                Forms\Components\Textarea::make('notes')
                    ->label('Partnership Notes (Maelezo ya Ushirikiano)')
                    ->rows(3)
                    ->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Photo')
                    ->circular()
                    ->state(fn ($record) => $record->image_url),
                Tables\Columns\TextColumn::make('code')
                    ->label('Code')
                    ->searchable()
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('name')
                    ->label('School Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('education_level')
                    ->label('Level')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('region')
                    ->label('Region')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_person')
                    ->label('Headteacher')
                    ->searchable(),
                Tables\Columns\TextColumn::make('students_count')
                    ->counts('students')
                    ->label('Sponsored Students')
                    ->badge()
                    ->color('success'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('education_level')
                    ->options([
                        'Primary'     => 'Primary',
                        'Secondary'   => 'Secondary',
                        'High School' => 'High School',
                        'Vocational'  => 'Vocational',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Schools Only'),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSchools::route('/'),
            'create' => Pages\CreateSchool::route('/create'),
            'edit'   => Pages\EditSchool::route('/{record}/edit'),
        ];
    }
}
