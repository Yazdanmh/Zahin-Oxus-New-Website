<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use Inertia\Inertia;

class ServiceCategoryController extends Controller
{
    public function index(){
        $categories = ServiceCategory::all();
        return Inertia::render('Admin/ServiceCategory/Index', [
            'categories' => $categories, 
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
            'icon' => 'required|string',
        ]); 
        ServiceCategory::create([
            'name' => $request->name,
            'icon' => $request->icon,
            'slug' => \Str::slug($request->name),
        ]);
        return redirect()->route('service-categories.index'); 

    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string',
            'icon' => 'required|string',
        ]);


        $category = ServiceCategory::findOrFail($id); 
        $category->name = $request->name; 
        $category->icon = $request->icon; 
        $category->slug = \Str::slug($request->name);
        $category->update(); 
        return redirect()->route('service-categories.index');

    }
    public function destroy($id){
        $category = ServiceCategory::findOrFail($id); 
        $category->delete(); 
        return redirect()->route('service-categories.index');
    }
}
