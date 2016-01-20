<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use App\User;
use App\Donor;
use App\Orphan;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddDonorRequest;

class DonorController extends ApiController
{

    public function __construct()
    {
        $this->middleware('auth.superadmin', ['except' => ['index', 'count', 'filter', 'stats']]);
    }

    /**
     * Get all donors
     *
     * @return JSON Response
     */
    public function index(Request $request, $filter = "data")
    {
        $donors = User::where('type', '=', 'donor');

        $donors = $this->manage($donors, $request);

        $donors = $this->filter($filter, $donors);
        
        $donors = $donors->get();
        
        $count = $this->count($filter);

        return $this->success($this->prepareCollection($donors), [
            'recordsTotal'    => $count,
            'recordsFiltered' => $count
            ]);
    }


    /**
     * Get a single donor based on the given ID
     *
     * @return JSON Response
     */
    public function show($id) 
    {
        $donor = User::where('type', '=', 'donor')->find($id);

        return $this->success($this->prepareSingle($donor));
    }


    /**
     * Add a new donor
     *
     * @return JSON Response
     */
    public function create(AddDonorRequest $request) 
    {
        Donor::create($request->all());

        return $this->success([
            'message' => 'Donor has been added to database.'
            ]);
    }


    /**
     * Update the donor with the given ID and data
     *
     * @return JSON Response
     */
    public function update($id, AddDonorRequest $request) 
    {
        $donor = Donor::find($id);

        $data = $request->all();

        if ($request->password == "") { 
            unset($data["password"]); 
        } else { 
            $data["password"] = bcrypt($request->password); 
        }

        $donor->update($data);

        return $this->success([
            'message' => 'Donor has been updated.',
            'updated_id' => $request->id != $id ? $request->id : null
            ]);
    }


    /**
     * Count Donors with the given filter
     *
     * @return Query Builder
     */
    public function count($filter) 
    {
        if ($filter == "active")   return User::where(['type' => 'donor', 'active' => 1])->count();
        if ($filter == "inactive") return User::where(['type' => 'donor', 'active' => 0])->count();

        return User::where(['type' => 'donor'])->count();
    }


    /**
     * Filter Donors query with the given filter
     *
     * @return Query Builder
     */
    public function filter($filter, $query) 
    {
        if ($filter == "active")    return $query->where(['active' => 1]);
        if ($filter == "inactive")  return $query->where(['active' => 0]);

        return $query;
    }


    /**
     * Stats for Donors
     *
     * @return JSON Response
     */
    public function stats() 
    {
        return $this->success([
            'totalCount'           => Donor::count(),
            'activeCount'          => Donor::where(['active' => 1])->count(),
            'inactiveCount'        => Donor::where(['active' => 0])->count()
            ]);
    }


    /**
     * Delete the Donor with the given ID
     *
     * @return JSON Response
     */
    public function delete($id) 
    {
        Orphan::where('donor_id', '=', $id)->update(['donor_id' => null]);
        Donor::where('id', '=', $id)->delete();

        return $this->success([
            'message' => 'Donor has been deleted.'
            ]);
    }


    /**
     * Delete multiple donors
     *
     * @return JSON Response
     */
    public function massDelete(Request $request) 
    {
        Orphan::whereIn('donor_id', $request->donors)->update(['donor_id' => null]);
        Donor::whereIn('id', $request->donors)->delete();

        return $this->success([
            'message' => 'Donors have been deleted.'
            ]);
    }


    /**
     * Get table data for a single donor.
     *
     * @return Array
     */
    public function prepare($donor) 
    {
        return [
        'id'       => "<div class=\"select-row\">{$donor['id']}</div>",
        'name'     => $donor['name'],
        'email'    => $donor['email'],
        'active'   => $donor['active'],
        'language' => $donor['language'],
        'username' => $donor['username'],

        'info'        => [
        'options' => view('admin.partials.settings.donor', ['id' => $donor['id']])->render(),
        'id'      => $donor['id']
        ]
        ];
    }


    /**
     * Get all data for a single donor for viewing/editing.
     *
     * @return Array
     */
    public function prepareSingle($donor) 
    {
        return [
        'id'       => $donor->id,
        'name'     => $donor->name,
        'email'    => $donor->email,
        'language' => $donor->language,
        'active'   => $donor->active,
        ];
    }
}

