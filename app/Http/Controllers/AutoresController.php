<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Autores as ServiceAutores;

class AutoresController extends Controller
{

    protected $serviceAutores;

    public function __construct(ServiceAutores $serviceAutores) 
    {
        $this->serviceAutores = $serviceAutores;
    }

    /**
     * Action responsável por fazer a busca de todos os autores e retornar-los para a view
     * @param Request $request
     */
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $autores = $this->serviceAutores->get($busca);
        return view('autores.autores', compact('autores', 'busca'));
    }

    /**
     * Action responsável por salvar um novo autor e editar um autor existente
     * @param Request $request
     */
    public function novoautor(Request $request)
    {
        $codAu = $request->query('codAu');
        $autor = null;

        if (!empty($codAu)) {
            try {
                $autor = $this->serviceAutores->getById($codAu);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', "Autor com identificador {$codAu} não foi encontrado.");
            }
        }
        if ($request->isMethod('post')) {
            try {
                $request->validate([
                    'nome' => 'required|string|max:40',
                ]);
                $this->serviceAutores->save($request->all());

                return redirect()->route('autores')->with('success', 'Autor salvo com sucesso!');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', "Não foi possível salvar o autor: {$e->getMessage()}");
            }
        }

        return view('autores.novoautor', ['autor' => $autor]);
    }

    /**
     * Action responsável por excluir um autor existente
     * @param Request $request
     */
    public function deletar(Request $request)
    {
        $codAs = $request->query('codAu');
        try {
            $this->serviceAutores->delete($codAs);
            return redirect()->route('autores')->with('success', 'Autor excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Não foi possível realizar a exclusão:  {$e->getMessage()}");
        }
    }
}
