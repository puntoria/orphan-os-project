<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    public function owner() {
    	return $this->belongsTo('App\Orphan', 'orphan_id');
    }
}
