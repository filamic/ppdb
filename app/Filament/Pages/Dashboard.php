<?php
 
namespace App\Filament\Pages;

use App\Filament\Forms\StudentForm;
use App\Models\Student;
use Filament\Actions\Action;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Actions\Contracts\HasActions;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class Dashboard extends \Filament\Pages\Dashboard implements HasForms, HasActions
{

    use InteractsWithActions;
    use InteractsWithForms;

    protected static string $view = 'filament.pages.dashboard';

    public ?Collection $students;

    public function boot(): void 
    {
        $this->students = Student::all();
    }

    public function createAction(): Action
    {
        return Action::make('create')
            ->label(__('filament-actions::create.single.label'))
            ->form(StudentForm::make())
            ->action(function(array $data){
                $insertData = Student::create($data);
                if($insertData){
                    // Sending success notification
                    Notification::make()
                        ->success()
                        ->title(__('notification.success'))
                        ->body('Berhasil menambahkan data peserta didik.')
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
            ->size('xs')
            ->color('danger')
            ->tooltip(__('filament-actions::delete.single.label'))
            ->action(function(array $arguments){
                $student = Student::find($arguments['student']);
                if($student?->delete()){
                    Notification::make()
                        ->success()
                        ->title(__('notification.deleted'))
                        ->body(__('notification.deleted_body'))
                        ->icon('heroicon-o-trash')
                        ->send();
                }
            })
            ;
    }

    public function editAction(): Action
    {
        return Action::make('edit')
            ->iconButton()
            ->icon('heroicon-m-pencil')
            ->size('xs')
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
                    ->body(__('notification.updated_body'))
                    ->icon('heroicon-o-pencil')
                    ->send();
            })
            ;
    }
    
    
    

}