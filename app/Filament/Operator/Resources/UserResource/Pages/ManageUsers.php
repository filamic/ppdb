<?php

namespace App\Filament\Operator\Resources\UserResource\Pages;

use App\Models\User;
use Filament\Actions;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Operator\Resources\UserResource;
use Filament\Forms\Components\TextInput;

class ManageUsers extends ManageRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            Action::make('createUser')
                ->color('info')
                ->action(function(){
                    $user = User::create([
                        'name' => 'user'.time(),
                        'email' =>  'user'.time().'@sekolahbasic.sch.id',
                        // 'password' => bcrypt( Str::random(8)),
                        'password' => bcrypt( 'mantapjiwa00'),
                    ]);
                    $user->schools()->attach(Filament::getTenant()->id);
                    if($user){
                        Notification::make('createUser')
                            ->success()
                            ->title(__('notification.success'))
                            ->body(__('notification.success_body',['name'=>'user']))
                            ->icon('heroicon-o-check-badge')
                            ->send();
                    }
                }),
            Action::make('createOperator')
                ->form([
                    TextInput::make('name')->label(__('form.name'))->required()
                ])
                ->action(function(array $data){
                    $user = User::create([
                        'name' => $data['name'],
                        'email' =>  'op_'.Str::snake($data['name']).'@sekolahbasic.sch.id',
                        'password' => bcrypt( 'a1b2c3d4'),
                        'is_admin' => true,
                    ]);
                    $user->schools()->attach(Filament::getTenant()->id);
                    if($user){
                        Notification::make('createOperator')
                            ->success()
                            ->title(__('notification.success'))
                            ->body(__('notification.success_body',['name'=>'operator']))
                            ->icon('heroicon-o-check-badge')
                            ->send();
                    }
                }),
        ];
    }
}
