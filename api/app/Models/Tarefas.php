<?php

namespace App\Models;

use App\Models\Usuarios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefas extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tarefas';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'administrador',
        'executante',
        'tarefa_a_ser_concluida',
        'tarefa_concluida',
    ];

    /**
     * Get the types attribute.
     *
     * @param  mixed  $value
     * @return bool
     */
    /*
    public function getTarefaConcluidaAttribute($value)
    {
        return (bool) $value;
    }
    */


    /**
    * The relations with other models.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function administrador(){
        return $this->belongsTo(Usuarios::class, 'administrador');
    }

    public function executante(){
        return $this->belongsTo(Usuarios::class, 'executante');
    }
}
