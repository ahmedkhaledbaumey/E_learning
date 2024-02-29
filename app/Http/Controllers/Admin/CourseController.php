<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Course;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(3);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $cats = Cat::all();
        $trainers = Trainer::all();

        return view('admin.courses.create', compact('cats', 'trainers'));
    }

    public function store(Request $request)
    {
        $courseData = $request->validate([
            'name' => 'required|string|max:255',
            'cat_id' => 'required|exists:cats,id',
            'trainer_id' => 'required|exists:trainers,id',
            'small_desc' => 'required|string',
            'desc' => 'required|string',
            'price' => 'required|numeric',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
    
        $course = new Course();
        $course->name = $courseData['name'];
        $course->cat_id = $courseData['cat_id'];
        $course->trainer_id = $courseData['trainer_id'];
        $course->small_desc = $courseData['small_desc'];
        $course->desc = $courseData['desc'];
        $course->price = $courseData['price'];
    
        if ($request->hasFile('img')) {
            $this->uploadImage($request, $course);
        } else {
            $course->img = '1.png'; // Set default image if no image is uploaded
        }
    
        $course->save();
    
        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully');
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.courses.show', compact('course'));
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $cats = Cat::all();
        $trainers = Trainer::all();

        return view('admin.courses.edit', compact('course', 'cats', 'trainers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'cat_id' => 'required|exists:cats,id',
            'trainer_id' => 'required|exists:trainers,id',
            'small_desc' => 'required|string',
            'desc' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $course = Course::findOrFail($id);
        $course->name = $request->name;
        $course->cat_id = $request->cat_id;
        $course->trainer_id = $request->trainer_id;
        $course->small_desc = $request->small_desc;
        $course->desc = $request->desc;
        $course->price = $request->price;

        if ($request->hasFile('img')) {
            $this->deleteOldImage($course->img);
            $this->uploadImage($request, $course);
        }

        $course->save();

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $this->deleteOldImage($course->img);
        $course->delete();

        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully');
    }

    protected function deleteOldImage($imageName)
    {
        $imagePath = public_path('upload/courses/') . $imageName;
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
    }

    protected function uploadImage(Request $request, Course $course)
    {
        $img = $request->file('img');
        $filename = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
        $path = 'upload/courses/' . $filename;

        // Resize image using Intervention Image
        $img = Image::make($img)->fit(50, 50);
        $img->save(public_path($path));

        $course->img = $filename;
    }
}
