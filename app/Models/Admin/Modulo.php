<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'modulos';

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
        'descricao'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        Modulo::deleting(function ($model) {
            $permissoes_modulo = Permissao::with('perfis')->whereModuloId($model->id)->get();

            foreach($permissoes_modulo as $permissao) {
                $permissao->perfis()->detach();
                $permissao->delete();
            }

            //Permissao::whereModuloId($model->id)->delete();
        });

        $permissoes = [
            'visualizar',
            'cadastrar',
            'editar',
            'excluir',
        ];

        Modulo::created(function ($model) use($permissoes){
            foreach($permissoes as $permissao) {
                Permissao::create([
                    'nome' => capitalize(str_replace('-', ' ', $permissao.' '.$model->slug)),
                    'modulo_id' => $model->id
                ]);
            }
        });

        Modulo::updated(function ($model) use($permissoes){

            $permissoes_modulo = Permissao::with('perfis')->whereModuloId($model->id)->get();

            foreach($permissoes_modulo as $permissao) {
                $permissao->perfis()->detach();
                $permissao->delete();
            }

            foreach($permissoes as $permissao) {
                Permissao::create([
                    'nome' => capitalize(str_replace('-', ' ', $permissao.' '.$model->slug)),
                    'modulo_id' => $model->id
                ]);
            }
        });
    }

    /*
    |---------------------------------------------------------------
    |   RELATIONSHIPS
    |---------------------------------------------------------------
     */

    public function permissoes() {
        return $this->hasMany(Permissao::class);
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
}
