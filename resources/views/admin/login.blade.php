<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Admin - SanA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Espace d'administration - Plateforme SanA">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS Principal -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /* Styles spécifiques à la page de connexion admin */
        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f0f7ff 0%, #e6f0ff 100%);
            padding: 1rem;
        }

        .login-container {
            width: 100%;
            max-width: 440px;
            animation: fadeIn 0.6s ease-out;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .login-header {
            background: linear-gradient(135deg, #1a365d 0%, #2d5aa0 100%);
            color: white;
            padding: 2.5rem;
            text-align: center;
            position: relative;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ff6b35, #00b4d8);
        }

        .login-icon {
            width: 5rem;
            height: 5rem;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            backdrop-filter: blur(10px);
        }

        .login-title {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            opacity: 0.9;
            font-weight: 300;
            font-size: 0.95rem;
        }

        .login-body {
            padding: 2.5rem;
        }

        .login-form .form-group {
            margin-bottom: 1.5rem;
        }

        .login-form .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #2d3748;
            font-size: 0.9rem;
        }

        .login-form .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            font-size: 0.95rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            background: #f8fafc;
            transition: all 0.25s ease;
            font-family: 'Montserrat', sans-serif;
        }

        .login-form .form-control:focus {
            outline: none;
            border-color: #2d5aa0;
            box-shadow: 0 0 0 3px rgba(45, 90, 160, 0.15);
            background: white;
        }

        .login-form .form-control::placeholder {
            color: #a0aec0;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #718096;
            cursor: pointer;
            padding: 0.25rem;
        }

        .password-toggle:hover {
            color: #2d5aa0;
        }

        .password-input {
            position: relative;
        }

        .login-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #2d5aa0 0%, #1a365d 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(45, 90, 160, 0.3);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .error-message {
            background: linear-gradient(135deg, #fed7d7 0%, #feb2b2 100%);
            border: 1px solid #fc8181;
            color: #c53030;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.9rem;
            animation: slideIn 0.3s ease-out;
        }

        .error-message i {
            font-size: 1.1rem;
        }

        .login-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
            color: #718096;
            font-size: 0.85rem;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #2d5aa0;
            text-decoration: none;
            font-weight: 500;
            margin-top: 1rem;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: #1a365d;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @media (max-width: 480px) {
            .login-header {
                padding: 2rem 1.5rem;
            }

            .login-body {
                padding: 2rem 1.5rem;
            }

            .login-icon {
                width: 4rem;
                height: 4rem;
                font-size: 1.75rem;
            }

            .login-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <div class="login-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <h1 class="login-title">Accès Administrateur</h1>
                <p class="login-subtitle">Plateforme SanA - Sécurité des Aliments</p>
            </div>

            <!-- Body -->
            <div class="login-body">
                @if ($errors->has('login'))
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $errors->first('login') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if (session('success'))
                    <div class="error-message" style="background: linear-gradient(135deg, #c6f6d5 0%, #9ae6b4 100%); border-color: #68d391; color: #22543d;">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit') }}" class="login-form">
                    @csrf

                    <div class="form-group">
                        <label for="username" class="form-label">
                            <i class="fas fa-user mr-1"></i>
                            Nom d'utilisateur
                        </label>
                        <input type="text"
                               id="username"
                               name="username"
                               required
                               class="form-control"
                               placeholder="Entrez votre identifiant"
                               autocomplete="username"
                               autofocus
                               value="{{ old('username') }}">
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-key mr-1"></i>
                            Mot de passe
                        </label>
                        <div class="password-input">
                            <input type="password"
                                   id="password"
                                   name="password"
                                   required
                                   class="form-control"
                                   placeholder="Entrez votre mot de passe"
                                   autocomplete="current-password">
                            <button type="button" class="password-toggle" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="login-btn">
                        <i class="fas fa-sign-in-alt"></i>
                        Se connecter
                    </button>
                </form>

                <div class="login-footer">
                    <p>Accès réservé au personnel autorisé</p>
                    <a href="{{ url('/') }}" class="back-link">
                        <i class="fas fa-arrow-left"></i>
                        Retour à l'accueil public
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

                    // Toggle icon
                    const icon = this.querySelector('i');
                    if (type === 'password') {
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    } else {
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    }
                });
            }

            // Add focus effects
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focused');
                });
            });

            // Form validation
            const form = document.querySelector('.login-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const username = document.getElementById('username');
                    const password = document.getElementById('password');
                    let isValid = true;

                    // Remove previous error styles
                    inputs.forEach(input => {
                        input.classList.remove('error');
                        const errorMsg = input.parentElement.querySelector('.error-text');
                        if (errorMsg) errorMsg.remove();
                    });

                    // Validate username
                    if (!username.value.trim()) {
                        isValid = false;
                        username.classList.add('error');
                        showError(username, "L'identifiant est requis");
                    }

                    // Validate password
                    if (!password.value.trim()) {
                        isValid = false;
                        password.classList.add('error');
                        showError(password, "Le mot de passe est requis");
                    }

                    if (!isValid) {
                        e.preventDefault();

                        // Scroll to first error
                        const firstError = document.querySelector('.error');
                        if (firstError) {
                            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            firstError.focus();
                        }
                    }
                });
            }

            function showError(input, message) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'error-text';
                errorDiv.style.color = '#c53030';
                errorDiv.style.fontSize = '0.85rem';
                errorDiv.style.marginTop = '0.5rem';
                errorDiv.innerHTML = `<i class="fas fa-exclamation-circle mr-1"></i>${message}`;
                input.parentElement.appendChild(errorDiv);
            }

            // Add animation to form elements
            const formGroups = document.querySelectorAll('.form-group');
            formGroups.forEach((group, index) => {
                group.style.opacity = '0';
                group.style.transform = 'translateY(20px)';
                group.style.transition = 'all 0.5s ease';

                setTimeout(() => {
                    group.style.opacity = '1';
                    group.style.transform = 'translateY(0)';
                }, 100 + (index * 100));
            });
        });
    </script>
</body>
</html>
