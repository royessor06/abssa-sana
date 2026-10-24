<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Plateforme officielle de déclaration et suivi d'alertes sanitaires - Agence Béninoise de Sécurité Sanitaire des Aliments">

    <title>@yield('title', 'SanA | Plateforme d\'Alerte Sanitaire')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS Principal -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @stack('styles')
</head>
<body class="flex flex-col min-h-screen">
    <!-- Header -->
    <header class="app-header">
        <div class="header-content">
            <div class="brand">
                <div class="brand-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div class="brand-text">
                    <h1>SanA</h1>
                    <p>Plateforme d'Alerte Sanitaire</p>
                </div>
            </div>

            <div class="gov-logo">
                <img src="{{ asset('img/logo_abssa.jpg') }}" alt="Logo ABSSA">
                <div class="gov-text">
                    <div class="country">République du Bénin</div>
                    <div class="ministry">Ministère de l'Agriculture, de l'Élevage et de la Pêche</div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="app-main">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="app-footer">
        <div class="footer-content">
            <div class="footer-logo">
                <i class="fas fa-shield-alt"></i>
                <span>SanA</span>
            </div>
            <p class="footer-text">
                &copy; {{ date('Y') }} Agence Béninoise de Sécurité Sanitaire des Aliments<br>
                <a href="{{ route('admin.login') }}">Tous droits réservés</a>
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>
