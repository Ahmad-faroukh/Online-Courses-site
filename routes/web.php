<?php

use RealRashid\SweetAlert\Facades\Alert;
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

Route::get('/', function () {
    return view('dashboard/pages/home');
})->name('home');

//============ Roles ============
Route::get('/roles/index','Admin\RolesController@index')->name('roles.index');
Route::get('/roles/create','Admin\RolesController@create')->name('roles.create');
Route::post('/roles/store','Admin\RolesController@store')->name('roles.store');
Route::get('/roles/edit/{id}','Admin\RolesController@edit')->name('roles.edit');
Route::put('/roles/update/{id}','Admin\RolesController@update')->name('roles.update');
Route::delete('/roles/destroy{id}','Admin\RolesController@destroy')->name('roles.destroy');


//============ Users ============
Route::get('/users/index','Admin\UsersController@index')->name('users.index');
Route::get('/users/create','Admin\UsersController@create')->name('users.create');
Route::post('/users/store','Admin\UsersController@store')->name('users.store');
Route::get('/users/edit/{id}','Admin\UsersController@edit')->name('users.edit');
Route::put('/users/update/{id}','Admin\UsersController@update')->name('users.update');
Route::delete('/users/destroy/{id}','Admin\UsersController@destroy')->name('users.destroy');


//============ Categories ============
Route::get('/categories/index','Admin\CategoriesController@index')->name('categories.index');
Route::get('/categories/create','Admin\CategoriesController@create')->name('categories.create');
Route::post('/categories/store','Admin\CategoriesController@store')->name('categories.store');
Route::get('/categories/edit/{id}','Admin\CategoriesController@edit')->name('categories.edit');
Route::put('/categories/update/{id}','Admin\CategoriesController@update')->name('categories.update');
Route::delete('/categories/destroy/{id}','Admin\CategoriesController@destroy')->name('categories.destroy');


//============ Courses ============
Route::get('/courses/index','Admin\CoursesController@index')->name('courses.index');
Route::get('/courses/show/{id}','Admin\CoursesController@show')->name('courses.show');
Route::get('/courses/create','Admin\CoursesController@create')->name('courses.create');
Route::post('/courses/store','Admin\CoursesController@store')->name('courses.store');
Route::get('/courses/edit/{id}','Admin\CoursesController@edit')->name('courses.edit');
Route::put('/courses/update/{id}','Admin\CoursesController@update')->name('courses.update');
Route::delete('/courses/destroy{id}','Admin\CoursesController@destroy')->name('courses.destroy');


//============ Topics ============
Route::get('{course_id}/topic/create','Admin\TopicsController@create')->name('topics.create');
Route::post('{course_id}/topics/store','Admin\TopicsController@store')->name('topics.store');
Route::get('/topics/download/{file}','Admin\TopicsController@download')->name('topics.download');
Route::delete('/topics/destroy{id}','Admin\TopicsController@destroy')->name('topics.destroy');
Route::get('/topics/edit/{id}','Admin\TopicsController@edit')->name('topics.edit');
Route::put('/topics/update/{id}','Admin\TopicsController@update')->name('topics.update');
Route::delete('/topics/removeFile/{file}','Admin\TopicsController@removeFile')->name('topics.removeFile');

//============ End User Pages ============
Route::get('/courses/browse', 'PagesController@browse')->name('pages.browse');
Route::get('/profile/{id}', 'PagesController@profile')->name('pages.profile');
Route::post('/profile/update{id}', 'PagesController@update')->name('pages.update');
Route::get('/courses/preview/{id}', 'PagesController@preview')->name('pages.preview');
Route::post('/courses/enroll/{id}', 'PagesController@enroll')->name('pages.enroll');
Route::get('/home','PagesController@home');



// export users that are enrolled in a specific course
Route::get('/users/export/{course_id}', 'Admin\UsersController@export')->name('students.export');
Route::get('/users/suspend/{course_id}', 'Admin\UsersController@removeFromCourse')->name('students.suspend');


Auth::routes();


//Route::get('/home', 'HomeController@index')->name('home');
