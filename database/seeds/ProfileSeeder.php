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
            'name' => 'Sai Hup Furniture and Decoration Pte Ltd',
            'roc_no' => '',
            'address' => '',
            'contact' => '',
            'payslip_start' => 1,
            'payslip_end' => 31,
            'payslip_otstart' => 1,
            'payslip_otend' => 31,
            'payday' => 28,
            'ot_payday' => 28,
            'notice' => '1 month notice or 1 month salary in lieu of notice 离职通知期为一个月',
        ]); 
    }
}
