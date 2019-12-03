<?php

namespace App;

use App\Models\Admin\Equipe;
use App\Models\Admin\Perfil;
use App\Models\Admin\Permissao;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\File;

class User extends Authenticatable
{
    use Notifiable;

    // pasta onde serao feitos os uploads de arquivos
    public $uploads = "usuarios";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'login',
        'email',
        'password',
        'cpf',
        'telefone',
        'celular',
        'imagem',
        'skin',
        'ativo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'ultimo_acesso',
        'ultima_atividade',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $model->perfis()->detach();

            if(!is_null($model->imagem))
                File::delete('storage/uploads/usuarios/'.$model->imagem);
        });
    }


    /*
    |---------------------------------------------------------
    |   RELATIONSHIPS
    |---------------------------------------------------------
     */

    public function perfis() {
        return $this->belongsToMany(Perfil::class, 'perfis_user')->orderBy('nome');
    }

    public function equipes()
    {
        return $this->belongsToMany(Equipe::class, 'equipe_agentes');
    }

    /*
    |---------------------------------------------------------
    |   ATTRIBUTES
    |---------------------------------------------------------
     */

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = so_numero($value);
    }

    public function setTelefoneAttribute($value)
    {
        $this->attributes['telefone'] = so_numero($value);
    }

    public function setCelularAttribute($value)
    {
        $this->attributes['celular'] = so_numero($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = capitalize($value);
    }

    public function getCpfFormatadoAttribute()
    {
        return $this->attributes['cpf'] ? formata_cpf_cnpj($this->attributes['cpf']) : '';
    }

    public function getTelefoneFormatadoAttribute()
    {
        return formata_telefone($this->attributes['telefone']);
    }

    public function getCelularFormatadoAttribute()
    {
        return formata_telefone($this->attributes['celular']);
    }

    public function getAtivoNomeAttribute()
    {
        $opcoes = [
            'S' => 'Sim',
            'N' => 'Não',
        ];

        return $opcoes[$this->attributes['ativo']];
    }

    public function isAtivo()
    {
        return $this->attributes['ativo'] == 'S';
    }


    /*
    |---------------------------------------------------------
    |   OTHERS
    |---------------------------------------------------------
     */

    public function hasPermission(Permissao $permissao)
    {
        return $this->hasAnyRole($permissao->perfis);
    }

    public function hasAnyRole($perfis)
    {
        $perfis_user = cache('perfis_user_'.$this->id);
        if(is_null($perfis_user)) {
            $perfis_user = $this->perfis;
            cache(['perfis_user_'.$this->id => $perfis_user], 60);
        }

        if(is_array($perfis) || is_object($perfis)){
            return !! $perfis->intersect($perfis_user)->count();
        }
        return $perfis_user->contains('slug', $perfis);
    }

    public function scopeAgentes($query)
    {
        $query->whereHas('perfis', function($q){
            $q->whereId(2);
        });
    }
}
