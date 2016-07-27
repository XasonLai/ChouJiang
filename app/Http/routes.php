<?php

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/test' , function(){
// 	return view('test');
// });

Route::get('/test' , 'RandomController@test');
Route::controller('random' , 'RandomController');