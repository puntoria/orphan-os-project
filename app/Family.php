<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
	public $timestamps = false;
	protected $table = 'family';
	public $fillable = [
	'family_members', 
	'brothers', 
	'sisters', 
	'no_parents', 
	'parent_death', 
	'caretaker_name', 
	'caretaker_relation', 
	'orphan_id',
	'id'
	];

	public function owner() {
		return $this->belongsTo('App\Orphan', 'orphan_id');
	}
}
