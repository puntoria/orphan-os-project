<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use DB;
use App\User;
use App\Donor;
use App\Orphan;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateProfileRequest;

class UserController extends ApiController
{

    public function __construct()
    {
        $this->middleware('auth.superadmin', ['except' => ['updateProfile', 'show']]);
    }


    /**
     * Get all users
     *
     * @return JSON Response
     */
    public function index(Request $request, $filter = "data")
    {
        $users = User::where('type', '!=', 'donor');

        $users = $this->manage($users, $request);

        $users = $this->filter($filter, $users);
        
        $users = $users->get();
        
        $count = $this->count($filter);

        return $this->success($this->prepareCollection($users), [
            'recordsTotal'    => $count,
            'recordsFiltered' => $count
            ]);
    }


    /**
     * Get a single user based on the given ID
     *
     * @return JSON Response
     */
    public function show($id) 
    {
        $user = User::find($id);

        return $this->success($this->prepareSingle($user));
    }


    /**
     * Add a new user
     *
     * @return JSON Response
     */
    public function create(AddUserRequest $request) 
    {
        // Add new user
        // 
        // The smallest available id is being attached to it
        // Encrypt the password
        // Save
        
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return $this->success([
            'message' => trans('general.responses.user.added'),
            'id'      => $user->id
            ]);
    }


    /**
     * Update the user with the given ID and data
     *
     * @return JSON Response
     */
    public function update($id, UpdateUserRequest $request) 
    {
        $user = User::find($id);

        $data = $request->all();

        if ($request->password == "") { 
            unset($data["password"]); 
        } else { 
            $data["password"] = bcrypt($request->password); 
        }

        $user->update($data);

        return $this->success([
            'message' => trans('general.responses.user.updated')
            ]);
    }


    public function updateProfile($id, UpdateProfileRequest $request)
    {
        $data = $request->only(['name', 'username', 'email', 'language', 'password']);

        if ($request->password == "") { 
            unset($data["password"]); 
        } else { 
            $data["password"] = bcrypt($request->password); 
        }

        User::find($id)->update($data);

        return $this->success([
            'message' => trans('general.responses.user.profile-updated')
            ]);
    }


    /**
     * Count Users with the given filter
     *
     * @return Query Builder
     */
    public function count($filter) 
    {
        if ($filter == "active")   return User::where('type', '!=', 'donor')->where(['active' => 1])->count();
        if ($filter == "inactive") return User::where('type', '!=', 'donor')->where(['active' => 0])->count();

        return User::where('type', '!=', 'donor')->count();
    }


    /**
     * Filter Users query with the given filter
     *
     * @return Query Builder
     */
    public function filter($filter, $query) 
    {
        if ($filter == "active")   return $query->where(['active' => 1]);
        if ($filter == "inactive") return $query->where(['active' => 0]);

        return $query;
    }


    /**
     * Stats for Users
     *
     * @return JSON Response
     */
    public function stats() 
    {
        return $this->success([
            'totalCount'           => User::where('type', '!=', 'donor')->count(),
            'activeCount'          => User::where('type', '!=', 'donor')->where(['active' => 1])->count(),
            'inactiveCount'        => User::where('type', '!=', 'donor')->where(['active' => 0])->count()
            ]);
    }


    /**
     * Delete the User with the given ID
     *
     * @return JSON Response
     */
    public function delete($id) 
    {
        User::where('id', '=', $id)->delete();

        if ($id == auth()->user()->id) {
            auth()->logout();
        }

        return $this->success([
            'message' => trans('general.responses.user.deleted')
            ]);
    }


    /**
     * Delete multiple users
     *
     * @return JSON Response
     */
    public function massDelete(Request $request) 
    {
        User::whereIn('id', $request->users)->delete();

        if (in_array(auth()->user()->id, $request->users)) {
            auth()->logout();
        }

        return $this->success([
            'message' => trans('general.responses.user.mass-deleted')
            ]);
    }


    /**
     * Get table data for a single user.
     *
     * @return Array
     */
    public function prepare($user) 
    {
        return [
        'id'       => "<div class=\"select-row\">{$user['id']}</div>",
        'name'     => $user['name'],
        'type'     => $user['type'],
        'email'    => $user['email'],
        'active'   => $user['active'] ? trans('general.actions.yes') : trans('general.actions.no'),
        'language' => trans('general.languages.' . $user['language']),
        'username' => $user['username'],

        'info'        => [
        'options' => view('admin.partials.settings.user', ['id' => $user['id']])->render(),
        'id'      => $user['id']
        ]
        ];
    }


    /**
     * Get all data for a single user for viewing/editing.
     *
     * @return Array
     */
    public function prepareSingle($user) 
    {
        return [
        'id'       => $user->id,
        'name'     => $user->name,
        'type'     => $user->type,
        'email'    => $user->email,
        'active'   => $user->active,
        'username' => $user->username,
        'language' => $user->language,
        ];
    }
}

