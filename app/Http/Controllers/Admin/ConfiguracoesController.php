<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ConfiguracaoRequest;
use App\Models\Admin\Configuracao;

class ConfiguracoesController extends Controller
{

    private $model;
    private $config;
    private $txt_plural = 'configurações';
    private $txt_singular = 'configuração';

    public function __construct(Configuracao $model)
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

        if (request('nomeF')) {
            $query->where('nome', 'like', '%' . request('nomeF') . '%');
        }

        if(!auth()->user()->hasAnyRole('root')){
            $query->where('root', 'N');
        }

        $query->orderBy(request('sort'), request('order'));

        $results = $query->paginate($this->config['registros_por_pagina']->valor_sem_tags);

        return view('admin.'.str_slug($this->txt_singular).'.index', compact('results'));
    }

    public function create() {

        return view('admin.'.str_slug($this->txt_singular).'.create');
    }

    public function store(ConfiguracaoRequest $request)
    {
        $result = $this->model->fill($request->all());
        $result->save();

        cache()->flush('configuracoes');

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

        return view('admin.'.str_slug($this->txt_singular).'.edit', compact('result'));
    }

    public function update($id, ConfiguracaoRequest $request)
    {
        $request->offsetSet('root', $request->filled('root') ? 'S' : 'N');

        $result = $this->model->findOrFail($id);
        $result->fill($request->all());
        $result->save();

        cache()->flush('configuracoes');

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

        cache()->flush('configuracoes');

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
