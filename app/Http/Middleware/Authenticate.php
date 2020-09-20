<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

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
      // return response()->json(['success' =>'aaa'], 200);
     // $acceptable = $this->getAcceptableContentTypes();
      if ($request->is('api/*') )
       {
           return route('member.login.form');
       }
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
