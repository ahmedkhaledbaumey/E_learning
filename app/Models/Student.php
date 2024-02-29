<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory; 
    protected $guarded = ['id'];  

    public function courses(){

return $this->belongsToMany(Course::class)->withPivot('status', 'id') ; 

    }  

    // Student.php

// public function courses()
// {
//     return $this->hasMany(Course::class);
// }


    public function cat(){ 
        return $this->belongsTo(Cat::class);
    }   
 
    public function trainer(){ 
        return $this->belongsTo(Trainer::class);
    }   
 

}
