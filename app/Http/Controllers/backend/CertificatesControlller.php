<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia; 
use App\Models\Certificate; 
use App\Models\Training; 
use Illuminate\Support\Facades\Validator;

class CertificatesControlller extends Controller
{
    public function index(Request $request)
    {
        $query = Certificate::query()->with('training');

        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('certificate_code', 'like', '%' . $request->search . '%')
                ->orWhere('certificate_name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('training_id') && $request->training_id) {
            $query->where('training_id', $request->training_id);
        }

        if ($request->has('issue_date') && $request->issue_date) {
            $query->whereDate('issue_date', $request->issue_date);
        }

        $certificates = $query->paginate(10);

        return Inertia::render('Admin/Certificates/Index', [
            'certificates' => $certificates,
            'trainings' => Training::all(),
        ]);
    }

    public function create(){
        $trainings = Training::select('id', 'name')->get(); 
        return Inertia::render('Admin/Certificates/Create', [
            'trainings' => $trainings, 
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'certificate_code' => 'required|string|max:255',
            'certificate_name' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'for_who' => 'required|string|max:255',
            'training_id' => 'required|exists:trainings,id',
            'certificate_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:2048', // Add validation for file
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $certificate = new Certificate();
        $certificate->certificate_code = $request->certificate_code;
        $certificate->certificate_name = $request->certificate_name;
        $certificate->issue_date = $request->issue_date;
        $certificate->for_who = $request->for_who;
        $certificate->training_id = $request->training_id;

        // Handle file upload
        if ($request->hasFile('certificate_file')) {
            $file = $request->file('certificate_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('certificates', $fileName, 'public');
            $certificate->certificate_file = $filePath; // Save file path to database
        }

        $certificate->save();

        // Return success message
        return redirect()->route('certificate.index')->with('success', 'Certificate created successfully!');
    }

    public function edit($id){
        $certificate = Certificate::findOrFail($id); 
        $trainings = Training::select('id', 'name')->get(); 
        return Inertia::render('Admin/Certificates/Edit', [
            'certificate' => $certificate, 
            'trainings' => $trainings, 
        ]);
    }
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'certificate_code' => 'required|string|max:255',
            'certificate_name' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'for_who' => 'required|string|max:255',
            'training_id' => 'required|exists:trainings,id',
            'certificate_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx', // Validate the file
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
   
        // Find the certificate by ID
        $certificate = Certificate::findOrFail($id);
    
        // Update certificate details
        $certificate->certificate_code = $request->certificate_code;
        $certificate->certificate_name = $request->certificate_name;
        $certificate->issue_date = $request->issue_date;
        $certificate->for_who = $request->for_who;
        $certificate->training_id = $request->training_id;
    
        // Handle file upload
        if ($request->hasFile('certificate_file')) {
            // Delete the old file if it exists
            if ($certificate->certificate_file && \Storage::disk('public')->exists($certificate->certificate_file)) {
                \Storage::disk('public')->delete($certificate->certificate_file);
            }
    
            $file = $request->file('certificate_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('certificates', $fileName, 'public');
            $certificate->certificate_file = $filePath; // Save new file path to database
        }
    
        $certificate->save();
    
        return redirect()->route('certificate.index')->with('success', 'Certificate updated successfully!');
    }
    

    public function destroy($id)
    {
        $certificate = Certificate::findOrFail($id);
    
        if ($certificate->certificate_file) {
            \Storage::disk('public')->delete($certificate->certificate_file);
        }
    
        $certificate->delete();
    
        return redirect()->route('certificate.index')->with('success', 'Certificate deleted successfully!');
    }
    
}
