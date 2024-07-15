<?php

namespace App\Models;

use App\Models\Usuarios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatalhaDePlaylist extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'batalha_de_playlist';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'imagem',
        'primeiro_competidor',
        'segundo_competidor',
    ];

    /**
    * The relations with other models.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function primeiro_competidor(){
        return $this->belongsTo(Usuarios::class, 'primeiro_competidor');
    }

    public function segundo_competidor(){
        return $this->belongsTo(Usuarios::class, 'segundo_competidor');
    }
}
