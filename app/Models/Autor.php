<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Autor extends Model
{
    protected $table = 'autor';
    protected $primaryKey = 'codAu';
    use HasFactory;

    protected $fillable = [
        'nome',
    ];

    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'livro_autor');
    }
}
