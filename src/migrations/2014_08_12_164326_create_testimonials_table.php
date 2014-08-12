<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestimonialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('testimonials', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->string('author');
			$table->string('position');
			$table->text('html');
			$table->text('plaintext');
			$table->integer('order');
			$table->timestamps(); // Adds `created_at` and `updated_at` columns

			if (Config::get('core::languages')) {
				$table->integer('language_id')->unsigned()->default(1);
				$table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
			}
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('testimonials');
	}

}
