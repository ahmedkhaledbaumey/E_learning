<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{ 
    public function cat($id) {  

     $data['cat'] =  Cat::findOrFail($id);  
     $data['courses'] =Course::where('cat_id',$id )->paginate(3);
     return view('Front.courses.cat')->with($data) ; 
    } 

    public function show($id , $c_id) 
    {
        $data['courses'] =  Course::findOrFail($c_id);  
        $data['courses'] =Course::where('id',$c_id )->first();
        return view('Front.courses.show')->with($data) ; 



    }

}
