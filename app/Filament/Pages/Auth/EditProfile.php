<?php

namespace App\Filament\Pages\Auth;

use App\Models\ActivityLog;
use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class EditProfile extends BaseEditProfile
{
    public static function getLabel(): string
    {
        return app()->getLocale() === 'sw' ? 'Wasifu & Nenosiri' : 'Profile & Password';
    }

    public function getTitle(): string | Htmlable
    {
        return app()->getLocale() === 'sw' ? 'Badili Nenosiri na Taarifa za Wasifu' : 'Edit Profile & Security';
    }

    public function getHeading(): string | Htmlable
    {
        return app()->getLocale() === 'sw' ? 'Wasifu na Usalama wa Akaunti' : 'Profile & Account Security';
    }

    public function getSubheading(): string | Htmlable | null
    {
        return app()->getLocale() === 'sw' 
            ? 'Sasisha taarifa zako binafsi na ubadilishe nenosiri lako la kuingia kwenye mfumo.'
            : 'Update your personal details and change your account password.';
    }

    protected function getPhoneFormComponent(): Component
    {
        return TextInput::make('phone')
            ->label(fn () => app()->getLocale() === 'sw' ? 'Namba ya Simu' : 'Phone Number')
            ->tel()
            ->maxLength(30);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(fn () => app()->getLocale() === 'sw' ? 'Taarifa Binafsi' : 'Personal Information')
                    ->description(fn () => app()->getLocale() === 'sw' ? 'Jina lako na njia rasmi za mawasiliano.' : 'Your name and contact information.')
                    ->components([
                        $this->getNameFormComponent()
                            ->label(fn () => app()->getLocale() === 'sw' ? 'Jina Kamili' : 'Full Name'),
                        $this->getEmailFormComponent()
                            ->label(fn () => app()->getLocale() === 'sw' ? 'Barua Pepe' : 'Email Address'),
                        $this->getPhoneFormComponent(),
                    ])->columns(2),

                Section::make(fn () => app()->getLocale() === 'sw' ? 'Usalama na Nenosiri' : 'Security & Password')
                    ->description(fn () => app()->getLocale() === 'sw' 
                        ? 'Weka nenosiri jipya ikiwa unataka kulibadilisha. Acha wazi kama hutaki kubadili nenosiri.' 
                        : 'Enter a new password if you wish to change it. Leave blank to keep current password.')
                    ->components([
                        $this->getCurrentPasswordFormComponent()
                            ->label(fn () => app()->getLocale() === 'sw' ? 'Nenosiri la Sasa' : 'Current Password')
                            ->belowContent(fn () => app()->getLocale() === 'sw' 
                                ? 'Lazima uthibitishe nenosiri lako la sasa ili kufanya mabadiliko haya ya kiusalama.' 
                                : 'Please confirm your current password to authorize security updates.'),
                        $this->getPasswordFormComponent()
                            ->label(fn () => app()->getLocale() === 'sw' ? 'Nenosiri Jipya' : 'New Password'),
                        $this->getPasswordConfirmationFormComponent()
                            ->label(fn () => app()->getLocale() === 'sw' ? 'Thibitisha Nenosiri Jipya' : 'Confirm New Password'),
                    ])->columns(1),
            ]);
    }

    protected function afterSave(): void
    {
        $user = $this->getUser();

        // Record audit activity log
        ActivityLog::record(
            'PROFILE_UPDATED',
            "Mtumiaji {$user->name} amesasisha taarifa za wasifu na usalama wa akaunti yake.",
            $user
        );

        // Send confirmation notification to user's database bell
        Notification::make()
            ->title(app()->getLocale() === 'sw' ? 'Wasifu & Nenosiri Vimesasishwa' : 'Profile & Password Updated')
            ->body(app()->getLocale() === 'sw' 
                ? 'Taarifa zako na nenosiri zimehifadhiwa kwa ufanisi kwenye mfumo.' 
                : 'Your profile and security credentials have been successfully updated.')
            ->success()
            ->sendToDatabase($user);
    }
}
