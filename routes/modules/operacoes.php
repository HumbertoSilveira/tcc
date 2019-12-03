<?php
/*
|--------------------------------------------------------------------------
| OPERACOES
|--------------------------------------------------------------------------
*/
$prefix = 'operacoes';

$this->group(['prefix' => $prefix, 'as' => $prefix . '.', 'namespace' => 'Admin'], function () {
    $controller = 'OperacoesController';

    $this->get('/', ['uses' => $controller . '@index', 'as' => 'index', 'middleware' => 'pode:visualizar-operacoes']);
    $this->get('/create', ['uses' => $controller . '@create', 'as' => 'create', 'middleware' => 'pode:cadastrar-operacoes']);
    $this->post('/', ['uses' => $controller . '@store', 'as' => 'store', 'middleware' => 'pode:cadastrar-operacoes']);
    $this->get('/{id}/edit', ['uses' => $controller . '@edit', 'as' => 'edit', 'middleware' => 'pode:editar-operacoes']);
    $this->get('/{id}/atribuicoes', ['uses' => $controller . '@atribuicoes', 'as' => 'atribuicoes', 'middleware' => 'pode:editar-atribuicoes']);
    $this->post('/{id}/atribuicoes', ['uses' => $controller . '@addAtribuicao', 'as' => 'atribuicoes.add', 'middleware' => 'pode:editar-atribuicoes']);
    $this->delete('/{id}/atribuicoes', ['uses' => $controller . '@destroyAtribuicao', 'as' => 'atribuicoes.destroy', 'middleware' => 'pode:editar-atribuicoes']);
    $this->put('/{id}', ['uses' => $controller . '@update', 'as' => 'update', 'middleware' => 'pode:editar-operacoes']);
    $this->delete('/', ['uses' => $controller . '@destroy', 'as' => 'destroy', 'middleware' => 'pode:excluir-operacoes']);
    $this->get('/{id}/documentos', ['uses' => $controller . '@documentos', 'as' => 'documentos', 'middleware' => 'pode:editar-documentos']);
});