<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfiguracoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('configuracoes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nome', 191);
			$table->string('slug', 191);
			$table->string('descricao', 191)->nullable();
			$table->text('valor', 65535);
			$table->enum('root', array('S','N'))->default('N');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('configuracoes');
	}

}
