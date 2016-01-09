<?php

use Illuminate\Database\Seeder;

use App\Orphan;
use App\Family;
use App\Education;
use App\Residence;

class OrphanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i = 1; $i < 50; $i++) { 
    		Orphan::create([
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
    			]);

            Family::create([
                'sisters'            => rand(0, 5), 
                'brothers'           => rand(0, 5), 
                'orphan_id'          => $i,
                'no_parents'         => rand(0, 1), 
                'parent_death'       => '', 
                'family_members'     => rand(0, 8), 
                'caretaker_name'     => 'Caretaker' . $i, 
                'caretaker_relation' => 'Caretaker Relation' . $i,
                ]);

            Education::create([
                'level'     => (string) rand(0, 15),
                'class'     => rand(0, 12),
                'grades'    => rand(0, 5),
                'with_pay'  => rand(0, 1),
                'orphan_id' => $i
                ]);

            Residence::create([
                'city'      => ['Prizren', 'Prishtina', 'Ferizaj', 'Peje'][rand(0, 3)],
                'country'   => 'Kosova',
                'village'   => 'Komoran',
                'ownership' => 'Unknown',
                'orphan_id' => $i
                ]);
    	}
    }
}
