<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->render(function (InternalErrorException $e, Request $request) {
            Log::error('Internal Server Error: ' . $e->getMessage());
            if ($request->is('api/*')) {
                Log::error('Internal Server Error: ' . $e->getMessage());
                return response()->json([
                    'status' => 'error',
                    'data' => [],
                    'message' => str($e)
                ], 500);
            }
        });
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 'not found',
                    'data' => [],
                    'message' => 'Record not found.' . ($e)
                ], 404);
            }
        });
        $exceptions->render(function (ModelNotFoundException $e, Request $request) {
            Log::error('Model Not Found: ' . $e->getMessage());
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 'error',
                    'data' => [],
                    'message' => str($e)
                ], 404);
            }
        });
    })->create();
