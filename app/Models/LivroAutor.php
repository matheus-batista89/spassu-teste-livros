<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LivroAutor extends Model
{
    protected $table = 'livro_autor';
    protected $primaryKey = 'livro_codL';

    protected $fillable = [
        'livro_codL',
        'autor_codAu'
    ];

    public function livro()
    {
        return $this->belongsTo(Livro::class, 'livro_codL');
    }

    public function autor()
    {
        return $this->belongsTo(Autor::class, 'autor_codAu');
    }
}
