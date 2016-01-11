<?php

use Illuminate\Database\Seeder;
use App\Leave;

class LeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Leave::create([
            'person_id' => 100001,
            'total_paidleave' => 20,
            'total_paidsickleave' => 14,
            'total_paidhospleave' => 60,
        ]);

        Leave::create([
            'person_id' => 100002,
            'total_paidleave' => 12,
            'total_paidsickleave' => 14,
            'total_paidhospleave' => 60,
        ]);

        Leave::create([
            'person_id' => 100003,
            'total_paidleave' => 7,
            'total_paidsickleave' => 14,
            'total_paidhospleave' => 60,
        ]);                
    }
}
