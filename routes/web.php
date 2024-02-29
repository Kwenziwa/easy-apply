<?php

use App\Http\Controllers\Common\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DocsKinController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\NextOfKinController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProgrammeController;
use App\Http\Controllers\Student\StudentProgrammeController;
use App\Http\Controllers\Admin\UniversityController;
use App\Http\Controllers\Admin\SchoolSubjectController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/my-dashboard/{type}', [HomeController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
// Route::get('/home', [HomeController::class, 'home'])->name('home');


Route::middleware(['auth', 'verified'])->prefix('settings')->group(function () {

    Route::resource('my-account', UserProfileController::class);
});

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user', 'verified'])->prefix('student')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('student.home');
    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects');
    Route::get('/subject/create', [SubjectController::class, 'create'])->name('subject.create');
    Route::post('/subject/create', [SubjectController::class, 'attachSubject'])->name('subject.attachsubject');
    Route::delete('/subject/{subject}', [SubjectController::class, 'deleteSubject'])->name('user.subject.delete');
    Route::get('/subject-update/{subject}', [SubjectController::class, 'edit'])->name('user.editsubject');
    Route::put('/subject/update-subject', [SubjectController::class, 'update'])->name('user.updatesubject');
    Route::resource('/next-of-kin', NextOfKinController::class);
    Route::resource('/my-documents', DocsKinController::class);
    Route::resource('my-programme', StudentProgrammeController::class);
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin', 'verified'])->prefix('admin')->group(function () {
    Route::get('dashboard', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::resource('/users', UserController::class);
    Route::resource('/universities', UniversityController::class);
    Route::resource('/school-subjects', SchoolSubjectController::class);
    Route::resource('/programmes', ProgrammeController::class);
});


Route::get('/subjects', [HomeController::class, 'getSubjects']);
Route::get('/toggle-theme', [HomeController::class, 'toggleTheme'])->name('toggle-theme');



/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:university', 'verified'])->prefix('university')->group(function () {

    Route::get('/home', [HomeController::class, 'universityHome'])->name('university.home');
});

Route::get('/clear', function () {
    \Artisan::call('cache:clear');
    Artisan::call('view:clear');
    \Artisan::call('route:clear');
    \Artisan::call('clear-compiled');
    \Artisan::call('config:cache');
});
