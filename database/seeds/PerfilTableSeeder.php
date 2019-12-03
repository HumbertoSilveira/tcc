<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Perfil;

class PerfilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perfil::create([
            'id' => 1,
            'nome' => "Root",
            'descricao' => 'Superusuário do sistema',
        ]);
    }
}
