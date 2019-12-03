<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nome', 191);
			$table->string('login', 191)->unique('login');
			$table->string('email', 191)->nullable();
			$table->string('password', 191);
			$table->string('cpf', 191)->unique('cpf');
			$table->dateTime('ultimo_acesso')->nullable();
			$table->dateTime('ultima_atividade')->nullable();
			$table->string('telefone', 191)->nullable();
			$table->string('celular', 191)->nullable();
			$table->string('imagem', 191)->nullable();
			$table->string('skin', 191)->nullable();
			$table->enum('ativo', array('S','N'))->default('S');
			$table->string('remember_token', 100)->nullable();
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
		Schema::drop('users');
	}

}
