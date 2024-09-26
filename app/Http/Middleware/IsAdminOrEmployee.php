<?php

namespace App\Http\Middleware;

use App\Traits\ResponseMessageTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdminOrEmployee
{
    use ResponseMessageTrait;

    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || ($request->user()->role !== 'ADMIN' && $request->user()->role !== 'EMPLOYEE')) {

           if ($request->expectsJson()) {
                return $this->responseMessage(403, false, 'Unauthorized', []);
            }

            // For web requests, redirect back with an error message in the session
            return redirect()->back()->with('error', 'Unauthorized access');

        }

        return $next($request);



    }
}
