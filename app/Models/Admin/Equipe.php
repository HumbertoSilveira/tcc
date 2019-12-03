<?php

namespace App\Models\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'equipes';

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
    public function operacoes()
    {
        return $this->hasMany(Operacao::class);
    }
    public function agentes()
    {
        return $this->belongsToMany(User::class, 'equipe_agentes', 'equipe_id', 'usuario_id');
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
