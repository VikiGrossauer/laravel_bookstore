<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//da in api - api/books
Route::get('books', 'BookController@index');
//book das nur ein buch mit isbn
Route::get('book/{isbn}', 'BookController@findByISBN');
//ob ISBN überhaupt da ist
//case-sensitive!!
Route::get('book/checkisbn/{isbn}', 'BookController@checkISBN');
Route::get('book/search/{searchTerm}', 'BookController@findBySearchTerm');

Route::group(['middleware' =>['api', 'cors', 'jwt.auth']], function () {
    Route::post('book', 'BookController@save');
    Route::put('book/{isbn}', 'BookController@update');
    Route::delete('book/{isbn}', 'BookController@delete');
    Route::post('auth/logout', 'Auth\ApiAuthController@logout');
});


Route::group(['middleware' =>['api', 'cors']], function (){
   Route::post('auth/login', 'Auth\ApiAuthController@login');
});