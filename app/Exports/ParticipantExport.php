<?php

namespace App\Exports;

use App\Models\TrainingParticipants;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParticipantExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return TrainingParticipants::with('training') // Eager load the 'training' relationship
            ->get()
            ->map(function ($participant) {
                return [
                    $participant->id,                      // ID
                    $participant->full_name,               // Name
                    $participant->email,                   // Email
                    $participant->phone_number,            // Phone Number
                    $participant->address,                 // Address
                    $participant->taskira_number,          // Taskira Number
                    $participant->organization,            // Organization
                    $participant->position,                // Position
                    $participant->training ? $participant->training->name : null, // Related Training Name
                    $participant->created_at,              // Created At
                    $participant->updated_at,              // Updated At
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
            'ID',               // Column label for the 'id' field
            'Full Name',        // Column label for the 'full_name' field
            'Email',            // Column label for the 'email' field
            'Phone Number',     // Column label for the 'phone_number' field
            'Address',          // Column label for the 'address' field
            'Taskira Number',   // Column label for the 'taskira_number' field
            'Organization',     // Column label for the 'organization' field
            'Position',         // Column label for the 'position' field
            'Training Name',    // Column label for the related 'training' name
            'Created At',       // Column label for the 'created_at' field
            'Updated At',       // Column label for the 'updated_at' field
        ];
    }
}
