<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EmployeeHub') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f4f7f6;
        }
        #wrapper {
            display: flex;
        }
        #sidebar-wrapper {
            min-width: 250px;
            max-width: 250px;
            background-color: #343a40;
            color: #fff;
            transition: all 0.3s;
            height: 100vh;
            position: sticky;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        #sidebar-wrapper .sidebar-heading {
            padding: 1.5rem 1rem;
            font-size: 1.2rem;
            background-color: #212529;
            text-align: center;
        }
        #sidebar-wrapper .list-group {
            width: 100%;
        }
        #sidebar-wrapper .list-group-item {
            background-color: #343a40;
            color: #adb5bd;
            border: none;
            padding: 0.75rem 1.25rem;
            transition: all 0.2s;
        }
        #sidebar-wrapper .list-group-item:hover {
            background-color: #495057;
            color: #fff;
        }
        #sidebar-wrapper .list-group-item.active {
            background-color: #007bff;
            color: #fff;
        }
        #page-content-wrapper {
            flex-grow: 1;
            padding: 20px;
        }
        .navbar {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0,0,0,.04);
        }
        .card {
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn {
            border-radius: 0.3rem;
        }
        .form-control, .form-select {
            border-radius: 0.3rem;
        }
        .badge {
            padding: 0.5em 0.7em;
            border-radius: 0.3rem;
            font-weight: normal;
        }
        .alert {
            border-radius: 0.5rem;
        }
        .modal-content {
            border-radius: 0.5rem;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading">EmployeeHub</div>
            <div class="list-group list-group-flush">
                <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action @if(request()->routeIs('dashboard')) active @endif">
                    <i class="bi bi-grid-fill me-2"></i> Dashboard
                </a>
                <a href="{{ route('employees.index') }}" class="list-group-item list-group-item-action @if(request()->routeIs('employees.*')) active @endif">
                    <i class="bi bi-people-fill me-2"></i> Employees
                </a>
                <!-- Admin specific menu items -->
                @if(Auth::check() && Auth::user()->isAdmin())
                    <a href="{{ route('departments.index') }}" class="list-group-item list-group-item-action @if(request()->routeIs('departments.*')) active @endif">
                        <i class="bi bi-building-fill me-2"></i> Departments
                    </a>
                @endif
                {{-- Removed "Roles" and "Settings" buttons --}}
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-primary d-lg-none" id="sidebarToggle">
                        <i class="bi bi-list"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-person-circle me-1"></i>
                                    @auth
                                        {{ Auth::user()->name }}
                                        @if(Auth::user()->role)
                                            <span class="badge bg-info ms-2">{{ ucfirst(Auth::user()->role) }}</span>
                                        @endif
                                    @else
                                        Guest
                                    @endauth
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</a>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container-fluid mt-4">
                @yield('content')
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

    <!-- Custom JS for sidebar toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var sidebarToggle = document.getElementById('sidebarToggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    document.getElementById('wrapper').classList.toggle('toggled');
                });
            }
        });
    </script>
</body>
</html>
