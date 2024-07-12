<?php

namespace App\Models;

use App\Models\Programas;
use App\Models\PedidosMusicais;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoAr extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'no_ar';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'programa',
        'controle_de_pedidos',
        'tipo_de_transmissao',
        'data_de_transmissao',
        'inicio_da_transmissao',
        'fim_da_transmissao',
        'conteudo',
        'tags',
        'fontes_de_pesquisa',
        'reacoes'
    ];

    /**
    * The relations with other models.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function programa(){
        return $this->belongsTo(Programas::class, 'programa');
    }

    public function pedidosMusicais(){
        return $this->hasMany(PedidosMusicais::class, 'programas_no_ar');
    }
}
