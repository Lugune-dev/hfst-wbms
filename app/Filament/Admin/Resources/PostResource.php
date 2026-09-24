<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return app()->getLocale() === 'sw' ? 'Mawasiliano & Maudhui' : 'Communications & Content';
    }

    public static function getNavigationLabel(): string
    {
        return app()->getLocale() === 'sw' ? 'Habari & Makala' : 'News & Posts';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Section::make('Post Information')->components([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(Post::class, 'slug', ignoreRecord: true),
                Forms\Components\Select::make('type')
                    ->label('Category / Type (Aina ya Maudhui)')
                    ->options([
                        'news'   => 'News (Habari)',
                        'report' => 'Report (Ripoti ya Uwazi)',
                        'event'  => 'Event (Tukio la Kijamii)',
                        'blog'   => 'Blog (Makala ya Elimu)',
                    ])
                    ->default('news')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status (Hali ya Chapisho)')
                    ->options([
                        'published' => 'Published (Imechapishwa Mtandaoni)',
                        'draft'     => 'Draft (Rasimu)',
                    ])
                    ->default('published')
                    ->required(),
                Forms\Components\Select::make('author_id')
                    ->label('Author (Mwandishi)')
                    ->relationship('author', 'name')
                    ->default(auth()->id())
                    ->required(),
                Forms\Components\DateTimePicker::make('published_at')
                    ->label('Published At (Tarehe ya Kuchapishwa)')
                    ->default(now()),
            ])->columns(2),

            \Filament\Schemas\Components\Section::make('Content & Media')->components([
                Forms\Components\FileUpload::make('image')
                    ->label('Cover Photo (Picha ya Jalada)')
                    ->image()
                    ->directory('posts')
                    ->disk('public')
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('content')
                    ->label('Full Story / Article Content (Maudhui Kamili ya Habari/Ripoti)')
                    ->required()
                    ->columnSpanFull(),
            ]),
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
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'event' => 'warning',
                        'news' => 'info',
                        default => 'success',
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('author.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'news' => 'News',
                        'event' => 'Event',
                        'blog' => 'Blog',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ]),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
