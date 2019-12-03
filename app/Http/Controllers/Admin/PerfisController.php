<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PerfilRequest;
use App\Models\Admin\Modulo;
use App\Models\Admin\Perfil;
use App\Models\Admin\Permissao;
use Illuminate\Http\Request;

class PerfisController extends Controller
{
    private $model;
    private $config;
    private $txt_plural = 'perfis';
    private $txt_singular = 'perfil';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Perfil $model)
    {
        $this->model = $model;
        $this->config = getConfig();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = $this->model->newQuery();
        $query->with('permissoes');
        $query->where('slug', '!=', 'root');
        $results = $query->paginate(config('app.pagination.default'));

        return view('admin.'.str_slug($this->txt_singular).'.index', compact('results'));
    }

    public function create(Modulo $moduloModel)
    {
        $opcoesSkin = collect(config('app.models.perfil.opcoes_skin'));
        $modulos = $moduloModel->with('permissoes')->orderBy('nome')->get();

        return view('admin.'.str_slug($this->txt_singular).'.create', compact('opcoesSkin', 'modulos'));
    }

    public function store(PerfilRequest $request)
    {
        $result = $this->model->fill($request->all());
        $result->save();

        $result->permissoes()->attach($request->get('permissoes'));

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

        $opcoesSkin = collect(config('app.models.perfil.opcoes_skin'));
        $modulos = $moduloModel->with('permissoes')->orderBy('nome')->get();

        return view('admin.'.str_slug($this->txt_singular).'.edit', compact('result', 'opcoesSkin', 'modulos'));
    }

    public function update($id, PerfilRequest $request)
    {
        $result = $this->model->findOrFail($id);
        $result->fill($request->all());
        $result->save();

        $result->permissoes()->sync($request->get('permissoes'));

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

    public function permissoes($id, Modulo $moduloModel)
    {
        $result = $this->model->with('permissoes')->findOrFail($id);
        $modulos = $moduloModel->with('permissoes')->orderBy('nome')->get();

        return view('admin.'.str_slug($this->txt_singular).'.permissoes', compact('result', 'modulos'));
    }

    public function storePermissoes($id, Request $request, Perfil $perfilModel)
    {
        $result = $perfilModel->find($id);
        $result->permissoes()->sync($request->get('permissoes'));

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Sucesso',
            'text' => 'Permissões atualizadas com sucesso',
        ]);

        return redirect()->route(str_slug($this->txt_plural).'.index', ['id' => $id]);
    }
}
