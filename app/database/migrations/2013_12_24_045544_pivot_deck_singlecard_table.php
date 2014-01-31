<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotDeckSinglecardTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('deck_singlecard', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('deck_id')->unsigned()->index();
			$table->bigInteger('singlecard_id')->unsigned()->index();
			$table->foreign('deck_id')->references('id')->on('decks')->onDelete('cascade');
			$table->foreign('singlecard_id')->references('id')->on('singlecards')->onDelete('cascade');
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
		Schema::drop('deck_singlecard');
	}

}
