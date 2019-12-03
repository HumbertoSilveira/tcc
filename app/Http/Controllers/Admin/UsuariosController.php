<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MeusDadosRequest;
use App\Http\Requests\Admin\PerfilRequest;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Admin\Perfil;
use App\Traits\UploadTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravolt\Avatar\Avatar;

class UsuariosController extends Controller
{
    use UploadTrait;

    private $model;
    private $config;
    private $txt_plural = 'usuários';
    private $txt_singular = 'usuário';

    private $avatar_backgrounds = [
        'blue' => '#3C8DBC',
        'blue-light' => '#3C8DBC',
        'yellow' => '#F39C12',
        'yellow-light' => '#F39C12',
        'green' => '#00A65A',
        'green-light' => '#00A65A',
        'purple' => '#605CA8',
        'purple-light' => '#605CA8',
        'red' => '#DD4B39',
        'red-light' => '#DD4B39',
        'black' => '#333333',
        'black-light' => '#333333',
    ];
    private $dimensoes_avatar;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $model)
    {
        $this->model = $model;
        $this->config = getConfig();
        $this->dimensoes_avatar = config('app.models.usuarios.avatar');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = $this->model->newQuery();

        $query->with('perfis');
        $results = $query->paginate(config('app.pagination.default'));

        return view('admin.usuario.index', compact('results'));
    }

    public function create(Perfil $perfil)
    {
        $opcoes_perfil = $perfil->when(!auth()->user()->hasAnyRole('root'), function($q){
            $q->where('slug', '!=', 'root');
        })->orderBy('nome')->pluck('nome', 'id');
        $opcoes_skin = collect(config('app.models.usuarios.opcoes_skin'));

        return view('admin.'.str_slug($this->txt_singular).'.create', compact('opcoes_perfil', 'opcoes_skin'));
    }

    public function store(UserRequest $request, Avatar $avatar)
    {
        if(!$request->get('ativo'))
            $request->offsetSet('ativo', 'N');

        $avatar = $this->setAvatar($request);
        if(!$avatar['sucesso'])
            Log::info('Erro ao salvar avatar: '.$avatar['mensagem']);

        $request->offsetSet('imagem', $avatar['sucesso'] ? $avatar['arquivo'] : null);

        $result = $this->model->fill($request->all());
        $result->save();

        $result->perfis()->attach(request('perfis'));

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Sucesso',
            'text' => config('app.messages.actions.insert'),
        ]);

        return redirect()->route(str_slug($this->txt_plural).'.index', ['id' => $result->id]);
    }

    public function edit($id, Perfil $perfil)
    {
        $result = $this->model->findOrFail($id);

        $opcoes_perfil = $perfil->when(!auth()->user()->hasAnyRole('root'), function($q){
            $q->where('slug', '!=', 'root');
        })->orderBy('nome')->pluck('nome', 'id');

        $opcoes_skin = collect(config('app.models.usuarios.opcoes_skin'));

        return view('admin.'.str_slug($this->txt_singular).'.edit', compact('result', 'opcoes_skin', 'opcoes_perfil'));
    }

    public function update($id, UserRequest $request)
    {
        if (!$request->get('password'))
            $request->offsetUnset('password');

        $result = $this->model->findOrFail($id);
        if(is_null($result->imagem)) {
            $avatar = $this->setAvatar($request);
            if(!$avatar['sucesso'])
                Log::info('Erro ao salvar avatar: '.$avatar['mensagem']);

            $request->offsetSet('imagem', $avatar['sucesso'] ? $avatar['arquivo'] : null);
        }

        $result->fill($request->all());
        $result->perfis()->sync(request('perfis'));

        $result->save();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Sucesso',
            'text' => config('app.messages.actions.insert'),
        ]);

        return redirect()->route(str_slug($this->txt_plural).'.index', ['id' => $id]);
    }

    public function updateAtivo($id)
    {
        $result = $this->model->find($id);

        $ativo = 'N';
        if($result->ativo == $ativo)
            $ativo = 'S';

        $result->ativo = $ativo;
        $result->save();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Sucesso',
            'text' => "Status alterado com sucesso",
        ]);

        return response()->json([
            'success' => true,
            'redirect' => route(str_slug($this->txt_plural).'.index')
        ]);
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

    public function destroyImagem($id) {

        $usuario = $this->model->find($id);

        if(!is_null($usuario->imagem)) {
            File::delete('storage/uploads/usuarios/' . $usuario->imagem);

            $usuario->imagem = NULL;
            $usuario->save();
        }

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Sucesso',
            'text' => config('app.messages.actions.delete'),
        ]);

        return response()->json([
            'success' => true,
            'redirect' => route(str_slug($this->txt_plural).'.edit', ['id' => $id])
        ]);
    }

    public function meusDados()
    {
        $result = auth()->user();
        $opcoes_skin = collect(config('app.models.usuarios.opcoes_skin'));

        return view('admin.usuario.edit_dados', compact('result', 'opcoes_skin'));
    }

    public function meusDadosUpdate(MeusDadosRequest $request, Avatar $avatar)
    {
        if (!$request->get('password'))
            $request->offsetUnset('password');

        $id = auth()->user()->id;

        $result = $this->model->findOrFail($id);

        if(is_null($result->imagem)) {
            $avatar = $this->setAvatar($request);
            if(!$avatar['sucesso'])
                Log::info('Erro ao salvar avatar: '.$avatar['mensagem']);

            $request->offsetSet('imagem', $avatar['sucesso'] ? $avatar['arquivo'] : null);
        }

        $result->fill($request->all());

        $result->save();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Sucesso',
            'text' => config('app.messages.actions.update'),
        ]);

        return redirect()->route('usuarios.meusdados');
    }

    public function meusDadosDestroyImagem($id) {

        $usuario = $this->model->find($id);

        if(!is_null($usuario->imagem)) {
            File::delete('storage/uploads/usuarios/' . $usuario->imagem);

            $usuario->imagem = NULL;
            $usuario->save();
        }

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Sucesso',
            'text' => config('app.messages.actions.delete'),
        ]);

        return response()->json([
            'success' => true,
            'redirect' => route(str_slug($this->txt_plural).'.meusdados', ['id' => $id])
        ]);
    }

    private function setAvatar(Request $request)
    {
        try{
            if(!$request->file('file')) {
                $avatar = new Avatar();
                $pasta = 'storage/uploads/usuarios/';
                $name = Str::random().'.jpg';

                $avatar->create($request->get('nome'))
                    ->setDimension($this->dimensoes_avatar['width'], $this->dimensoes_avatar['height'])
                    ->setFontSize(80)
                    ->setBackground($this->avatar_backgrounds[$request->get('skin')])
                    ->save($pasta . $name, 60);
            } else {
                $pasta = $this->model->uploads . "/";
                $dimensoes = $this->dimensoes_avatar;

                $upload = $this->uploadImage($request->file('file'), $pasta, $dimensoes);
                if (!$upload['success'])
                    throw new \Exception("Erro ao salvar imagem: " . $upload['erro']);

                $name = $upload['arquivo'];
            }

            return [
                'sucesso' => true,
                'arquivo' => $name
            ];
        }catch(\Exception $e) {
            return [
                'sucesso' => false,
                'mensagem' => $e->getMessage()
            ];
        }
    }
}
