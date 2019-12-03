<?php
/*
|--------------------------------------------------------------------------
| PERFIS DE USUARIO
|--------------------------------------------------------------------------
*/
$prefix = 'perfis';

$this->group(['prefix' => $prefix, 'as' => $prefix . '.', 'namespace' => 'Admin'], function () {
    $controller = 'PerfisController';

    $this->get('/', ['uses' => $controller . '@index', 'as' => 'index', 'middleware' => 'pode:visualizar-perfis-de-usuario']);
    $this->get('/create', ['uses' => $controller . '@create', 'as' => 'create', 'middleware' => 'pode:cadastrar-perfis-de-usuario']);
    $this->post('/', ['uses' => $controller . '@store', 'as' => 'store', 'middleware' => 'pode:cadastrar-perfis-de-usuario']);
    $this->get('/{id}/edit', ['uses' => $controller . '@edit', 'as' => 'edit', 'middleware' => 'pode:editar-perfis-de-usuario']);
    $this->put('/{id}', ['uses' => $controller . '@update', 'as' => 'update', 'middleware' => 'pode:editar-perfis-de-usuario']);
    $this->delete('/', ['uses' => $controller . '@destroy', 'as' => 'destroy', 'middleware' => 'pode:excluir-perfis-de-usuario']);
    $this->get('/{id}/edit/permissoes', ['uses' => $controller . '@permissoes', 'as' => 'permissoes', 'middleware' => 'pode:visualizar-permissoes-do-perfil']);
    $this->put('/{id}/edit/permissoes', ['uses' => $controller . '@storePermissoes', 'as' => 'storePermissoes', 'middleware' => 'pode:editar-permissoes-do-perfil']);
});