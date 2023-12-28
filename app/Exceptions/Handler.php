<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

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
        $this->renderable(function (NotFoundHttpException $e) {
            Log::error($e->getMessage(), ['path' => dirname(__FILE__)]);
            return apiResponse(false, 'Requested page not found in the server', '', 404);
        });

        $this->renderable(function (RouteNotFoundException $e) {
            Log::error($e->getMessage(), ['path' => dirname(__FILE__)]);
            return apiResponse(false, 'Requested route not found in the server', '', 404);
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception): JsonResponse
    {
        return apiResponse(false, "Please login first to continue", '', 403);
    }
}
