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
    public function index($id, $filter = "data", Request $request)
    {
        $orphans = Orphan::with('Residence')->where('donor_id', '=', $id);

        $orphans = $this->manage($orphans, $request);

        $orphans = $this->filter($filter, $orphans);
        
        $orphans = $orphans->get();
        
        $count = $this->count($filter, $id);

        return $this->success($this->prepareCollection($orphans), [
            'recordsTotal'    => $count,
            'recordsFiltered' => $count
            ]);
    }

    /**
     * List all orphans without donation in the donor panel
     *
     * @return \Illuminate\Http\Response
     */
    public function withoutDonation(Request $request)
    {
        $orphans = Orphan::with('Residence')->where('has_donation', '=', 0);

        $orphans = $this->manage($orphans, $request);

        $orphans = $orphans->get();

        $count = Orphan::where('has_donation', '=', 0)->count();

        return $this->success($this->prepareCollection($orphans, 'prepareForDonation'), [
            'recordsTotal'    => $count,
            'recordsFiltered' => $count
            ]);
    }


    /**
     * Count Orphans with the given filter
     *
     * @return Query Builder
     */
    public function count($filter, $id) 
    {
        if ($filter == "withDonation")    return Orphan::where(['donor_id' => $id, 'has_donation' => 1])->count();
        if ($filter == "withoutDonation") return Orphan::where(['donor_id' => $id, 'has_donation' => 0])->count();

        return Orphan::where(['donor_id' => $id])->count();
    }


    /**
     * Filter Orphans query with the given filter
     *
     * @return Query Builder
     */
    public function filter($filter, $query) 
    {
        if ($filter == "withDonation")    return $query->where(['has_donation' => 1]);
        if ($filter == "withoutDonation") return $query->where(['has_donation' => 0]);

        return $query;
    }


    /**
     * Stats for Orphans
     *
     * @return JSON Response
     */
    public function stats($id) 
    {
        return $this->success([
            'totalCount'           => Orphan::where(['donor_id' => $id])->count(),
            'withDonationCount'    => Orphan::where(['donor_id' => $id, 'has_donation' => 1])->count(),
            'withoutDonationCount' => Orphan::where(['donor_id' => $id, 'has_donation' => 0])->count()
            ]);
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


    /**
     * Prepare Orphans without Donation
     *
     * @return Array
     */
    public function prepareForDonation($orphan) 
    {
        return [
        'id'          => "<div class=\"select-row\">{$orphan['id']}</div>",
        'first_name'  => $orphan['first_name'],
        'middle_name' => $orphan['middle_name'],
        'last_name'   => $orphan['last_name'],
        'city'        => $orphan['residence']['city'],
        'video'       => $orphan['video'],
        'info'        => [
        'options' => view('donor.partials.settings.orphan', [
            'id'   => $orphan['id'],
            'name' => $orphan['first_name'] . " " . $orphan['last_name']
            ])->render(),
        'id'      => $orphan['id']
        ]
        ];
    }
}
