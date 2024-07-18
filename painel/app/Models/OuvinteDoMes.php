<?php

namespace App\Models;

use App\Models\Programas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OuvinteDoMes extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ouvinte_do_mes';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'endereco',
        'avatar',
        'quantidade_de_pedidos',
        'programa_favorito',
    ];

    /**
    * The relations with other models.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function programa_favorito(){
        return $this->belongsTo(Programas::class, 'programa_favorito');
    }
}
