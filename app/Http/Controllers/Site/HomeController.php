<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests\Site\MensagemRequest;
use App\Models\Admin\Categoria;
use App\Models\Admin\Lote;
use App\Models\Admin\Mensagem;
use App\Models\Admin\Municipio;
use App\Models\Admin\Raca;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Mockery\Exception;

class HomeController extends Controller
{
    public function index()
    {
        return view('site.home');
    }

}
