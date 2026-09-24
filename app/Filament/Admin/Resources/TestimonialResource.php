<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?int $navigationSort = 3;
    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return app()->getLocale() === 'sw' ? 'Mawasiliano & Maudhui' : 'Communications & Content';
    }

    public static function getNavigationLabel(): string
    {
        return app()->getLocale() === 'sw' ? 'Sauti za Athari (Ushuhuda)' : 'Testimonials & Voices';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Section::make('Ushuhuda / Testimonial Details')->components([
                Forms\Components\TextInput::make('name')
                    ->label('Full Name (Jina Kamili)')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('e.g. Amina Hassan au Mwl. John Simoni'),
                Forms\Components\TextInput::make('role')
                    ->label('Role / Title (Nafasi / Cheo)')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('e.g. Mwanafunzi Mnufaika, Mfadhili, Mwalimu wa Taaluma'),
                Forms\Components\Textarea::make('message')
                    ->label('Testimonial Message (Ujumbe wa Ushuhuda)')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull()
                    ->placeholder('Andika ushuhuda kamili wa mwanafunzi, mzazi, mwalimu au mfadhili...'),
                Forms\Components\FileUpload::make('photo')
                    ->label('Photo (Picha ya Mtoa Ushuhuda)')
                    ->image()
                    ->directory('testimonials')
                    ->disk('public')
                    ->avatar()
                    ->imageEditor(),
                Forms\Components\Toggle::make('is_featured')
                    ->label('Featured on Home Page (Onyesha Ukurasa wa Mbele)')
                    ->helperText('Ukiweka alama hii, ushuhuda huu utaonekana moja kwa moja kwenye ukurasa wa mbele (Sauti za Athari).')
                    ->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Photo')
                    ->circular()
                    ->state(fn ($record) => $record->photo_url),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('role')
                    ->label('Role / Title')
                    ->searchable()
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('message')
                    ->label('Message')
                    ->limit(65)
                    ->tooltip(fn ($record) => $record->message),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Added')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
