<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ActivityLogResource\Pages;
use App\Models\ActivityLog;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ActivityLogResource extends Resource
{
    protected static ?string $model = ActivityLog::class;

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return app()->getLocale() === 'sw' ? 'Usalama & Mfumo' : 'Security & System';
    }

    public static function getNavigationLabel(): string
    {
        return app()->getLocale() === 'sw' ? 'Kumbukumbu za Mfumo (Logs)' : 'Audit Logs';
    }

    public static function getModelLabel(): string
    {
        return app()->getLocale() === 'sw' ? 'Kumbukumbu ya Mfumo' : 'Audit Log';
    }

    public static function getPluralModelLabel(): string
    {
        return app()->getLocale() === 'sw' ? 'Kumbukumbu za Mfumo' : 'Audit Logs';
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Section::make(fn () => app()->getLocale() === 'sw' ? 'Taarifa za Kumbukumbu' : 'Audit Event Details')
                ->components([
                    Forms\Components\TextInput::make('created_at')
                        ->label(fn () => app()->getLocale() === 'sw' ? 'Tarehe na Saa' : 'Timestamp'),
                    Forms\Components\TextInput::make('user_name')
                        ->label(fn () => app()->getLocale() === 'sw' ? 'Jina la Mtumiaji' : 'User Name'),
                    Forms\Components\TextInput::make('user_email')
                        ->label(fn () => app()->getLocale() === 'sw' ? 'Barua Pepe' : 'User Email'),
                    Forms\Components\TextInput::make('role')
                        ->label(fn () => app()->getLocale() === 'sw' ? 'Wadhifa / Role' : 'Role'),
                    Forms\Components\TextInput::make('action')
                        ->label(fn () => app()->getLocale() === 'sw' ? 'Kitendo / Action' : 'Action'),
                    Forms\Components\TextInput::make('ip_address')
                        ->label('IP Address'),
                    Forms\Components\Textarea::make('description')
                        ->label(fn () => app()->getLocale() === 'sw' ? 'Maelezo Kamili' : 'Description')
                        ->rows(3)
                        ->columnSpanFull(),
                    Forms\Components\Textarea::make('user_agent')
                        ->label('User Agent / Browser')
                        ->rows(2)
                        ->columnSpanFull(),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label(fn () => app()->getLocale() === 'sw' ? 'Muda' : 'Time')
                    ->dateTime('d M Y H:i:s')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user_name')
                    ->label(fn () => app()->getLocale() === 'sw' ? 'Mtumiaji' : 'User')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('role')
                    ->label(fn () => app()->getLocale() === 'sw' ? 'Wadhifa' : 'Role')
                    ->badge()
                    ->color(fn (?string $state): string => match (strtolower($state ?? '')) {
                        'admin'   => 'danger',
                        'staff'   => 'warning',
                        'donor'   => 'info',
                        'teacher' => 'primary',
                        'student' => 'success',
                        default   => 'gray',
                    }),
                Tables\Columns\TextColumn::make('action')
                    ->label(fn () => app()->getLocale() === 'sw' ? 'Kitendo' : 'Action')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'LOGIN'            => 'success',
                        'LOGOUT'           => 'gray',
                        'LOGIN_FAILED'     => 'danger',
                        'DONATION'         => 'primary',
                        'AID_APPROVED'     => 'success',
                        'PASSWORD_CHANGED' => 'warning',
                        default            => 'info',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label(fn () => app()->getLocale() === 'sw' ? 'Maelezo' : 'Description')
                    ->searchable()
                    ->wrap()
                    ->limit(90),
                Tables\Columns\TextColumn::make('ip_address')
                    ->label('IP')
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->label(fn () => app()->getLocale() === 'sw' ? 'Chuja kwa Wadhifa' : 'Filter by Role')
                    ->options([
                        'admin'   => 'Admin',
                        'staff'   => 'Staff',
                        'donor'   => 'Donor',
                        'teacher' => 'Teacher',
                        'student' => 'Student',
                    ]),
                Tables\Filters\SelectFilter::make('action')
                    ->label(fn () => app()->getLocale() === 'sw' ? 'Chuja kwa Kitendo' : 'Filter by Action')
                    ->options([
                        'LOGIN'            => 'LOGIN',
                        'LOGOUT'           => 'LOGOUT',
                        'LOGIN_FAILED'     => 'LOGIN_FAILED',
                        'DONATION'         => 'DONATION',
                        'AID_APPROVED'     => 'AID_APPROVED',
                        'PASSWORD_CHANGED' => 'PASSWORD_CHANGED',
                        'STUDENT_UPDATE'   => 'STUDENT_UPDATE',
                    ]),
            ])
            ->actions([
                \Filament\Actions\ViewAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivityLogs::route('/'),
            'view'  => Pages\ViewActivityLog::route('/{record}'),
        ];
    }
}
