<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additions', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount', 15, 2)->nullable();
            $table->timestamps();

            $table->integer('additem_id')->unsigned()->nullable();
            $table->foreign('additem_id')->references('id')->on('additems')->onDelete('cascade');

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
        Schema::drop('additions');
    }
}
