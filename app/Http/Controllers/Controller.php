<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\JsonResponse as HttpJsonResponse;

abstract class Controller
{
    use AuthorizesRequests;

    private array $data = [];

    use AuthorizesRequests;

    /**
     * Return a success response
     *
     * @param array $data The data to return
     * @param string $key The key to use for the data
     * @param int $statusCode The HTTP status code
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($data = [], $key = 'data', $statusCode = 200): JsonResponse
    {
        $response = ['status' => 'success'];

        if ($data) {
            if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator) {
                $response[$key] = $data->items(); 
                $response['pagination'] = [
                    'current_page' => $data->currentPage(),
                    'per_page' => $data->perPage(),
                    'total' => $data->total(),
                    'last_page' => $data->lastPage(),
                    'from' => $data->firstItem(),
                    'to' => $data->lastItem(),
                ];
            } else {
                $response[$key] = $data;
            }
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Return a failure response
     *
     * @param array $error The error details
     * @param int $statusCode The HTTP status code
     * @param string $status The status message
     * @return \Illuminate\Http\JsonResponse
     */

    public function failure($error = [], $statusCode = 500, $status = 'fail'): JsonResponse
    {
        $result = array_merge(['status' => $status], $error);
        return response()->json($result, $statusCode);
    }
}
