<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AcademicCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Illuminate\Routing\Controllers\Middleware;

class AcademicCalendarController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:site_data.view', only: ['index']),
            new Middleware('can:site_data.create', only: ['store']),
            new Middleware('can:site_data.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $calendars = AcademicCalendar::paginate(10);
        return Inertia::render('Admin/Calendar/Index', [
            'calendars' => $calendars,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,docx,xlsx|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $calendar = new AcademicCalendar();
        $calendar->title = $request->title;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('academic_calendar', $fileName, 'public');
            $calendar->file = $filePath;
        }
        $calendar->save();
        return redirect()->route('calendars.index')->with('success', 'Academic Calendar uploaded successfully!');
    }

    public function destroy($id)
    {
        $calendar = AcademicCalendar::findOrFail($id);

        if ($calendar->file) {
            Storage::disk('public')->delete($calendar->file);
        }

        $calendar->delete();

        return redirect()->route('calendars.index')->with('success', 'Certificate deleted successfully!');
    }
}
