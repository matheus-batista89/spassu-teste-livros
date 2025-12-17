<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Assuntos as AssuntoService;

class AssuntosController extends Controller
{
    protected $serviceAssunto;

    public function __construct(AssuntoService $serviceAssunto)
    {
        $this->serviceAssunto = $serviceAssunto;
    }

    /**
     * Action responsável por fazer a busca de todos os assuntos e retornar-los para a view
     * @param Request $request
     */
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $assuntos = $this->serviceAssunto->get($busca);
        return view('assuntos.assuntos', compact('assuntos', 'busca'));
    }

    /**
     * Action responsável por salvar um novo assunto e editar um assunto existente
     * @param Request $request
     */
    public function novoAssunto(Request $request)
    {
        $codAs = $request->query('codAs');
        $assunto = null;

        if (!empty($codAs)) {
            try {
                $assunto = $this->serviceAssunto->getById($codAs);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', "Assunto com identificador {$codAs} não foi encontrado.");
            }
        }
        if ($request->isMethod('post')) {
            try {
                $request->validate([
                    'descricao' => 'required|string|max:20',
                ]);
                $this->serviceAssunto->save($request->all());

                return redirect()->route('assuntos')->with('success', 'Assunto salvo com sucesso!');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', "Não foi possível salvar o assunto: {$e->getMessage()}");
            }
        }

        return view('assuntos.novoassunto', ['assunto' => $assunto]);
    }

    /**
     * Action responsável por excluir um assunto existente
     * @param Request $request
     */
    public function deletar(Request $request)
    {
        $codAs = $request->query('codAs');
        try {
            $this->serviceAssunto->delete($codAs);
            return redirect()->route('assuntos')->with('success', 'Assunto excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Não foi possível realizar a exclusão: {$e->getMessage()}");
        }
    }
}
