<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcasts extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'podcasts';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'autor',
        'temporada',
        'episodio',
        'titulo_do_episodio',
        'capa_do_episodio',
        'descricao_do_episodio',
        'conteudo_da_publicacao',
        'endereco_do_audio',
        'agregadores'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'agregadores' => 'array',
    ];


    /**
    * The relations with other models.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function autor(){
        return $this->belongsTo(Usuarios::class, 'autor');
    }
}
