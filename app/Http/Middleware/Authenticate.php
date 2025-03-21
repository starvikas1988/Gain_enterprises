<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if(Str::contains($request->url, 'admin/'))
            return route('login');
        else
            echo json_encode(['success' => false, 'errorcode'=>'01', 'message' => 'Unauthorized Request', 'data'=>array()], true);
        exit();
        /*if (! $request->expectsJson()) {
            return route('login');
        }*/
    }
}
