<?php

use App\Http\Controllers\ActionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Models\Production;

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


Auth::routes();

Route::get('/', [MainController::class, 'show_login']);//->name('login');
Route::post('confirm_login', [MainController::class, 'confirm_login']);

Route::middleware(['auth'])->group(function ()
{
    Route::get('home', [HomeController::class, 'index']);
    Route::get('setting',[SettingController::class, 'index']);

    //POST
    Route::post('machine', [MachineController::class,'index']);//Filter search
    Route::post('update_general_setting',[SettingController::class, 'update_general_setting']);

    //Operator
    Route::get('operation', [OperatorController::class, 'index']);
    Route::post('production_machine', [ProductionController::class,'index']);
    Route::Post('operation/create', [OperatorController::class, 'create']);
    Route::Post('operation/store', [OperatorController::class, 'store']);

    //RESOURCES
    Route::resources([
        'machine' => MachineController::class,
        'production' => ProductionController::class,
        'action' => ActionController::class,
        'user' => UserController::class,
    ]);

    //Ajax calls
    Route::post('production/change_machine',[ProductionController::class,'change_machine']);
    Route::post('operation/change_production',[OperatorController::class,'change_production']);

});

Route::get('/upload_page', [MainController::class, 'upload_page']);
Route::Post('/handle_file', [MainController::class, 'handle_file']);
