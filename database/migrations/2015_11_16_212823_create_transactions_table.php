<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount', 10, 2);
            $table->text('transremark')->nullable();
            $table->integer('person_id')->unsigned()->nullable();
            $table->foreign('person_id')->references('id')->on('people');
            $table->timestamp('contract_start');
            $table->timestamp('contract_end');
            $table->timestamps();
            $table->softDeletes();
        });

        $statement = "ALTER TABLE transactions AUTO_INCREMENT = 100001;";
        DB::unprepared($statement);         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transactions');
    }
}
