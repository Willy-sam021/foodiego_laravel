<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\OrderPageMiddleWare;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        using: function () {
            Route::middleware("web")
                ->group(base_path("routes/web.php"));

            Route::middleware("api")
                ->prefix("api")
                ->group(base_path("routes/api.php"));

            Route::middleware("web")
                ->group(base_path("routes/seller.php"));

            Route::middleware("web")
                ->group(base_path("routes/product.php"));
            Route::middleware("web")
                ->group(base_path("routes/order.php"));
            Route::middleware("web")
            ->group(base_path("routes/cart.php"));
            Route::middleware("web")
                ->group(base_path("routes/user.php"));
            Route::middleware("web")
                ->group(base_path('routes/payment.php'));

        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
        'seller' => \App\Http\Middleware\IsSeller::class,
        'orderPage'=> OrderPageMiddleWare::class,
    ]);
    })
    ->withExceptions(function (Exceptions $exception) {

         $exception->render(function (HttpException $exception) {
            $statusCode = $exception->getStatusCode();
            if ( $statusCode=== 404 ) {
                if($exception->getPrevious() instanceof ModelNotFoundException){
                    return response()->view('errors.404', [], 404);
                }
                return response()->view('errors.404', [], 404);
            }

           if ($statusCode == 500) {
            return response()->view('errors.500', [], 500);
            }

            if ($statusCode == 429) {
            return response()->view('errors.429', [], 500);
            }

            if($statusCode == 433){
                return response()->view('errors.433', [], 500);
            }
        });

        $exception->render(function(ModelNotFoundException $ex){
            $model = class_basename($ex->getModel());
             return response()->view('errors.404', [], 404);
        });

    })->create();
