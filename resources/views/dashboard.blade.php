@extends('layouts.layout')

@section('title', 'SanA | Tableau de bord')

@section('content')
<div class="fade-in">
    <!-- Hero Section -->
    <div class="hero-section">
        <h1 class="hero-title">Service de Déclaration d'Alerte Sanitaire</h1>
        <p class="hero-subtitle">
            Contribuez à la sécurité alimentaire en signalant les produits non conformes
            et suivez le traitement de vos alertes en temps réel.
        </p>
    </div>

    <!-- Services Section -->
    <div class="card p-8 mb-6">
        <h2 class="text-center mb-6">Choisissez un service</h2>

        <div class="services-grid">
            <div class="service-card" onclick="window.location.href='{{ route('alertes.create') }}'">
                <div class="service-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h3>Déclarer une alerte</h3>
                <p>Signalez un problème sanitaire lié à un produit alimentaire en remplissant notre formulaire sécurisé.</p>
                <button class="btn btn-primary btn-lg">
                    <i class="fas fa-arrow-right mr-2"></i>Commencer
                </button>
            </div>

            <div class="service-card" onclick="window.location.href='{{ route('alertes.follow') }}'">
                <div class="service-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3>Suivre une alerte</h3>
                <p>Consultez l'état d'une alerte déjà déclarée en utilisant votre numéro de suivi unique.</p>
                <button class="btn btn-primary btn-lg">
                    <i class="fas fa-arrow-right mr-2"></i>Rechercher
                </button>
            </div>
        </div>
    </div>

    <!-- Information Section -->
    <div class="card p-8">
        <h2 class="mb-4">À propos de notre service</h2>

        <div class="space-y-6">
            <div class="fade-in" style="animation-delay: 100ms">
                <p>
                    <strong>SanA</strong> est la plateforme officielle de l'Agence Béninoise de Sécurité Sanitaire des Aliments
                    (ABSSA) dédiée à la déclaration et au suivi des alertes sanitaires. Notre mission est de garantir
                    la sécurité des consommateurs et la qualité des produits alimentaires sur tout le territoire national.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div class="slide-in" style="animation-delay: 200ms">
                    <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-exclamation-circle text-blue-600"></i>
                            </div>
                            <h3 class="text-lg font-semibold">Déclarer une alerte</h3>
                        </div>
                        <p class="text-gray-600 text-sm">
                            Signalez tout problème sanitaire lié à un produit alimentaire. Notre équipe traitera
                            votre déclaration dans les plus brefs délais et vous tiendra informé de l'avancement.
                        </p>
                    </div>
                </div>

                <div class="slide-in" style="animation-delay: 300ms">
                    <div class="bg-green-50 p-6 rounded-xl border border-green-100">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-search text-green-600"></i>
                            </div>
                            <h3 class="text-lg font-semibold">Suivre une alerte</h3>
                        </div>
                        <p class="text-gray-600 text-sm">
                            Suivez en temps réel l'évolution de votre déclaration grâce à votre numéro de suivi unique.
                            Restez informé des actions entreprises par notre équipe.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="mb-4">Contact et support</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="https://agriculture.gouv.bj/abssa/"
                       target="_blank"
                       class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <i class="fas fa-globe text-blue-600 mr-3"></i>
                        <div>
                            <div class="font-semibold">Site officiel</div>
                            <div class="text-sm text-gray-600">agriculture.gouv.bj/abssa</div>
                        </div>
                    </a>

                    <a href="mailto:abssabenin@yahoo.fr"
                       class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <i class="fas fa-envelope text-blue-600 mr-3"></i>
                        <div>
                            <div class="font-semibold">Email</div>
                            <div class="text-sm text-gray-600">abssabenin@yahoo.fr</div>
                        </div>
                    </a>

                    <a href="https://facebook.com/ABSSABENIN"
                       target="_blank"
                       class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <i class="fab fa-facebook text-blue-600 mr-3"></i>
                        <div>
                            <div class="font-semibold">Facebook</div>
                            <div class="text-sm text-gray-600">ABSSABENIN</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.grid {
    display: grid;
}

.grid-cols-1 {
    grid-template-columns: repeat(1, minmax(0, 1fr));
}

.space-y-6 > * + * {
    margin-top: 1.5rem;
}

@media (min-width: 768px) {
    .md\:grid-cols-2 {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .md\:grid-cols-3 {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }
}

.bg-blue-50 { background-color: #eff6ff; }
.bg-blue-100 { background-color: #dbeafe; }
.text-blue-600 { color: #2563eb; }
.border-blue-100 { border-color: #dbeafe; }

.bg-green-50 { background-color: #f0fdf4; }
.bg-green-100 { background-color: #dcfce7; }
.text-green-600 { color: #16a34a; }
.border-green-100 { border-color: #dcfce7; }

.hover\:bg-gray-100:hover {
    background-color: #f3f4f6;
}

.transition-colors {
    transition: background-color 0.2s ease;
}
</style>
@endsection
