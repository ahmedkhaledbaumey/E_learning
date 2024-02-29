<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Message;
use App\Models\NewsLetter;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class MessageController extends Controller
{
    public function newsletter(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
        ]);

        NewsLetter::create($data);

        return back()->with('success', 'Success! Your newsletter subscription has been sent.');
    }

    public function contact(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'subject' => 'nullable|string|max:191',
            'message' => 'required|string|max:10000',
        ]);

        Message::create($data);

        return back()->with('success', 'Success! Your message has been sent.');
    }

    public function enroll(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:191',
            'email' => 'required|email|max:191',
            'spec' => 'nullable|string|max:191',
            'phone' => 'nullable|string|max:191',
            'course_id' => 'required|exists:courses,id',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $course = Course::with('cat', 'trainer')->findOrFail($data['course_id']);

        $cat_id = $course->cat->id;
        $trainer_id = $course->trainer->id;

        $old_student = Student::where('email', $data['email'])->first();

        if ($old_student === null) {
            $student = Student::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'spec' => $data['spec'],
                'phone' => $data['phone'] ?? '',
                'cat_id' => $cat_id,
                'trainer_id' => $trainer_id,
                'img' => '1.png',
            ]);

            $student_id = $student->id;

            if ($request->hasFile('img')) {
                $img = $request->file('img');
                $filename = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
                $path = $img->storeAs('upload/students', $filename, 'public');
                $student->img = $filename;
                $student->save();
            }
        } else {
            $student_id = $old_student->id;
            if (isset($data['name']) && $data['name'] !== null) {
                $old_student->update(['name' => $data['name']]);
            }
            if (isset($data['spec']) && $data['spec'] !== null) {
                $old_student->update(['spec' => $data['spec']]);
            }
            if (isset($data['phone']) && $data['phone'] !== null) {
                $old_student->update(['phone' => $data['phone']]);
            }
        }

        DB::table('course_student')->insert([
            'course_id' => $data['course_id'],
            'student_id' => $student_id ?? $student->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Success! Your enrollment has been submitted.');
    }
}
