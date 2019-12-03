<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EquipeRequest;
use App\Http\Requests\Admin\ModuloRequest;
use App\Http\Requests\Admin\OperacaoRequest;
use App\Models\Admin\Equipe;
use App\Models\Admin\Modulo;
use App\Models\Admin\Operacao;
use App\User;

class EquipesController extends Controller
{
    /**
     * @var Modulo
     */
    private $model;
    private $config;
    private $txt_plural = 'equipes';
    private $txt_singular = 'equipe';


    public function __construct(Equipe $model)
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
        $query->withCount(['agentes', 'operacoes']);

        if (request('nomeF')) {
            $query->where('nome', 'like', '%' . request('nomeF') . '%');
        }

        $query->orderBy(request('sort'), request('order'));

        $results = $query->paginate($this->config['registros_por_pagina']->valor_sem_tags);

        return view('admin.'.str_slug($this->txt_singular).'.index', compact('results'));
    }

    public function create()
    {
        $agentes = User::agentes()->pluck('nome', 'id');
        return view('admin.'.str_slug($this->txt_singular).'.create', compact('agentes'));
    }

    public function store(EquipeRequest $request)
    {
        $result = $this->model->fill($request->all());
        $result->save();

        $result->agentes()->attach($request->agentes);

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Sucesso',
            'text' => config('app.messages.actions.insert'),
        ]);

        return redirect()->route(str_slug($this->txt_plural).'.index', ['id' => $result->id]);
    }

    public function edit($id)
    {
        $result = $this->model->findOrFail($id);

        $agentes = User::agentes()->pluck('nome', 'id');

        return view('admin.'.str_slug($this->txt_singular).'.edit', compact('result', 'agentes'));
    }

    public function update($id, EquipeRequest $request)
    {
        $result = $this->model->findOrFail($id);
        $result->fill($request->all());
        $result->save();

        $result->agentes()->sync($request->agentes);

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Sucesso',
            'text' => config('app.messages.actions.insert'),
        ]);

        return redirect()->route(str_slug($this->txt_plural).'.index', ['id' => $id]);
    }

    public function destroy()
    {
        $itens = request('itens');

        if (!is_array($itens) || empty($itens)) {
            return response()->json([
                'success' => false
            ]);
        }

        $this->model->destroy($itens);

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Sucesso',
            'text' => config('app.messages.actions.delete'),
        ]);

        return response()->json([
            'success' => true,
            'redirect' => route(str_slug($this->txt_plural).'.index')
        ]);
    }
}
