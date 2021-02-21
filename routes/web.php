<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;



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
    return view('auth.login');
});
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function (){

    Route::get('/dashboard', function () {return view('index');})->name('dashboard.index');


    Route::get('/logout', [LoginController::class, 'logout']);

    Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
    Route::post('/project', [ProjectController::class, 'store'])->name('project.store');

    Route::get('/user/{user}/profile', [UserController::class, 'show'])->name('user.profile.show');
    Route::put('/user/{user}/update', [UserController::class, 'update'])->name('user.profile.update');
    Route::put('/users/{user}/attach',[UserController::class, 'attach'])->name('user.role.attach');
    Route::put('/users/{user}/detach',[UserController::class, 'detach'])->name('user.role.detach');
    Route::delete('/users/{user}/destroy',[UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/tellers', [UserController::class, 'tellerIndex'])->name('tellers.index');
    Route::get('/teller',[UserController::class, 'tellerCreate'])->name('tellers.create');
    Route::post('/teller',[UserController::class, 'tellerStore'])->name('tellers.store');

    Route::get('/customers', [UserController::class, 'customerIndex'])->name('customers.index');
    Route::get('/customer',[UserController::class, 'customerCreate'])->name('customers.create');
    Route::post('/customer',[UserController::class, 'customerStore'])->name('customers.store');

    Route::get('/users', [UserController::class, 'userIndex'])->name('users.index');
    Route::get('/user',[UserController::class, 'userCreate'])->name('users.create');
    Route::post('/user',[UserController::class, 'userStore'])->name('users.store');

});



