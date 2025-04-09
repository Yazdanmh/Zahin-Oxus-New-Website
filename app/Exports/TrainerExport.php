<?php

namespace App\Exports;

use App\Models\Trainer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class TrainerExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Trainer::with('service') // Eager load the 'service' relationship
            ->get()
            ->map(function ($trainer) {
                return [
                    $trainer->id,
                    $trainer->name,
                    $trainer->position,
                    $trainer->service ? $trainer->service->title : null, // Get the related service title
                    $trainer->created_at,
                    $trainer->updated_at,
                ];
            });
    }

    /**
     * Return the headings for the columns.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',         // Column label for the 'id' field
            'Name',       // Column label for the 'name' field
            'Position',    // Column label for the 'service.title' field
            'Service', // Column label for the 'start_date' field
            'Created At',   // Column label for the 'end_date' field
            'Updated At',   // Column label for the 'end_date' field
        ];
    }
}
