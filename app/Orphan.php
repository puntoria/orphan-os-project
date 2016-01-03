<?php

namespace App;

use Storage;
use Illuminate\Database\Eloquent\Model;

class Orphan extends Model
{
	protected $table = 'orphans';

	protected $fillable = [
	'first_name', 'first_name_ar', 'middle_name', 'middle_name_ar', 'last_name', 'last_name_ar',
	'gender', 'birthday', 'phone', 'email', 'national_id', 'bank_id', 'photo', 'video', 'health_state',
	'has_donation', 'donor_id', 'note', 'id'
	];

	protected $hidden = ['bank_id'];

	public function documents() {
		return $this->hasMany('App\Document', 'orphan_id');
	}

	public function education() {
		return $this->hasOne('App\Education', 'orphan_id');
	}

	public function residence() {
		return $this->hasOne('App\Residence', 'orphan_id');
	}

	public function family() {
		return $this->hasOne('App\Family', 'orphan_id');
	}

	public function donor() {
    	return $this->belongsTo('App\Donor', 'donor_id');
    }

    public function updatePhoto($oldPhoto) 
    {
    	if ($this->photo != $oldPhoto && $oldPhoto != 'default.jpg' && Storage::disk('photos')->has($oldPhoto)) {
    		Storage::disk('photos')->delete($oldPhoto);
    	}
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($orphan) {
             $orphan->family()->delete();
             $orphan->education()->delete();
             $orphan->residence()->delete();
        });
    }
}
