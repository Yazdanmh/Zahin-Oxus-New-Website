<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Certificate; 

class CertificateController extends Controller
{
    public function verify(){
        return Inertia::render('Client/Certificates/Index');
    }

    public function verify_post(Request $request)
    {
        $certificate = Certificate::where('certificate_code', $request->certificate_number)->first();
    
        if ($certificate) {
            return Inertia::render('Client/Certificates/CertificateVerified', [
                'verified' => true,
                'certificate' => $certificate, 
            ]);
        } else {
            return Inertia::render('Client/Certificates/CertificateVerified', [
                'verified' => false,
                'message' => 'Certificate not found',
            ]);
        }
    }
    




}
