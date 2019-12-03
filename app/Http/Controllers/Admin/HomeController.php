<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Faker\Factory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $faker = Factory::create('pt_BR');

//        foreach(range(0,10) as $usuario){
//            $name = $faker->firstName.' '.$faker->lastName;
//            $user = User::create([
//                'nome' => $name,
//                'login' => str_slug($name, ''),
//                'password' => 'secret',
//                'skin' => 'blue'
//            ]);
//            $user->perfis()->attach(2);
//        }

        return view('admin.home');
    }

    public function limparCache()
    {
        cache()->flush();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Sucesso',
            'text' => "Cache excluído com sucesso",
        ]);

        return redirect()->back();
    }
}
