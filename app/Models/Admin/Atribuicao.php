<?php

namespace App\Models\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Atribuicao extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'view_atribuicoes';

    /*
    |---------------------------------------------------------------
    |   RELATIONSHIPS
    |---------------------------------------------------------------
     */
    public function operacoes()
    {
        return $this->belongsTo(Operacao::class);
    }

    /*
    |---------------------------------------------------------------
    |   ATTRIBUTES
    |---------------------------------------------------------------
     */


    /*
    |---------------------------------------------------------------
    |   SCOPES
    |---------------------------------------------------------------
     */


    /*
    |---------------------------------------------------------------
    |   HELPERS
    |---------------------------------------------------------------
     */

}
