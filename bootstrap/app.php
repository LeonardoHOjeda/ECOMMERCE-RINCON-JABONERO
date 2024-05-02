<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
      $exceptions->renderable(function (NotFoundHttpException  $e, $request) {
        if ($request->is('api/*')) {
          return response()->json([
            'error' => 'No existe el recurso ' . $request->path()
          ], 404);
        }
      });

      $exceptions->renderable(function (UnauthorizedException $e, $request){
        if ($request->is('api/*')) {
          return response()->json([
            'error' => 'Acceso no autorizado'
          ], 401);
        }
      });

      $exceptions->renderable(function (Throwable $e, $request) {
        if ($request->is('api/*')) {
          return response()->json([
            'error' => 'Error interno del servidor'
          ], 500);
        }
      });

      $exceptions->reportable(function (Throwable $e) {
        Log::error($e->getMessage());
      });

    })->create();
