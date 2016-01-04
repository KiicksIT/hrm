<?php

use Illuminate\Database\Seeder;
use App\Person;
use Carbon\Carbon;

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
            'name' => 'Mr ABC',
            'nric_fin' => 'S1234567J',
            'contract_type' => 'Full Time',
            'gender' => 'Male',
            'dob' => Carbon::create(1957, 5, 21, 12),
            'nationality' => 'Sinagporean',
            'resident' => 1,
            'contact' => '8888888',
            'address' => '128 Woodlands Ave 4',
            'start_date' => date("Y-m-d H:i:s"),
            'email' => 'abc@gmail.com',
            'education' => 'Bachelor Degree of Arts',
            'basic' => 3500,
            'ot_rate' => 1.5,
            'prob_start' => date("Y-m-d H:i:s"),
            'department_id' => 2,
            'hour_remark' => '8-9pm Weekdays',
            'day_remark' => '5 days a week',
            'off_remark' => '2 days a week',
            'position_id' => 2,
            'basic_rate' =>  15,
            'paid_leave' => 7,
            'mc' => 14,
            'hospital_leave' => 60,
            'medic_exam' => 1,
            'benefit_remark' => 'Medical fees waive until $60',
        ]); 

        Person::create([
            'name' => 'Miss Catherine',
            'nric_fin' => 'S3456789J',
            'contract_type' => 'Full Time',
            'gender' => 'Female',
            'dob' => Carbon::create(1980, 5, 21, 12),
            'nationality' => 'Sinagporean',
            'resident' => 1,
            'contact' => '93993939',
            'address' => '110 Woodlands Ave 4',
            'start_date' => date("Y-m-d H:i:s"),
            'email' => 'cat@gmail.com',
            'education' => 'Bachelor Degree of IT',
            'basic' => 3000,
            'ot_rate' => 1.5,
            'prob_start' => date("Y-m-d H:i:s"),
            'department_id' => 1,
            'hour_remark' => '8-4pm Weekdays',
            'day_remark' => '5 days a week',
            'off_remark' => '2 days a week',
            'position_id' => 1,
            'basic_rate' =>  13,
            'paid_leave' => 7,
            'mc' => 14,
            'hospital_leave' => 60,
            'medic_exam' => 1,
            'benefit_remark' => 'Medical fees waive until $60',
        ]); 

        Person::create([
            'name' => 'Adam',
            'nric_fin' => 'S9876543J',
            'contract_type' => 'Full Time',
            'gender' => 'Male',
            'dob' => Carbon::create(1966, 5, 21, 12),
            'nationality' => 'Malaysian',
            'resident' => 0,
            'contact' => '0160403003',
            'address' => '34, JLN Similan, Tmn Similan, Johor',
            'start_date' => date("Y-m-d H:i:s"),
            'email' => 'adam@gmail.com',
            'education' => 'Bachelor Degree of Hospitality',
            'basic' => 2000,
            'ot_rate' => 1.5,
            'prob_start' => date("Y-m-d H:i:s"),
            'department_id' => 1,
            'hour_remark' => '8-9pm Weekdays',
            'day_remark' => '5.5 days a week',
            'off_remark' => '1.5 days a week',
            'position_id' => 3,
            'basic_rate' =>  10,
            'paid_leave' => 7,
            'mc' => 14,
            'hospital_leave' => 60,
            'medic_exam' => 1,
            'benefit_remark' => 'Medical fees waive until $30',
        ]);                                                         
    }
}
