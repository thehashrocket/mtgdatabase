<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSinglecardTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('singlecards', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('card_id');
            $table->bigInteger('user_id');
            $table->integer('condition_id');
            $table->bigInteger('deck_id');
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_price', 19, 4)->nullable();
            $table->integer('saletype_id')->nullable();
            $table->date('sell_date')->nullable();
            $table->decimal('sell_price', 19, 4)->nullable();
            $table->string('notes', 4000)->nullable();
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
		//
        Schema::drop('singlecards');
	}

}