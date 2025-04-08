<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; 
use Inertia\Inertia;
use Illuminate\Routing\Controllers\Middleware;

class CategoryController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:site_data.view', only: ['index']),
            new Middleware('can:site_data.create', only: ['store']),
            new Middleware('can:site_data.edit', only: ['update']),
            new Middleware('can:site_data.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $categories = Category::all();
        return Inertia::render('Admin/Category/Index', [
            'categories' => $categories, 
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
        ]); 
        Category::create([
            'title' => $request->title
        ]);
        return redirect()->route('categories.index'); 
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id); 
        $category->title = $request->title; 
        $category->update(); 
        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id); 
        $category->delete(); 
        return redirect()->route('categories.index');
    }
}
