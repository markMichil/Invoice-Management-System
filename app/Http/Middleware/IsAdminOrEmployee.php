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
            return $this->responseMessage(403, false, 'Unauthorized', []);
        }

        return $next($request);
    }
}
