<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia; 
use App\Models\MOU; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage; 

class MOUController extends Controller
{


    public function index(Request $request)
    {
        $searchQuery = $request->input('search', '');
        $selectedDate = $request->input('date', '');

        $mousQuery = MOU::query();

        if ($searchQuery) {
            $mousQuery->where('title', 'like', '%' . $searchQuery . '%');
        }

        if ($selectedDate) {
            $mousQuery->whereDate('start_date', '=', $selectedDate);
        }

        $mou = $mousQuery->paginate(10);

        return inertia('Admin/MOU/Index', [
            'mou' => $mou,
        ]);
    }

    public function create(){
        return Inertia::render('Admin/MOU/Create'); 
    }
    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'parties_involved' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'status' => 'required|in:Active,Inactive,Pending',
            'mou_file' => 'required|file|mimes:pdf,docx,jpg,jpeg,png|max:10240',
        ]);
    
        if ($validator->fails()) {
            // Pass errors directly in the Inertia response as 'errors'
            return Inertia::render('Admin/MOU/Create', [
                'errors' => $validator->errors(),
                'form' => $request->all() // Pass form data to repopulate the fields
            ]);
        }
    
        // Handle file upload if present
        $mouFilePath = null;
        if ($request->hasFile('mou_file')) {
            $mouFile = $request->file('mou_file');
            $mouFilePath = $mouFile->storeAs('mou_files', time() . '-' . $mouFile->getClientOriginalName(), 'public');
        }

        MOU::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'parties_involved' => $request->input('parties_involved'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'status' => $request->input('status'),
            'mou_file' => $mouFilePath, // Store the file path if present
        ]);
    
        // Redirect back to the MOU list or a success page using Inertia
        return redirect()->route('mou.index')->with('success', 'MOU created successfully!');
    }

    public function edit($id){
        $mou = MOU::findOrFail($id);
        return Inertia::render('Admin/MOU/Edit', [
            'mou' => $mou, 
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'parties_involved' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'status' => 'required|in:Active,Inactive,Pending',
            'mou_file' => 'nullable|file|mimes:pdf,docx,jpg,jpeg,png|max:10240',
        ]);
        
        if ($validator->fails()) {
            return Inertia::render('Admin/MOU/Edit', [
                'errors' => $validator->errors(),
                'form' => $request->all(), 
            ]);
        }

        $mou = MOU::findOrFail($id);
        $mouFilePath = $mou->mou_file; 
        if ($request->hasFile('mou_file')) {
            if ($mou->mou_file) {
                Storage::disk('public')->delete($mou->mou_file);
            }
            $mouFile = $request->file('mou_file');
            $mouFilePath = $mouFile->storeAs('mou_files', time() . '-' . $mouFile->getClientOriginalName(), 'public');

        }
        $mou->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'parties_involved' => $request->input('parties_involved'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'status' => $request->input('status'),
            'mou_file' => $mouFilePath, 
        ]);
        return redirect()->route('mou.index')->with('success', 'MOU updated successfully!');
    }
    public function destroy($id)
    {
        $mou = MOU::findOrFail($id);
        if ($mou->mou_file) {
            Storage::disk('public')->delete($mou->mou_file);
        }
        $mou->delete();
        return redirect()->route('mou.index')->with('success', 'MOU deleted successfully!');
    }

    public function show($id){
        $mou = MOU::findOrFail($id); 
        return Inertia::render('Admin/MOU/Details',[
            'mou' => $mou, 
        ]);
    }

}
