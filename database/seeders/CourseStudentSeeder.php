<?php

namespace Database\Seeders;

use App\Models\Course;
// هنا الجديد 
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 2; $i <= 20; $i++) {
            // احصل على course_id و student_id من الموديلز
            $courseId = Course::inRandomOrder()->value('id');
            $studentId = Student::inRandomOrder()->value('id');
    
            // قم بإدراج البيانات باستخدام المتغيرات المحددة
            DB::table('course_student')->insert([
                'course_id' => $courseId,
                'student_id' => $studentId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
