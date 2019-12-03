<?php

namespace App\Models\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Funcao extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'funcoes';

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nome',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
    }

    /*
    |---------------------------------------------------------------
    |   RELATIONSHIPS
    |---------------------------------------------------------------
     */


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
