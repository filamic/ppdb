<?php

namespace App\Filament\Exports;

use App\Models\Student;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class StudentExporter extends Exporter
{
    protected static ?string $model = Student::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            // ExportColumn::make('user.name'),
            ExportColumn::make('annual_study')->label(__('form.annual_study')),
            ExportColumn::make('registration_number'),
            ExportColumn::make('name')->label(__('form.name')),
            ExportColumn::make('nickname')->label(__('form.nickname')),
            ExportColumn::make('place_of_birth')->label(__('form.place_of_birth')),
            ExportColumn::make('date_of_birth')->label(__('form.date_of_birth')),
            ExportColumn::make('mother_tongue')->label(__('form.mother_tongue')),
            ExportColumn::make('status_in_the_family')->label(__('form.status_in_the_family')),
            ExportColumn::make('pupil_position')->label(__('form.pupil_position')),
            ExportColumn::make('sex')->label(__('form.sex')),
            ExportColumn::make('religion')->label(__('form.religion')),
            ExportColumn::make('nationality')->label(__('form.nationality')),
            ExportColumn::make('numbers_of_siblings')->label(__('form.numbers_of_siblings')),
            ExportColumn::make('previous_school_name')->label(__('form.previous_school_name')),
            ExportColumn::make('previous_school_city_name')->label(__('form.previous_school_city_name')),
            ExportColumn::make('previous_school_country_name')->label(__('form.previous_school_country_name')),
            // ExportColumn::make('attachment'),
            // ExportColumn::make('school.name'),
            // ExportColumn::make('statement'),
            ExportColumn::make('confidential_health_information')->listAsJson(),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your student export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
