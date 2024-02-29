<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
 
// هنا طريقه بدائيه وقديمه 


class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            for ($j = 1; $j <= 6; $j++) {
                Course::create([
                    'cat_id' => $i,
                    'trainer_id' => rand(1, 5),
                    'name' => "course num $j cat num $i", 
                    'small_desc' => "Lorem ipsum dolor sit, amet consectetur adipisicing e",
                    'desc' => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Soluta laudantium odit quaerat eum voluptatum nihil exercitationem nulla accusamus tempora veritatis, quia iusto aspernatur laboriosam beatae, et quisquam accusantium. Accusamus, tem!",
                    'price' => rand(1000, 5000),
                    'img' => "$i.png",
                ]);
            }
        }
    }
}