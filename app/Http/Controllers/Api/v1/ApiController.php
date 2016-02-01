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
    public function respond($data, $status = 200, $error = false, $extra = []) {
        return response()->json(array_merge([
            'data' => $data,
            'error' => $error
            ], $extra), $status);
    }


    /**
     * Compose a successful JSON response with data
     *
     * @return JSON Response
     */
    public function success($data, $extra = []) {
        return $this->respond($data, 200, false, $extra);
    }


    /**
     * Compose an unsuccessful JSON response with data
     *
     * @return JSON Response
     */
    public function error($data, $extra = []) {
        return $this->respond($data, 400, true, $extra);
    }


    /**
     * Prepare a given collection of data to be returned in array format.
     *
     * @return Multi Dimensional Array
     */
    public function prepareCollection($collection, $function = 'prepare') 
    {
        return array_map([$this, $function], $collection->toArray());
    }

    /**
     * Manage the query for returning data to datatables.
     *
     * @return Query Builder
     */
    public function manage($query, $request) {
        $arabicColumns = ['orphans.first_name', 'orphans.middle_name', 'orphans.last_name'];

        if (is_array($request->order) && !empty($request->order)) {
            foreach ($request->order as $order) {
                $query = $query->orderBy($request->columns[$order['column']]['data'], $order['dir']);
            }
        }

        if ($request->start && $request->length) {
            $query = $query->skip($request->start)
                           ->limit($request->length);
        }

        if (is_array($request->search) && $request->search['value'] != '') {
            $columns = array_filter( array_map(function($column) {
                if ($column['searchable'] == 'true') return $column['data'];
            }, $request->columns));

            $orWhere = false;
            foreach ($columns as $column) {
                if ($orWhere) {
                    $query = $query->orWhere($column, 'LIKE', '%' . $request->search['value'] . '%');

                    if (in_array($column, $arabicColumns)) {
                        $query = $query->orWhere("{$column}_ar", 'LIKE', '%' . $request->search['value'] . '%');
                    }

                } else {
                    $query = $query->where($column, 'LIKE', '%' . $request->search['value'] . '%');

                    if (in_array($column, $arabicColumns)) {
                        $query = $query->orWhere("{$column}_ar", 'LIKE', '%' . $request->search['value'] . '%');
                    }
                    $orWhere = true;
                }
            }
        }

        $query = $query->limit($request->length);

        return $query;
    }
}
