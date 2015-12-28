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
            'hod' => 'Mr Lee',
        ]); 

        Department::create([
            'name' => 'MD',
            'remark' => 'Management for whole company',
            'hod' => 'Mr Loh',
        ]); 

        Department::create([
            'name' => 'Operation',
            'remark' => 'Operation',
            'hod' => 'Mr Lah',
        ]);                 
    }
}
