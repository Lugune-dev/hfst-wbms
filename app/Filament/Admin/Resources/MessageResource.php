<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MessageResource\Pages;
use App\Models\Message;
use App\Models\User;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;
    protected static string|\UnitEnum|null $navigationGroup = 'System';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Contact Messages';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Section::make('Message Details')->components([
                Forms\Components\Select::make('sender_id')
                    ->label('From')
                    ->relationship('sender', 'name')
                    ->disabled(),

                Forms\Components\Select::make('recipient_id')
                    ->label('To')
                    ->relationship('recipient', 'name')
                    ->disabled(),

                Forms\Components\TextInput::make('subject')
                    ->label('Subject')
                    ->disabled()
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('body')
                    ->label('Message')
                    ->rows(6)
                    ->disabled()
                    ->columnSpanFull(),
            ])->columns(2),

            \Filament\Schemas\Components\Section::make('Reply / Admin Notes')->components([
                Forms\Components\Toggle::make('is_read')
                    ->label('Mark as Read'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sender.name')
                    ->label('From')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subject')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('body')
                    ->label('Preview')
                    ->limit(60)
                    ->wrap(),
                Tables\Columns\IconColumn::make('is_read')
                    ->label('Read')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_read')->label('Read Status'),
            ])
            ->actions([
                \Filament\Actions\ViewAction::make(),
                \Filament\Actions\EditAction::make()->label('Mark Read'),
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
            'index' => Pages\ListMessages::route('/'),
            'view'  => Pages\ViewMessage::route('/{record}'),
            'edit'  => Pages\EditMessage::route('/{record}/edit'),
        ];
    }
}
