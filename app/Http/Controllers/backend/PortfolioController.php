<?php

namespace App\Http\Controllers\backend;

use App\Models\Category;
use App\Models\Portfolio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;


class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::with('category')->paginate(10);
        return Inertia::render('Admin/Portfolio/Index', [
            'portfolios' => $portfolios,
        ]);
    }
    public function create()
    {
        $categories = Category::all();
        return Inertia::render('Admin/Portfolio/Create', [
            'categories' => $categories,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required|integer',
            'has_form' => 'required|integer',
            'date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,gif,PNG,svg,webp',
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
    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $categories = Category::all();

        return Inertia::render('Admin/Portfolio/Edit', [
            'portfolio' => $portfolio,
            'categories' => $categories,
        ]);
    }
    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required|integer',
            'has_form' => 'required|integer',
            'date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,gif,PNG,svg,webp',
        ]);

        $portfolio->title = $request['title'];
        $portfolio->description = $request['description'];
        $portfolio->category_id = $request['category_id'];
        $portfolio->has_form = $request['has_form'];
        $portfolio->date = $request['date'];

        if ($request->hasFile('image')) {
            if ($portfolio->image) {
                Storage::disk('public')->delete($portfolio->image);
            }
            $imagePath = $request->file('image')->store('portfolio', 'public');
            $portfolio->image = $imagePath;
        }
        $portfolio->save();
        return redirect()->route('portfolio.index');
    }
    public function show($id)
    {
        $portfolio = Portfolio::with('category')->find($id);

        return Inertia::render('Admin/Portfolio/Details', [
            'portfolio' => $portfolio,
        ]);
    }
    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        if ($portfolio->image) {
            Storage::disk('public')->delete($portfolio->image);
        }
        $portfolio->delete();
        return redirect()->route('portfolio.index');
    }
}
