<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Sitecontent;
use App\Models\Student;
use App\Models\Test;
use App\Models\Trainer;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
public function index(){ 


    $data['banner'] = json_decode(Sitecontent::select('content')->where('name', 'banner')->first()->content); 
    $data['courses'] = Course::latest()->take(3)->get(); 
    $data['courses_count'] = Course::count();
    $data['trainers_count'] = Trainer::count();
    $data['students_count'] = Student::count();
    $data['tests'] = Test::get(); 
    return view('Front.index')->with($data) ; 
}
}
