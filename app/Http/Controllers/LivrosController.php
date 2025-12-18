<?php

namespace App\Http\Controllers;

use App\DTO\LivroDTO;
use Illuminate\Http\Request;
use App\Services\Livros as ServiceLivros;
use App\Services\Autores as ServiceAutores;
use App\Services\Assuntos as ServiceAssuntos;

class LivrosController extends Controller
{

    protected $serviceLivros;
    protected $serviceAutores;
    protected $serviceAssuntos;

    public function __construct(
        ServiceLivros $serviceLivros,
        ServiceAutores $serviceAutores,
        ServiceAssuntos $serviceAssuntos
    ) {
        $this->serviceLivros = $serviceLivros;
        $this->serviceAutores = $serviceAutores;
        $this->serviceAssuntos = $serviceAssuntos;
    }

    /**
     * Action responsável por fazer a busca de todos os livros e retornar-los para a view
     * @param Request $request
     */
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $livros = $this->serviceLivros->get($busca);
        return view('livros.livros', compact('livros', 'busca'));
    }

    /**
     * Action responsável por salvar um novo livro e editar um livro existente
     * @param Request $request
     */
    public function novolivro(Request $request)
    {
        $codL = $request->query('codL');
        $livro = null;

        if (!empty($codL)) {
            try {
                $livro = $this->serviceLivros->getById($codL);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', "Livro com identificador {$codL} não foi encontrado.");
            }
        }
        if ($request->isMethod('post')) {
            try {
                $livroDTO = LivroDTO::fromRequest($request);
                $this->serviceLivros->save($livroDTO);
                return redirect()->route('livros')->with('success', 'Livro salvo com sucesso!');
            } catch (\Illuminate\Validation\ValidationException $e) {
                return redirect()->back()->withErrors($e->errors())->withInput();
            } catch (\Exception $e) {
                return redirect()->back()->with('error', "Não foi possível salvar o livro: {$e->getMessage()}");
            }
        }
        $autores = $this->serviceAutores->get();
        $assuntos = $this->serviceAssuntos->get();
        // dd($livro);
        return view('livros.novolivro', ['livro' => $livro, 'autores' => $autores, 'assuntos' => $assuntos]);
    }

    /**
     * Action responsável por excluir um livro existente
     * @param Request $request
     */
    public function deletar(Request $request)
    {
        $codL = $request->query('codL');
        try {
            $this->serviceLivros->deleteLivro($codL);
            return redirect()->route('livros')->with('success', 'Livro excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Não foi possível excluir o livro: {$e->getMessage()}");
        }
    }
}
