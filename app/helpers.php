<?php

/**
 * unify response format
 * code:default=>200,unknown=>500,other=>getCode()
 *
 * @param array $data
 * @param int $code
 * @return \Illuminate\Http\JsonResponse
 */
function responseJson($data = [], $code = \Illuminate\Http\Response::HTTP_OK)
{
    return response()->json([
        'code' => $code,
        'data' => $data
    ]);
}

///**
// * unify response format with pagination
// * code:default=>200,unknown=>500,other=>getCode()
// * @param \Illuminate\Pagination\Paginator $data
// * @param int $code
// * @return \Illuminate\Http\JsonResponse
// */
//function responsePagination(\Illuminate\Pagination\Paginator $data, $code = \Illuminate\Http\Response::HTTP_OK)
//{
//    $data = array_merge(['code' => $code], $data->toArray());
//
//    return response()->json($data);
//}