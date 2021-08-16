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
Route::get('/home', 'HomeController@index');

Route::get('/login', 'LoginController@index')->middleware(['guest'])->name('login');
Route::post('/login', 'LoginController@authenticate');

Route::get('/logout', 'LoginController@logout');

Route::get('/register', 'LoginController@register')->middleware(['guest']);
Route::post('/register-lecturer', 'UserController@registerLecturer');
Route::post('/register-student', 'UserController@registerStudent');

Route::get('/add-student', 'UserController@addStudentView')->middleware(['guest']);
Route::get('/add-lecturer', 'UserController@addLecturerView')->middleware(['guest']);

Route::get('/forgot-password', 'ForgotPasswordController@index')->middleware(['guest']);
Route::post('/reset-password', 'ForgotPasswordController@resetPassword')->middleware(['guest']);

Route::get('/lecturers', 'UserController@lecturerView')->middleware(['auth']);
Route::get('/delete-lecturer/{id}', 'UserController@deleteLecturer')->middleware(['auth']);
Route::get('/edit-lecturer/{id}', 'UserController@editLecturerView')->middleware(['auth']);
Route::post('/update-lecturer', 'UserController@updateLecturer')->middleware(['auth']);

Route::get('/students', 'UserController@studentView')->middleware(['auth']);
Route::get('/delete-student/{id}', 'UserController@deleteStudent')->middleware(['auth']);
Route::get('/edit-student/{id}', 'UserController@editStudentView')->middleware(['auth']);
Route::post('/update-student', 'UserController@updateStudent')->middleware(['auth']);

Route::post('/register-course', 'CourseController@registerCourse')->middleware(['auth']);
Route::get('/courses', 'CourseController@courseView')->middleware(['auth']);
Route::get('/add-course', 'CourseController@addCourseView')->middleware(['auth']);
Route::get('/delete-course/{id}', 'CourseController@deleteCourse')->middleware(['auth']);
Route::get('/edit-course/{id}', 'CourseController@editCourseView')->middleware(['auth']);
Route::post('/update-course', 'CourseController@updateCourse')->middleware(['auth']);

Route::get('/result-upload', 'ResultController@resultUploadView')->middleware(['auth']);
Route::get('/view-results', 'ResultController@resultView')->middleware(['auth']);
Route::post('/upload-report', 'ResultController@uploadResult')->middleware(['auth']);

Route::get('/profile', 'UserController@profileView')->middleware(['auth']);

Route::post('/update-student-profile', 'UserController@studentProfileUpdate')->middleware(['auth']);
Route::post('/update-lecturer-profile', 'UserController@lecturerProfileUpdate')->middleware(['auth']);
