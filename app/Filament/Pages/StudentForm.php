<?php

namespace App\Filament\Pages;

use App\Models\Sex;
use App\Models\Student;
use Filament\Forms\Get;
use App\Models\Religion;
use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Models\ClassLevel;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Illuminate\Support\Facades\Blade;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;

class StudentForm extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.student-form';

    protected static bool $shouldRegisterNavigation = false;
    
    public ?array $data = [];
    public ?array $annualStudyMaster = [];
    
    public function mount(): void
    {
        $this->setAnnualStudy();
        $this->form->fill();
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

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        Wizard::make([
                            Wizard\Step::make('studentDetail')
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
                            Wizard\Step::make('studentPreviousSchool')
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
                        ->extraAlpineAttributes([
                            '@form-submitted.window' => 'step=\'studentdetail\'' // pass the wizard name here.
                        ])
                        ->submitAction(
                            new HtmlString(Blade::render(<<<BLADE
                            <x-filament::button
                                type="submit"
                            >
                                {{__('button.label.submit')}}
                            </x-filament::button>
                        BLADE))),
                    ]),
                    Section::make([
                        Select::make('annual_study')
                            ->options($this->getAnnualStudy())
                            ->label(__('form.annual_study'))
                            ->required(),
                        Select::make('class_level_proposed')
                            ->options(ClassLevel::all()->pluck('name','id')->toArray())
                            ->label(__('form.class_level_proposed'))
                            ->required()
                    ])->grow(false),
                ])->from('md'),
                
            ])
            ->statePath('data');
    }
    
    public function create(): void
    {
        $insertData = Student::create($this->form->getState());
        if($insertData){
            // Sending success notification
            Notification::make()
                ->success()
                ->title(__('notification.success'))
                ->body('Berhasil menambahkan data peserta didik.')
                ->icon('heroicon-o-check-badge')
                ->persistent()
                ->actions([
                    Action::make('view')
                        ->label('Kembali ke halaman utama')
                        ->button()
                        ->url('/')
                ])
                ->send();

            // Reinitialize the form to clear its data.
            $this->form->fill();
            $this->dispatch('form-submitted');
        }
    }
}
