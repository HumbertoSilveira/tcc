<?php

use Illuminate\Database\Seeder;
use App\User;
use Laravolt\Avatar\Avatar;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $avatar = new Avatar();

        $pasta = storage_path('app\public\uploads\usuarios');
        $name = time().'.jpg';
        while(file_exists($pasta.'\\'.$name))
            $name = time().'.jpg';

        $avatar->create("Laruê Agência")
            ->setDimension(160, 160)
            ->setFontSize(80)
            ->setBackground('#3C8DBC')
            ->save($pasta .'\\'. $name, 100);


        $user = User::create([
            'nome' => "Laruê Agência",
            'login' => "larue",
            'cpf' => '68147675119',
            'password' => 'jcLA6917',
            'skin' => 'blue',
            'imagem' => $name
        ]);

        $user->perfis()->attach(1);


    }
}
