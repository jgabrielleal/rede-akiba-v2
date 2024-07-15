<?php

namespace App\Models;

use App\Models\NoAr;
use App\Models\ListaDeMusicas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidosMusicais extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pedidos_musicais';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'apelido_do_ouvinte',
        'endereco_do_ouvinte',
        'recado_para_o_locutor',
        'programa_no_ar',
        'musica_pedida',
    ];

    /**
    * The relations with other models.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function programa_no_ar(){
        return $this->belongsTo(NoAr::class, 'programa_no_ar');
    }

    public function musica_pedida(){
        return $this->belongsTo(ListaDeMusicas::class, 'musica_pedida');
    }
}
