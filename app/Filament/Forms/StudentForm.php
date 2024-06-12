<?php
 
namespace App\Filament\Forms;

use App\Models\Sex;
use App\Models\School;
use Filament\Forms\Get;
use App\Models\Religion;
use Filament\Facades\Filament;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Wizard\Step;

class StudentForm {

    public static function make() : array 
    {
        return [
            Wizard::make([
                Step::make('studentClassLevelProposed')
                    ->label(__('form.student_class_level_proposed'))
                    ->icon('heroicon-m-cog')
                    ->schema([
                        Select::make('annual_study')
                            ->options(self::generateAnnualStudy())
                            ->label(__('form.annual_study'))
                            ->required(),
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
                            ->placeholder(__('form.ex_status_in_the_family'))
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
                    ]),
                Step::make('studentConfidentialHealthInformation')
                    ->label(__('form.student_confidential_health_information'))
                    ->icon('heroicon-m-arrow-up-tray')
                    ->schema([
                        Repeater::make('confidential_health_information')
                            ->label(__('form.student_confidential_health_information'))
                            ->helperText(__('form.medical_history_helper_text'))
                            ->schema([
                                TextInput::make('name')->label(__('form.medical_history_name'))->required(),
                                Textarea::make('description')->label(__('form.medical_history_description'))->required(),
                            ])
                            ->defaultItems(0)
                    ]),
                Step::make('attachment')
                    ->label(__('form.attachment'))
                    ->icon('heroicon-m-arrow-up-tray')
                    ->schema([
                        FileUpload::make('attachment')
                            ->label(__('form.certificate_of_birth'))
                            ->image()
                            ->required()
                            ->maxSize(1024)
                            ->downloadable(),
                        Placeholder::make('school_statement')
                            ->label(__('form.statement'))
                            ->hidden(function(): bool {
                                $record = Filament::getTenant();
                                return empty($record->statement);
                            })
                            ->content(new HtmlString(Filament::getTenant()->statement)),
                        Checkbox::make('statement')
                            ->label(__('form.student_statement'))
                            ->hidden(function(): bool {
                                $record = Filament::getTenant();
                                return empty($record->statement);
                            })
                            ->accepted()
                    ])
                
            ])->skippable()
        ];
    }

    private static function generateAnnualStudy() :array
    {
        $annualStudyMaster = [];
        for ($i=date('Y')-1; $i < date('Y')+10; $i++) { 
            $annualStudyMaster[$i.'/'.$i+1] = $i.'/'.$i+1;
        }
        return $annualStudyMaster;
    }
}
