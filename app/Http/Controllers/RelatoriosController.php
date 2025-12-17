<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViewLivrosResumo;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\Livros as ServiceLivros;

class RelatoriosController extends Controller
{

    protected $serviceLivros;

    public function __construct(ServiceLivros $serviceLivros)
    {
        $this->serviceLivros = $serviceLivros;
    }

    public function index(Request $request)
    {
        return view('relatorios.index');
    }

    public function relatorio()
    {
        $livros = $this->serviceLivros->getDadosLivrosRelatorioGeral();
        $pdf = Pdf::loadView('relatorios.geral', ['livros' => $livros]);
        $nomeArquivo = "relatorio_livros_geral_" . date('dmYi') .'.pdf';

        return $pdf->download($nomeArquivo);
    }
}
