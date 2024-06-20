<?php

namespace App\Filament\Operator\Pages\Tenancy;

use App\Models\School;
use Filament\Forms\Form;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use App\Filament\Forms\SchoolForm;
use Filament\Forms\Components\Select;
use App\Filament\User\Pages\Dashboard;
use Filament\Pages\Tenancy\RegisterTenant;

class RegisterSchool extends RegisterTenant
{
    
    public static function canView(): bool
    {

        if (auth()->user()->is_admin) {
            return true;
        }
        return parent::canView();

    }

    public static function getLabel(): string
    {
        return __('filament-actions::create.single.label');
    }
 
    public function form(Form $form): Form
    {
        // return $form->schema([
        //     Select::make('school_id')
        //         ->options(School::all()->pluck('name','id')->toArray())
        //         ->label(__('form.school'))
        //         ->searchable()
        //         ->optionsLimit(10)
        //         ->preload()
        //         ->required()
        // ]);
        return $form->schema(SchoolForm::make());
    }

    protected function handleRegistration(array $data): School
    {
        $school = School::create($data);
 
        $school->users()->syncWithoutDetaching(auth()->user());
 
        return $school;
    }

    /**
     * @return array<Action | ActionGroup>
     */
    public function getFormActions(): array
    {
        if(auth()->user()->schools->count()){
            return array_merge(parent::getFormActions(), [$this->cancelAction()]);
        }
        return parent::getFormActions();
        
    }

    public function cancelAction(): Action
    {
        return Action::make('cancel')
            ->label(__('action.back'))
            ->color('danger')
            ->url(Dashboard::getUrl(['tenant' => auth()->user()->schools->first()]));
            // ->url('/');
    }
}