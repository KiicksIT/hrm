<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('nric_fin');
            $table->string('contract_type');
            $table->timestamp('contract_start')->nullable();
            $table->timestamp('contract_end')->nullable();
            $table->string('contract_length')->nullable();
            $table->string('gender');
            $table->datetime('dob');
            $table->string('nationality');
            $table->string('resident');
            $table->string('contact');
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();
            $table->string('leave_reason')->nullable();
            $table->string('education')->nullable();
            $table->decimal('basic', 10, 2);
            $table->decimal('basic_rate', 10, 2);
            $table->decimal('ot_rate', 3, 1);
            $table->string('total_earned');
            $table->text('salary_component')->nullable();
            $table->text('person_remark')->nullable();
            $table->timestamp('prob_start')->nullable();
            $table->string('prob_length')->nullable();
            $table->timestamp('prob_end')->nullable();
            $table->integer('department_id')->unsigned()->nullable();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->integer('position_id')->unsigned()->nullable();
            $table->foreign('position_id')->references('id')->on('positions');
            $table->text('hour_remark')->nullable();
            $table->text('day_remark')->nullable();
            $table->text('off_remark')->nullable();
            $table->decimal('paid_leave', 3, 1);                         
            $table->decimal('mc', 3, 1);
            $table->decimal('hospital_leave', 3, 1);
            $table->integer('medic_exam')->nullable();
            $table->text('other_leave')->nullable();
            $table->text('benefit_remark')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');            
            $table->timestamps();
            $table->softDeletes();
        });  

        $statement = "ALTER TABLE people AUTO_INCREMENT = 100001;";
        DB::unprepared($statement);              
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('people');
    }
}
