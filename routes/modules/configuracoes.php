<?php
/*
|--------------------------------------------------------------------------
| CONFIGURACOES
|--------------------------------------------------------------------------
*/
$prefix = 'configuracoes';

$this->group(['prefix' => $prefix, 'as' => $prefix . '.', 'namespace' => 'Admin'], function () {
    $controller = 'ConfiguracoesController';

    $this->get('/', ['uses' => $controller . '@index', 'as' => 'index', 'middleware' => 'pode:visualizar-configuracoes']);
    $this->get('/create', ['uses' => $controller . '@create', 'as' => 'create', 'middleware' => 'pode:cadastrar-configuracoes']);
    $this->post('/', ['uses' => $controller . '@store', 'as' => 'store', 'middleware' => 'pode:cadastrar-configuracoes']);
    $this->get('/{id}/edit', ['uses' => $controller . '@edit', 'as' => 'edit', 'middleware' => 'pode:editar-configuracoes']);
    $this->put('/{id}', ['uses' => $controller . '@update', 'as' => 'update', 'middleware' => 'pode:editar-configuracoes']);
    $this->delete('/', ['uses' => $controller . '@destroy', 'as' => 'destroy', 'middleware' => 'pode:excluir-configuracoes']);
});