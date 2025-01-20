<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; 
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return Inertia::render('Admin/Category/Index', [
            'categories' => $categories, 
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string',
        ]); 
        Category::create([
            'title' => $request->title
        ]);
        return redirect()->route('categories.index'); 

    }

    public function update(Request $request, $id){
        $category = Category::findOrFail($id); 
        $category->title = $request->title; 
        $category->update(); 
        return redirect()->route('categories.index');

    }
    public function destroy($id){
        $category = Category::findOrFail($id); 
        $category->delete(); 
        return redirect()->route('categories.index');
    }
}
