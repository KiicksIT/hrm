<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonattsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personatts', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('basic', 10, 2);
            $table->decimal('basic_rate', 10, 2);
            $table->decimal('ot_rate', 3, 1);
            $table->string('resident');
            $table->string('total_earned');
            $table->decimal('paid_leave', 3, 1);
            $table->decimal('mc', 3, 1);
            $table->decimal('hospital_leave', 3, 1);
            $table->text('other_leave')->nullable();
            $table->text('benefit_remark')->nullable();
            $table->integer('person_id')->unsigned()->nullable();
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
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
        Schema::drop('personatts');
    }
}
