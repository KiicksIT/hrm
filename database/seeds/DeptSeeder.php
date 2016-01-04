<?php

use Illuminate\Database\Seeder;
use App\Department;

class DeptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'name' => 'IT Dept',
            'remark' => 'Company Software',
        ]); 

        Department::create([
            'name' => 'MD',
            'remark' => 'Management for whole company',
        ]); 

        Department::create([
            'name' => 'Operation',
            'remark' => 'Operation',
        ]);                 
    }
}
