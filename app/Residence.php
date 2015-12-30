<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residence extends Model
{
	protected $fillable = ['country', 'city', 'village', 'ownership', 'orphan_id', 'id'];

	protected $table = "residence";

	public $timestamps = false;

    public function owner() {
    	return $this->belongsTo('App\Orphan', 'orphan_id');
    }
}
