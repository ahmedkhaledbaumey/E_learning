<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cat; // Make sure to import the Cat model
use Illuminate\Http\Request;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $cats = Cat::orderBy('id', 'DESC')->get();
         return view('admin.cats.index', compact('cats')); // Assuming you have a view named 'cats.index'
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cats.create'); // Assuming you have a view for creating a category
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            // Add any other validation rules as needed
        ]);

        // Create a new category
        Cat::create([
            'name' => $request->input('name'),
            // Add any other fields you want to save
        ]);

        return redirect(route('admin.cats.index'))->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cat = Cat::findOrFail($id);
        return view('admin.cats.show', compact('cat')); // Assuming you have a view for showing a category
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cat = Cat::findOrFail($id);
        return view('admin.cats.edit', compact('cat')); // Assuming you have a view for editing a category
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Add any other validation rules as needed
        ]);

        $cat = Cat::findOrFail($id);
        $cat->update([
            'name' => $request->input('name'),
            // Add any other fields you want to update
        ]);

        return redirect()->route('admin.cats.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cat = Cat::findOrFail($id);
        $cat->delete();

        return redirect()->route('admin.cats.index')->with('success', 'Category deleted successfully!');
    }
}
