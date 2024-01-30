<?php

declare(strict_types=1);

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

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

Route::group(['middleware' => 'auth:sanctum'], static function (): void {
    Route::prefix('auth')->withoutMiddleware('auth:sanctum')
        ->group(static function (): void {
            $limiter = config('fortify.limiters.login');

            Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware(array_filter([
                    'guest:'. config('fortify.guard'),
                    $limiter ? 'throttle:' . $limiter : null,
                ]));

            Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest:'. config('fortify.guard'));

            Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest:'. config('fortify.guard'))
                ->name('password.email');
        });

    Route::group(['prefix' => 'account'], static function (): void {

        Route::get('/user', static function (Request $request) {
            return $request->user();
        });

        Route::get('/users', UserController::class);
        Route::get('/products', ProductController::class);

        // get all orders for current user, get order by id, create new order
        Route::apiResource('/orders', OrderController::class)->except([
            'update'
        ]);

        Route::get('/status/check/{hashCode}', [StatusController::class, 'checkStatus']);
        //update rent if product available for rent
        Route::put('/status/rent/{order}/update', [StatusController::class, 'updateRent']);
    });
});
