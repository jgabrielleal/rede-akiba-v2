<?php

namespace App\Models;

use App\Models\ListaDeMusicas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopDeMusicas extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'top_de_musicas';

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'avatar',
        'musica',
    ];


    /**
    * The relations with other models.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function musica(){
        return $this->belongsTo(ListaDeMusicas::class, 'musica');
    }
}
