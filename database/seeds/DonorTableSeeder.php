<?php

use Illuminate\Database\Seeder;
use App\User;

class DonorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 50; $i++) {
            $id = $i + 20000;
            User::create([
                "id"       => $id,
                "name"     => "Donor $id", 
                "username" => "donor$id@orphandb.org", 
                "email"    => "donor$id@orphandb.org", 
                "type"     => "donor", 
                "language" => ['ar-kw', 'al', 'en', 'ar'][rand(0, 3)], 
                "active"   => rand(0, 1), 
                "password" => bcrypt("111111")
                ]);
        }
    }
}
