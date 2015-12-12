<?php

use Illuminate\Database\Seeder;
use App\Profile;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::create([
            'name' => 'VENTURA',
            'roc_no' => '',
            'address' => '',
            'contact' => ''
        ]); 
    }
}
