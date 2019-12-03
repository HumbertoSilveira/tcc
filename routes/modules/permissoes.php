<?php
/*
|--------------------------------------------------------------------------
| PERMISSOES DE PERFIL
|--------------------------------------------------------------------------
*/
$prefix = 'permissoes';

$this->group(['prefix' => $prefix, 'as' => $prefix . '.', 'namespace' => 'Admin'], function () {
    $controller = 'PermissoesController';

    $this->get('/', ['uses' => $controller . '@index', 'as' => 'index', 'middleware' => 'pode:visualizar-permissoes']);
    $this->get('/create', ['uses' => $controller . '@create', 'as' => 'create', 'middleware' => 'pode:cadastrar-permissoes']);
    $this->post('/', ['uses' => $controller . '@store', 'as' => 'store', 'middleware' => 'pode:cadastrar-permissoes']);
    $this->get('/{id}/edit', ['uses' => $controller . '@edit', 'as' => 'edit', 'middleware' => 'pode:editar-permissoes']);
    $this->put('/{id}', ['uses' => $controller . '@update', 'as' => 'update', 'middleware' => 'pode:editar-permissoes']);
    $this->delete('/', ['uses' => $controller . '@destroy', 'as' => 'destroy', 'middleware' => 'pode:excluir-permissoes']);
});