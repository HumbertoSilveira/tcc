<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePerfisPermissoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('perfis_permissoes', function(Blueprint $table)
		{
			$table->integer('perfil_id')->unsigned();
			$table->integer('permissao_id')->unsigned();
			$table->primary(['perfil_id','permissao_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('perfis_permissoes');
	}

}
