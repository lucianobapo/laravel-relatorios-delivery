<?php

use App\Repositories\BaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductSharedStatTable extends BaseMigration {

    protected $table = 'product_shared_stat';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function upMigration()
	{
        $this->createTable(function(Blueprint $table){
            $table->timestamps();

            $table->integer('product_id')->unsigned()->index();
            $table->integer('shared_stat_id')->unsigned()->index();
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
