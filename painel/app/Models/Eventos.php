<?php

namespace App\Models;

use App\Models\Usuarios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventos extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'eventos';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'autor',
        'titulo',
        'imagem_em_destaque',
        'capa_do_evento',
        'datas',
        'local',
        'conteudo'
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
