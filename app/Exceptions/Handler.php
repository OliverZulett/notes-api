<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Laravel\Prompts\Output\ConsoleOutput;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function render($request, \Throwable $exception)
    {
        $output = new ConsoleOutput();
        if ($exception instanceof NotFoundHttpException) {
            $output->write($exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Resource Not found',
                    'statusCode' => 404,
                    'error' => $exception->getMessage(),
                ],
                404
            );
        }
        if ($exception instanceof BadRequestException) {
            $output->write($exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Bad Request',
                    'statusCode' => 404,
                    'error' => $exception->getMessage(),
                ],
                400
            );
        }
        return parent::render($request, $exception);
    }
}
