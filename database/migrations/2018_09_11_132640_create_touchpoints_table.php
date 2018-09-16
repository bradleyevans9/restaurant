<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTouchpointsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('touchpoints', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('person_id');
			$table->integer('staff_id');
			$table->string('type');
			$table->text('notes', 16777215);
			$table->dateTime('touched_at')->default('0000-00-00 00:00:00');
			$table->softDeletes();
			$table->timestamps();
			$table->integer('touchcategory_id')->unsigned()->nullable();
			$table->string('status')->default('Resolved');
			$table->string('urgency')->default('Normal');
			$table->dateTime('due_at')->nullable();
			$table->integer('assignedto_id')->unsigned()->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('touchpoints');
	}

}
