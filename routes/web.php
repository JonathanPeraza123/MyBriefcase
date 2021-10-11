<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// VIEWS
Route::view('/', 'Welcome')->name('home');

Route::view('profile', 'MyProfile')->name('my.profile')->middleware('auth');

Route::get('@{user}', [ProfileController::class, 'show'])->name('profile.show');

Route::get('projects/{project}', [ProjectController::class, 'show'])->name('projects.show');




//PROJECTS
Route::post('projects', [ProjectController::class, 'store'])
    ->middleware('auth')
    ->name('project.store');

Route::get('projects', [ProjectController::class, 'index'])
    ->name('projects.index');

Route::get('myprojects/profile', [ProjectController::class, 'project'])->name('projects.profile');


Route::put('projects/{project}', [ProjectController::class, 'update'])->middleware('auth')->name('projects.update');

Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->middleware('auth')->name('projects.delete');




//PROFILE

Route::put('profile/{profile}', [ProfileController::class, 'update'])->middleware('auth')->name('update.profile');



// PROJECTS COMMENTS ROUTES

Route::post('projects/{project}/comments', [CommentController::class, 'store'])
    ->middleware('auth')->name('projects.comments.store');

Route::get('projects/{project}/comments', [CommentController::class, 'index'])->name('projects.comments.index');



//EMAILS


// Route::get('contacts/emails', [ContactController::class, 'index']);


Route::post('contacts/emails', [ContactController::class, 'store']);

Route::get('disenoContact', function () {
    return view('emails.contact');
});



//AUTH

Auth::routes();
