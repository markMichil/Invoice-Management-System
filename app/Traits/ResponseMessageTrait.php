<?php

namespace App\Traits;

trait ResponseMessageTrait
{
    public function responseMessage($code, $Status, $Message = null, $data = null)
    {
        return response()->json([
            'code' => $code,
            'status' => $Status,
            'message' => $Message,
            'data' => $data
        ]);
    }
}
