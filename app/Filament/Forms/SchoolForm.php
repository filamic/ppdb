<?php
 
namespace App\Filament\Forms;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\TextInput;

class SchoolForm {
    public static function make() : array 
    {
        return [
            Group::make([
                TextInput::make('name')
                    ->label(__('form.school_name'))
                    ->live()
                    ->required()
            ])
        ];
    }
}
