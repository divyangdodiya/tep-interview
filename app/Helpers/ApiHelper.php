<?php

use Illuminate\Http\JsonResponse;

if (!function_exists('apiResponse')) {
    function apiResponse($status = null, $message = null, $data = null, $http_code = 500): JsonResponse
    {
        $res = [];

        if (!is_null($status)) {
            $res['status'] = $status;
        }

        if (!is_null($message)) {
            $res['message'] = $message;
        }

        // Check if the data object / array is instance of paginator
        if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            $paginate = [
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
            ];
            $res['paginate'] = $paginate;
            $data = $data->items();
        }

        if (!is_null($data) && $data != '') {
            $res['data'] = $data;
        } else {
            $res['data'] = null;
        }

        return response()->json($res, $http_code);
    }
}
?>
