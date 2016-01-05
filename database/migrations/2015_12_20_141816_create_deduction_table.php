<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeductionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deductions', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('deduct_amount', 15, 2)->nullable();
            $table->timestamps();

            $table->integer('deductitem_id')->unsigned()->nullable();
            $table->foreign('deductitem_id')->references('id')->on('deductitems')->onDelete('cascade');

            $table->integer('payslip_id')->unsigned()->nullable();
            $table->foreign('payslip_id')->references('id')->on('payslips')->onDelete('cascade');                         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('deductions');
    }
}
