<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PermissaoRequest;
use App\Models\Admin\Modulo;
use App\Models\Admin\Permissao;

class PermissoesController extends Controller
{

    private $model;
    private $config;
    private $txt_plural = 'permissoes';
    private $txt_singular = 'permissao';

    public function __construct(Permissao $model)
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


        $query->when(request('nomeF'), function($q){
           return $q->where('nome', 'like', '%' . request('nomeF') . '%');
        });


        $query->orderBy(request('sort'), request('order'));

        $results = $query->paginate($this->config['registros_por_pagina']->valor_sem_tags);

        return view('admin.'.str_slug($this->txt_singular).'.index', compact('results'));
    }

    public function create(Modulo $moduloModel) {

        $opcoes_modulo = $moduloModel->orderBy('nome')->pluck('nome', 'id');
        return view('admin.'.str_slug($this->txt_singular).'.create', compact('opcoes_modulo'));
    }

    public function store(PermissaoRequest $request)
    {
        $result = $this->model->fill($request->all());
        $result->save();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Sucesso',
            'text' => config('app.messages.actions.insert'),
        ]);

        return redirect()->route(str_slug($this->txt_plural).'.index', ['id' => $result->id]);
    }

    public function edit($id, Modulo $moduloModel)
    {
        $result = $this->model->findOrFail($id);

        $opcoes_modulo = $moduloModel->orderBy('nome')->pluck('nome', 'id');

        return view('admin.'.str_slug($this->txt_singular).'.edit', compact('result', 'opcoes_modulo'));
    }

    public function update($id, PermissaoRequest $request)
    {
        $result = $this->model->findOrFail($id);
        $result->fill($request->all());
        $result->save();

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
