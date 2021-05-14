<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/',[HomeController::class, 'index']);
Route::get('/a',[HomeController::class, 'indexMe']);
Route::get('/get-scores',[HomeController::class, 'show']);
Route::post('/save-scores',[HomeController::class, 'store']);




Route::any('/{x}/{y?}/{z?}', function () {
	return redirect('/'); // if someone tries something else it redirects to /.
}); 