<?php

use Illuminate\Database\Seeder;
use App\DeductItem;

class DeductItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeductItem::create([
            'id' => 1,
            'name' => 'Employee\'s EPF Deduction',
        ]); 
    }
}
