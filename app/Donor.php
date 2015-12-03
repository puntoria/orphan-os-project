<?php

namespace App;

use App\User;

class Donor extends User
{
	public function __construct() {
		$this->type = "donor";
	}

    public function orphans() {
    	return $this->hasMany('App\Orphan');
    }
}
