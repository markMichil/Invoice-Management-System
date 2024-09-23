<?php

namespace App\Http\Middleware;

use App\Traits\ResponseMessageTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentType
{

    use ResponseMessageTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check content type
        $contentType = $request->header('Content-Type');

        if (!$this->isValidContentType($contentType)) {
            return $this->responseMessage(400, false, 'Invalid content type. Must be application / json . (body/Row->type/json)', []);
        }

        return $next($request);
    }

    private function isValidContentType($contentType)
    {

        return in_array($contentType, [
            "application/json",
        ]);
    }
}
