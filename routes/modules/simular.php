<?php
/*
|--------------------------------------------------------------------------
| SIMULAR LOGIN
|--------------------------------------------------------------------------
*/
$prefix = 'simular';

$this->group(['prefix' => $prefix, 'as' => $prefix . '.', 'namespace' => 'Admin'], function () {
    $controller = 'SimuladorController';

    $this->get('/', ['uses' => $controller . '@index', 'as' => 'index', 'middleware' => 'pode:simular-login']);
    $this->get('/{id}', ['uses' => $controller . '@simular', 'as' => 'simular', 'middleware' => 'pode:simular-login']);
});