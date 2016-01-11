<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('roc_no')->nullable();
            $table->text('address')->nullable();
            $table->string('contact');
            $table->string('alt_contact')->nullable();
            $table->string('email')->nullable();
            $table->string('header')->nullable();
            $table->string('logo')->nullable();
            $table->string('footer')->nullable();
            $table->integer('payslip_start')->nullable();
            $table->integer('payslip_end')->nullable();
            $table->integer('payslip_otstart')->nullable();
            $table->integer('payslip_otend')->nullable();
            $table->integer('payday')->nullable();
            $table->integer('ot_payday')->nullable();
            $table->text('notice')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profile');
    }
}
