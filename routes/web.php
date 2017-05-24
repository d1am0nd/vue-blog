<?php

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
    return view('dev');
});

Route::get('test', function () {
    return [Auth::check()];
});

// Authentication routes
Route::group(['as' => 'api.', 'prefix' => 'api'], function () {
    Route::get('users/current', 'Auth\AuthController@getCurrent')
        ->name('currentUser');

    // Authentication Routes...
    Route::get('users/login', 'Auth\LoginController@showLoginForm')
        ->name('getLogin');
    Route::post('users/login', 'Auth\LoginController@login')
        ->name('postLogin');

    Route::get('users/logout', 'Auth\LoginController@logout')
        ->name('logout');

    // Registration Routes...
    Route::get('users/register', 'Auth\RegisterController@showRegistrationForm')
        ->name('getRegister');
    Route::post('users/register', 'Auth\RegisterController@register')
        ->name('postRegister');

    // Password Reset Routes...
    Route::get('users/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')
        ->name("getPasswordReset");
    Route::post('users/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
        ->name("postPasswordResetEmail");
    Route::get('users/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
        ->name("getPasswordResetForm");
    Route::post('users/password/reset', 'Auth\ResetPasswordController@reset')
        ->name("postPasswordReset");

    // Posts
    Route::group(['prefix' => 'posts'], function () {
        Route::post('create', 'PostsController@postNew')
            ->name('postNewPost');
        Route::post('edit/{slug}', 'PostsController@postEdit')
            ->name('postEditPost');
        Route::get('my/all', 'PostsController@getByUser')
            ->name('getMyPosts')
            ->middleware(['auth']);
        Route::get('all', 'PostsController@getAllPublished')
            ->name('getPublished');
        Route::get('{slug}', 'PostsController@getBySlug')
            ->name('postBySlug');
    });
});

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
