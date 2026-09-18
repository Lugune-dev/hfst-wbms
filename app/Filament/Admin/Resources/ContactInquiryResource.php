<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ContactInquiryResource\Pages;
use App\Models\ContactInquiry;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactInquiryResource extends Resource
{
    protected static ?string $model = ContactInquiry::class;
    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): ?string
    {
        return app()->getLocale() === 'sw' ? 'Mawasiliano & Maudhui' : 'Communications & Content';
    }

    public static function getNavigationLabel(): string
    {
        return app()->getLocale() === 'sw' ? 'Meseji za Tovuti' : 'Contact Inquiries';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Section::make('Inquiry Details')->components([
                Forms\Components\TextInput::make('name')
                    ->label('Sender Name')
                    ->disabled(),
                Forms\Components\TextInput::make('email')
                    ->label('Sender Email')
                    ->email()
                    ->disabled(),
                Forms\Components\TextInput::make('subject')
                    ->label('Subject')
                    ->disabled()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('body')
                    ->label('Message Body')
                    ->rows(5)
                    ->disabled()
                    ->columnSpanFull(),
            ])->columns(2),

            \Filament\Schemas\Components\Section::make('Status & Internal Handling')->components([
                Forms\Components\Select::make('status')
                    ->options([
                        'new'      => '🆕 New / Haujasomwa',
                        'read'     => '👀 Read / Umesomwa',
                        'replied'  => '✅ Replied / Umejibiwa',
                        'archived' => '📁 Archived / Umehifadhiwa',
                    ])
                    ->required(),
                Forms\Components\Select::make('handled_by')
                    ->relationship('handler', 'name')
                    ->label('Handled By (Afisa Aliyeshughulikia)'),
                Forms\Components\Textarea::make('admin_notes')
                    ->label('Admin Action Notes (Maelezo ya Ndani)')
                    ->rows(3)
                    ->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject')
                    ->label('Subject')
                    ->limit(35)
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new'      => 'warning',
                        'read'     => 'info',
                        'replied'  => 'success',
                        'archived' => 'gray',
                        default    => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'new'      => 'New',
                        'read'     => 'Read',
                        'replied'  => 'Replied',
                        'archived' => 'Archived',
                    ]),
            ])
            ->actions([
                \Filament\Actions\ViewAction::make(),
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\Action::make('mark_replied')
                    ->label('Mark Replied')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->action(fn ($record) => $record->update([
                        'status'     => 'replied',
                        'handled_by' => auth()->id(),
                        'handled_at' => now(),
                    ])),
            ])
            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactInquiries::route('/'),
        ];
    }
}
