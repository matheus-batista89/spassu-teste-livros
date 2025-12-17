<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Minha Aplicação')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="/">
                <i class="bi bi-book-fill me-2 fs-4"></i>
                <span>Cadastro de Livros</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="/" class="nav-link {{ request()->is('/') ? 'active fw-semibold' : '' }}" title="Home">
                            <i class="bi bi-house-door me-1"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('assuntos*') ? 'active fw-semibold' : '' }}" 
                           href="{{ route('assuntos') }}">
                            <i class="bi bi-tags me-1"></i>
                            <span>Assuntos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('autores*') ? 'active fw-semibold' : '' }}" 
                           href="{{ route('autores') }}">
                            <i class="bi bi-person-badge me-1"></i>
                            <span>Autores</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('livros*') ? 'active fw-semibold' : '' }}" 
                           href="{{ route('livros') }}">
                            <i class="bi bi-book me-1"></i>
                            <span>Livros</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('relatorios*') ? 'active fw-semibold' : '' }}" 
                           href="{{ route('relatorios') }}">
                            <i class="bi bi-file-earmark-text me-1"></i>
                            <span>Relatórios</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @include('layouts.callouts')
        @yield('content')
    </div>

</body>

</html>
