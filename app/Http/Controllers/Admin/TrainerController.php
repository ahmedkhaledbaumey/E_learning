<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trainer;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class TrainerController extends Controller
{
    public function index()
    {
        $trainers = Trainer::all();
        return view('admin.trainers.index', compact('trainers'));
    }

    public function create()
    {
        return view('admin.trainers.create');
    }

    public function store(Request $request)
    {
        $trainerData = $request->validate([
            'name' => 'required|string|max:255',
            'spec' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $trainer = new Trainer();
        $trainer->name = $trainerData['name'];
        $trainer->spec = $trainerData['spec'];
        $trainer->phone = $trainerData['phone'] ?? '';

        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $filename = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
            $path = 'upload/trainers/' . $filename;

            // Resize image using Intervention Image
            $img = Image::make($img)->fit(50, 50);
            $img->save(public_path($path));

            $trainer->img = $filename;
        } else {
            // If no image in the request, set a default image
            $trainer->img = '1.png';
        }

        $trainer->save();

        return redirect()->route('admin.trainers.index')->with('success', 'Trainer created successfully');
    }

    public function show($id)
    {
        $trainer = Trainer::findOrFail($id);
        return view('admin.trainers.show', compact('trainer'));
    }

    public function edit($id)
    {
        $trainer = Trainer::findOrFail($id);
        return view('admin.trainers.edit', compact('trainer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'spec' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
        ]);

        $trainer = Trainer::findOrFail($id);
        $trainer->name = $request->name;

        if ($request->hasFile('img')) {
            // Delete old image if it exists
            $imagePath = public_path('upload/trainers/') . $trainer->img;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $img = $request->file('img');
            $filename = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
            $path = 'upload/trainers/' . $filename;

            // Resize image using Intervention Image
            $img = Image::make($img)->fit(50, 50);
            $img->save(public_path($path));

            $trainer->img = $filename;
        }

        $trainer->save();

        return redirect()->route('admin.trainers.index')->with('success', 'Trainer updated successfully');
    }

    public function destroy($id)
    {
        $trainer = Trainer::findOrFail($id);

        // Delete image
        $imagePath = public_path('upload/trainers/') . $trainer->img;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $trainer->delete();

        return redirect()->route('admin.trainers.index')->with('success', 'Trainer deleted successfully');
    }
}
