<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('updatePassword')
                ->form([
                    TextInput::make('password')
                        ->password()
                        ->required()
                        ->confirmed(),
                    TextInput::make('password_confirmation')
                        ->password()
                        ->required(),
                ])
                ->action(function (array $data) {
                    $user = $this->record;
                    $user->update([
                        'password' => $data['password']
                    ]);

                    Notification::make()
                        ->title('Password Updated Successfully!')
                        ->success()
                        ->send();
                })
//            Actions\DeleteAction::make(),
        ];
    }
}
