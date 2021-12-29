<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StudentAssessmentController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/addstudent', function () {
    return view('Student.addstudent');
});

Route::view('/studentlist','Student.studentlist');
Route::view('/editstudent/{id}','Student.editstudent');


    
Route::get('/addsubject', function () {
    return view('Subject.addsubject');
});


Route::get('/subjectlist', function () {
    return view('Subject.subjectlist');
});
Route::view('/editsubject/{id}','Subject.editsubject');



Route::get('/addcourse', function () {
    return view('Course.addcourse');
});


Route::get('/courselist', function () {
    return view('Course.courselist');
});
Route::view('/editcourse/{id}','Course.editcourse');

Route::get('/addfaculty', function () {
    return view('Teacher.addfaculty');
});

Route::view('/facultylist','Teacher.facultylist');
Route::view('/editfaculty/{id}','Teacher.editfaculty');