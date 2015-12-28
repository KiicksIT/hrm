<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddotherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addothers', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount', 15, 2);
            $table->timestamps();

            $table->integer('addotheritem_id')->unsigned()->nullable();
            $table->foreign('addotheritem_id')->references('id')->on('addotheritems')->onDelete('cascade');

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
        Schema::drop('addothers');
    }
}
