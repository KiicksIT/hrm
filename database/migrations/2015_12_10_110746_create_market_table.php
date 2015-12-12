<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company');

            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('contact');
            $table->string('subject');
            $table->string('status');
            $table->text('remark')->nullable();
            $table->timestamp('appt_date')->nullable();
            $table->timestamps();
            $table->integer('person_id')->unsigned()->nullable();
            $table->foreign('person_id')->references('id')->on('people');
            $table->integer('transaction_id')->unsigned()->nullable();
            $table->foreign('transaction_id')->references('id')->on('transactions');            

            // temporary storage
            $table->string('roc_no')->nullable();
            $table->string('office_no')->nullable();
            $table->text('address')->nullable();
            $table->integer('postcode')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->timestamp('contract_start')->nullable();
            $table->timestamp('contract_end')->nullable();
            $table->text('transremark')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('markets');
    }
}
