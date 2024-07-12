<?php

namespace App\Models;

use App\Models\AvisosParaEquipe;
use App\Models\Calendario;
use App\Models\Eventos;
use App\Models\Formularios;
use App\Models\Materias;
use App\Models\Podcasts;
use App\Models\Programas;
use App\Models\RepositorioDeArquivos;
use App\Models\Reviews;
use App\Models\Tarefas;
use App\Models\VideosDoYoutube;
use App\Models\BatalhaDePlaylist;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuarios extends Authenticatable
{

    use HasFactory;
    use HasApiTokens;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'usuarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'ativo',
        'login',
        'senha',
        'niveis_de_acesso',
        'avatar',
        'nome',
        'apelido',
        'email',
        'idade',
        'cidade',
        'estado',
        'pais',
        'biografia',
        'redes_sociais',
        'gostos',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'niveis_de_acesso' => 'array',
        'redes_sociais' => 'array',
        'gostos' => 'array',
    ];

    /**
    * The relations with other models.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function avisosDestinatario(){
        return $this->hasMany(AvisosParaEquipe::class, 'destinatario');
    }

    public function avisosRemente(){
        return $this->hasMany(AvisosParaEquipe::class, 'remetente');
    }

    public function calendario(){
        return $this->hasMany(Calendario::class, 'designado');
    }

    public function eventos(){
        return $this->hasMany(Eventos::class, 'autor');
    }

    public function formularios(){
        return $this->hasMany(Formularios::class, 'ultima_visualizacao');
    }

    public function materias(){
        return $this->hasMany(Materias::class, 'autor');
    }

    public function podcasts(){
        return $this->hasMany(Podcasts::class, 'autor');
    }

    public function programas(){
        return $this->hasMany(Programas::class, 'locutor');
    }

    public function repositorioDeArquivos(){
        return $this->hasMany(RepositorioDeArquivos::class, 'uploader');
    }

    public function reviews(){
        return $this->hasMany(Reviews::class, 'autor');
    }

    public function tarefasAdministrador(){
        return $this->hasMany(Tarefas::class, 'administrador');
    }

    public function tarefasExecutante(){
        return $this->hasMany(Tarefas::class, 'executante');
    }

    public function videosDoYoutube(){
        return $this->hasMany(VideosDoYoutube::class, 'autor');
    }

    public function batalhaDePlaylistPrimeiroCompetidor(){
        return $this->hasMany(BatalhaDePlaylist::class, 'primeiro_competidor');
    }

    public function batalhaDePlaylistSegundoCompetidor(){
        return $this->hasMany(BatalhaDePlaylist::class, 'segundo_competidor');
    }
}
