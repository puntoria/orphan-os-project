<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
	protected $table = 'family';

    public function owner() {
    	return $this->belongsTo('App\Orphan', 'orphan_id');
    }
}
