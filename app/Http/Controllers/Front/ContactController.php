<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
   



    public function index(){ 

        $data['settings'] = Setting::first();  

        return View('front.contact.index')->with($data); 
      
    }
}
