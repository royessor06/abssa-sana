@extends('layouts.layout')

@section('title', 'Suivre une alerte | SanA')

@push('styles')
<style>
/* Page de suivi spécifique */
.tracking-section {
    max-width: 600px;
    margin: 0 auto;
}

.search-card {
    padding: 2.5rem;
    text-align: center;
}

.search-icon {
    width: 5rem;
    height: 5rem;
    background: linear-gradient(135deg, var(--primary-light), var(--accent));
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2rem;
    color: var(--white);
}

.search-form .form-group {
    margin-bottom: 1.5rem;
}

.search-hint {
    margin-top: 1rem;
    font-size: 0.875rem;
    color: var(--gray-600);
    background: var(--gray-100);
    padding: 0.75rem;
    border-radius: var(--radius-md);
    border-left: 3px solid var(--primary-main);
}

/* Alert Details */
.alert-details {
    animation: fadeIn 0.6s ease-out;
}

.alert-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--gray-200);
}

.alert-id {
    font-family: 'Monaco', 'Courier New', monospace;
    background: var(--gray-100);
    padding: 0.5rem 1rem;
    border-radius: var(--radius-md);
    font-size: 0.875rem;
    color: var(--gray-700);
}

.alert-status {
    padding: 0.5rem 1.25rem;
    border-radius: var(--radius-full);
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.status-en_cours {
    background: var(--warning);
    color: var(--white);
}

.status-traitee {
    background: var(--success);
    color: var(--white);
}

.status-enregistree {
    background: var(--info);
    color: var(--white);
}

/* Details Cards */
.details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin: 2rem 0;
}

.detail-card {
    background: var(--gray-50);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    border: 1px solid var(--gray-200);
    transition: transform var(--transition-normal);
}

.detail-card:hover {
    transform: translateY(-4px);
}

.detail-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid var(--gray-200);
}

.detail-header i {
    color: var(--primary-main);
    font-size: 1.25rem;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 0.75rem 0;
    border-bottom: 1px solid var(--gray-200);
}

.detail-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.detail-label {
    font-weight: 600;
    color: var(--gray-700);
    font-size: 0.875rem;
    flex: 1;
}

.detail-value {
    color: var(--gray-900);
    font-weight: 500;
    text-align: right;
    flex: 1;
    margin-left: 1rem;
    word-break: break-word;
}

/* Timeline */
.status-timeline {
    margin: 3rem 0;
    position: relative;
}

.timeline-title {
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.timeline-track {
    position: relative;
    padding-left: 2rem;
}

.timeline-track::before {
    content: '';
    position: absolute;
    left: 7px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: linear-gradient(to bottom, var(--primary-light), var(--accent));
}

.timeline-step {
    position: relative;
    margin-bottom: 2rem;
}

.timeline-step:last-child {
    margin-bottom: 0;
}

.timeline-step::before {
    content: '';
    position: absolute;
    left: -2rem;
    top: 0;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: var(--white);
    border: 3px solid var(--gray-400);
    transition: all var(--transition-normal);
}

.timeline-step.completed::before {
    background: var(--success);
    border-color: var(--success);
    box-shadow: 0 0 0 3px rgba(46, 204, 113, 0.2);
}

.timeline-step.current::before {
    background: var(--primary-main);
    border-color: var(--primary-main);
    box-shadow: 0 0 0 3px rgba(45, 90, 160, 0.3);
    animation: pulse 2s infinite;
}

.timeline-date {
    font-weight: 600;
    color: var(--gray-900);
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.timeline-description {
    color: var(--gray-600);
    font-size: 0.875rem;
    line-height: 1.5;
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(45, 90, 160, 0.4);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(45, 90, 160, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(45, 90, 160, 0);
    }
}

/* Product Photo */
.product-photo-section {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 2px solid var(--gray-200);
}

.photo-container {
    max-width: 400px;
    margin: 1.5rem auto 0;
    text-align: center;
}

.product-photo {
    width: 100%;
    height: auto;
    max-height: 400px;
    object-fit: contain;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--gray-200);
}

.photo-placeholder {
    width: 100%;
    height: 200px;
    background: linear-gradient(135deg, var(--gray-100), var(--gray-200));
    border-radius: var(--radius-lg);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: var(--gray-500);
}

.photo-placeholder i {
    font-size: 3rem;
    margin-bottom: 1rem;
}

/* Responsive */
@media (max-width: 768px) {
    .search-card {
        padding: 2rem 1.5rem;
    }

    .alert-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }

    .details-grid {
        grid-template-columns: 1fr;
    }

    .detail-item {
        flex-direction: column;
        gap: 0.5rem;
        align-items: flex-start;
    }

    .detail-value {
        text-align: left;
        margin-left: 0;
        width: 100%;
    }

    .timeline-track {
        padding-left: 1.5rem;
    }

    .timeline-step::before {
        left: -1.5rem;
    }
}
</style>
@endpush

@section('content')
<div class="fade-in">
    <!-- Search Section -->
    <div class="tracking-section mb-6">
        <div class="card search-card">
            <div class="search-icon">
                <i class="fas fa-search"></i>
            </div>

            <h2 class="mb-4">Suivre une alerte</h2>
            <p class="text-gray-600 mb-6">Entrez votre numéro de suivi pour consulter l'état de votre déclaration</p>

            <form method="POST" action="{{ route('alertes.show') }}" class="search-form">
                @csrf

                <div class="form-group">
                    <label for="numeroSuivi" class="form-label">
                        Numéro de suivi
                        <span class="required">*</span>
                    </label>
                    <input type="text"
                           id="numeroSuivi"
                           name="numeroSuivi"
                           value="{{ old('numeroSuivi') }}"
                           placeholder="SA-{{ date('Y') }}-001234"
                           required
                           class="form-control"
                           autocomplete="off">
                </div>

                @if (session('error'))
                    <div class="alert alert-error mb-4">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success mb-4">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <button type="submit" class="btn btn-primary btn-lg w-full">
                    <i class="fas fa-search mr-2"></i>
                    Rechercher l'alerte
                </button>

                <div class="search-hint mt-4">
                    <i class="fas fa-info-circle mr-2"></i>
                    Votre numéro de suivi vous a été envoyé par email après votre déclaration.
                    Vérifiez votre boîte de réception et vos spams.
                </div>
            </form>
        </div>
    </div>

    <!-- Alert Details (appears after search) -->
    @if(isset($alerte))
    <div class="alert-details">
        <div class="card p-8">
            <!-- Alert Header -->
            <div class="alert-header">
                <div>
                    <h3 class="mb-1">Détails de l'alerte</h3>
                    <div class="alert-id">
                        <i class="fas fa-hashtag mr-1"></i>
                        {{ $alerte->numero_suivi ?? 'SA-' . $alerte->id }}
                    </div>
                </div>
                <div class="alert-status status-{{ $alerte->statut }}">
                    {{ str_replace('_', ' ', $alerte->statut) }}
                </div>
            </div>

            <!-- Details Grid -->
            <div class="details-grid">
                <!-- Personal Information -->
                <div class="detail-card">
                    <div class="detail-header">
                        <i class="fas fa-user-circle"></i>
                        <h4>Informations personnelles</h4>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Nom complet</span>
                        <span class="detail-value">{{ $alerte->nom }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Email</span>
                        <span class="detail-value">{{ $alerte->email }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Téléphone</span>
                        <span class="detail-value">{{ $alerte->numeroTelephone }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Département</span>
                        <span class="detail-value">{{ $alerte->departement }}</span>
                    </div>
                </div>

                <!-- Product Information -->
                <div class="detail-card">
                    <div class="detail-header">
                        <i class="fas fa-shopping-bag"></i>
                        <h4>Informations produit</h4>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Produit</span>
                        <span class="detail-value">{{ $alerte->nomProduit }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Marque</span>
                        <span class="detail-value">{{ $alerte->marqueProduit }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Distributeur</span>
                        <span class="detail-value">{{ $alerte->distributeur }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Matrice</span>
                        <span class="detail-value">{{ $alerte->matrice->libelle ?? 'Non spécifié' }}</span>
                    </div>
                </div>
            </div>

            <!-- Alert Details -->
            <div class="detail-card mt-4">
                <div class="detail-header">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h4>Détails de l'alerte</h4>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Type d'alerte</span>
                    <span class="detail-value">
                        <span class="badge {{ $alerte->type_alerte_id == 1 ? 'badge-danger' : 'badge-warning' }}">
                            {{ $alerte->typeAlerte->nom_alerte ?? 'Non spécifié' }}
                        </span>
                    </span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Motif</span>
                    <span class="detail-value">{{ $alerte->motif }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Date de déclaration</span>
                    <span class="detail-value">{{ $alerte->created_at->format('d/m/Y à H\hi') }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Dernière mise à jour</span>
                    <span class="detail-value">{{ $alerte->updated_at->format('d/m/Y à H\hi') }}</span>
                </div>
            </div>

            <!-- Status Timeline -->
            <div class="status-timeline">
                <h4 class="timeline-title">
                    <i class="fas fa-history"></i>
                    Historique du statut
                </h4>

                <div class="timeline-track">
                    <!-- Step 1: Registered -->
                    <div class="timeline-step completed">
                        <div class="timeline-date">
                            {{ $alerte->created_at->format('d/m/Y') }}
                        </div>
                        <div class="timeline-description">
                            Déclaration enregistrée avec succès. Votre alerte a été transmise à notre équipe.
                        </div>
                    </div>

                    <!-- Step 2: In Progress or Completed -->
                    <div class="timeline-step {{ $alerte->statut == 'traitee' ? 'completed' : 'current' }}">
                        <div class="timeline-date">
                            @if($alerte->statut == 'traitee')
                                {{ $alerte->updated_at->format('d/m/Y') }}
                            @else
                                En cours
                            @endif
                        </div>
                        <div class="timeline-description">
                            @if($alerte->statut == 'en_cours')
                                Notre équipe examine actuellement votre déclaration. Nous vous tiendrons informé des prochaines étapes.
                            @elseif($alerte->statut == 'traitee')
                                L'alerte a été traitée. Les actions correctives nécessaires ont été mises en œuvre.
                            @else
                                Analyse en cours par nos experts en sécurité alimentaire.
                            @endif
                        </div>
                    </div>

                    <!-- Step 3: Completed (only if treated) -->
                    @if($alerte->statut == 'traitee')
                    <div class="timeline-step completed">
                        <div class="timeline-date">
                            Traitement terminé
                        </div>
                        <div class="timeline-description">
                            Le dossier a été clôturé. Vous pouvez nous contacter pour plus d'informations si nécessaire.
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Product Photo -->
            <div class="product-photo-section">
                <h4 class="mb-2">
                    <i class="fas fa-camera"></i>
                    Photo du produit
                </h4>

                @if($alerte->photoProduit)
                <div class="photo-container">
                    <img src="{{ asset('storage/' . $alerte->photoProduit) }}"
                         alt="Photo du produit {{ $alerte->nomProduit }}"
                         class="product-photo"
                         onerror="this.onerror=null; this.src='data:image/svg+xml;charset=UTF-8,%3Csvg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 300 200\"%3E%3Crect width=\"300\" height=\"200\" fill=\"%23f0f0f0\"/%3E%3Ctext x=\"50%\" y=\"50%\" font-family=\"Arial\" font-size=\"16\" text-anchor=\"middle\" fill=\"%23999\"%3EImage non disponible%3C/text%3E%3C/svg%3E'">
                </div>
                @else
                <div class="photo-placeholder">
                    <i class="fas fa-image"></i>
                    <p>Aucune photo disponible</p>
                </div>
                @endif
            </div>

            <!-- Contact Information -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h5 class="mb-3">Besoin d'assistance ?</h5>
                <div class="flex flex-wrap gap-3">
                    <a href="mailto:abssabenin@yahoo.fr" class="btn btn-secondary">
                        <i class="fas fa-envelope mr-2"></i>
                        Nous contacter
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-home mr-2"></i>
                        Retour à l'accueil
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const searchForm = document.querySelector('.search-form');
    const numeroSuiviInput = document.getElementById('numeroSuivi');

    if (searchForm && numeroSuiviInput) {
        searchForm.addEventListener('submit', function(e) {
            if (!numeroSuiviInput.value.trim()) {
                e.preventDefault();

                // Add error styling
                numeroSuiviInput.classList.add('error');
                numeroSuiviInput.focus();

                // Add error message
                const errorDiv = document.createElement('div');
                errorDiv.className = 'alert alert-error mt-2';
                errorDiv.innerHTML = '<i class="fas fa-exclamation-circle mr-2"></i>Veuillez entrer un numéro de suivi valide';

                // Remove existing error if any
                const existingError = searchForm.querySelector('.alert-error');
                if (existingError) {
                    existingError.remove();
                }

                searchForm.insertBefore(errorDiv, searchForm.querySelector('.search-hint'));
            }
        });

        // Clear error on input
        numeroSuiviInput.addEventListener('input', function() {
            this.classList.remove('error');
            const errorDiv = searchForm.querySelector('.alert-error');
            if (errorDiv) {
                errorDiv.remove();
            }
        });
    }

    // If alert details are shown, scroll to them
    @if(isset($alerte))
    setTimeout(() => {
        const alertDetails = document.querySelector('.alert-details');
        if (alertDetails) {
            alertDetails.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }, 100);
    @endif
});
</script>
@endpush

@endsection
