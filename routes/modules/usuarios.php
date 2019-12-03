<?php
/*
|--------------------------------------------------------------------------
| USUARIOS
|--------------------------------------------------------------------------
*/
$prefix = 'usuarios';

$this->group(['prefix' => $prefix, 'as' => $prefix . '.', 'namespace' => 'Admin'], function () {
    $controller = 'UsuariosController';

    $this->get('/meus-dados', $controller.'@meusDados')->name('meusdados')->middleware('auth');
    $this->put('/meus-dados', $controller.'@meusDadosUpdate')->name('meusdados.update')->middleware('auth');
    $this->delete('/meus-dados/{id}/imagem', ['uses' => $controller . '@meusDadosDestroyImagem', 'as' => 'meusdados.destroyImagem'])->middleware('auth');

    $this->get('/', ['uses' => $controller . '@index', 'as' => 'index', 'middleware' => 'pode:visualizar-usuarios']);
    $this->get('/create', ['uses' => $controller . '@create', 'as' => 'create', 'middleware' => 'pode:cadastrar-usuarios']);
    $this->post('/', ['uses' => $controller . '@store', 'as' => 'store', 'middleware' => 'pode:cadastrar-usuarios']);
    $this->get('/{id}/edit', ['uses' => $controller . '@edit', 'as' => 'edit', 'middleware' => 'pode:editar-usuarios']);
    $this->put('/{id}', ['uses' => $controller . '@update', 'as' => 'update', 'middleware' => 'pode:editar-usuarios']);
    $this->put('/{id}/ativo', ['uses' => $controller . '@updateAtivo', 'as' => 'updateAtivo', 'middleware' => 'pode:editar-usuarios']);
    $this->delete('/', ['uses' => $controller . '@destroy', 'as' => 'destroy', 'middleware' => 'pode:excluir-usuarios']);
    $this->delete('/{id}/imagem', ['uses' => $controller . '@destroyImagem', 'as' => 'destroyImagem', 'middleware' => 'pode:excluir-imagem-de-usuario']);
});