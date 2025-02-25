<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia; 
use App\Models\News; 
use Str; 
use Illuminate\Support\Facades\Storage;
class NewsController extends Controller
{
    public function index(){
        return Inertia::render('Admin/News/Index', [
            'news' => News::paginate(10),
        ]);
    }
    public function create(){
        return Inertia::render('Admin/News/Create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'is_published' => 'required|boolean',
            'tags' => 'required|string|max:255', 
            'image' => 'required|image|mimes:jpeg,png,gif,PNG,svg,webp',
        ]);

        $imagePath = $request->file('image')->store('news', 'public');

        News::create([
            'title' => $request->input('title'),
            'content' => $request->input('description'),
            'is_published' => $request->input('is_published'),
            'tags' => $request->input('tags'),
            'image' => $imagePath,
            'slug' => Str::slug($request->input('title')),
        ]);

        return redirect()->route('news.index');
    }

    public function edit($id){
        $news = News::findOrFail($id); 
        return Inertia::render('Admin/News/Edit',[
            'news' => $news, 
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tags' => 'required|string|max:255',
            'is_published' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,gif,PNG,svg,webp',  
        ]);

        $news = News::findOrFail($id);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($news->image);

            $imagePath = $request->file('image')->store('news', 'public');
            $news->image = $imagePath;  
        }

        $news->update([
            'title' => $request->input('title'),
            'content' => $request->input('description'),
            'tags' => $request->input('tags'),
            'is_published' => $request->input('is_published'),
            'slug' => Str::slug($request->input('title')), 
        ]);
        return redirect()->route('news.index')->with('success', 'News updated successfully');
    }

    public function show($id){
        $news = News::findOrFail($id); 
        return Inertia::render('Admin/News/Details',[
            'news' => $news, 
        ]);
    }
    public function destroy($id){
        $news = News::findOrFail($id);
        if($news->image){
            Storage::disk('public')->delete($news->image);
        }
        $news->delete(); 
        return redirect()->route('news.index');
    }
}
