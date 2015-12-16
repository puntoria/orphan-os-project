<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
	public $timestamps = false;
	protected $fillable = ['level', 'class', 'grades', 'with_pay'];

    public function owner() {
    	return $this->belongsTo('App\Orphan', 'orphan_id');
    }
}
