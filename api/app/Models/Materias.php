<?php

namespace App\Models;

use App\Models\Usuarios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materias extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'materias';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'publicado',
        'autor',
        'imagem_em_destaque',
        'capa_da_materia',
        'titulo',
        'conteudo',
        'tags',
        'fontes_de_pesquisa',
        'reacoes'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tags' => 'array',
        'fontes_de_pesquisa' => 'array',
        'reacoes' => 'array'
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
