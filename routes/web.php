<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('plantilla');
});

// vistas de las paginas
//::view('/','paginas.blog');
//::view('/administradores','paginas.administradores');
//::view('/articulos','paginas.articulos');
//::view('/categorias','paginas.categorias');
//::view('/opiniones','paginas.opiniones');
//::view('/banner','paginas.banner');
//::view('/anuncios','paginas.anuncios');

// traer datos de las paginas sql
//::get('/', 'App\Http\Controllers\BlogController@traerBlog');
//::get('/administradores', 'App\Http\Controllers\AdministradoresController@traerAdministradores');
//::get('/anuncios', 'App\Http\Controllers\AnunciosController@traerAnuncios');
//::get('/articulos', 'App\Http\Controllers\ArticulosController@traerArticulos');
//::get('/banner', 'App\Http\Controllers\BannerController@traerBanner');
//::get('/categorias', 'App\Http\Controllers\CategoriasController@traerCategorias');
//::get('/opiniones', 'App\Http\Controllers\OpinionesController@traerOpiniones');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/logout', [App\Http\Controllers\LoginController::class,'logout'])->name('logout');
//Route::get('/logout', 'Auth\LoginController@logout');



//RUTAS QUE INCLUYEN TODOS LOS METODOS HTTP
//Route::resource
//php artisan route:list

//Route::resource('/', 'App\Http\Controllers\BlogController');
//Route::resource('/blog', 'App\Http\Controllers\BlogController');
Route::resource('/administradores', 'App\Http\Controllers\AdministradoresController');
Route::resource('/', 'App\Http\Controllers\AdministradoresController');
Route::resource('/anuncios', 'App\Http\Controllers\AnunciosController');
Route::resource('/articulos', 'App\Http\Controllers\ArticulosController');
Route::resource('/banner', 'App\Http\Controllers\BannerController');
Route::resource('/categorias', 'App\Http\Controllers\CategoriasController');
Route::resource('/opiniones', 'App\Http\Controllers\OpinionesController');
Route::resource('/pets', 'App\Http\Controllers\PetsController');
Route::resource('/appointments', 'App\Http\Controllers\AppointmentController');
Route::resource('/calendar', 'App\Http\Controllers\CalendarController');



