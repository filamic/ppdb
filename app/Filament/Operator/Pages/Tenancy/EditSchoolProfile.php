<?php 

namespace App\Filament\Operator\Pages\Tenancy;
 
use Filament\Forms\Form;
use App\Filament\Forms\SchoolForm;
use Filament\Pages\Tenancy\EditTenantProfile;
 
class EditSchoolProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return __('filament-actions::edit.single.label').' '.__('label.profile');
    }
 
    public function form(Form $form): Form
    {
        return $form->schema(SchoolForm::make());
    }
}