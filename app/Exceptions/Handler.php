<?php

namespace App\Exceptions;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
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
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson() || $request->is('api/*')) {
			//return response()->json(['success' => false, 'message'=>'Unauthenticated','data'=>array()], 401);
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        $guard = Arr::get($exception->guards(), 0);
       	switch ($guard) {
         	case 'admin':
           		$login='admin.login';
           		break; 
		 	case 'staff':
           		$login='staff.login';
           		break;

         	default:
           		 return response()->json(['error' => 'Unauthenticated.'], 401); 
           		//break;
       	}
        return redirect()->guest(route($login));
    }
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }
	
	
}