<?php

namespace App\Http\ViewComposers;

use App\Models\Admin\Configuracao;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminComposer
{
    public $configModel;

    /**
     * Create a menu composer.
     *
     * @return void
     */
    public function __construct(Configuracao $configModel)
    {
        $this->configModel = $configModel;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function getConfig(View $view)
    {
        //Cache::flush('configuracoes');
        $config = cache('configuracoes');
        if(is_null($config)) {
            $config = $this->configModel->all();
            cache(['configuracoes' => $config], 1440);
        }

        $view->with('config', $config);
    }
}