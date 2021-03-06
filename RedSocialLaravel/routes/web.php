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
    return view('auth.login');
});
Route::get('/registro', function () {
    return view('auth.register');
});

Route::group(['middleware'=>'auth'],function(){
	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/inicio', 'HomeController@inicio')->name('inicio');
	Route::get('/mensajes', 'MensajesController@index')->name('mensajes');
	Route::get('/peticiones', 'PeticionesController@index')->name('peticiones');

	//Rutas para la gestion de "Amigos"
	Route::get('/listAmigos','AmigosController@listAmigos'); //Lleva al método que consigue todos los amigos del usuario que se ha registrado
	Route::get('/getAmigos','AmigosController@getAmigos'); //Lleva al método que consigue todos los amigos del usuario que se ha registrado
	Route::get('/findAmigos','UserController@getUserByName'); //Lleva al método que busca usuarios por nombre para, por ejemplo, mandar una solicitud de amistad.
	Route::get('/getAmistad/{idUsuario}','AmigosController@getAmistad');//Lleva al método que envia una solicitud de amistad.
	Route::get('/aceptarAmistad/{idUsuario}','AmigosController@aceptarAmistad');//Lleva al método que acepta una solicitud de amistad.
	Route::delete('/deleteAmigos/{idAmigos}','AmigosController@deleteAmigos'); //LLeva al método que borra un amigo de la base de datos.

	//Rutas para la gestión de usuarios
	Route::get('/getUser/{name}','UserController@getUserByName'); /* Ruta para que un usuario pueda buscar a otros por el nombre
									  y pueda enviar una solicitud de amistad.*/
	Route::get('/usuario','UserController@getUser'); /*Lleva al formulario que coge los datos para  actualizar un usuario*/
	Route::put('/updateUser/{idUsuario}','UserController@updateUser'); /*Ruta que lleva al metodo que actualiza los datos del usuario*/
	Route::delete('/deleteUser/{idUsuario}','UserController@deleteUser'); /*Ruta que lleva al metodo donde se borra el perfil del usuario*/

	//Rutas para gestionar publicaciones
	Route::get('/publicaciones','PublicacionesController@index');
	Route::get('/getPublicaciones/{idUser}','PublicacionesController@getPublicaciones');
	Route::get('/publicaciones/read','PublicacionesController@read');
    Route::post('/create','PublicacionesController@create');
    Route::delete('/delete/{idPublicacion}','PublicacionesController@delete');

	//Rutas para gestionar mensajes
	//Route::get('/mensajes','MensajesController@index');
	Route::get('/mensajes','MensajesController@read')->name('mensajes');
    Route::post('/mensaje/create','MensajesController@create');
	Route::delete('/deleteMensaje/{id_Mensaje}','MensajesController@delete');

});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

