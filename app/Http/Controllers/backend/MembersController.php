<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia; 
use App\Models\Member;
use Illuminate\Support\Facades\Storage; 
use Str; 
class MembersController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Members/Index', [
          'members' => Member::paginate(10), 
        ]);
    }
    public function create()
    {
        return Inertia::render('Admin/Members/Create');
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'phone' => 'required|string|max:20',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
            'description' => 'required|string',
            'skills' => 'nullable|json',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('members', 'public');
        }

        // Create member
        Member::create([
            'name' => $request->name,
            'position' => $request->position,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $imagePath ?? null,
            'description' => $request->description,
            'skills' => $request->skills,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('members.index')->with('success', 'Member created successfully.');
    }

    public function edit($id){
        $member = Member::findOrFail($id);
        return Inertia::render('Admin/Members/Edit', [
            'member' => $member
        ]);
    }
    public function update(Request $request, $id)
    {
        // return $request->all(); 
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $id,
            'phone' => 'required|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',  
            'description' => 'required|string',
            'skills' => 'nullable|json',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url'
        ]);

 
        $member = Member::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($member->image) {
                Storage::disk('public')->delete($member->image);
            }
            $imagePath = $request->file('image')->store('members', 'public');
        } else {
            $imagePath = $member->image;  
        }

        $member->update([
            'name' => $request->name,
            'position' => $request->position,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $imagePath,
            'description' => $request->description,
            'skills' => $request->skills,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    public function show($id){
        $member = Member::findOrFail($id);
        return Inertia::render('Admin/Members/Show', [
            'member' => $member
        ]);
    }
    public function destroy($id){
        $member = Member::findOrFail($id);
        if($member->image){
            Storage::disk('public')->delete($member->image);
        }
        $member->delete(); 
        return redirect()->route('members.index');
    }

}
