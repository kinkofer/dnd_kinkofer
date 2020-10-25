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

Route::get('/', "CompendiumController@index");
Route::get('/compendium', "CompendiumController@index");
Route::post('/compendium', "CompendiumController@compendium");


Route::get('/merge', "MergeController@index");
Route::post('/merge', "MergeController@merge");


Route::get('/skyreach', "SkyreachController@index");
Route::post('/skyreach/rune', "SkyreachController@selectRune");
Route::get('/skyreach/{name}', "SkyreachController@navigate");