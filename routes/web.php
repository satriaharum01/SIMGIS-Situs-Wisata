<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicController;

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
    return redirect('/welcome');
    //return view('welcome');
});

Auth::routes();

//GET
Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
Route::get('/nodes', [AdminController::class, 'nodes'])->name('nodes');
Route::get('/graf', [AdminController::class, 'graf'])->name('graf');
Route::get('/situs', [AdminController::class, 'situs'])->name('situs');

//LANDING PAGE
Route::get('/welcome', [PublicController::class, 'index'])->name('landing');
Route::get('/welcome/rute', [PublicController::class, 'rute'])->name('landing.rute');
Route::get('/welcome/about', [PublicController::class, 'about'])->name('landing.about');
Route::get('/welcome/wisata', [PublicController::class, 'wisata'])->name('landing.wisata');
Route::get('/welcome/wisata/article/{id}', [PublicController::class, 'article_wisata'])->name('landing.article');
Route::get('/welcome/peta', [PublicController::class, 'peta'])->name('landing.peta');

//JSON
Route::get('/situs/json', [AdminController::class, 'json_situs']);
Route::get('/wisata/json', [AdminController::class, 'json_wisata']);
Route::get('/wisata/get/{id}', [AdminController::class, 'get_wisata']);
Route::get('/nodes/json', [AdminController::class, 'json_node']);
Route::get('/category/json', [AdminController::class, 'json_cat']);
Route::get('/graf/json', [AdminController::class, 'json_graf']);

//PUBLIC JSON
Route::get('/welcome/situs/json', [PublicController::class, 'json_situs']);
Route::get('/welcome/situs/tujuan/{lokasi}', [PublicController::class, 'json_tujuan']);
Route::get('/welcome/situs/titik_awal', [PublicController::class, 'json_titik_awal']);
Route::get('/welcome/situs/get/{id}', [PublicController::class, 'getjson_wisata']);
Route::get('/welcome/getgraf/{id}', [PublicController::class, 'get_Graf']);
Route::get('/welcome/rute/wisata/{id}', [PublicController::class, 'wisata_sekitar']);

//PATCH
Route::PATCH('/situs/update/{id}', [AdminController::class, 'update_situs']);
Route::PATCH('/nodes/update/{id}', [AdminController::class, 'update_node']);
Route::PATCH('/category/update/{id}', [AdminController::class, 'update_cat']);
Route::PATCH('/graf/update/{id}', [AdminController::class, 'update_graf']);

//POST
Route::POST('/situs/store', [AdminController::class, 'store_situs']);
Route::POST('/nodes/store', [AdminController::class, 'store_node']);
Route::POST('/category/store', [AdminController::class, 'store_cat']);
Route::POST('/graf/store', [AdminController::class, 'store_graf']);

//DESTROY
Route::GET('/situs/delete/{id}', [AdminController::class, 'destroy_situs'])->name('situs.destroy');
Route::GET('/nodes/delete/{id}', [AdminController::class, 'destroy_node'])->name('node.destroy');
Route::GET('/category/delete/{id}', [AdminController::class, 'destroy_cat'])->name('cat.destroy');
Route::GET('/graf/delete/{id}', [AdminController::class, 'destroy_graf'])->name('graf.destroy');

//GETJSON
Route::GET('/situs/getjson/{id}', [AdminController::class, 'getjson_situs']);
Route::GET('/nodes/getjson/{id}', [AdminController::class, 'getjson_node']);
Route::GET('/category/getjson/{id}', [AdminController::class, 'getjson_cat']);
Route::GET('/graf/getjson/{id}', [AdminController::class, 'getjson_graf']);

//Khusus Wisata 
Route::get('/welcome/wisata/all', [PublicController::class, 'wisata_all']);
Route::get('/welcome/peta/all', [PublicController::class, 'wisata_peta']);
Route::get('/welcome/wisata/all/get/{id}', [PublicController::class, 'wisata_load']);
Route::get('/welcome/wisata/get/{id}', [PublicController::class, 'wisata_spesifik']);
Route::get('/welcome/peta/get/{id}', [PublicController::class, 'peta_spesifik']);