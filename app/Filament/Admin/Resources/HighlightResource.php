<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\HighlightResource\Pages;
use App\Models\Highlight;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HighlightResource extends Resource
{
    protected static ?string $model = Highlight::class;
    protected static string | \UnitEnum | null $navigationGroup = 'Projects';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Section::make('Highlight')->components([
                Forms\Components\TextInput::make('title')->required()->maxLength(255),
                Forms\Components\TextInput::make('slug')->required()->maxLength(255)->unique(Highlight::class, 'slug', ignoreRecord: true),
                Forms\Components\Textarea::make('description')->columnSpanFull(),
                Forms\Components\TextInput::make('image_url')
                    ->label('Image URL')
                    ->url()
                    ->helperText('Optional: provide full image URL to use instead of uploading a file.'),
                Forms\Components\FileUpload::make('image')->image()->directory('highlights')->disk('public')->required()->columnSpanFull(),
                Forms\Components\Toggle::make('is_active')->label('Active')->default(true),
                Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->disk('public'),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
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
            'index' => Pages\ListHighlights::route('/'),
            'create' => Pages\CreateHighlight::route('/create'),
            'edit' => Pages\EditHighlight::route('/{record}/edit'),
        ];
    }
}
