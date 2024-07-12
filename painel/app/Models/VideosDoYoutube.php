<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideosDoYoutube extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'videos_do_youtube';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'autor',
        'titulo_do_video',
        'identificador_do_video',
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
