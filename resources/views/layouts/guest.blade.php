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
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
            }
            .auth-card {
                width: 100%;
                max-width: 400px;
                padding: 2rem;
                border-radius: 0.5rem;
                box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
                background-color: #fff;
            }
            .auth-card-header {
                text-align: center;
                margin-bottom: 1.5rem;
            }
            .auth-card-header .app-name-gradient {
                font-size: 2.5rem; /* Adjust size as needed */
                font-weight: 700;
                background: linear-gradient(45deg, #007bff, #00c6ff); /* Blue gradient */
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                color: transparent; /* Fallback for browsers that don't support background-clip */
                display: block;
                margin-bottom: 0.5rem;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="auth-card">
            <div class="auth-card-header">
                <a href="/" class="text-decoration-none">
                    <span class="app-name-gradient">{{ config('app.name', 'EmployeeHub') }}</span>
                </a>
            </div>

            @yield('content')
        </div>

        <!-- Bootstrap JS and Popper.js -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    </body>
</html>
