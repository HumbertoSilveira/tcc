<?php

namespace App\Models\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{

    protected $table = "perfis";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'descricao',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        Perfil::deleting(function ($perfil) {
            $perfil->permissoes()->detach();
        });
    }

    /*
    |---------------------------------------------------------------
    |   RELATIONSHIPS
    |---------------------------------------------------------------
     */
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'perfis_user');
    }

    public function permissoes()
    {
        return $this->belongsToMany(Permissao::class, 'perfis_permissoes');
    }

    /*
    |---------------------------------------------------------------
    |   ATTRIBUTES
    |---------------------------------------------------------------
     */
    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    /*
    |---------------------------------------------------------------
    |   OTHER
    |---------------------------------------------------------------
     */
    public function tem_permissao($permissao)
    {
        return $tem_permissao = $this->permissoes->contains('slug', $permissao);
    }
}
