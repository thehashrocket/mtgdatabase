<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotAttributeSinglecardTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attribute_singlecard', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('attribute_id')->unsigned()->index();
			$table->bigInteger('singlecard_id')->unsigned()->index();
			$table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
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
		Schema::drop('attribute_singlecard');
	}

}
