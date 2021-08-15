<?php

namespace App\Exceptions;

use App\Services\Response\ResponseService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (AccessDeniedHttpException $e, $request) {
            if ($request->wantsJson()) {
                return ResponseService::notFound();
            }
        });

        $this->reportable(function (AuthenticationException $e, $request) {
            if ($request->wantsJson()) {
                return ResponseService::notAuthorize();
            }
        });
    }
}
