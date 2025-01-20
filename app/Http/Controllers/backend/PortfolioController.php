<?php

namespace App\Http\Controllers\backend;
use App\Models\Category; 
use App\Models\Portfolio; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia; 


class PortfolioController extends Controller
{
    public function index(){
        $portfolios = Portfolio::with('category')->paginate(10); 
        return Inertia::render('Admin/Portfolio/Index',[
            'portfolios' => $portfolios,
        ]);
    }
    public function create(){
        $categories = Category::all(); 
        return Inertia::render('Admin/Portfolio/Create',[
            'categories' => $categories, 
        ]); 
    }
    public function store(Request $request){

        $request->validate([
            'title' => 'required', 
            'description' => 'required', 
            'category_id' => 'required|integer', 
            'has_form' => 'required|integer', 
            'date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,gif,PNG',
        ]); 
        $imagePath = $request->file('image')->store('portfolio', 'public');
        Portfolio::create([
            'title' => $request->input('title'), 
            'description' => $request->input('description'), 
            'category_id' => $request->input('category_id'), 
            'has_form' => $request->input('has_form'), 
            'date' => $request->input('date'), 
            'image' => $imagePath,
        ]);
        return redirect()->route('portfolio.index');

    }
}
