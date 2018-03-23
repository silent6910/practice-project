<?php

/**
 * unify response format
 * code:default=>200,unknown=>0,other=>getCode()
 *
 * @param array $data
 * @param int $code
 * @return \Illuminate\Http\JsonResponse
 */
function responseJs on($data = [], $code = \Illuminate\Http\Response::HTTP_OK)
{
    return response()->json([
        'code' => $code,
        'data' => ($code == \Illuminate\Http\Response::HTTP_OK) ? $data : []
    ]);
}