<?php

namespace App\Models;

use App\Models\Usuarios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvisosParaEquipe extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'avisos_para_equipe';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'remetente',
        'destinatario',
        'mensagem',
    ];

    /**
    * The relations with other models.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function remetente(){
        return $this->belongsTo(Usuarios::class, 'remetente');
    }

    public function destinatario(){
        return $this->belongsTo(Usuarios::class, 'destinatario');
    }
}
