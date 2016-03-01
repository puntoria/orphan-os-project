<?php

namespace App;

use DB;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
AuthorizableContract,
CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'username', 'email', 'type', 'language', 'active', 'password', 'id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public static function nextAvailableID() 
    {
        $query = DB::select(DB::raw(
            'SELECT MIN(t1.ID + 1) AS nextID FROM users t1 
            LEFT JOIN users t2 ON t1.ID + 1 = t2.ID 
            WHERE t2.ID IS NULL'
            ));

        return array_pop($query)->nextID;
    }

    public function isAdmin() { return $this->type == "admin"; }
    public function isDonor() { return $this->type == "donor"; }
    public function isView()  { return $this->type == "view"; }
}
