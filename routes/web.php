<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ ServiceController::class, 'index' ] )->name( 'services.index' );

Route::middleware( [ 'auth' ] )->group( function () {
    Route::get('my-services', [ ServiceController::class, 'userServices' ] )->name( 'my-services' );
    Route::get('service/create', [ ServiceController::class, 'create' ] )->name( 'services.create' );
    Route::post('service', [ ServiceController::class, 'store' ] )->name( 'services.store' );
    
    Route::get('my-chats', [ ChatController::class, 'index' ] )->name( 'my-chats' );
    Route::get('chat', [ ChatController::class, 'chat' ] )->name( 'chat' );
} );

require __DIR__.'/auth.php';

