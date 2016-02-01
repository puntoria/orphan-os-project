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
            'message' => trans('general.responses.donor.added')
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
            'message' => trans('general.responses.donor.updated'),
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
            'totalCount'           => User::where(['type' => 'donor'])->count(),
            'activeCount'          => User::where(['type' => 'donor', 'active' => 1])->count(),
            'inactiveCount'        => User::where(['type' => 'donor', 'active' => 0])->count()
            ]);
    }


    /**
     * Generate CSV file 
     *
     * @return CSV File
     */
    public function csv() 
    {
        $donors = User::where('type', '=', 'donor')->get();


        $data = array_map(function($donor) {
            $line = [];

            $line[] = $donor['id'];
            $line[] = $donor['name'];
            $line[] = $donor['username'];
            $line[] = $donor['email'];
            $line[] = $donor['active'] == 0 ? trans('general.actions.no') : trans('general.actions.yes');

            return $line;
        }, $donors->toArray());

        $headings = [
            trans('general.fields.donor.id'),
            trans('general.fields.donor.name'),
            trans('general.fields.user.username'),
            trans('general.fields.donor.email'),
            trans('general.fields.donor.active')
        ];

        array_unshift($data, $headings);

        $csvFile = tempnam('./csv', '');
        $csv = fopen($csvFile, 'w');

        foreach ($data as $row) fputcsv($csv, $row, "\t");

        fclose($csv);

        header('Content-Encoding: UTF-8');
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename=Donors_List.csv');

        echo chr(255) . chr(254) . mb_convert_encoding(file_get_contents($csvFile), 'UTF-16LE', 'UTF-8');

        die();
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
            'message' => trans('general.responses.donor.deleted')
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
            'message' => trans('general.responses.donor.mass-deleted')
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
        'users' => [
            'id'       => "<div class=\"select-row\">{$donor['id']}</div>",
            'name'     => $donor['name'],
            'email'    => $donor['email'],
            'active'   => $donor['active'] ? trans('general.actions.yes') : trans('general.actions.no'),
            'language' => trans('general.languages.' . $donor['language']),
            'username' => $donor['username'],
            'orphans' => Orphan::where('donor_id', '=', $donor['id'])->count()
        ],

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

