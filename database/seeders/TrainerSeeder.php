<?php

namespace Database\Seeders;

use App\Models\Trainer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PHPUnit\Event\Tracer\Tracer;

class TrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        Trainer::create([
         
'name' => 'ahmed khaled' , 
'spec' => 'web development' , 
'img' => '1.png' , 

            
        ]) ; 
        Trainer::create([
         
'name' => 'omda' , 
'spec' => 'dentist' , 
'img' => '2.png' , 


        ]) ; 
        Trainer::create([
         
'name' => 'kreep' , 
'spec' => 'doctor' , 
'img' => '3.png' , 


        ]) ; 
        Trainer::create([
         
'name' => 'elol' , 
'spec' => 'english teacher' , 
'img' => '4.png' , 


        ]) ; 
        Trainer::create([
         
'name' => 'walaa' , 
'spec' => 'doctor' , 
'img' => '5.png' , 


        ]) ; 
     
    }
}
