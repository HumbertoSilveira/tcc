<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Configuracao;

class ConfiguracoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuracao::create([
            'nome' => "Registros Por Página",
            'descricao' => 'Quantidade de registros por página',
            'valor' => '<p>10</p>',
            'root' => 'S'
        ]);
    }
}
