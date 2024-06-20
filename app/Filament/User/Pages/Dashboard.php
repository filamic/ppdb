<?php
 
namespace App\Filament\User\Pages;

use App\Models\User;
use App\Models\Student;
use App\Models\Guardian;
use Filament\Actions\Action;
use App\Models\StudentTimeline;
use App\Filament\Forms\StudentForm;
use App\Filament\Forms\GuardianForm;
use JibayMcs\FilamentTour\Tour\Step;
use JibayMcs\FilamentTour\Tour\Tour;
use Filament\Forms\Contracts\HasForms;
use JibayMcs\FilamentTour\Tour\HasTour;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Actions\Contracts\HasActions;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Notifications\Actions\Action as ModalAction;

class Dashboard extends \Filament\Pages\Dashboard implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;
    use HasTour;
    protected static string $view = 'filament.user.pages.dashboard';

    public ?Collection $students;
    public ?Collection $guardians;
    public function boot(): void 
    {
        $this->students = Student::with('school','lastActivity')->where('user_id', auth()->id())->get();
        $this->guardians = Guardian::all();
    }


    public function tours(): array {
        $setup = [];
        if((!auth()->guest()) && auth()->user()->schools->count()){
            $setup = [
               Tour::make('dashboard')
                   ->steps(
                    Step::make('')
                        ->title(__('tour.welcome'))
                        ->description(__('tour.welcome_desc')),
                    Step::make('#create_student')
                                ->title(__('tour.first_step'))
                                ->description(__('tour.first_step_desc')),
                    Step::make('#create_parent')
                                ->title(__('tour.second_step'))
                                ->description(__('tour.second_step_desc')),
                    Step::make('#create_student_file')
                                ->title(__('tour.third_step'))
                                ->description(__('tour.third_step_desc')),
                            Step::make('#last_step')
                                ->title(__('tour.last_step'))
                                ->description(__('tour.last_step_desc')),
                            Step::make('.fi-tenant-menu-trigger')
                                ->title(__('tour.choose_school'))
                                ->description(__('tour.choose_school_desc'))
                   ),
            ];
        }
        return $setup;
    }
    
    public function createAction(): Action
    {
        return Action::make('create')
            ->label(__('filament-actions::create.single.label'))
            ->form(StudentForm::make())
            ->databaseTransaction()
            ->action(function(array $data){
                $student = Student::create($data);
                StudentTimeline::create([
                    'user_id' => auth()->id(),
                    'student_id' => $student->id,
                    'verification_status' => 1,
                ]);
                if($student){
                    // Sending success notification
                    Notification::make()
                        ->success()
                        ->title(__('notification.success'))
                        ->body(__('notification.success_body',['name'=>__('label.student')]).__('notification.waiting_verification'))
                        ->icon('heroicon-o-check-badge')
                        ->persistent()
                        ->actions([
                            ModalAction::make(__('notification.close'))
                                ->color('gray')
                                ->close(),
                        ])
                        ->send();
                }
            });
    }

    public function deleteAction(): Action
    {
        return Action::make('delete')
            ->requiresConfirmation()
            // ->iconButton()
            ->icon('heroicon-m-trash')
            ->size('xs')
            ->label(__('filament-actions::delete.single.label'))
            ->color('danger')
            ->tooltip(__('filament-actions::delete.single.label'))
            ->action(function(array $arguments){
                $student = Student::find($arguments['student']);
                if($student?->delete()){
                    Notification::make()
                        ->success()
                        ->title(__('notification.deleted'))
                        ->body(__('notification.deleted_body',['name'=>__('label.student')]))
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
            // ->iconButton()
            ->size('xs')
            ->label(__('filament-actions::edit.single.label'))
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
                    ->body(__('notification.updated_body',['name'=>__('label.student')]))
                    ->icon('heroicon-o-pencil')
                    ->send();
            })
            ;
    }

    
    public function createGuardianAction(): Action 
    {
        return Action::make('guardianCreate')
            ->label(__('filament-actions::create.single.label'))
            ->form(GuardianForm::make())
            ->action(function(array $data){
                $guardian = Guardian::create($data);
                if($guardian){
                    // Sending success notification
                    Notification::make()
                        ->success()
                        ->title(__('notification.success'))
                        ->body(__('notification.success_body',['name' => __('label.guardian')]))
                        ->icon('heroicon-o-check-badge')
                        ->send();
                }
            });
    }
    

    
    public function guardianDeleteAction(): Action
    {
        return Action::make('guardianDelete')
            ->requiresConfirmation()
            // ->iconButton()
            ->icon('heroicon-m-trash')
            ->size('xs')
            ->color('danger')
            ->label(__('filament-actions::delete.single.label'))
            ->tooltip(__('filament-actions::delete.single.label'))
            ->action(function(array $arguments){
                $delete = Guardian::find($arguments['guardian']);
                if($delete?->delete()){
                    Notification::make()
                        ->success()
                        ->title(__('notification.deleted'))
                        ->body(__('notification.deleted_body',['name' => __('label.guardian')]))
                        ->icon('heroicon-o-trash')
                        ->send();
                }
            })
            ;
    }


    public function guardianEditAction(): Action
    {
        return Action::make('guardianEdit')
            // ->iconButton()
            ->icon('heroicon-m-pencil')
            ->size('xs')
            ->color('gray')
            ->label(__('filament-actions::edit.single.label'))
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
                    ->body(__('notification.updated_body',['name' => __('label.guardian')]))
                    ->icon('heroicon-o-pencil')
                    ->send();
            })
            ;
    }
    
    public function createUserAttachmentAction(): Action 
    {
        return Action::make('userAttachmentCreate')
            ->label(__('filament-actions::create.single.label'))
            ->form([
                FileUpload::make('attachment')
                    ->label(__('form.family_card'))
                    ->image()
                    ->maxSize(1024)
                    ->downloadable()
            ])
            ->fillForm(function(){
                $record = User::find(auth()->id());
                return $record->attributesToArray();
            })
            ->action(function(array $data){
                $edit = User::find(auth()->id());
                $edit->update($data);
                if($edit){
                    // Sending success notification
                    Notification::make()
                        ->success()
                        ->title(__('notification.success'))
                        ->body(__('notification.success_body',['name' =>__('form.family_card')]))
                        ->icon('heroicon-o-check-badge')
                        ->send();
                }
            });
    }


}