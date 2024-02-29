<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CatController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TrainerController; 
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\CourseController as FrontCourseController;
use App\Http\Controllers\Front\HomepageController;
use App\Http\Controllers\Front\MessageController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route; 








/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::namespace('Front')->group(function () {
   
    
    
    Route::get('/', [HomepageController::class , 'index'])->name('Front.homepage');
    Route::get('/cat/{id}', [FrontCourseController::class , 'cat'])->name('Front.courseCat');
    Route::get('/cat/{id}/course/{c_id}', [FrontCourseController::class , 'show'])->name('Front.courseShow');
    Route::get('/contact', [ContactController::class , 'index'])->name('Front.contact');
    Route::post('/message/newsletter', [MessageController::class , 'newsletter'])->name('Front.message.newsletter');
    Route::post('/message/contact', [MessageController::class , 'contact'])->name('Front.message.contact');
    Route::post('/message/enroll', [MessageController::class , 'enroll'])->name('Front.message.enroll');

    
}); 



Route::namespace('Admin')->prefix('dashboard')->group(function () {
    Route::get('//login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('//do-login', [AuthController::class , 'dologin'])->name('admin.dologin');
    
    Route::middleware(['adminAuth:admin'])->group(function () { 
        Route::get('/', [HomeController::class , 'index'])->name('admin.home'); 
        Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout'); 
        Route::prefix('cats')->group(function () {
            Route::get('/', [CatController::class, 'index'])->name('admin.cats.index');
            Route::get('/create', [CatController::class, 'create'])->name('admin.cats.create');
            Route::post('/store', [CatController::class, 'store'])->name('admin.cats.store');
            Route::get('/{id}', [CatController::class, 'show'])->name('admin.cats.show');
            Route::get('/{id}/edit', [CatController::class, 'edit'])->name('admin.cats.edit');
            Route::put('/{id}', [CatController::class, 'update'])->name('admin.cats.update');
            Route::delete('/{id}', [CatController::class, 'destroy'])->name('admin.cats.destroy');
        });
        Route::prefix('trainers')->group(function () {
            Route::get('/', [TrainerController::class, 'index'])->name('admin.trainers.index');
            Route::get('/create', [TrainerController::class, 'create'])->name('admin.trainers.create');
            Route::post('/store', [TrainerController::class, 'store'])->name('admin.trainers.store');
            Route::get('/{id}', [TrainerController::class, 'show'])->name('admin.trainers.show');
            Route::get('/{id}/edit', [TrainerController::class, 'edit'])->name('admin.trainers.edit');
            Route::put('/{id}', [TrainerController::class, 'update'])->name('admin.trainers.update');
            Route::delete('/{id}', [TrainerController::class, 'destroy'])->name('admin.trainers.destroy');
        });
        Route::prefix('courses')->group(function () {
            Route::get('/', [AdminCourseController::class, 'index'])->name('admin.courses.index');
            Route::get('/create', [AdminCourseController::class, 'create'])->name('admin.courses.create');
            Route::post('/store', [AdminCourseController::class, 'store'])->name('admin.courses.store');
            Route::get('/{id}', [AdminCourseController::class, 'show'])->name('admin.courses.show');
            Route::get('/{id}/edit', [AdminCourseController::class, 'edit'])->name('admin.courses.edit');
            Route::put('/{id}', [AdminCourseController::class, 'update'])->name('admin.courses.update');
            Route::delete('/{id}', [AdminCourseController::class, 'destroy'])->name('admin.courses.destroy');
        });
        Route::prefix('students')->group(function () {
            Route::get('/', [StudentController::class, 'index'])->name('admin.students.index');
            Route::get('/create', [StudentController::class, 'create'])->name('admin.students.create');
            Route::post('/store', [StudentController::class, 'store'])->name('admin.students.store');
            Route::get('/{id}', [StudentController::class, 'show'])->name('admin.students.show');
            Route::get('/showcourse/{id}', [StudentController::class, 'showCourse'])->name('admin.students.showCourses');
            Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('admin.students.edit');
            Route::put('/{id}', [StudentController::class, 'update'])->name('admin.students.update');
            Route::delete('/{id}', [StudentController::class, 'destroy'])->name('admin.students.destroy'); 
            Route::get('/{id}/courses/{c_id}/approve', [StudentController::class, 'approve'])->name('admin.students.approve');
            Route::get('/{id}/courses/{c_id}/reject', [StudentController::class, 'reject'])->name('admin.students.reject');
            Route::get('/{id}/add-to-course', [StudentController::class, 'addCourse'])->name('admin.students.addCourse');
            Route::post('/{id}/add-to-course', [StudentController::class, 'storeCourse'])->name('admin.students.storeCourse');
            Route::delete('/{id}/add-to-course', [StudentController::class, 'removeCourse'])->name('admin.students.removeCourse'); 
            

        });
      
    });
    
    


}); 