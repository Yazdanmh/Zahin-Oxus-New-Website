<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Friend;
use Illuminate\Support\Facades\Storage;
class FriendsController extends Controller
{
    public function index(){
        $friends = Friend::paginate(5); 
        return Inertia::render('Admin/Friends/Index', [
            'companies' => $friends
        ]); 
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,gif,svg,webp|max:1024',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('companies', 'public');
        }

        // Create the company
        Friend::create([
            'name' => $request->input('name'),
            'image' => $imagePath,
        ]);
        return redirect()->back();
    }
    public function destroy($id)
    {
        $company = Friend::findOrFail($id);
        if ($company->image) {
            Storage::disk('public')->delete($company->image);
        }
        $company->delete();
        return redirect()->back();
    }
    

}
