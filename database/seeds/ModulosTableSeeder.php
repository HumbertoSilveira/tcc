<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Modulo;

class ModulosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modulos = [
            [
                'nome' => 'Configurações',
                'descricao' => 'Configurações do sistema'
            ],
            [
                'nome' => 'Módulos',
                'descricao' => 'Módulos do sistema'
            ],
            [
                'nome' => 'Perfis de usuário',
                'descricao' => 'Perfis de usuário do sistema'
            ],
            [
                'nome' => 'Permissões',
                'descricao' => 'Permissões dos perfis do sistema'
            ],
            [
                'nome' => 'Usuários',
                'descricao' => 'Usuários do sistema'
            ],
            [
                'nome' => 'Simular login',
                'descricao' => 'Simular login com outro usuário do sistema'
            ],
            [
                'nome' => 'Logs do sistema',
                'descricao' => 'Logs do sistema'
            ],
        ];

        foreach($modulos as $modulo) {
            Modulo::create([
                'nome' => $modulo['nome'],
                'descricao' => $modulo['descricao'],
            ]);
        }
    }
}
