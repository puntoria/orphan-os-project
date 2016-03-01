<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{

    protected $loginPath = '/';

    protected $redirectPath = 'dashboard';

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required', 'password' => 'required',
            ]);

        if($validator->fails()) {
            return Redirect::back()
            ->withErrors($validator);
        }

        $credentials = $request->only('username', 'password');

        if (auth()->attempt($credentials, $request->has('remember')))
        {
            if (!auth()->user()->active) {
                auth()->logout();
                
                return redirect($this->loginPath())
                ->withErrors([
                    'inactive' => 'Your account is no longer active.',
                    ]);
            }

            if ($request->redirect != "") $this->redirectTo = $request->redirect;

            return redirect()->intended($this->redirectPath());
        }

        return redirect($this->loginPath())
        ->withInput($request->only('username', 'remember'))
        ->withErrors([
            'username' => $this->getFailedLoginMessage(),
            ]);
    }
}
