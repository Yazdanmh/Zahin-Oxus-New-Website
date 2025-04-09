<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\Service;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TrainingExport;
use Barryvdh\DomPDF\Facade\Pdf;

class TrainingController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:training.view', only: ['index', 'show', 'export']),
            new Middleware('can:training.create', only: ['store', 'create']),
            new Middleware('can:training.edit', only: ['update', 'edit']),
            new Middleware('can:training.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $trainings = Training::with('service')->paginate(10);
        return Inertia::render('Admin/Training/Index', [
            'trainings' => $trainings,
        ]);
    }

    public function create()
    {
        $services = Service::select('id', 'title')->get();
        return Inertia::render('Admin/Training/Create', [
            'services' => $services,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'image' => 'required|image|mimes:jpeg,png,gif,PNG,svg,webp',
            'description' => 'required|string',
            'has_form' => 'required|boolean',
            'service_id' => 'required|integer'
        ]);

        $imagePath = $request->file('image')->store('trainings', 'public');

        Training::create([
            'name' => $request->input('name'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'image' => $imagePath,
            'description' => $request->input('description'),
            'has_form' => $request->input('has_form'),
            'service_id' => $request->input('service_id'),
            'slug' => Str::slug($request->input('name')),
        ]);

        return redirect()->route('training.index');
    }

    public function edit($id)
    {
        $training = Training::findOrFail($id);
        $services = Service::select("id", 'title')->get();
        return Inertia::render('Admin/Training/Edit', [
            'training' => $training,
            'services' => $services,
        ]);
    }

    public function update(Request $request, $id)
    {
        $training = Training::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024', // 1MB max size
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'has_form' => 'nullable|boolean',
            'service_id' => 'required|integer'
        ]);

        if ($request->hasFile('image')) {
            if ($training->image) {
                Storage::disk('public')->delete($training->image);
            }

            // Store the new image
            $validated['image'] = $request->file('image')->store('trainings', 'public');
        } else {
            // If no new image, keep the old image
            $validated['image'] = $training->image;
        }

        // Update the slug if the name changes
        $validated['slug'] = Str::slug($request->input('name'));

        // Update the training record
        $training->update($validated);

        return redirect()->route('training.index')->with('success', 'Training updated successfully!');
    }

    public function destroy($id)
    {
        $training = Training::findOrFail($id);
        if ($training->image) {
            Storage::disk('public')->delete($training->image);
        }
        $training->delete();
        return redirect()->route('training.index');
    }

    public function show($id)
    {
        $training = Training::with('service')->findOrFail($id);
        return Inertia::render('Admin/Training/Details', [
            'training' => $training,
        ]);
    }
    public function export($fileType)
    {
        // Handle the file export based on the file type
        if ($fileType === 'excel') {
            return Excel::download(new TrainingExport, 'trainings.xlsx');
        } elseif ($fileType === 'pdf') {
            $trainings = Training::with('service')->get(); // Fetch the training data
            $pdf = Pdf::loadView('exports.trainings', compact('trainings'));
            return $pdf->download('trainings.pdf');
        } else {
            return redirect()->route('trainings.index')->with('error', 'Invalid file type');
        }
    }
}
