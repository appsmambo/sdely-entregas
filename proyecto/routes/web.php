<?php

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('home');
//        return view('welcome');
    } else {
        return redirect('login');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/genera-orden', 'OrdenController@getGeneraOrden')->name('genera-orden');
Route::post('/genera-orden', 'OrdenController@postGeneraOrden');


Route::post('/grabar-cliente', 'ClienteController@postGrabarCliente');


