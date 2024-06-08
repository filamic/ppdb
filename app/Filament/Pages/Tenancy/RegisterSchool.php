<?php

namespace App\Filament\Pages\Tenancy;
 
use App\Models\School;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Illuminate\Support\Str;
use App\Filament\Forms\SchoolForm;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\RegisterTenant;
 
class RegisterSchool extends RegisterTenant
{
    public static function getLabel(): string
    {
        return __('filament-actions::create.single.label').' '.__('form.school');
    }
 
    public function form(Form $form): Form
    {
        return $form->schema(SchoolForm::make());
    }
 
    protected function handleRegistration(array $data): School
    {
        $school = School::create($data);
 
        $school->users()->attach(auth()->user());
 
        return $school;
    }
}