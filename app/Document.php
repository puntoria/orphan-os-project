<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
	protected $fillable = ['location', 'description'];

	public $timestamps = false;

    public function owner() {
    	return $this->belongsTo('App\Orphan', 'orphan_id');
    }
}
