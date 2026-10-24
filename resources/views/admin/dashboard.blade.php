<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard') - SanA Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tableau de bord administrateur - Plateforme SanA">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS Principal -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        :root {
            --primary-color: #1a365d;
            --secondary-color: #2d5aa0;
            --accent-color: #00b4d8;
            --warning-color: #ff6b35;
            --success-color: #38b2ac;
            --light-color: #f8fafc;
            --dark-color: #2d3748;
            --gray-color: #718096;
            --border-radius: 12px;
            --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: #f0f7ff;
            color: var(--dark-color);
            min-height: 100vh;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, var(--primary-color) 0%, #0f2547 100%);
            color: white;
            padding: 1.5rem 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: var(--transition);
            z-index: 1000;
        }

        .sidebar-header {
            padding: 0 1.5rem 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .logo-icon {
            background: var(--accent-color);
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-menu {
            padding: 1.5rem;
        }

        .nav-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 1rem;
            padding-left: 0.5rem;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .nav-link i {
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 2rem;
            transition: var(--transition);
        }

        /* Top Bar */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .page-title h1 {
            font-size: 1.75rem;
            color: var(--primary-color);
            font-weight: 600;
        }

        .page-title p {
            color: var(--gray-color);
            margin-top: 0.25rem;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .logout-btn {
            background: none;
            border: 1px solid #e2e8f0;
            color: var(--gray-color);
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
        }

        .logout-btn:hover {
            background: #fee;
            color: #c53030;
            border-color: #feb2b2;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .stat-icon.primary { background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); }
        .stat-icon.warning { background: linear-gradient(135deg, #ff6b35, #ff8c42); }
        .stat-icon.success { background: linear-gradient(135deg, #38b2ac, #4fd1c7); }
        .stat-icon.info { background: linear-gradient(135deg, var(--accent-color), #0096c7); }

        .stat-content h3 {
            font-size: 0.875rem;
            color: var(--gray-color);
            margin-bottom: 0.25rem;
        }

        .stat-number {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        /* Alertes Table */
        .section-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-header h2 {
            font-size: 1.25rem;
            color: var(--primary-color);
        }

        .btn {
            padding: 0.75rem 1.25rem;
            border-radius: var(--border-radius);
            border: none;
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(45, 90, 160, 0.3);
        }

        .table-responsive {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            background: #f8fafc;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: var(--dark-color);
            border-bottom: 2px solid #e2e8f0;
        }

        .data-table td {
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .data-table tr:hover {
            background: #f8fafc;
        }

        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
        }

        .badge-warning { background: #fffaf0; color: #dd6b20; }
        .badge-info { background: #ebf8ff; color: #3182ce; }
        .badge-success { background: #f0fff4; color: #38a169; }

        .action-btn {
            padding: 0.375rem 0.75rem;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            background: white;
            color: var(--gray-color);
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.875rem;
        }

        .action-btn:hover {
            background: #f8fafc;
            color: var(--primary-color);
            border-color: var(--secondary-color);
        }

        /* Recent Activity */
        .activity-list {
            list-style: none;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #f0f7ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--secondary-color);
        }

        .activity-content {
            flex: 1;
        }

        .activity-content p {
            margin-bottom: 0.25rem;
        }

        .activity-time {
            font-size: 0.75rem;
            color: var(--gray-color);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar.active {
                transform: translateX(0);
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .top-bar {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .user-menu {
                width: 100%;
                justify-content: space-between;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <div class="logo-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <span>SanA Admin</span>
                </div>
            </div>

            <nav class="nav-menu">
                <div class="nav-title">Menu Principal</div>
                <div class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.alertes.index') }}" class="nav-link">
                        <i class="fas fa-bell"></i>
                        Alertes
                        <span class="badge badge-warning" style="margin-left: auto;">{{ $alertesCount ?? 0 }}</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-users"></i>
                        Utilisateurs
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-chart-bar"></i>
                        Rapports
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cog"></i>
                        Paramètres
                    </a>
                </div>

                <div class="nav-title" style="margin-top: 2rem;">Actions Rapides</div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-plus-circle"></i>
                        Nouvelle alerte
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file-export"></i>
                        Exporter données
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <div class="page-title">
                    <h1>@yield('title', 'Tableau de bord')</h1>
                    <p>Bienvenue dans l'interface d'administration SanA</p>
                </div>

                <div class="user-menu">
                    <div class="user-info">
                        <div class="user-avatar">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div>
                            <div style="font-weight: 500;">{{ Auth::user()->name ?? 'Administrateur' }}</div>
                            <div style="font-size: 0.875rem; color: var(--gray-color);">Administrateur</div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon primary">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Alertes totales</h3>
                        <div class="stat-number">{{ $totalAlertes ?? 0 }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon warning">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-content">
                        <h3>En attente</h3>
                        <div class="stat-number">{{ $pendingAlertes ?? 0 }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon info">
                        <i class="fas fa-spinner"></i>
                    </div>
                    <div class="stat-content">
                        <h3>En cours</h3>
                        <div class="stat-number">{{ $inProgressAlertes ?? 0 }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Résolues</h3>
                        <div class="stat-number">{{ $resolvedAlertes ?? 0 }}</div>
                    </div>
                </div>
            </div>

            <!-- Recent Alertes -->
            <div class="section-card">
                <div class="section-header">
                    <h2>Alertes récentes</h2>
                    <a href="{{ route('admin.alertes.index') }}" class="btn btn-primary">
                        <i class="fas fa-list"></i>
                        Voir toutes
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Produit</th>
                                <th>Déclarant</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentAlertes ?? [] as $alerte)
                            @if($alerte)
                            <tr>
                                <td>#{{ $alerte->numeroSuivi ?? 'N/A' }}</td>
                                <td>{{ $alerte->nomProduit ?? 'N/A' }}</td>
                                <td>{{ $alerte->user->nom ?? 'N/A' }}</td>
                                <td>{{ $alerte->created_at ? $alerte->created_at->format('d/m/Y') : 'N/A' }}</td>
                                <td>
                                    <span class="badge badge-{{ ($alerte->statut ?? '') === 'en attente' ? 'warning' : (($alerte->statut ?? '') === 'en cours' ? 'info' : 'success') }}">
                                        {{ ucfirst($alerte->statut ?? 'inconnu') }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.alertes.show', $alerte->id ?? '#') }}" class="action-btn">
                                        <i class="fas fa-eye"></i>
                                        Voir
                                    </a>
                                </td>
                            </tr>
                            @endif
                            @empty
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 2rem;">
                                    <i class="fas fa-inbox" style="font-size: 2rem; color: #cbd5e0; margin-bottom: 1rem;"></i>
                                    <p>Aucune alerte récente</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="section-card">
                <div class="section-header">
                    <h2>Activité récente</h2>
                </div>
                <ul class="activity-list">
                    @forelse($recentActivities ?? [] as $activity)
                    @if($activity)
                    <li class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-{{ $activity->icon ?? 'bell' }}"></i>
                        </div>
                        <div class="activity-content">
                            <p>{{ $activity->description ?? 'Activité' }}</p>
                            <div class="activity-time">{{ $activity->created_at ? $activity->created_at->diffForHumans() : '--' }}</div>
                        </div>
                    </li>
                    @endif
                    @empty
                    <li class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="activity-content">
                            <p>Aucune activité récente</p>
                            <div class="activity-time">--</div>
                        </div>
                    </li>
                    @endforelse
                </ul>
            </div>

            <!-- Main Content Section -->
            @yield('content')
        </main>
    </div>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            // Menu toggle for mobile
            const menuToggle = document.createElement('button');
            menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
            menuToggle.className = 'menu-toggle';
            menuToggle.style.position = 'fixed';
            menuToggle.style.top = '1rem';
            menuToggle.style.left = '1rem';
            menuToggle.style.zIndex = '1001';
            menuToggle.style.background = 'var(--primary-color)';
            menuToggle.style.color = 'white';
            menuToggle.style.border = 'none';
            menuToggle.style.borderRadius = '8px';
            menuToggle.style.padding = '0.75rem';
            menuToggle.style.cursor = 'pointer';
            menuToggle.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';

            document.body.appendChild(menuToggle);

            const sidebar = document.querySelector('.sidebar');

            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 1024 &&
                    !sidebar.contains(event.target) &&
                    !menuToggle.contains(event.target) &&
                    sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                }
            });

            // Stats animation
            const statNumbers = document.querySelectorAll('.stat-number');
            statNumbers.forEach(stat => {
                const finalNumber = parseInt(stat.textContent);
                let currentNumber = 0;
                const increment = finalNumber / 50;
                const timer = setInterval(() => {
                    currentNumber += increment;
                    if (currentNumber >= finalNumber) {
                        stat.textContent = finalNumber;
                        clearInterval(timer);
                    } else {
                        stat.textContent = Math.floor(currentNumber);
                    }
                }, 30);
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
