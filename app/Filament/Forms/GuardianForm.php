<?php
 
namespace App\Filament\Forms;

use App\Models\LastEducation;
use App\Models\Religion;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;

class GuardianForm {
    public static function make() : array 
    {
        return [
            TextInput::make('name')
                ->label(__('form.name'))
                ->required(),
            TextInput::make('place_of_birth')
                ->label(__('form.place_of_birth'))
                ->required(),
            DatePicker::make('date_of_birth')
                ->label(__('form.date_of_birth'))
                ->required(),
            Select::make('religion')
                ->options(Religion::all()->pluck('name','id')->toArray())
                ->label(__('form.religion'))
                ->required(),
            TextInput::make('nationality')
                ->label(__('form.nationality'))
                ->required(),
            Select::make('last_education')
                ->options(LastEducation::all()->pluck('name','id')->toArray())
                ->label(__('form.last_education'))
                ->required(),
            TextInput::make('profession')
                ->label(__('form.profession'))
                ->required(),
            Textarea::make('address')
                ->label(__('form.address'))
                ->required(),
            TextInput::make('phone_numbers')
                ->tel()
                ->label(__('form.phone_numbers'))
                ->required(),
            Toggle::make('authorized_to_pickup_pupil')
                ->label(__('form.authorized_to_pickup_pupil'))
                ->required(),
        ];
    }
}
