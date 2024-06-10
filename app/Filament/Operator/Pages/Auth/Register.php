<?php

namespace App\Filament\Operator\Pages\Auth;

use App\Models\User;

class Register extends \Filament\Pages\Auth\Register
{
    protected function handleRegistration(array $data): User
    {
        $user = User::create(array_merge($data, ['is_admin' => 1]));
 
        return $user;
    }
}
