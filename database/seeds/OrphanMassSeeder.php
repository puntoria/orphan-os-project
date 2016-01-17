<?php

use Illuminate\Database\Seeder;

use App\Orphan;
use App\Family;
use App\Finance;
use App\Education;
use App\Residence;

class OrphanMassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$list = [];
    	for ($i = 5520; $i < 7520; $i++) { 
    		$list[] = [
                'id' => $i,
    			'first_name'     => "Orphan $i", 
    			'first_name_ar'  => "Ar: Orphan $i", 
    			'middle_name'    => "Midname $i", 
    			'middle_name_ar' => "Ar: Midname $i", 
    			'last_name'      => "Last name $i", 
    			'last_name_ar'   => "Ar: Last name $i",
    			'gender'         => 0, 
    			'birthday'       => "2002-02-02", 
    			'phone'          => "0038649123456$i", 
    			'email'          => "Orphan$i@orphandb.org", 
    			'national_id'    => "111222333444555$i", 
    			'bank_id'        => "010203040506070$i", 
    			'photo'          => "test$i.png", 
    			'video'          => "test$i.com", 
    			'health_state'   => 1,
    			'has_donation'   => 1,
    			'donor_id' => range(20001, 20050)[rand(0, 48)],
    			'note' => "Asddf gf gh $i"
    			];
    	}

    	Orphan::insert($list);
    }
}
