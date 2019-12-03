<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Configuracao extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'configuracoes';

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
        'descricao',
        'valor',
        'root',
    ];

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
    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = capitalize($value);
        $this->attributes['slug'] = str_slug($value, '_');
    }

    public function getValorSemTagsAttribute()
    {
        return strip_tags($this->attributes['valor']);
    }

    /*
    |---------------------------------------------------------------
    |   OTHERS
    |---------------------------------------------------------------
     */
}
