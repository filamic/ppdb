<?php

namespace App\Filament\Operator\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\School;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use App\Filament\Exports\UserExporter;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ExportAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Operator\Resources\UserResource\Pages;
use App\Filament\Operator\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static bool $isScopedToTenant = false;

    // protected static ?string $tenantOwnershipRelationshipName = 'schools';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(),
                Forms\Components\TextInput::make('attachment'),
                Forms\Components\Toggle::make('is_admin'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('schools.name')
                    ->listWithLineBreaks()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->copyable()
                    ->copyMessage('Email address copied')
                    ->copyMessageDuration(1500)
                    ->searchable(),
                // Tables\Columns\TextColumn::make('email_verified_at')
                //     ->dateTime()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('attachment')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_admin')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('assignSchool')
                        ->label(__('label.assignSchool'))
                        ->icon('heroicon-m-building-office')
                        ->color('primary')
                        ->form([
                            Select::make('school_id')
                                ->options(School::all()->pluck('name','id')->toArray())
                                ->label(__('form.school'))
                                ->searchable()
                                ->multiple()
                                ->optionsLimit(10)
                                ->preload()
                                ->required()
                        ])
                        ->action(function(array $data, $livewire){
                            try {
                                $operate = $livewire->getSelectedTableRecords()->map(function ($item) use($data) {
                                    return $item->schools()->syncWithoutDetaching($data['school_id']);
                                });
                                Notification::make()
                                    ->success()
                                    ->title(__('notification.success'))
                                    ->body(__('notification.success_body',['name'=>'pada sekolah yang sudah terpilih']))
                                    ->icon('heroicon-o-check-badge')
                                    ->send();
                            } catch (\Throwable $th) {
                                Notification::make()
                                    ->danger()
                                    ->title(__('notification.danger'))
                                    ->body(__('notification.danger_body',['body'=>$th]))
                                    ->icon('heroicon-o-x-circle')
                                    ->send();
                            }
                            
                        })
                ]),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(UserExporter::class)
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsers::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $currentTeamId = Filament::getTenant()->id;

        return parent::getEloquentQuery()
                 ->whereHas('schools', function ($query) use ($currentTeamId) {
                $query->where('schools.id', $currentTeamId);
            });
    }
}
