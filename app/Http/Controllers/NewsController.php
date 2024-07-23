<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Http\RedirectResponse;

class NewsController extends Controller
{
    public function index(){
        $news = News::all();
        return view('news.index', compact('news'));
    }

    public function store(Request $request): RedirectResponse
{
    // Validate the request
    $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'date' => ['required', 'date'],
        'description' => ['required', 'string', 'max:2000'],
        'category' => ['required', 'string', 'max:255'],
        'image' => ['required', 'array', 'min:3'],
        'image.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
    ], [
        'image.min' => 'The news must have at least 3 images.'
    ]);

    // Create a new news item
    $news = new News();
    $news->title = $request->title;
    $news->date = $request->date;
    $news->description = $request->description;
    $news->category = $request->category;

    $imagePaths = [];

    if ($request->hasFile('image')) {
        foreach ($request->file('image') as $image) {
            $newImageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images/news_images'), $newImageName);
            $imagePaths[] = $newImageName;
        }
    }

    $news->image = json_encode($imagePaths);
    $news->save();

    // Redirect to a route after successfully storing the news
    return redirect()->route('news.add')->with('success', 'News added successfully!');
}


    public function view($id){
        $news = News::find($id);
        return view('news.view' ,compact('news'));
    }

    public function delete(Request $request){
        $clubs = News::find($request->id);
        $clubs->delete();
        return redirect()->back();
    }
}
