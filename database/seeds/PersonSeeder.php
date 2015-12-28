<?php

use Illuminate\Database\Seeder;
use App\Person;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Person::create([
            'cust_id' => 'S001L',
            'company' => 'Drink Stall @ Fuhua Sec School',
            'bill_to' => 'Drink Stall @ Fuhua Sec School',
            'del_address' => '5 Jurong West Street 41',
            'postcode' => '649410',
            'name' => 'Mr Ang',
            'contact' => '94870491',
            'alt_contact' => '84287363',
            'payterm' => 'C.O.D',
            'cost_rate' => 75,
        ]);                                         
    }
}
