<?php

namespace App\Models;

use App\Models\Usuarios;
use App\Models\NoAr;
use App\Models\OuvinteDoMes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programas extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'programas';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'auto_dj',
        'locutor',
        'nome_do_programa',
        'logo_do_programa',
    ];

    /**
    * The relations with other models.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function locutor(){
        return $this->belongsTo(Usuarios::class, 'locutor');
    }

    public function programa(){
        return $this->hasMany(NoAr::class, 'programa');
    }

    public function programa_favorito(){
        return $this->hasMany(OuvinteDoMes::class, 'programa_favorito');    }
}
