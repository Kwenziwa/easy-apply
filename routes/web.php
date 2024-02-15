<?php

use App\Http\Controllers\DocsKinController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\NextOfKinController;

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


/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user', 'verified'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects');
    Route::get('/subject/create', [SubjectController::class, 'create'])->name('subject.create');
    Route::post('/subject/create', [SubjectController::class, 'attachSubject'])->name('subject.attachsubject');
    Route::delete('/subject/{subject}', [SubjectController::class, 'deleteSubject'])->name('user.subject.delete');
    Route::get('/subject-update/{subject}', [SubjectController::class, 'edit'])->name('user.editsubject');
    Route::put('/subject/update-subject', [SubjectController::class, 'update'])->name('user.updatesubject');
    Route::resource('/next-of-kin', NextOfKinController::class);
    Route::resource('/my-documents', DocsKinController::class);

});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin', 'verified'])->group(function () {

    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:university', 'verified'])->group(function () {

    Route::get('/university/home', [HomeController::class, 'universityHome'])->name('university.home');
});

Route::get('/clear', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    \Artisan::call('route:clear');
    \Artisan::call('clear-compiled');
    \Artisan::call('config:cache');
    dd("Cache is cleared");
});
