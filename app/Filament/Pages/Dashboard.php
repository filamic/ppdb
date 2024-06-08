<?php
 
namespace App\Filament\Pages;

use App\Filament\Forms\GuardianForm;
use App\Models\Student;
use Filament\Actions\Action;
use App\Filament\Forms\StudentForm;
use App\Models\Guardian;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Actions\Contracts\HasActions;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Pages\Page;

class Dashboard extends \Filament\Pages\Dashboard implements HasForms, HasActions
// class Dashboard extends Page implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string $view = 'filament.pages.dashboard';

    public ?Collection $students;
    public ?Collection $guardians;
    public ?Collection $activeModel;

    public function boot(): void 
    {
        $this->students = Student::all();
        $this->guardians = Guardian::all();
    }
    
    public function createAction(): Action
    {
        return Action::make('create')
            ->label(__('filament-actions::create.single.label'))
            ->form(StudentForm::make())
            ->action(function(array $data){
                $student = Student::create($data);
                if($student){
                    // Sending success notification
                    Notification::make()
                        ->success()
                        ->title(__('notification.success'))
                        ->body(__('notification.success_body',['name' =>'peserta didik']))
                        ->icon('heroicon-o-check-badge')
                        ->send();
                }
            });
    }

    public function deleteAction(): Action
    {
        return Action::make('delete')
            ->requiresConfirmation()
            ->iconButton()
            ->icon('heroicon-m-trash')
            ->size('sm')
            ->color('danger')
            ->tooltip(__('filament-actions::delete.single.label'))
            ->action(function(array $arguments){
                $student = Student::find($arguments['student']);
                if($student?->delete()){
                    Notification::make()
                        ->success()
                        ->title(__('notification.deleted'))
                        ->body(__('notification.deleted_body',['name' =>'peserta didik']))
                        ->icon('heroicon-o-trash')
                        ->send();
                }
            })
            ;
    }

    public function guardianDeleteAction(): Action
    {
        return Action::make('guardianDelete')
            ->requiresConfirmation()
            ->iconButton()
            ->icon('heroicon-m-trash')
            ->size('sm')
            ->color('danger')
            ->tooltip(__('filament-actions::delete.single.label'))
            ->action(function(array $arguments){
                $delete = Guardian::find($arguments['guardian']);
                if($delete?->delete()){
                    Notification::make()
                        ->success()
                        ->title(__('notification.deleted'))
                        ->body(__('notification.deleted_body',['name' =>'Orang tua/Wali']))
                        ->icon('heroicon-o-trash')
                        ->send();
                }
            })
            ;
    }

    public function editAction(): Action
    {
        return Action::make('edit')
            ->icon('heroicon-m-pencil')
            ->iconButton()
            ->size('sm')
            ->color('gray')
            ->tooltip(__('filament-actions::edit.single.label'))
            // ->steps($this->generateForm())
            ->form(StudentForm::make())
            ->fillForm(function(array $arguments){
                $record = Student::find($arguments['student']);
                return $record->attributesToArray();
            })
            ->action(function(array $arguments, array $data){
                $student = Student::find($arguments['student']);
                $student->update($data);
                Notification::make()
                    ->success()
                    ->title(__('notification.updated'))
                    ->body(__('notification.updated_body',['name' =>'peserta didik']))
                    ->icon('heroicon-o-pencil')
                    ->send();
            })
            ;
    }

    public function guardianEditAction(): Action
    {
        return Action::make('guardianEdit')
            ->iconButton()
            ->icon('heroicon-m-pencil')
            ->size('sm')
            ->color('gray')
            ->tooltip(__('filament-actions::edit.single.label'))
            ->form(GuardianForm::make())
            ->fillForm(function(array $arguments){
                $record = Guardian::find($arguments['guardian']);
                return $record->attributesToArray();
            })
            ->action(function(array $arguments, array $data){
                $edit = Guardian::find($arguments['guardian']);
                $edit->update($data);
                Notification::make()
                    ->success()
                    ->title(__('notification.updated'))
                    ->body(__('notification.updated_body',['name' =>'Orang tua/Wali']))
                    ->icon('heroicon-o-pencil')
                    ->send();
            })
            ;
    }
    
    public function createGuardianAction(): Action 
    {
        return Action::make('create')
            ->label(__('filament-actions::create.single.label'))
            ->form(GuardianForm::make())
            ->action(function(array $data){
                $guardian = Guardian::create($data);
                if($guardian){
                    // Sending success notification
                    Notification::make()
                        ->success()
                        ->title(__('notification.success'))
                        ->body(__('notification.success_body',['name' =>'orang tua atau wali']))
                        ->icon('heroicon-o-check-badge')
                        ->send();
                }
            });
    }


}