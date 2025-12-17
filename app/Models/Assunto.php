<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Assunto extends Model
{
    protected $table = 'assunto';
    protected $primaryKey = 'codAs';
    use HasFactory;

    protected $fillable = [
        'descricao',
    ];

    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'livro_assunto');
    }
}
