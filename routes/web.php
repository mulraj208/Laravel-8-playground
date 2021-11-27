<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Category;

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

Route::get( '/', function () {
    return view( 'welcome' );
} );

Route::get( '/posts', function () {
    return view( 'post', [
//        'post' => Post::all() // N + 1 Problem
        'post' => Post::with('category')->get()
    ] );
} );

Route::get( '/posts/{post:slug}', function ( Post $post ) {
    return view( 'post', [
        'post' => $post
    ] );
} );

Route::get( '/categories/{category:slug}', function (Category $category) {
    return view( 'category', [
        'posts' => $category->posts
    ] );
} );
