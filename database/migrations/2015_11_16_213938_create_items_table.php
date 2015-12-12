<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->text('remark')->nullable();
            $table->timestamps();
        });

        Schema::create('item_transaction', function (Blueprint $table){
            $table->integer('item_id')->unsigned()->index();
            $table->foreign('item_id')->references('id')->on('items');

            $table->integer('transaction_id')->unsigned()->index();
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');

            $table->timestamps();
        });  

        $statement = "ALTER TABLE items AUTO_INCREMENT = 100001;";
        DB::unprepared($statement);               
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('item_transaction');
        Schema::drop('items');
    }
}
