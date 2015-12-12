<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedulers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('remark');
            $table->string('status');
            $table->timestamp('notify_date');
            $table->timestamp('appt_date');
            $table->timestamps();
        });

        Schema::create('scheduler_user', function (Blueprint $table){
            $table->integer('scheduler_id')->unsigned()->index();
            $table->foreign('scheduler_id')->references('id')->on('schedulers')->onDelete('cascade');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::drop('scheduler_user');
        Schema::drop('schedulers');
    }
}
