<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
|---------------------------------------------------------------------
|   LOGIN
|---------------------------------------------------------------------
 */
$this->group(['prefix' => 'admin'], function () {
    //Auth::routes();
    $this->get('/login', '\App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
    $this->post('/login', '\App\Http\Controllers\Auth\LoginController@login');
    $this->post('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
});


/*
|---------------------------------------------------------------------
|   ADMIN
|---------------------------------------------------------------------
 */
$this->group(['prefix' => 'admin', 'middleware' => ['auth', 'update_user_activity']], function () {

    $this->group(['namespace' => 'Admin'], function () {
        $this->get('/', 'HomeController@index')->name('home');
        $this->get('/limpar-cache', ['uses' => 'HomeController@limparCache', 'as' => 'cache.limpar']);
    });

    /*
    |---------------------------------------------------------------------
    |   LOGS VIEWER
    |---------------------------------------------------------------------
     */
    $this->get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('log');

    /*
    |---------------------------------------------------------------------
    |   MODULOS DO ADMIN
    |---------------------------------------------------------------------
     */
    $modulos = glob("../routes/modules/*");
    foreach($modulos as $modulo) {
        require_once($modulo);
    }

});


/*
|---------------------------------------------------------------------
|   SITE
|---------------------------------------------------------------------
 */
$this->group(['namespace' => 'Site'], function(){
    $this->get('/', 'HomeController@index')->name('site.home');
});