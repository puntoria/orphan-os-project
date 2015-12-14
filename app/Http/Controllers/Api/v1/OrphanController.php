<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use App\Orphan;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrphanController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orphans = Orphan::with('Donor', 'Residence')->get();

        return response()->json([
            'data' => $this->prepareCollection($orphans)
            ], 200);
    }

    public function prepareCollection($collection) 
    {
        /* $data = array_map([$this, 'prepare'], $collection->toArray());
        $data = array_merge($data, $data, $data, $data, $data, $data, $data, $data, $data, $data, $data, $data);
        $data = array_merge($data, $data, $data, $data, $data, $data, $data, $data, $data, $data, $data, $data);
        $data = array_merge($data, $data, $data, $data, $data, $data, $data, $data, $data, $data, $data, $data); 
        -- Stress Test*/

        return array_map([$this, 'prepare'], $collection->toArray());
    }

    public function prepare($orphan) {
        return [
        'id'          => $orphan['id'],
        'donor'       => $orphan['donor']['name'],
        'donation'    => $orphan['has_donation'],
        'first_name'  => $orphan['first_name'],
        'middle_name' => $orphan['middle_name'],
        'last_name'   => $orphan['last_name'],
        'city'        => $orphan['residence']['city'],
        'video'       => $orphan['video'],
        'info'        => [
            'options' => view('admin.partials.settings.orphan')->render()
            ]
        ];
    }
}
