<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory; 
    protected $guarded = ['id'];  

    public function courses(){ 
        return $this->hasMany(Courses::class); 

    }   
    public function students(){ 
        return $this->hasMany(Students::class); 

    }   






}
