<?php

use App\Repositories\BaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductProductGroupTable extends BaseMigration {

	protected $table = 'product_product_group';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function upMigration()
	{
		$this->createTable(function(Blueprint $table)
		{
			$table->timestamps();

			$table->integer('product_id')->unsigned()->index();
			$table->integer('product_group_id')->unsigned()->index();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function downMigration()
	{
		$this->dropTable();
	}

}
