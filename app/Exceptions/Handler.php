<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }
    protected function unauthenticated($request, \Illuminate\Auth\AuthenticationException $exception)
    {
        if($request->expectsJson()){
            return response()->json(['message'=>$exception->getMessage()],401);
        }
        $guard = Arr::get($exception->guards(),0);
        switch ($guard) {
            case 'admin':
                $routeName='admin.login';
                break;
            
            default:
                $routeName='index';
                break;
        }
        Session::forget('url.intended');
        return redirect()->guest(route($routeName));
    }
}
