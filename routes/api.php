<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Tasks\ViewController;
use App\Http\Controllers\Tasks\IndexController;
use App\Http\Controllers\Tasks\CreateController;
use App\Http\Controllers\Tasks\UpdateController;
use App\Http\Controllers\Tasks\DeleteController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'tasks', 'name' => 'tasks'], static function (\Illuminate\Routing\Router $router) {
    $router->post('/', CreateController::class);
    $router->get('/', IndexController::class);
    $router->get('/{id}', ViewController::class)->whereNumber('id');
    $router->put('/{id}', UpdateController::class)->whereNumber('id');
    $router->delete('/{id}', DeleteController::class)->whereNumber('id');
});

Route::post('/register', RegisterController::class);
Route::post('/login', LoginController::class);
