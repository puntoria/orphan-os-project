<?php

namespace App;

use App\User;

class Donor extends User
{
	public $defaultPassword = "orphandb2016";

	public function orphans() {
        return $this->hasMany('App\Orphan', 'donor_id');
    }

    public function savePassword($password, $useDefault = false) {
    	if ($password != '') {
            return $this->password = bcrypt($password);
        }

        if ($useDefault) {
        	return $this->password = bcrypt($this->defaultPassword);
        }

        return false;
    }

    protected static function boot() {
    	parent::boot();

    	static::creating(function($donor) {
    		$donor->type = 'donor';

    		$donor->savePassword($donor->password, true);
    	});

    	// static::deleting(function($donor) {dd(123);
    	// 	$donor->orphans()->detach();
    	// });
    }
}
