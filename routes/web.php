<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssuntosController;
use App\Http\Controllers\AutoresController;
use App\Http\Controllers\LivrosController;
use App\Http\Controllers\RelatoriosController;

Route::get('/', function () {
    return view('home.index');
});

// Rotas Assunto
Route::get('/assuntos', [AssuntosController::class, 'index'])->name('assuntos');
Route::match(['get', 'post'], '/novoassunto', [AssuntosController::class, 'novoassunto'])->name('novoassunto');
Route::delete('/deletarassunto', [AssuntosController::class, 'deletar'])->name('deletarassunto');

// Rotas Autor
Route::get('/autores', [AutoresController::class, 'index'])->name('autores');
Route::match(['get', 'post'], '/novoautor', [AutoresController::class, 'novoautor'])->name('novoautor');
Route::delete('/deletarautor', [AutoresController::class, 'deletar'])->name('deletarautor');

// Rotas Livro
Route::get('/livros', [LivrosController::class, 'index'])->name('livros');
Route::match(['get', 'post'], '/novolivro', [LivrosController::class, 'novolivro'])->name('novolivro');
Route::delete('/deletarlivro', [LivrosController::class, 'deletar'])->name('deletarlivro');

// Rotas relatorios
Route::get('/relatorios', [RelatoriosController::class, 'index'])->name('relatorios');
Route::post('/relatorio', [RelatoriosController::class, 'relatorio'])->name('relatorio');
Route::post('/relatorioagrupado', [RelatoriosController::class, 'relatorioagrupado'])->name('relatorioagrupado');
