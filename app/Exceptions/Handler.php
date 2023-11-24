<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'message' => 'No query results for model [' . $exception->getModel() . ']',
                'code' => 404
            ], 404);
        } elseif ($exception instanceof ValidationException && $request->expectsJson()) {
            return response()->json([
                'message' => $exception->getMessage(),
                'code' => $exception->status
            ], $exception->status);
        }

        return parent::render($request, $exception);
    }
}
