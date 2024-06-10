<?php

namespace App\Filament\User\Pages\Tenancy;

use App\Filament\User\Pages\Dashboard;
use App\Models\School;
use Filament\Forms\Form;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Forms\Components\Select;
use Filament\Pages\Tenancy\RegisterTenant;

use function PHPUnit\Framework\isNull;

class RegisterSchool extends RegisterTenant
{
    public static function getLabel(): string
    {
        return __('form.register');
    }
 
    public function form(Form $form): Form
    {
        return $form->schema([
            Select::make('school_id')
                ->options(School::all()->pluck('name','id')->toArray())
                ->label(__('form.school'))
                ->searchable()
                ->optionsLimit(10)
                ->preload()
                ->required()
        ]);
    }
 
    protected function handleRegistration(array $data): School
    {
        $school = School::find($data['school_id']);
 
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