<?php

namespace App\Exceptions;

use Exception;
use Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
        // exception for JWTAuth errors
        if ($exception instanceof TokenInvalidException){
            return Response::json(['error' => 'invalid token'], $exception->getStatusCode());
        } else if ($exception instanceof TokenExpiredException ){
            return Response::json(['error' => 'token expired'], $exception->getStatusCode());
        } else if ($exception instanceof JWTException) {
            return Response::json(['error' => 'error fetching token'], $exception->getStatusCode());
        }

    // exception for DB errors
        if ( $exception instanceof \PDOException )
        {
            $response = [
                'errors' => 'Sorry, something went wrong. '
            ];
            switch ($exception->getCode()) {
                case 2002:
    //Error 2002: no connection to DB
                    $response = [
                        'errors' => 'Could not connect to DB.'
                    ];
            }
            return response()->json($response, 500);
        }
        if ($request->wantsJson()) {
            $response = [
                'errors' => 'Sorry, something went wrong. ' . $exception->getMessage()
            ];
            // Default response of 400
            $status = 400;
            // If this exception is an instance of HttpException
            if ($this->isHttpException($exception)) {
                // Grab the HTTP status code from the Exception
                $status = $exception->getStatusCode();
            }
            // Return a JSON response with the response array and status code
            return response()->json($response, $status);
        }
       return parent::render($request, $exception);
     }
}
