<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\PostControler;
use App\Models\Kategori;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;


// AUTHENTIFICATION
// Login
Route::get('/login', [AuthController::class, 'login' ])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate' ]);
Route::post('/logout', [AuthController::class, 'logout' ]);
// Register
Route::get('/register', [AuthController::class, 'register' ])->middleware('guest');
Route::post('/register', [AuthController::class, 'store' ]);


// ADMIN
// Dashboard Admin
Route::get('/admin', function () {
    return view('admin.layout.home');
})->middleware('auth');

// POST
Route::get('/admin/posts', [DashboardPostController::class, 'index' ])->middleware('auth');
Route::get('/admin/posts/create', [DashboardPostController::class, 'create' ])->middleware('auth');
Route::post('/admin/posts/store', [DashboardPostController::class, 'store' ])->middleware('auth');
Route::get('/admin/posts/checkslug', [DashboardPostController::class, 'checkslug' ])->middleware('auth');
Route::get('/admin/posts/{post:slug}', [DashboardPostController::class, 'show'])->middleware('auth');



//END USER
// HOME
Route::get('/', function () {
    return view('enduser.layout.home', ['title' => 'Home Page']);
});

// ABOUT
Route::get('/about', function () {
    return view('enduser.about.view', ['nama'=>'Made Andika Ary Wiguna','title' => 'About']);
});

// BLOG
Route::get('/posts', [PostControler::class, 'index']);
Route::get('/posts/{post:slug}', [PostControler::class, 'show']);
// Route::get('/authors/{user:username}', [PostControler::class, 'author']);
// Route::get('/kategoris/{kategori:slug}', [PostControler::class, 'kategori']);

// CONTACT
Route::get('/contact', function () {
    return view('enduser.contact.view', ['title' => 'Contact']);
   });
