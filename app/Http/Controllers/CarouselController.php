<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Carousel;

class CarouselController extends Controller
{
    public function index() {
        $carousel = Carousel::all();
        return view('carousel.index', compact('carousel'));
    }
    
    public function add() {
        return view('carousel.add');
    }

    public function store(Request $request): RedirectResponse {
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png,svg,webp|max:5048'
        ]);
    
        $newImageName = time() . '_' . $request->image->getClientOriginalName();
        $request->image->move(public_path('images/carousel_images'), $newImageName);
    
        // Create a new carousel instance
        $carousel = new Carousel();
        $carousel->image = $newImageName; // corrected property name
        $carousel->save();
    
        // Redirect back with a success message
        return redirect()->route('carousel.add')->with('success', 'Carousel image has been added successfully!');
    }

    public function edit($id)
    {
        $carousel = Carousel::find($id);
        return view('carousel.edit', compact('carousel'));
    }
    

    public function update(Request $request) {
        $request->validate([
            'image' => 'nullable|mimes:jpg,jpeg,png,svg,webp|max:5048',
        ]);

        // Find the club by its ID
        $carousel= Carousel::find($request->id);

        // Check if the club exists
        if (!$carousel) {
            return redirect()->back()->with('error', 'Carousel not found.');
        }

        // Check if a new logo file has been uploaded
        if ($request->hasFile('image')) {
            // Delete the old logo file if it exists
            if ($carousel->image && file_exists(public_path('images/carousel_images/' . $carousel->image))) {
                unlink(public_path('images/carousel_images/' . $carousel->image));
            }

            // Store the new logo file
            $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('images/carousel_images'), $newImageName);
            $carousel->image = $newImageName;
        }

        // Save the changes
        $carousel->save();

        return redirect()->back()->with('success', 'Carousel Image updated successfully!');
    }

    public function delete(Request $request) {
        $carousel = Carousel::find($request->id);
        $carousel->delete();
        return redirect()->back();
    }
    
}
