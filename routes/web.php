<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RestTestController;

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
    return view('welcome');
});

//Route::resource('rest', RestTestController::class);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['namespace' => 'App\Http\Controllers\Blog', 'prefix' => 'blog'], function () {
    Route::resource('posts', PostController::class);
});

// админка блога
$groupData = [
    'namespace' => 'App\Http\Controllers\Blog\Admin',
    'prefix' => 'admin/blog',
    'as' => 'blog.admin.'
];

Route::group($groupData, function() {
    // BlogCategory
    $methods = ['index','store','create','edit','update','destroy'];
    Route::resource('categories', CategoryController::class)
        ->only($methods);

    // BlogPosts
    Route::resource('posts', PostController::class)
        ->only($methods)
        ->except(['show']);
});

