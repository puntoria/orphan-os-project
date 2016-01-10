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
            'message' => 'User has been added to database.',
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
            'message' => 'User has been updated.'
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
            'message' => 'Your profile data have been updated.'
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
            'message' => 'User has been deleted.'
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
            'message' => 'Users have been deleted.'
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
        'active'   => $user['active'],
        'language' => $user['language'],
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
        'email'    => $user->email,
        'active'   => $user->active,
        'username' => $user->username,
        'language' => $user->language,
        ];
    }
}

