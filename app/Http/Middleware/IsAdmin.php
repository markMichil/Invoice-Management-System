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
            return $this->responseMessage(403,false,'Unauthorized YOU DONT HAS ADMIN PERMISSION',[]);

        }

        return $next($request);
    }
}
