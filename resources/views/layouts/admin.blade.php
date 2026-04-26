<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Painel Atlas')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/views/portfolio/admin.css'])
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"><i class="bi bi-list"></i></a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <a href="{{ route('home') }}" class="nav-link">Portal de vagas</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    <li class="nav-item d-none d-md-block">
                        <span class="nav-link text-muted">{{ auth()->user()?->email }}</span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary btn-sm">Sair</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <div class="sidebar-brand">
                <a href="{{ route('dashboard.home') }}" class="brand-link text-decoration-none">
                    <span class="brand-image admin-brand-mark">AR</span>
                    <span class="brand-text fw-light">Atlas Recruta</span>
                </a>
            </div>
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.home') }}" class="nav-link {{ request()->routeIs('dashboard.home') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-speedometer2"></i>
                                <p>Visao geral</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.vacancies.create') }}" class="nav-link {{ request()->routeIs('dashboard.vacancies.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-kanban"></i>
                                <p>Gerenciar vagas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">
                                <i class="nav-icon bi bi-briefcase"></i>
                                <p>Portal publico</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h1 class="mb-0">@yield('page_title', 'Painel Atlas')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@yield('page_title', 'Painel Atlas')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid pb-4">
                    @if (session('dashboard_feedback'))
                        <div class="feedback-banner" role="status">
                            <div>
                                <strong>Atualizacao concluida</strong>
                                <p class="mb-0">{{ session('dashboard_feedback') }}</p>
                            </div>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </main>

        <footer class="app-footer">
            <strong>Atlas Recruta</strong>
            <span class="float-end d-none d-sm-inline">Painel administrativo com AdminLTE</span>
        </footer>
    </div>
</body>
</html>