<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User;
use App\Http\Controllers\Admin;

// ini perubahan

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
/*

<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteRule ^(.*)$ /public/$1 [L,QSA]
</IfModule>


*/

Route::get('/', function () {
    return view('welcome');
});


require __DIR__.'/auth.php';

Route::middleware('isAdmin')->group( function() {

    // Route::get('/dashboard', function () {
    //     return view('dashboard')->name('dashboard');
    // });

    Route::prefix('admin')->group( function() {
        Route::get('/', [Admin\HomeController::class, 'index'])->name('admin.index');

        Route::get('/profile/edit', [Admin\ProfileController::class, 'edit'])->name('admin.profile.edit');

        Route::put('/profile/update', [Admin\ProfileController::class, 'update'])->name('admin.profile.update');

        Route::get('/post', [Admin\PostController::class, 'index'])->name('admin.post.index');

        Route::get('/test', [Admin\PostController::class, 'index'])->name('admin.post.test');

        Route::get('/post-create', [Admin\PostController::class, 'create'])->name('admin.post.create');

        Route::post('/post-store', [Admin\PostController::class, 'store'])->name('admin.post.store');

        Route::get('/post-edit/{id}', [Admin\PostController::class, 'edit'])->name('admin.post.edit');

        Route::put('/post-update/{id}', [Admin\PostController::class, 'update'])->name('admin.post.update');

        Route::delete('/post-destroy/{id}', [Admin\PostController::class, 'destroy'])->name('admin.post.destroy');

        Route::put('/post-update-approve/{id}', [Admin\PostController::class, 'approve'])->name('admin.post.update.approve');

        Route::put('/post-update-reject/{id}', [Admin\PostController::class, 'reject'])->name('admin.post.update.reject');

    });
});

Route::middleware('isUser')->group( function() {

    // Route::get('/dashboard', function () {
    //     return view('dashboard')->name('dashboard');
    // });
    

    Route::prefix('user')->group( function() {
        Route::get('/', [User\HomeController::class, 'index'])->name('user.index');

        Route::get('/post', [User\PostController::class, 'index'])->name('user.post.index');

        Route::get('/post-create', [User\PostController::class, 'create'])->name('user.post.create');

        Route::post('/post-store', [User\PostController::class, 'store'])->name('user.post.store');
    });
});

Route::get('test-template', function(){
    return view('layouts.template');
});