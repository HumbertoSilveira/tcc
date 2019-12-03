<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'permissoes';

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nome',
        'slug',
        'modulo_id',

    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        Permissao::deleting(function ($permissao) {
            $permissao->perfis()->detach();
        });
    }

    /*
    |---------------------------------------------------------
    |   RELATIONSHIPS
    |---------------------------------------------------------
     */
    public function perfis()
    {
        return $this->belongsToMany(Perfil::class, 'perfis_permissoes');
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }

    /*
    |---------------------------------------------------------
    |   ATTRIBUTES
    |---------------------------------------------------------
     */
    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }


    /*
    |---------------------------------------------------------
    |   OTHERS
    |---------------------------------------------------------
     */

}
