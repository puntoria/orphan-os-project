<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use App\User;
use App\Donor;
use App\Orphan;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddDonorRequest;

class UserController extends ApiController
{

    /**
     * Get all users
     *
     * @return JSON Response
     */
    public function index()
    {
        $users = User::where('type', '!=', 'donor')->get();

        return $this->success($this->prepareCollection($users));
    }


    /**
     * Get a single user based on the given ID
     *
     * @return JSON Response
     */
    public function show($id) 
    {
        $user = User::where('type', '!=', 'donor')->find($id);

        return $this->success($this->prepareSingle($user));
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
    public function prepare($user) 
    {
        return [
        'id'       => "<div class=\"select-row\">{$user['id']}</div>",
        'name'     => $user['name'],
        'email'    => $user['email'],
        'active'   => $user['active'],
        'language' => $user['language'],
        'username' => $user['username'],
        'type'     => $user['type'],

        'info'        => [
        'options' => view('admin.partials.settings.user', ['id' => $user['id']])->render(),
        'id'      => $user['id']
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

