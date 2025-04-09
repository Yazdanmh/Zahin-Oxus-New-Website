<?php

namespace App\Exports;

use App\Models\Certificate;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class CertificateExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Certificate::with('training') // Eager load the 'service' relationship
            ->get()
            ->map(function ($certificate) {
                return [
                    $certificate->certificate_code,
                    $certificate->certificate_name,
                    $certificate->issue_date,
                    $certificate->for_who,
                    $certificate->training ? $certificate->training->name : null, // Get the related service title
                    $certificate->created_at,
                    $certificate->updated_at,
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
            'Certificate Code',
            'Certificate Name',
            'Issue Date',
            'Issued For',
            'Training Name',
            'Created At',
            'Updated At',
        ];
    }
    
}
