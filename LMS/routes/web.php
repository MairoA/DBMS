<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index');

Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@authenticate');

Route::get('/logout', 'LoginController@logout');


Route::post('/register-lecturer', 'UserController@registerLecturer');
Route::post('/register-student', 'UserController@registerStudent');

Route::get('/lecturers', 'UserController@lecturerView');
Route::get('/add-lecturer', 'UserController@addLecturerView');
Route::get('/delete-lecturer/{id}', 'UserController@deleteLecturer');
Route::get('/edit-lecturer/{id}', 'UserController@editLecturerView');
Route::post('/update-lecturer', 'UserController@updateLecturer');


Route::get('/students', 'UserController@studentView');
Route::get('/add-student', 'UserController@addStudentView');
Route::get('/delete-student/{id}', 'UserController@deleteStudent');
Route::get('/edit-student/{id}', 'UserController@editStudentView');
Route::post('/update-student', 'UserController@updateStudent');

Route::post('/register-course', 'CourseController@registerCourse');
Route::get('/courses', 'CourseController@courseView');
Route::get('/add-course', 'CourseController@addCourseView');
Route::get('/delete-course/{id}', 'CourseController@deleteCourse');
Route::get('/edit-course/{id}', 'CourseController@editCourseView');
Route::post('/update-course', 'CourseController@updateCourse');

Route::get('/result-upload', 'ResultController@resultUploadView');
Route::get('/view-results', 'ResultController@resultView');
Route::post('/upload-report', 'ResultController@uploadResult');

Route::get('/forgot-password', 'ForgotPasswordController@index');
Route::post('/reset-password', 'ForgotPasswordController@resetPassword');

Route::get('/register', 'LoginController@register');
Route::get('/profile', 'UserController@profileView');

Route::post('/update-student-profile', 'UserController@studentProfileUpdate');
Route::post('/update-lecturer-profile', 'UserController@lecturerProfileUpdate');
