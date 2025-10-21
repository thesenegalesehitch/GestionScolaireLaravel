<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'BankApp') }} - Application Bancaire</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar-custom {
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }

        .main-content {
            background-color: #ffffff;
            border-radius: 8px;
            margin-top: 20px;
            min-height: calc(100vh - 120px);
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }

        .footer-custom {
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
            color: #6c757d;
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <div class="container-fluid main-content">
        <div class="container py-4">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-custom">
        <div class="container">
            <p class="mb-0">
                <i class="fas fa-code me-2"></i>
                Made by Alexandre Albert Ndour
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
