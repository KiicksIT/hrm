<?php

use Illuminate\Database\Seeder;
use App\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::create([
            'name' => 'IT Manager',
            'remark' => 'Manage IT dept',
            'work_hour' => 8,
            'work_day' => 5,
            'work_off' => 2,
        ]); 

        Position::create([
            'name' => 'General Manager',
            'remark' => 'Manage All dept',
            'work_hour' => 5,
            'work_day' => 4,
            'work_off' => 2,
        ]);

        Position::create([
            'name' => 'Worker',
            'remark' => 'Keep the operation running',
            'work_hour' => 10,
            'work_day' => 5.5,
            'work_off' => 1.5,
        ]);                  
    }
}
