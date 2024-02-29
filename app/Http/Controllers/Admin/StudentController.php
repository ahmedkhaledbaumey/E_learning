<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Course;
use App\Models\Student;
use App\Models\Trainer;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::paginate(3); 
        $cats = Cat::all();
        $trainers = Trainer::all();
        return view('admin.students.index', compact('students', 'cats', 'trainers'));
    }

    public function create()
    { 
        $cats = Cat::all();
        $trainers = Trainer::all();
        return view('admin.students.create', compact('cats', 'trainers'));
    }

    public function store(Request $request)
    {
        $studentData = $request->validate([
            'name' => 'required|string|max:255',
            'spec' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255', 
            'email' => 'required|email|max:255|unique:students',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'cat_id' => 'required|exists:cats,id',
            'trainer_id' => 'required|exists:trainers,id',
        ]);

        $student = new Student();
        $student->name = $studentData['name'];
        $student->spec = $studentData['spec'];
        $student->email = $studentData['email'];
        $student->phone = $studentData['phone'] ?? '';
        $student->cat_id = $studentData['cat_id'];
        $student->trainer_id = $studentData['trainer_id'];

        if ($request->hasFile('img')) {
            $this->uploadImage($request, $student);
        } else {
            $student->img = '1.png';
        }

        $student->save();

        return redirect()->route('admin.students.index')->with('success', 'Student created successfully');
    } 

    public function show($id)
    { 
        $student = Student::findOrFail($id);  
        $cats = Cat::all();
        $trainers = Trainer::all();
        return view('admin.students.show', compact('student', 'cats', 'trainers'));
    }

    public function edit($id)
    { 
        $cats = Cat::all();
        $trainers = Trainer::all();
        $student = Student::findOrFail($id);
        return view('admin.students.edit', compact('student', 'cats', 'trainers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'spec' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:students',
            'phone' => 'nullable|string|max:255',
            'cat_id' => 'required|exists:cats,id',
            'trainer_id' => 'required|exists:trainers,id',
        ]);

        $student = Student::findOrFail($id);
        $student->name = $request->name;
        $student->spec = $request->spec;
        $student->email = $request->email;
        $student->phone = $request->phone ?? '';
        $student->cat_id = $request->cat_id;
        $student->trainer_id = $request->trainer_id;

        if ($request->hasFile('img')) {
            $this->deleteOldImage($student->img);
            $this->uploadImage($request, $student);
        } 

        $student->save();

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $this->deleteOldImage($student->img);
        $student->delete();

        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully');
    }

    protected function deleteOldImage($imageName)
    {
        $imagePath = public_path('upload/courses/') . $imageName;
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
    }

    protected function uploadImage(Request $request, Student $student)
    {
        $img = $request->file('img');
        $filename = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
        $path = 'upload/students/' . $filename;

        // Resize image using Intervention Image
        $img = Image::make($img)->fit(50, 50);
        $img->save(public_path($path));

        $student->img = $filename;
    } 


    
    public function showCourse($id)
    {
        $student = Student::findOrFail($id);
        $courses = $student->courses;
    
        // تجميع معلومات الطلاب لكل دورة
        $studentsInCourses = [];
        foreach ($courses as $course) {
            $studentsInCourses[$course->id] = $course->students;
        }
    
        $student_id = $id;
    
        return view('admin.students.showCourses', compact('courses', 'student_id', 'studentsInCourses'));
    }
    

    public function approve($id , $c_id) 
    { 
        DB::table('course_student')->where('student_id' ,$id )->where('course_id' , $c_id)->update([
            'status' => 'approve' 
        ]) ; 
        return back( );


    } 

    public function reject($id , $c_id) 
    {

        DB::table('course_student')->where('student_id' ,$id )->where('course_id' , $c_id)->update([
            'status' => 'reject' 
        ]) ; 
        return back();

    } 


     
    public function addCourse($id) 
    {
    
        $student_id = $id ; 

        $courses = Course::get();  
         
        return view('admin.students.addCourse', compact('courses', 'student_id'));


    } 

    public function storeCourse($id, Request $request)
    {
        // Validate the request data
        $courseData = $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);
    
        // Check if the student is already enrolled in the selected course
        $existingRecord = DB::table('course_student')
            ->where('student_id', $id)
            ->where('course_id', $courseData['course_id'])
            ->first();
    
        if (!$existingRecord) {
            // Insert a record into the course_student pivot table
            DB::table('course_student')->insert([
                'student_id' => $id,
                'course_id' => $courseData['course_id'],
            ]);
    
            // Redirect back to the student's courses page
            return redirect(route('admin.students.showCourses', $id))->with('success', 'Course added successfully');
        } else {
            // Redirect back with a message indicating that the student is already enrolled
            return redirect(route('admin.students.showCourses', $id))->with('error', 'Student is already enrolled in this course');
        }
    }
    

    public function removeCourse($id)
    {
        // Validate the request data
       
    
        // Insert a record into the course_student pivot table
        DB::table('course_student')->where('course_id' ,$id )->delete() ; 
    
        // Redirect back to the student's courses page
        // return redirect(route('admin.students.showCourses', $id));
        return redirect()->back(); // good boy khalood 
    }
    
   
  
}
