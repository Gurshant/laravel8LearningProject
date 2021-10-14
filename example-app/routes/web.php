<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
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
//
// Route::get('/', function () {
//     return view('home.index', []);
// })->name ('home.index');
//  above is equivalent to

Route::get('/', [HomeController::class, 'home'])
    ->name('home.index');

Route::get('/contact', [HomeController::class, 'contact'])
    ->name('home.contact');

Route::get('/about', AboutController::class)
    ->name('home.about');

$posts = [
    1 => [
        'title' => 'Intro to Laravel',
        'content' => 'This is a short intro to Laravel',
        'is_new' => true,
    ],
    2 => [
        'title' => 'Intro to PHP',
        'content' => 'This is a short intro to PHP',
        'is_new' => false,
    ],
];

// get specific post
// Verification for a num happens in RouteServiceProvider
Route::get('/posts/{id}', function ($id) use ($posts) {

    // Abort if post is not found
    abort_if(!isset($posts[$id]), 404);
    return view('posts.show', ['post' => $posts[$id]]);
})->name('posts.show');

Route::get('/posts', function () use ($posts) {
    // dd(request()->all());
    dd((int) request()->input('page', 1));
    return view('posts.index', ['posts' => $posts]);
})->name('posts.index');

// get with optional param
Route::get('/recent-posts/{days_ago?}', function ($daysAgo = 20) {
    return 'Posts from ' . $daysAgo . ' days ago';
})->name('posts.recent.index')->middleware('auth');

// Group function fun
Route::prefix('/fun')->name('fun.')->group(function () use ($posts) {

    Route::get('/responses', function () use ($posts) {
        return response($posts, 201)
            ->header('Content-Type', 'application/json')
            ->cookie('MY_COOKIE', 'P J', 3600);
    })->name('responses');

// redirect to posts.show[1]
    Route::get('/redirect', function () {
        return redirect()->route('posts.show', ['id' => 1]);
    })->name('redirect');

// go back
    Route::get('/back', function () {
        return back();
    })->name('back');

});
