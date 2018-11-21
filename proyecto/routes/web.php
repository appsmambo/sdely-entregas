<?php

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('home');
    } else {
        return redirect('login');
    }
});

Route::get('logout', 'HomeController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/ordenes', 'OrdenController@getOrdenes')->name('ordenes');
Route::get('/genera-orden', 'OrdenController@getGeneraOrden')->name('genera-orden');
Route::post('/genera-orden', 'OrdenController@postGeneraOrden');
Route::get('/ver-orden/{id}', 'OrdenController@getVerOrden')->name('ver-orden');
Route::post('/cancelar-orden', 'OrdenController@postCancelarOrden');

Route::post('/grabar-cliente', 'ClienteController@postGrabarCliente');

Route::get('storage/{folder}/{filename}', function ($folder, $filename)
{
	$path = storage_path('app/'.$folder.'/' . $filename);

	if (!File::exists($path)) {
		abort(404);
	}

	$file = File::get($path);
	$type = File::mimeType($path);

	$response = Response::make($file, 200);
	$response->header("Content-Type", $type);

	return $response;
});

