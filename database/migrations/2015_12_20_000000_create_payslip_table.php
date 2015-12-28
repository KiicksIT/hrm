<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreatePayslipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payslips', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('person_id')->unsigned()->nullable();
            $table->foreign('person_id')->references('id')->on('people'); 
            $table->decimal('basic', 10, 2);
            $table->decimal('workday_actual', 4, 1)->nullable();
            $table->decimal('workday_total', 4, 1)->nullable();
            $table->decimal('add_total', 10, 2)->nullable();
            $table->decimal('deduct_total', 10, 2)->nullable();
            $table->timestamp('pay_date')->default(Carbon::now());
            $table->string('pay_mode');
            $table->timestamp('ot_from')->default(Carbon::now()->startOfMonth());
            $table->timestamp('ot_to')->default(Carbon::now()->endOfMonth());
            $table->decimal('ot_hour', 5, 1)->nullable();
            $table->decimal('ot_total', 10, 2)->default(0);
            $table->decimal('other_total', 10, 2)->nullable();
            $table->decimal('net_pay', 15, 2);
            $table->decimal('employee_epf', 10, 2)->nullable();
            $table->decimal('employercont_epf', 10, 2)->nullable();
            $table->string('status')->default('Pending'); 
            $table->timestamp('payslip_from')->default(Carbon::now()->startOfMonth());
            $table->timestamp('payslip_to')->default(Carbon::now()->endOfMonth()); 
            $table->timestamps();         
        });

        $statement = "ALTER TABLE payslips AUTO_INCREMENT = 100001;";
        DB::unprepared($statement);  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payslips');
    }
}
