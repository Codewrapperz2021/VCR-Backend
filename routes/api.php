<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CorrectanswerController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\StudentAssessmentController;
use App\Http\Controllers\TimetableController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',[AuthController::class,'login']);/*login the user*/

Route::group(['middleware'=>['auth:sanctum']], function() {

});
Route::post('/logout',[AuthController::class,'logout']);/*logout the user*/

Route::get('get-profile',[AuthController::class,'getProfile']);




//Register Module    
Route::post('/register',[AuthController::class,'register']);/*Registering the new user*/


// Student Module
Route::get('/student',[StudentController::class,'index']);/*Show all students*/

Route::post('/student',[StudentController::class,'store']);/*Getting the new student*/

Route::get('/student/{id}',[StudentController::class,'show']);/*Fetching Single Student*/

Route::put('/student/{id}',[StudentController::class,'update']);/*Updating Student Details*/

Route::delete('/student/{id}',[StudentController::class,'destroy']);/*Deleting Student*/

Route::get('/student/search/{first_name}',[StudentController::class,'search']);/*Search Student*/

Route::get('student-export-excel',[StudentController::class,'exportIntoExcel']);/*Export Student in excel*/

Route::get('student-export-csv',[StudentController::class,'exportIntoCSV']);/*Export Student in excel*/


//question

Route::get('/question',[QuestionController::class,'index']);/*Show all students*/

Route::post('/question',[QuestionController::class,'store']);/*Getting the new student*/

Route::get('/question/{id}',[QuestionController::class,'show']);/*Fetching Single Student*/

Route::put('/question/{id}',[QuestionController::class,'update']);/*Updating Student Details*/

Route::delete('/question/{id}',[QuestionController::class,'destroy']);/*Deleting Student*/

Route::get('/question/search/{first_name}',[QuestionController::class,'search']);/*Search Student*/

Route::get('/innerjoin',[QuestionController::class,'innerJoin'])->name('question.innerjoin');



// Subject Module

Route::post('/subject',[SubjectController::class,'store']);/*adding the new student*/

Route::get('/subject',[SubjectController::class,'index']);/*Show all subject*/

Route::get('/subject/{id}',[SubjectController::class,'show']);/*Fetching Single subject*/

Route::put('/subject/{id}',[SubjectController::class,'update']);/*Updating subject Details*/

Route::delete('/subject/{id}',[SubjectController::class,'destroy']);/*Deleting subLecture
Route::get('/subject/search/{name}',[SubjectController::class,'search']);/*Search subject*/


//  Course Module
Route::get('/course',[CourseController::class,'index']);/*Show all course*/

Route::post('/course',[CourseController::class,'store']);/*Getting the new student*/

Route::get('/course/{id}',[CourseController::class,'show']);/*Fetching Single course*/

Route::put('/course/{id}',[CourseController::class,'update']);/*Updating course Details*/

Route::delete('/course/{id}',[CourseController::class,'destroy']);/*Deleting course*/

Route::get('/course/search/{first_name}',[CourseController::class,'search']);/*Search course*/


 //Faculty Module
 Route::get('/faculty',[FacultyController::class,'index']);/*Show all Faculty*/

Route::get('/faculty/{id}',[FacultyController::class,'show']);/*Fetching Single Faculty */

Route::put('/faculty/{id}',[FacultyController::class,'update']);/*Updating Faculty  Details*/

Route::delete('/faculty/{id}',[FacultyController::class,'destroy']);/*Deleting Faculty*/

Route::post('faculty',[FacultyController::class,'store']);/*Adding the new Faculty*/

Route::get('/faculty/search/{first_name}',[FacultyController::class,'search']);/*Search Faculty */

Route::get('faculty-export-excel',[FacultyController::class,'exportIntoExcel']);/*Export  in excel*/

//Lecture Module
Route::get('/lecture',[LectureController::class,'index']);/*Show all Lecture*/

Route::get('/lecture/{id}',[LectureController::class,'show']);/*Fetching Single Lecture */

Route::put('/lecture/{id}',[LectureController::class,'update']);/*Updating Lecture  Details*/

Route::delete('/lecture/{id}',[LectureController::class,'destroy']);/*Deleting Lecture*/

Route::post('lecture',[LectureController::class,'store']);/*Adding the new Lecture*/

Route::get('/lecture/search/{first_name}',[LectureController::class,'search']);/*Search Lecture */


//Lecture Module
Route::get('/day',[DayController::class,'index']);/*Show all Day*/

Route::get('/day/{id}',[DayController::class,'show']);/*Fetching Single Day */

Route::put('/day/{id}',[DayController::class,'update']);/*Updating Day  Details*/

Route::delete('/day/{id}',[DayController::class,'destroy']);/*Deleting Day*/

Route::post('day',[DayController::class,'store']);/*Adding the new Day*/

Route::get('/day/search/{first_name}',[DayController::class,'search']);/*Search Day */


//Timetable Module
Route::get('/timetable',[TimetableController::class,'index']);/*Show all Timetable*/

Route::get('/timetable/{id}',[TimetableController::class,'show']);/*Fetching Single Timetable */

Route::put('/timetable/{id}',[TimetableController::class,'update']);/*Updating Timetable  Details*/

Route::delete('/timetable/{id}',[TimetableController::class,'destroy']);/*Deleting Timetable*/

Route::post('timetable',[TimetableController::class,'store']);/*Adding the new Timetable*/

Route::get('/timetable/search/{first_name}',[TimetableController::class,'search']);/*Search Timetable */


//correctanswer
Route::get('/correctanswer',[CorrectanswerController::class,'index']);/*Show all students*/

Route::post('/correctanswer',[CorrectanswerController::class,'store']);/*Getting the new student*/

Route::get('/correctanswer/{id}',[CorrectanswerController::class,'show']);/*Fetching Single Student*/

Route::put('/correctanswer/{id}',[CorrectanswerController::class,'update']);/*Updating Student Details*/

Route::delete('/correctanswer/{id}',[CorrectanswerController::class,'destroy']);/*Deleting Student*/

Route::get('/correctanswer/search/{first_name}',[CorrectanswerController::class,'search']);/*Search Student*/


//assessment
Route::get('/assessment',[AssessmentController::class,'index']);/*Show all students*/

Route::post('/assessment',[AssessmentController::class,'store']);/*Getting the new student*/

Route::get('/assessment/{id}',[AssessmentController::class,'show']);/*Fetching Single Student*/

Route::put('/assessment/{id}',[AssessmentController::class,'update']);/*Updating Student Details*/

Route::delete('/assessment/{id}',[AssessmentController::class,'destroy']);/*Deleting Student*/

Route::get('/assessment/search/{first_name}',[AssessmentController::class,'search']);/*Search Student*/


//Student_Assessment
Route::get('/student-assessment',[StudentAssessmentController::class,'index']);/*Show all Faculty*/

Route::get('/student-assessment/{id}',[StudentAssessmentController::class,'show']);/*Fetching Single Faculty */

Route::put('/student-assessment/{id}',[StudentAssessmentController::class,'update']);/*Updating Faculty Details*/

Route::delete('/student-assessment/{id}',[StudentAssessmentController::class,'destroy']);/*Deleting Faculty*/

Route::post('/student-assessment',[StudentAssessmentController::class,'multiplestore']);/*Adding the new Faculty*/

Route::get('/student-assessment/search/{first_name}',[StudentAssessmentController::class,'search']);/*Search Faculty */

