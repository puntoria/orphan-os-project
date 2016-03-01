<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
	public $timestamps = false;

	public $fillable = [
	'year',
	'month', 
	'has_donation', 
	'amount_euro', 
	'amount_dinar', 
	'type', 
	'received_at', 
	'orphan_id',
	'id'
	];

	public function owner() {
		return $this->belongsTo('App\Orphan', 'orphan_id');
	}
}
