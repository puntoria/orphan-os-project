<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orphan extends Model
{
	protected $table = 'orphans';

	protected $fillable = [
	'first_name', 'first_name_ar', 'middle_name', 'middle_name_ar', 'last_name', 'last_name_ar',
	'gender', 'birthday', 'phone', 'email', 'national_id', 'bank_id', 'photo', 'video', 'health_state',
	'has_donation', 'note'
	];

	protected $hidden = ['bank_id'];
}
