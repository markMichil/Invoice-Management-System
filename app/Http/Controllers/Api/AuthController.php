<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseMessageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ResponseMessageTrait;

    public function login(Request $request)
    {

        // Check content type
        $contentType = $request->header('Content-Type');

        if (!$this->isValidContentType($contentType)) {
            return $this->responseMessage(400, false, 'Invalid content type. Must be application/json.', []);
        }


        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('api-token')->plainTextToken;
            $data = [
                'type'  =>   'Bearer',
                'token' =>   $token,
                'user'  =>   $user,
            ];

            return   $this->responseMessage(200,true,'login successfully',$data);

        }
        return   $this->responseMessage(401,false,'sUnauthorized',[]);

    }

    public function logout(Request $request)
    {

        if (!$request->user()) {
            return $this->responseMessage(401, false, 'Token is invalid or expired', []);
        }

        // Revoke the current access token
        $request->user()->currentAccessToken()->delete();

        return $this->responseMessage(200, true, 'Logged out successfully', []);



    }

    private function isValidContentType($contentType)
    {

        return in_array($contentType, [
            "application/json",
        ]);
    }
}
