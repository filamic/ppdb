<?php
 
namespace App\Filament\Operator\Pages;

use App\Models\GuardianType;
use App\Models\Student;
use Filament\Forms\Components\Radio;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use App\Models\StudentTimeline;
use App\Models\VerificationStatus;
use App\traits\generateAnnualStudy;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

// class Dashboard extends \Filament\Pages\Dashboard
class Dashboard extends \Filament\Pages\Dashboard implements HasForms, HasTable
{
    use generateAnnualStudy;
    use InteractsWithTable;
    use InteractsWithForms;

    protected static string $view = 'filament.operator.pages.dashboard';
    public ?string $activeAnnualStudy;
    public ?array $annualStudyData;
    public ?Collection $students;

    public function mount(): void 
    {
        $this->annualStudyData = self::generateAnnualStudy();
    }

    // public function boot(): void 
    // {
    //     $this->students = Student::with('school','activities')->get();
    // }

    public function getHeading(): string|Htmlable
    {
        return __('label.welcome_back').', '.auth()->user()->name.' 👋';
    }
    public function getSubheading(): string|Htmlable|null{
        return __('label.dashboard_sub_heading_operator',['name'=> Filament::getTenant()->name]);
    }

    public function generateColumns(){
        $columns = [
            TextColumn::make('user.name')->label('user')->toggleable()->toggledHiddenByDefault(),
            TextColumn::make('annual_study')->label(__('form.annual_study')),
            TextColumn::make('registration_number')->toggleable()->toggledHiddenByDefault(),
            TextColumn::make('name')->label(__('form.name')),
            TextColumn::make('lastActivity')
                ->label(__('form.verification_status'))
                ->badge()
                ->formatStateUsing(function(string $state){
                    if($state){
                        return VerificationStatus::find(json_decode($state)->verification_status)->name;
                    }
                    return $state;
                })
                ->color(function(string $state){
                    if($state){
                        return VerificationStatus::find(json_decode($state)->verification_status)->color;
                    }
                    return $state;
                })
                ->action(
                    Action::make(__('form.verification_status'))
                        ->form([
                            Radio::make('verification_status')
                                ->label(__('form.verification_status'))
                                ->options(VerificationStatus::all()->pluck('name','id')->toArray())
                                ->required(),
                            Textarea::make('verification_status_description')
                        ])
                        ->action(function (array $data,Student $record): void {
                            $StudentTimeline = StudentTimeline::create([
                                'user_id' => auth()->id(),
                                'student_id' => $record->id,
                                'verification_status' => $data['verification_status'],
                                'verification_status_description' => $data['verification_status_description'],
                            ]);
                            if($StudentTimeline){
                                //return notification here
                            }
                        }),
                ),
            TextColumn::make('nickname')->label(__('form.nickname')),
            TextColumn::make('place_of_birth')->label(__('form.place_of_birth')),
            TextColumn::make('date_of_birth')->label(__('form.date_of_birth')),
            TextColumn::make('mother_tongue')->label(__('form.mother_tongue')),
            TextColumn::make('status_in_the_family')->label(__('form.status_in_the_family')),
            TextColumn::make('pupil_position')->label(__('form.pupil_position')),
            TextColumn::make('sex')->label(__('form.sex')),
            TextColumn::make('religion')->label(__('form.religion')),
            TextColumn::make('nationality')->label(__('form.nationality')),
            TextColumn::make('numbers_of_siblings')->label(__('form.numbers_of_siblings')),
            TextColumn::make('previous_school_name')->label(__('form.previous_school_name')),
            TextColumn::make('previous_school_city_name')->label(__('form.previous_school_city_name')),
            TextColumn::make('previous_school_country_name')->label(__('form.previous_school_country_name')),
            ImageColumn::make('attachment')->label(__('form.certificate_of_birth'))->square()->visibility('private')->simpleLightbox(),
            ImageColumn::make('user.attachment')->label(__('form.family_card'))->square()->visibility('private')->simpleLightbox(),
            ImageColumn::make('guardians.attachment')->label(__('form.attachment').' '.__('label.guardian'))->square()->stacked()->wrap()->visibility('private')->simpleLightbox(),
            TextColumn::make('guardians.name')->label(__('label.guardian'))->bulleted(),
            TextColumn::make('guardians')
                ->formatStateUsing(function(string $state){
                    if($state){
                        return GuardianType::find(json_decode($state)->guardian_type)->name;
                    }
                    return $state;
                })
                ->label(__('form.guardian_type'))
                ->bulleted(),
        ];

        return $columns;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Student::query()->with('school','activities'))
            ->columns($this->generateColumns())
            ->filters([
                SelectFilter::make(__('form.annual_study'))
                    ->multiple()
                    ->options($this->annualStudyData)
            ])
            ->actions([
                // Action::make('show_certificate_of_birth')
                //     ->label(__('form.certificate_of_birth'))
            ])
            ->bulkActions([
                // ...
            ]);
    }

}