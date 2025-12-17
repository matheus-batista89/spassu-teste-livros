<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LivroAssunto extends Model
{
    protected $table = 'livro_assunto';
    protected $primaryKey = 'livro_codL';

    protected $fillable = [
        'livro_codL',
        'assunto_codAs'
    ];

    public function livro()
    {
        return $this->belongsTo(Livro::class, 'livro_codL');
    }

    public function assunto()
    {
        return $this->belongsTo(Assunto::class, 'assunto_codAs');
    }
}
