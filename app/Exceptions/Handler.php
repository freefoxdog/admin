<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
    protected function invalidJson($request, ValidationException $exception)
    {

        $msg = $exception->getMessage();

        foreach ($exception->errors() as $name=>$val)
        {
            if($name==='password'){
                return response()->apiReturn([], 420, $msg, 420);
            }
            $msg .= " {$name}:".implode("\n",$val);
        }

        return response()->apiReturn([], $exception->status, $msg, $exception->status);

    }
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? response()->apiReturn([], 401, 'Unauthorized', 401)
            : redirect()->guest(route('login'));
    }
    protected function prepareJsonResponse($request, Exception $e)
    {
        $status = $this->isHttpException($e) ? $e->getStatusCode() : 500;


        //  $headers = $this->isHttpException($e) ? $e->getHeaders() : [];
        return  response()->apiReturn([], $e->getCode(), $e->getMessage(), $status);


    }
    protected function prepareException(Exception $e)
    {
        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e, $e->getCode());
        } elseif ($e instanceof AuthorizationException) {
            $e = new AccessDeniedHttpException($e->getMessage(), $e);
        } elseif ($e instanceof TokenMismatchException) {
            $e = new HttpException(419, $e->getMessage(), $e);
        }

        return $e;
    }
}
