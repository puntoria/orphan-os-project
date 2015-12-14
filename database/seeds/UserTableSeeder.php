<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
    		'name'     => 'Administrator', 
    		'username' => 'admin', 
    		'email'    => 'admin@orphandb.org', 
    		'type'     => 'admin', 
    		'language' => 'sq', 
    		'active'   => true, 
    		'password' => bcrypt('111111')
    		]);

    	User::create([
    		'name'     => 'Viewer', 
    		'username' => 'view', 
    		'email'    => 'view@orphandb.org', 
    		'type'     => 'view', 
    		'language' => 'sq', 
    		'active'   => true, 
    		'password' => bcrypt('111111')
    		]);

    	User::create([
    		'name'     => 'Donor', 
    		'username' => 'donor', 
    		'email'    => 'donor@orphandb.org', 
    		'type'     => 'donor', 
    		'language' => 'ar-kw', 
    		'active'   => true, 
    		'password' => bcrypt('111111')
    		]);
    }
}
