<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Lang;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;


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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        /*if($e instanceof AccessDeniedHttpException){
            return shovel()->withError(['message' => $e->getMessage()], 403);
        }

        if($e instanceof AuthorizationException){
            return shovel()->withError($e->getMessage(), 403);
        }

        if ($e instanceof TokenExpiredException) {
            return shovel()->withError(['message' => 'Token Expired'], 401);
        }

        if ($e instanceof JWTException){
            return shovel()->withError(['message' => $e->getMessage() ?: 'Unauthorized', 'fail' => true], 401);
        }

        if ($e instanceof NotFoundHttpException) {
            return shovel()->withError(['message' => 'Not Found'], 404);
        }

        if ($e instanceof HttpException) {
            if ($e->getStatusCode() == 503)
                return shovel()->withError(['message' => 'Page in maintenance'], $e->getStatusCode());

            if($e->getCode() == 777){
                return shovel()->withError(['message' => $e->getMessage(), 'fail' => true], $e->getStatusCode());
            }

            return shovel()->withError($e->getMessage(), $e->getStatusCode());
        }

        if($e instanceof QueryException){
            return shovel()->withError($e->getMessage(), 400);
        }*/
        if($request->wantsJson()){
            return shovel()->withError($e->getMessage(),$e->getCode());
        }

        return parent::render($request, $e);
    }
}
