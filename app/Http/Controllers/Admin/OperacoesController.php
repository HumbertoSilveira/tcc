<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OperacaoRequest;
use App\Models\Admin\Atribuicao;
use App\Models\Admin\Equipe;
use App\Models\Admin\Funcao;
use App\Models\Admin\Modulo;
use App\Models\Admin\Operacao;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperacoesController extends Controller
{
    /**
     * @var Modulo
     */
    private $model;
    private $config;
    private $txt_plural = 'operações';
    private $txt_singular = 'operação';


    public function __construct(Operacao $model)
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
            request()->offsetSet('sort', 'created_at');
        }

        if (!request()->has('order')) {
            request()->offsetSet('order', 'desc');
        }

        // QUERY
        $query = $this->model->newQuery();

        if (request('nomeF')) {
            $query->where('nome', 'like', '%' . request('nomeF') . '%');
        }

        $query->orderBy(request('sort'), request('order'));

        $results = $query->paginate($this->config['registros_por_pagina']->valor_sem_tags);

        return view('admin.'.str_slug($this->txt_singular).'.index', compact('results'));
    }

    public function create()
    {
        $equipes = Equipe::whereHas('agentes')->pluck('nome', 'id');
        $equipes->prepend('', '');

        return view('admin.'.str_slug($this->txt_singular).'.create', compact('equipes'));
    }

    public function store(OperacaoRequest $request)
    {
        $menu = $this->model->fill($request->all());
        $menu->save();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Sucesso',
            'text' => config('app.messages.actions.insert'),
        ]);

        return redirect()->route(str_slug($this->txt_plural).'.index', ['id' => $menu->id]);
    }

    public function edit($id)
    {
        $result = $this->model->findOrFail($id);

        $equipes = Equipe::whereHas('agentes')->pluck('nome', 'id');
        $equipes->prepend('', '');

        return view('admin.'.str_slug($this->txt_singular).'.edit', compact('result', 'equipes'));
    }

    public function atribuicoes($id)
    {
        $result = $this->model->with('atribuicoes')->findOrFail($id);
        $agentes = User::agentes()->orderby('nome')->pluck('nome', 'id');
        $funcoes = Funcao::orderBy('nome')->pluck('nome', 'id');


        return view('admin.'.str_slug($this->txt_singular).'.atribuicoes', compact('result', 'agentes', 'funcoes'));
    }

    public function addAtribuicao($id, Request $request)
    {
        try{
            DB::beginTransaction();

            DB::table('operacoes_atribuicoes')->insert([
                'operacao_id' => $id,
                'agente_id' => $request->agente_id,
                'funcao_id' => $request->funcao_id
            ]);

            $atribuicoes = $this->getAtribuicoes($id);

            DB::commit();
            return response()->json([
                'sucesso' => true,
                'mensagem' => 'Dados inseridos com sucesso',
                'atribuicoes' => $atribuicoes
            ]);
        }catch(\Exception $e) {
            DB::rollback();
            return response()->json([
                'sucesso' => false,
                'mensagem' => $e->getMessage()
            ]);
        }
    }

    public function destroyAtribuicao($id, Request $request)
    {
        try{
            DB::beginTransaction();

            DB::table('operacoes_atribuicoes')->where('id', $request->atribuicao_id)->delete();

            $atribuicoes = $this->getAtribuicoes($id);

            DB::commit();
            return response()->json([
                'sucesso' => true,
                'mensagem' => 'Dados removidos com sucesso',
                'atribuicoes' => $atribuicoes
            ]);
        }catch(\Exception $e) {
            DB::rollback();
            return response()->json([
                'sucesso' => false,
                'mensagem' => $e->getMessage()
            ]);
        }
    }

    public function getAtribuicoes($operacao_id)
    {
        return Atribuicao::whereOperacaoId($operacao_id)->get();
    }

    public function update($id, OperacaoRequest $request)
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
                'success' => false,
                'mensagem' => "Nenhum item selecionado"
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

    public function documentos($id)
    {
        $result = $this->model->with('documentos')->findOrFail($id);
        $agentes = User::agentes()->orderby('nome')->pluck('nome', 'id');
        $funcoes = Funcao::orderBy('nome')->pluck('nome', 'id');


        return view('admin.'.str_slug($this->txt_singular).'.atribuicoes', compact('result', 'agentes', 'funcoes'));
    }
}
