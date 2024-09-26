<?php
namespace App\Http\Middleware;

use App\Traits\ResponseMessageTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    use ResponseMessageTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {


        if (!$request->user() || $request->user()->role !== 'ADMIN') {


            if ($request->expectsJson()) {
                return $this->responseMessage(403, false, 'Unauthorized YOU DONT HAS ADMIN PERMISSION', []);
            }

            // For web requests, redirect back with an error message in the session
            return redirect()->back()->with('error', 'Unauthorized YOU DONT HAS ADMIN PERMISSION');


        }

        return $next($request);
    }
}
