<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\UserController;


Route::get( "/logout", [ UserController::class, "logout" ] );
Route::post( "/login", [ UserController::class, "login" ] );
Route::fallback( fn() => response( "Request Not Found", 404, [ "content-type" => "application/json" ] ) );

Route::middleware( "auth:api" )->group( function ()
{
    Route::apiResource( "/room", RoomsController::class);
    Route::apiResource( "/booking", BookingsController::class);
    Route::apiResource( "/user", UserController::class);
} );