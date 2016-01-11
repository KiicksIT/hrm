<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplyleaveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applyleaves', function (Blueprint $table) {
            $table->increments('id');
            $table->string('leave_type');
            $table->timestamp('leave_from');
            $table->timestamp('leave_to');
            $table->decimal('day_num', 4 , 1);
            $table->string('status');
            $table->string('handover_person')->nullable();
            $table->text('reason');
            $table->text('leaveremark')->nullable();
            $table->timestamps();

            $table->integer('person_id')->unsigned();
            $table->foreign('person_id')->references('id')->on('people');                       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('applyleaves');
    }
}
