@extends('layouts.app')

@section('title', 'Relatórios')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body d-flex flex-column justify-content-center p-5">
                    <h4 class="card-title text-center mb-3">Relatório geral</h4>
                    <p class="text-center text-muted mb-4">
                        Este relatório apresenta os livros agrupados por autor.
                    </p>
                    <form action="{{ route('relatorio') }}" method="POST">
                        @csrf
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Gerar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
