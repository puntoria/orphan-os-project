<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use App\Orphan;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DonorOrphansController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $orphans = Orphan::with('Residence')->where('donor_id', '=', $id)->get();

        return $this->success($this->prepareCollection($orphans));
    }

    /**
     * Get table data for a single orphan.
     *
     * @return Array
     */
    public function prepare($orphan) 
    {
        return [
        'id'          => "<div class=\"select-row\">{$orphan['id']}</div>",
        'donation'    => $orphan['has_donation'],
        'first_name'  => $orphan['first_name'],
        'last_name'   => $orphan['last_name'],
        'city'        => $orphan['residence']['city'],
        'video'       => $orphan['video'],
        'info'        => [
        'options' => view('admin.partials.settings.orphan', ['id' => $orphan['id']])->render(),
        'id'      => $orphan['id']
        ]
        ];
    }
}
