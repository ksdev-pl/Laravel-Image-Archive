<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::patterns([
    'categoryId' => '[0-9]+',
    'albumId' => '[0-9]+',
    'imageId' => '[0-9]+',
    'userId' => '[0-9]+'
]);

// Categories

Route::group(['before' => 'authForRole:' . User::RESTRICTED], function() {
    Route::get('/', function() {
        return Redirect::to('/categories');
    });

    Route::get('/categories', 'CategoryController@index');

    Route::get('/categories/create', 'CategoryController@create');
    Route::post('/categories/create', 'CategoryController@create');
});

Route::group(['before' => 'authForRole:' . User::NORMAL], function() {
    Route::get('/categories/{categoryId}/update', 'CategoryController@update');
    Route::post('/categories/{categoryId}/update', 'CategoryController@update');

    Route::get('/categories/{categoryId}/delete', 'CategoryController@delete');
    Route::post('/categories/{categoryId}/delete', [
        'before' => 'csrf',
        'uses' => 'CategoryController@delete'
    ]);
});

// Albums

Route::group(['before' => 'authForRole:' . User::RESTRICTED], function() {
    Route::get('/categories/{categoryId}/albums', 'AlbumController@index');

    Route::get('/categories/{categoryId}/albums/create', 'AlbumController@create');
    Route::post('/categories/{categoryId}/albums/create', 'AlbumController@create');
});

Route::group(['before' => 'authForRole:' . User::NORMAL], function() {
    Route::get('/categories/{categoryId}/albums/{albumId}/update', 'AlbumController@update');
    Route::post('/categories/{categoryId}/albums/{albumId}/update', 'AlbumController@update');

    Route::get('/categories/{categoryId}/albums/{albumId}/delete', 'AlbumController@delete');
    Route::post('/categories/{categoryId}/albums/{albumId}/delete', [
        'before' => 'csrf',
        'uses' => 'AlbumController@delete'
    ]);
});

// Images

Route::group(['before' => 'authForRole:' . User::RESTRICTED], function() {
    Route::get('/categories/{categoryId}/albums/{albumId}/images', 'ImageController@index');

    Route::get('/categories/{categoryId}/albums/{albumId}/images/create', 'ImageController@create');
    Route::post('/categories/{categoryId}/albums/{albumId}/images/create', [
        'before' => 'csrf',
        'uses' => 'ImageController@create'
    ]);
});

Route::group(['before' => 'authForRole:' . User::NORMAL], function() {
    Route::get('/categories/{categoryId}/albums/{albumId}/images/{imageId}/update', 'ImageController@update');
    Route::post('/categories/{categoryId}/albums/{albumId}/images/{imageId}/update', 'ImageController@update');

    Route::get('/categories/{categoryId}/albums/{albumId}/images/{imageId}/delete', 'ImageController@delete');
    Route::post('/categories/{categoryId}/albums/{albumId}/images/{imageId}/delete', [
        'before' => 'csrf',
        'uses' => 'ImageController@delete'
    ]);
});

Route::get('/categories/{categoryId}/albums/{albumId}/images/{imageId}', [
    'before' => 'authForRole:' . User::RESTRICTED,
    'uses' => 'ImageController@show'
]);

// Users

Route::group(['before' => 'authForRole:' . User::ADMIN], function() {
    Route::get('/users', 'UserController@index');

    Route::get('/users/create', 'UserController@create');
    Route::post('/users/create', 'UserController@create');

    Route::get('/users/{userId}/update', 'UserController@update');
    Route::post('/users/{userId}/update', 'UserController@update');

    Route::get('/users/{userId}/delete', 'UserController@delete');
    Route::post('/users/{userId}/delete', [
        'before' => 'csrf',
        'uses' => 'UserController@delete'
    ]);
});

Route::get('/signin', 'UserController@signIn');
Route::post('/signin', [
    'before' => 'csrf',
    'uses' => 'UserController@signIn'
]);

Route::get('/signout', 'UserController@signOut');