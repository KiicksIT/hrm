<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('remark')->nullable();
            $table->decimal('work_hour', 5, 2);
            $table->decimal('work_day', 3, 1);
            $table->decimal('work_off', 3, 1);
            $table->string('prob_length');            
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
        Schema::drop('positions');
    }
}
