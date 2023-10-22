<?php

namespace App\Exceptions;

use App\Helpers\ReturnApi;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

        $this->renderable(function (NotFoundHttpException  $notFoundHttpException) {
            return ReturnApi::messageReturn(true, "Route not found", $notFoundHttpException, [
                "file" => $notFoundHttpException->getFile(),
                "message" => $notFoundHttpException->getMessage(),
                "code" => $notFoundHttpException->getCode(),
                "line" => $notFoundHttpException->getLine()
            ], 404);
        });

        $this->renderable(function (Exception $exception) {
            return ReturnApi::messageReturn(true, "Unspected error", $exception, [
                "file" => $exception->getFile(),
                "message" => $exception->getMessage(),
                "code" => $exception->getCode(),
                "line" => $exception->getLine()
            ], 500);
        });
    }
}
