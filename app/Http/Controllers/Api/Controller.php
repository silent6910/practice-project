<?php

namespace App\Http\Controllers\Api;

class Controller
{

    /**
     * 整理回傳型式
     *
     * @param array $responseResult
     * @return array
     */
    protected function responseJSON(array $responseResult = [])
    {
        $responseResult = (config('httpStatus.successStatus') == config('httpStatus.defaultStatus'))
            ? $responseResult
            : [];
        return response()->json(['status' => config('httpStatus.defaultStatus'), 'data' => $responseResult]);
    }

}