<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use App\User;
use App\Orphan;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends ApiController
{
	public function index()
	{
		return $this->success([
			'orphans' => [
				'count'           => Orphan::count(),
				'withDonation'    => Orphan::where(['has_donation' => 1])->count(),
				'withoutDonation' => Orphan::where(['has_donation' => 0])->count(),
				'last' => Orphan::select(['first_name_ar', 'last_name_ar'])
								->orderBy('created_at', 'DESC')
								->take(10)
								->get()->toArray()
				],

			'donors' => [
				'count'    => User::where(['type' => 'donor'])->count(),
				'active'   => User::where(['type' => 'donor', 'active' => 1])->count(),
				'inactive' => User::where(['type' => 'donor', 'active' => 0])->count(),
				'last' => User::select(['name'])->where(['type' => 'donor'])
								->orderBy('created_at', 'DESC')
								->take(10)
								->get()->toArray()
				],

			'users' => User::select(['name'])->where(['type' => 'view'])
						   ->orderBy('created_at', 'DESC')
						   ->take(10)
						   ->get()->toArray()
			]);
	}
}
