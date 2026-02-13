<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'DRAKE System') }} - @yield('title')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            --drake-primary: #0d6efd;
            --drake-secondary: #6c757d;
            --drake-success: #198754;
            --drake-danger: #dc3545;
            --drake-warning: #ffc107;
            --drake-info: #0dcaf0;
            --drake-dark: #1a1d20;
            --drake-sidebar: #2c3e50;
            --drake-sidebar-hover: #34495e;
        }
        
        body {
            font-size: 0.875rem;
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar-brand {
            padding-top: .75rem;
            padding-bottom: .75rem;
            font-size: 1.25rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
            letter-spacing: 1px;
        }
        
        .navbar-brand i {
            font-size: 1.5rem;
            margin-right: 8px;
        }
        
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            background: var(--drake-sidebar);
            box-shadow: 2px 0 5px rgba(0,0,0,.1);
            width: 250px;
        }
        
        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, .8);
            padding: .75rem 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: var(--drake-sidebar-hover);
            border-left-color: #667eea;
        }
        
        .sidebar .nav-link.active {
            color: #fff;
            background-color: var(--drake-sidebar-hover);
            border-left-color: #667eea;
        }
        
        .sidebar .nav-link i {
            margin-right: 8px;
            width: 20px;
            text-align: center;
        }
        
        .sidebar-heading {
            font-size: .75rem;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .5);
            padding: 1rem 1rem .5rem;
            letter-spacing: 1px;
            font-weight: 600;
        }
        
        main {
            margin-left: 250px;
            padding: 20px 30px;
        }
        
        .page-header {
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e9ecef;
        }
        
        .page-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #2c3e50;
        }
        
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,.08);
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,.12);
            transform: translateY(-2px);
        }
        
        .card-header {
            background-color: #fff;
            border-bottom: 2px solid #f8f9fa;
            font-weight: 600;
            color: #2c3e50;
            padding: 1rem 1.25rem;
        }
        
        .kpi-card {
            border-left: 4px solid;
            transition: all 0.3s ease;
        }
        
        .kpi-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 12px rgba(0,0,0,.15);
        }
        
        .kpi-card.border-primary { border-left-color: var(--drake-primary); }
        .kpi-card.border-warning { border-left-color: var(--drake-warning); }
        .kpi-card.border-info { border-left-color: var(--drake-info); }
        .kpi-card.border-success { border-left-color: var(--drake-success); }
        
        .kpi-card h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
        }
        
        .kpi-card h5 {
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }
        
        .table {
            font-size: 0.875rem;
        }
        
        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            color: #495057;
        }
        
        .table tbody tr {
            transition: background-color 0.2s ease;
        }
        
        .table tbody tr:hover {
            background-color: #f8f9fa;
        }
        
        .btn {
            border-radius: 6px;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,.15);
        }
        
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
            border-radius: 4px;
        }
        
        .alert {
            border: none;
            border-radius: 8px;
            border-left: 4px solid;
        }
        
        .alert-success { border-left-color: var(--drake-success); }
        .alert-danger { border-left-color: var(--drake-danger); }
        .alert-warning { border-left-color: var(--drake-warning); }
        .alert-info { border-left-color: var(--drake-info); }
        
        .navbar-text {
            margin-right: 1rem;
        }
        
        .navbar .nav-link {
            color: rgba(255, 255, 255, .9);
            transition: color 0.3s ease;
        }
        
        .navbar .nav-link:hover {
            color: #fff;
        }
        
        @media (max-width: 767.98px) {
            main {
                margin-left: 0;
            }
            .sidebar {
                display: none;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{ route('dashboard') }}">
            <i class="bi bi-lightning-charge-fill"></i> DRAKE System
        </a>
        <div class="navbar-nav flex-row ms-auto">
            <div class="nav-item text-nowrap d-flex align-items-center">
                <span class="navbar-text text-white px-3">
                    <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                </span>
                <a class="nav-link px-3" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i> Sair
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                    </ul>
                    
                    <h6 class="sidebar-heading">Cadastros</h6>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('companies.*') ? 'active' : '' }}" href="{{ route('companies.index') }}">
                                <i class="bi bi-building"></i> Empresas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('collaborators.*') ? 'active' : '' }}" href="{{ route('collaborators.index') }}">
                                <i class="bi bi-people-fill"></i> Colaboradores
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading">Operações</h6>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('work-schedules.*') ? 'active' : '' }}" href="{{ route('work-schedules.index') }}">
                                <i class="bi bi-calendar-week"></i> Escalas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('trainings.*') ? 'active' : '' }}" href="{{ route('trainings.index') }}">
                                <i class="bi bi-award-fill"></i> Treinamentos
                            </a>
                        </li>
                    </ul>
                    
                    <h6 class="sidebar-heading">Módulos</h6>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-clipboard-check"></i> Compliance
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-truck"></i> Logística
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-person-badge-fill"></i> RH
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-bar-chart-fill"></i> Relatórios
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
                
                <footer class="mt-5 pt-3 border-top text-muted small">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-0">&copy; {{ date('Y') }} DRAKE System - Gestão de Pessoas e Processos</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <p class="mb-0">Versão 1.0 | <a href="#" class="text-decoration-none">Suporte</a></p>
                        </div>
                    </div>
                </footer>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>

            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{ route('dashboard') }}">
            <i class="bi bi-graph-up"></i> DRAKE System
        </a>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <span class="navbar-text text-white px-3">
                    {{ Auth::user()->name }}
                </span>
                <a class="nav-link d-inline px-3" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="bi bi-house-door"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('companies.*') ? 'active' : '' }}" href="{{ route('companies.index') }}">
                                <i class="bi bi-building"></i> Companies
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('collaborators.*') ? 'active' : '' }}" href="{{ route('collaborators.index') }}">
                                <i class="bi bi-people"></i> Collaborators
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('work-schedules.*') ? 'active' : '' }}" href="{{ route('work-schedules.index') }}">
                                <i class="bi bi-calendar3"></i> Work Schedules
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('trainings.*') ? 'active' : '' }}" href="{{ route('trainings.index') }}">
                                <i class="bi bi-award"></i> Trainings
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Modules</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-clipboard-check"></i> Compliance
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-truck"></i> Logistics
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-person-badge"></i> HR
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-gear"></i> Operations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-bar-chart"></i> Reports
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
