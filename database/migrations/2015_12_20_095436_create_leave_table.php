<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('total_paidleave', 4, 1);
            $table->decimal('total_paidsickleave', 4, 1);
            $table->decimal('total_paidhospleave', 4, 1);
            $table->timestamps();

            $table->integer('person_id')->unsigned();
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');            
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('leaves');
    }
}
