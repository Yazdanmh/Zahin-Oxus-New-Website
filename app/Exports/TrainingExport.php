<?php 
namespace App\Exports;

use App\Models\Training;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TrainingExport implements FromCollection, WithHeadings
{
    /**
     * Return the collection of data to be exported.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Training::with('service') // Eager load the 'service' relationship
            ->get()
            ->map(function ($training) {
                return [
                    $training->id,
                    $training->name,
                    $training->service ? $training->service->title : null, // Get the related service title
                    $training->start_date,
                    $training->end_date,
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
            'Service',    // Column label for the 'service.title' field
            'Start Date', // Column label for the 'start_date' field
            'End Date',   // Column label for the 'end_date' field
        ];
    }
}
