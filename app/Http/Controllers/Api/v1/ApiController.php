<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    /**
     * Compose a JSON response with data and a status code
     *
     * @return JSON Response
     */
    public function respond($data, $status = 200, $error = false) {
        return response()->json([
            'data' => $data,
            'error' => $error
            ], $status);
    }

    /**
     * Compose a successful JSON response with data
     *
     * @return JSON Response
     */
    public function success($data) {
        return $this->respond($data, 200, false);
    }

    /**
     * Compose an unsuccessful JSON response with data
     *
     * @return JSON Response
     */
    public function error($data) {
        return $this->respond($data, 400, true);
    }

    /**
     * Prepare a given collection of data to be returned in array format.
     *
     * @return Multi Dimensional Array
     */
    public function prepareCollection($collection) 
    {
        return array_map([$this, 'prepare'], $collection->toArray());
    }
}
