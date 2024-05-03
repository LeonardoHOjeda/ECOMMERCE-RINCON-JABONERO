<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
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
      $exceptions->renderable(function (ValidationException $e, $request) {
        if ($request->is('api/*')) {
          $errors = $e->errors();

          return response()->json(['error' => array_values($errors)[0][0],], 422);
        }
      });

      // UnauthorizedException - Error de autorización
      $exceptions->renderable(function (UnauthorizedException $e, $request){
        if ($request->is('api/*')) {
          return response()->json(['error' => 'Acceso no autorizado'], 401);
        }
      });

      // AccessDeniedHttpException - Error de acceso denegado
      $exceptions->renderable(function (AccessDeniedHttpException $e, $request) {
        if ($request->is('api/*')) {
          return response()->json(['error' => 'Acción no permitida'], 403);
        }
      });
      
      // AuthenticationException - Error de autenticación
      $exceptions->renderable(function (AuthenticationException $e, $request) {
        if ($request->is('api/*')) {
          return response()->json([
            'error' => 'No estás autenticado',
            'unauthenticated' => true
          ], 401);
        }
      });

      // NotFoundHttpException - Error de recurso no encontrado
      $exceptions->renderable(function (NotFoundHttpException $e, $request) {
        if ($request->is('api/*')) {
          return response()->json([
            'error' => $e->getMessage() ?? 'No existe el recurso ' . $request->path()
          ], 404);
        }
      });

      // Error interno del servidor
      $exceptions->renderable(function (Throwable $e, $request) {
        if ($request->is('api/*')) {
          return response()->json([
            'error' => $e->getMessage() ?? 'Error interno del servidor'
          ], 500);
        }
      });
      
      $exceptions->reportable(function (Throwable $e) {
        Log::error($e->getMessage());
      });

    })->create();
