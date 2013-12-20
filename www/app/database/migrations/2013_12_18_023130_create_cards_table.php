<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('cards', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('card_id');
            $table->bigInteger('set_number');
            $table->string('name', 255);
            $table->string('description', 255);
            $table->integer('flavor')->nullable();
            $table->string('manacost', 10)->nullable();
            $table->integer('converted_mana_cost');
            $table->string('card_set_name', 255);
            $table->string('type', 255);
            $table->string('subtype', 255)->nullable();
            $table->string('power', 3)->nullable();
            $table->string('toughness', 3)->nullable();
            $table->string('loyalty', 3)->nullable();
            $table->string('rarity', 255)->nullable();
            $table->string('artist', 255);
            $table->text('card_image');
            $table->bigInteger('card_set_id');
            $table->string('released_at', 255);
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
        Schema::drop('cards');
	}

}