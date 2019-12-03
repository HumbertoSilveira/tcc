<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class SimuladorController extends Controller
{

    private $model;
    private $config;
    private $txt_plural = 'simuladores';
    private $txt_singular = 'simulador';

    public function __construct(User $model)
    {
        $this->model = $model;
        $this->config = getConfig();
    }

    public function index()
    {

        // FILTERS
        if (!request()->has('nomeF')) {
            request()->offsetSet('nomeF', '');
        }

        // DEFAULT SORT COLUMN
        if (!request()->has('sort')) {
            request()->offsetSet('sort', 'nome');
        }

        if (!request()->has('order')) {
            request()->offsetSet('order', 'asc');
        }

        // QUERY
        $query = $this->model->newQuery();
        $query->with('perfis');

        if (request('nomeF')) {
            $query->where('nome', 'like', '%' . request('nomeF') . '%');
        }

        $query->where('id', '!=', auth()->user()->id);

        $query->orderBy(request('sort'), request('order'));

        $results = $query->paginate($this->config['registros_por_pagina']->valor_sem_tags);

        return view('admin.'.str_slug($this->txt_singular).'.index', compact('results'));
    }

    public function simular($id) {

        $user = $this->model->findOrFail($id);
        Auth::login($user);

        return redirect()->route('home');
    }
}
