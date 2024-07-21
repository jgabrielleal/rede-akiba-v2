<?php

namespace App\Models;

use App\Models\PedidosMusicais;
use App\Models\TopDeMusicas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaDeMusicas extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lista_de_musicas';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'numeros_de_vezes_tocada',
        'nome_do_anime',
        'nome_da_musica',
        'nome_do_artista',
        'nome_do_album',
        'ano_do_lancamento'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'conteudo_do_formulario' => 'array',
    ];

    /**
    * The relations with other models.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function pedidos_musicais(){
        return $this->hasMany(PedidosMusicais::class);
    }

    public function top_de_musicas(){
        return $this->hasMany(TopDeMusicas::class);
    }
}
