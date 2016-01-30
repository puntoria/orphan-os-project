<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\User;
use \App\Orphan;
use \App\Family;
use \App\Education;
use \App\Residence;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	public function dashboard()
	{
		if ( auth()->user()->isDonor() ) return redirect()->to( route('Donor::dashboard') );

		return redirect()->to( route('Admin::dashboard') );
	}

	public function migrateOldDatabase(Request $request)
	{
		require base_path('../migration/users.php');
		require base_path('../migration/orphans.php');
		require base_path('../migration/education.php');
		require base_path('../migration/family.php');
		require base_path('../migration/residence.php');
		set_time_limit(30 * 60);

		$password = bcrypt('phf_2016');

		$_users = array_map(function($user) use ($password) {
			return new User([
				'id'       => $user['username'],
				'name'     => $user['name'],
				'username' => $user['username'],
				'email'    => $user['username'] . '@patienthelpfund.org',
				'type'     => 'donor',
				'language' => 'ar-kw',
				'active'   => $user['confirmed'],
				'password' => $password
				]);
		}, $users);

		$_orphans = array_map(function($orphan) {
			return new Orphan([
				'id'             => $orphan['identity'],
				'first_name'     => '',
				'first_name_ar'  => $orphan['first_name'],
				'middle_name'    => '',
				'middle_name_ar' => $orphan['middle_name'],
				'last_name'      => '',
				'last_name_ar'   => $orphan['last_name'],
				'birthday'       => $orphan['birthdate'],
				'donor_id'       => $orphan['user_id'],
				'gender'         => $orphan['gender'],
				'health_state'   => $orphan['health_state'],
				'video'          => $orphan['video'],
				'phone'          => $orphan['phone'] || '',
				'email'          => $orphan['email'] || '',
				'photo'          => $orphan['photo'] || '',
				'has_donation'   => $orphan['has_donation'],
				'note'           => $orphan['acknowledgement'],
				]);
		}, $person);
// foreach ($_orphans as $orphan) {
// 	if (strlen($orphan->donor_id) != 5) {
// 		# code...
// 	dump($orphan);
// 	}
// }dd();
		$_education = array_map(function($ed) {
			return new Education([
				'orphan_id' => $ed['person_id'],
				'level'    => $ed['level'],
				'class'    => $ed['class'],
				'grades'   => $ed['grades'],
				'with_pay' => $ed['with_pay'],
				]);
		}, $education);


		$_residence = array_map(function($res) {
			return new Residence([
				'orphan_id'  => $res['person_id'],
				'ownership' => $res['property'],
				'country'   => $res['country'],
				'city'      => $res['city'],
				'village'   => $res['village'],
				]);
		}, $residence);

		$_family = array_map(function($fam) {
			return new Family([
				'orphan_id'          => $fam['person_id'],
				'parent_death'       => $fam['parent_death'],
				'caretaker_name'     => $fam['custodian_name'],
				'caretaker_relation' => $fam['custodian_relation'],
				'no_parents'         => $fam['no_parents'],
				'family_members'     => $fam['members'],
				'brothers'           => $fam['brothers'],
				'sisters'            => $fam['sisters'],
				]);
		}, $family);

		// dd($_users, $_orphans, $_family, $_education, $_residence);

		if ($request->run == true) {
			// foreach($_users as $user)     $user->save();
/*			foreach($_orphans as $orphan) {
				if (User::where('id', '=', $orphan->donor_id)->exists()) {
					$orphan->has_donation = true;
					$orphan->save();
				} else {
					$orphan->donor_id = null;
					$orphan->has_donation = false;
					$orphan->save();
				}
			}*/
/*			foreach($_family as $fam) {
				if (Orphan::where('id', '=', $fam->orphan_id)->exists()) {
					$fam->save();
				}
			}*/

/*			foreach($_education as $ed) {
				if (Orphan::where('id', '=', $ed->orphan_id)->exists()) {
					$ed->save();
				}
			}*/

/*			foreach($_residence as $res) {
				if (Orphan::where('id', '=', $res->orphan_id)->exists()) {
					if (!$res->village) $res->village = '';
					
					$res->save();
				}
			}*/
			// foreach($_education as $ed)   $ed->save();
			// foreach($_residence as $res)  $res->save();
		}
	}
}
