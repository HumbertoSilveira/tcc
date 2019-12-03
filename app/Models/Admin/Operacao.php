<?php

namespace App\Models\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Operacao extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'operacoes';

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nome',
        'descricao',
        'status_id',
        'equipe_id',
        'criado_por'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function($model){
            $model->criado_por = auth()->user()->id ?? 0;
        });

        static::deleting(function($model){
            DB::table('operacoes_atribuicoes')->where('operacao_id', $model->id)->delete();
        });
    }

    /*
    |---------------------------------------------------------------
    |   RELATIONSHIPS
    |---------------------------------------------------------------
     */
    public function equipe()
    {
        return $this->belongsTo(Equipe::class);
    }

    public function atribuicoes()
    {
        return $this->hasMany(Atribuicao::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'criado_por');
    }
    /*
    |---------------------------------------------------------------
    |   ATTRIBUTES
    |---------------------------------------------------------------
     */
    public function setDescricaoAttribute($value)
    {
        $this->attributes['descricao'] = $value ? toUtf8($value) : '';
    }
    public function getDescricaoSiteAttribute()
    {
        return strip_tags($this->attributes['descricao'], config('app.tags_permitidas'));
    }

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
