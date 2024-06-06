<?php
 
namespace App\Filament\Pages;

use App\Models\Sex;
use App\Models\Student;
use Filament\Forms\Get;
use App\Models\Religion;
use App\Models\ClassLevel;
use Filament\Actions\Action;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Wizard\Step;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class Dashboard extends \Filament\Pages\Dashboard implements HasForms, HasActions
{

    use InteractsWithActions;
    use InteractsWithForms;

    protected static string $view = 'filament.pages.dashboard';

    public ?array $annualStudyMaster = [];

    public ?Collection $students;

    public function mount(): void
    {
        $this->setAnnualStudy();
    }

    public function boot(): void 
    {
        $this->students = Student::all();
    }

    public function setAnnualStudy() :void
    {
        for ($i=date('Y')-1; $i < date('Y')+10; $i++) { 
            $this->annualStudyMaster[$i.'/'.$i+1] = $i.'/'.$i+1;
        }
    }

    public function getAnnualStudy() :array
    {
        return $this->annualStudyMaster;
    }

    public function createAction(): Action
    {
        return Action::make('create')
            ->steps([
                Step::make('studentClassLevelProposed')
                    ->label(__('form.student_class_level_proposed'))
                    ->icon('heroicon-m-cog')
                    ->schema([
                        Group::make([
                            Select::make('annual_study')
                                ->options($this->getAnnualStudy())
                                ->label(__('form.annual_study'))
                                ->required(),
                            Select::make('class_level_proposed')
                                ->options(ClassLevel::all()->pluck('name','id')->toArray())
                                ->label(__('form.class_level_proposed'))
                                ->required()
                        ])->columns(2)
                    ]),
                Step::make('studentDetail')
                    ->label(__('form.student_identity'))
                    ->icon('heroicon-m-user')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label(__('form.name'))
                            ->required(),
                        TextInput::make('nickname')
                            ->label(__('form.nickname'))
                            ->required(),
                        TextInput::make('place_of_birth')
                            ->label(__('form.place_of_birth'))
                            ->required(),
                        DatePicker::make('date_of_birth')
                            ->label(__('form.date_of_birth'))
                            ->required(),
                        TextInput::make('mother_tongue')
                            ->label(__('form.mother_tongue'))
                            ->required(),
                        TextInput::make('status_in_the_family')
                            ->label(__('form.status_in_the_family'))
                            ->required(),
                        TextInput::make('pupil_position')
                            ->numeric()
                            ->live()
                            ->minValue(1)
                            ->label(__('form.pupil_position'))
                            ->required(),
                        Select::make('sex')
                            ->options(Sex::all()->pluck('name','id')->toArray())
                            ->label(__('form.sex'))
                            ->required(),
                        Select::make('religion')
                            ->options(Religion::all()->pluck('name','id')->toArray())
                            ->label(__('form.religion'))
                            ->required(),
                        TextInput::make('nationality')
                            ->label(__('form.nationality'))
                            ->required(),
                        TextInput::make('numbers_of_siblings')
                            ->numeric()
                            ->minValue(fn(Get $get)=>$get('pupil_position'))
                            ->label(__('form.numbers_of_siblings'))
                            ->required()
                    ]),
                Step::make('studentPreviousSchool')
                    ->label(__('form.student_previous_school_identity'))
                    ->icon('heroicon-m-building-library')
                    ->schema([
                        Group::make([
                            TextInput::make('previous_school_name')
                                ->label(__('form.previous_school_name'))
                                ->columnSpanFull()
                                ->required(),
                            TextInput::make('previous_school_city_name')
                                ->label(__('form.previous_school_city_name'))
                                ->required(),
                            TextInput::make('previous_school_country_name')
                                ->label(__('form.previous_school_country_name'))
                                ->required()
                        ])->columns(2)
                    ])
            ])
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
                $student?->delete();
            });
    }
    
    

}