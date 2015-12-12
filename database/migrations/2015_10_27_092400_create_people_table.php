<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');  
            $table->string('name');
            $table->string('nric');
            $table->string('contact');
            $table->text('address');
            $table->string('email')->unique()->nullable();
            $table->text('remark')->nullable();
            $table->string('carplate')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });  

        $statement = "ALTER TABLE people AUTO_INCREMENT = 100001;";
        DB::unprepared($statement);              
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('people');
    }
}
