<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Redeye\Models\Image;

class CreateImagesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create((new Image)->getTable(), function (Blueprint $table) {
			$table->increments('id');
			$table->string('hash', 16);
			$table->unsignedInteger('width');
			$table->unsignedInteger('height');
			$table->string('uuid'); // unique name for file
			$table->timestamps();

			// index isn't needed because we don't use it.
			// only binary operations will be applied
			// for integer variables we can use indexes but in our case this is not required
			// because our table is small (mysql doesn't use integer indexes in small data sets eg. just table scan)
			// for huge database we need to implement something smarter
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop((new Image)->getTable());
	}
}
