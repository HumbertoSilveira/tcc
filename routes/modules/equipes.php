<?php
/*
|--------------------------------------------------------------------------
| EQUIPES
|--------------------------------------------------------------------------
*/
$prefix = 'equipes';

$this->group(['prefix' => $prefix, 'as' => $prefix . '.', 'namespace' => 'Admin'], function () {
    $controller = 'EquipesController';

    $this->get('/', ['uses' => $controller . '@index', 'as' => 'index', 'middleware' => 'pode:visualizar-gerenciar-equipes']);
    $this->get('/create', ['uses' => $controller . '@create', 'as' => 'create', 'middleware' => 'pode:cadastrar-gerenciar-equipes']);
    $this->post('/', ['uses' => $controller . '@store', 'as' => 'store', 'middleware' => 'pode:cadastrar-gerenciar-equipes']);
    $this->get('/{id}/edit', ['uses' => $controller . '@edit', 'as' => 'edit', 'middleware' => 'pode:editar-gerenciar-equipes']);
    $this->put('/{id}', ['uses' => $controller . '@update', 'as' => 'update', 'middleware' => 'pode:editar-gerenciar-equipes']);
    $this->delete('/', ['uses' => $controller . '@destroy', 'as' => 'destroy', 'middleware' => 'pode:excluir-gerenciar-equipes']);
});