<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        TokenExpiredException::class,
        TokenInvalidException::class,
        JWTException::class,
        UnauthorizedHttpException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable $exception
     * @return void
     * @throws Exception
     */
    public function report(Throwable $exception)
    {
        if ($exception->getCode() == config('errorCode.unknown')) {
            if (app()->bound('sentry') && $this->shouldReport($exception)) {
                app('sentry')->captureException($exception);
            }
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     * code:default=>200,unknown=>0,other=>errorCode
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Throwable $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        $code = 0;

        //return parent::render($request, $exception);
        //It is not better that turn to use switch.
        if ($exception instanceof TokenExpiredException) {
            $code = config('errorCode.token_expired');
        }
        elseif ($exception instanceof TokenInvalidException) {
            $code = config('errorCode.token_expired');
        }
        elseif ($exception instanceof JWTException || $exception instanceof UnauthorizedHttpException) {
            $code = config('errorCode.token_error');
        }
        elseif ($exception instanceof CustomException) {
            $code = config('errorCode.' . $exception->getMessage());
        }
        elseif ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            $code = config('errorCode.permission_unauthorized');
        }
        // model not found exception is not NotFoundHttpException
        elseif ($exception instanceof ModelNotFoundException) {
            $code = config('errorCode.not found');
        }
        elseif ($this->isHttpException($exception)) {
            $code = config('errorCode.not found');
        }
        else{
            $code = config('errorCode.unknown');
        }

        return responseJson([], $code);
    }
}
