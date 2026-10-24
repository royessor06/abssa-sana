@extends('admin.layout')

@section('title', 'Détails de l\'alerte #' . $alerte->numeroSuivi)

@section('page-title', 'Détails de l\'alerte')

@section('page-actions')
    <a href="{{ route('admin.alertes.index') }}" class="btn" style="background: #718096; color: white;">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
@endsection

@section('page-content')
    <div class="alerte-details-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">

        <!-- Informations du déclarant -->
        <div class="detail-card" style="background: white; border-radius: var(--border-radius); padding: 1.5rem; box-shadow: var(--box-shadow);">
            <h3 style="display: flex; align-items: center; gap: 0.5rem; color: var(--primary-color); margin-bottom: 1rem;">
                <i class="fas fa-user-circle"></i>
                Informations du déclarant
            </h3>
            <div class="info-list">
                <div class="info-item" style="margin-bottom: 0.75rem;">
                    <div style="font-weight: 500; color: var(--gray-color); font-size: 0.875rem;">Nom</div>
                    <div>{{ $alerte->user->nom ?? 'N/A' }}</div>
                </div>
                <div class="info-item" style="margin-bottom: 0.75rem;">
                    <div style="font-weight: 500; color: var(--gray-color); font-size: 0.875rem;">Email</div>
                    <div>{{ $alerte->user->email ?? 'N/A' }}</div>
                </div>
                <div class="info-item" style="margin-bottom: 0.75rem;">
                    <div style="font-weight: 500; color: var(--gray-color); font-size: 0.875rem;">Téléphone</div>
                    <div>{{ $alerte->user->numeroTelephone ?? 'N/A' }}</div>
                </div>
                <div class="info-item">
                    <div style="font-weight: 500; color: var(--gray-color); font-size: 0.875rem;">Adresse</div>
                    <div>{{ $alerte->user->adresse ?? 'N/A' }}</div>
                </div>
            </div>
        </div>

        <!-- Produit concerné -->
        <div class="detail-card" style="background: white; border-radius: var(--border-radius); padding: 1.5rem; box-shadow: var(--box-shadow);">
            <h3 style="display: flex; align-items: center; gap: 0.5rem; color: var(--primary-color); margin-bottom: 1rem;">
                <i class="fas fa-box"></i>
                Produit concerné
            </h3>
            <div class="info-list">
                <div class="info-item" style="margin-bottom: 0.75rem;">
                    <div style="font-weight: 500; color: var(--gray-color); font-size: 0.875rem;">Nom</div>
                    <div>{{ $alerte->nomProduit }}</div>
                </div>
                <div class="info-item" style="margin-bottom: 0.75rem;">
                    <div style="font-weight: 500; color: var(--gray-color); font-size: 0.875rem;">Marque</div>
                    <div>{{ $alerte->marqueProduit }}</div>
                </div>
                <div class="info-item" style="margin-bottom: 0.75rem;">
                    <div style="font-weight: 500; color: var(--gray-color); font-size: 0.875rem;">Distributeur</div>
                    <div>{{ $alerte->distributeur }}</div>
                </div>
                <div class="info-item">
                    <div style="font-weight: 500; color: var(--gray-color); font-size: 0.875rem;">Matrice</div>
                    <div>{{ $alerte->matrice->libelle ?? 'N/A' }}</div>
                </div>
                @if($alerte->photoProduit)
                <div class="info-item" style="margin-top: 1rem;">
                    <div style="font-weight: 500; color: var(--gray-color); font-size: 0.875rem;">Photo</div>
                    <img src="{{ asset('storage/' . $alerte->photoProduit) }}"
                         alt="Photo du produit"
                         style="max-width: 200px; border-radius: 8px; margin-top: 0.5rem;">
                </div>
                @endif
            </div>
        </div>

        <!-- Détails de l'alerte -->
        <div class="detail-card" style="background: white; border-radius: var(--border-radius); padding: 1.5rem; box-shadow: var(--box-shadow); grid-column: span 2;">
            <h3 style="display: flex; align-items: center; gap: 0.5rem; color: var(--primary-color); margin-bottom: 1rem;">
                <i class="fas fa-exclamation-triangle"></i>
                Détails de l'alerte
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                <div class="info-item">
                    <div style="font-weight: 500; color: var(--gray-color); font-size: 0.875rem;">Numéro de suivi</div>
                    <div style="font-weight: 600; color: var(--primary-color); font-size: 1.125rem;">
                        #{{ $alerte->numeroSuivi }}
                    </div>
                </div>
                <div class="info-item">
                    <div style="font-weight: 500; color: var(--gray-color); font-size: 0.875rem;">Type d'alerte</div>
                    <div>{{ $alerte->typeAlerte->nom_alerte ?? 'Non défini' }}</div>
                </div>
                <div class="info-item">
                    <div style="font-weight: 500; color: var(--gray-color); font-size: 0.875rem;">Département</div>
                    <div>{{ $alerte->departement }}</div>
                </div>
                <div class="info-item">
                    <div style="font-weight: 500; color: var(--gray-color); font-size: 0.875rem;">Date de création</div>
                    <div>{{ $alerte->created_at->format('d/m/Y H:i') }}</div>
                </div>

                <!-- Statut avec édition -->
                <div class="info-item">
                    <div style="font-weight: 500; color: var(--gray-color); font-size: 0.875rem;">Statut</div>
                    @if(request('edit_statut') !== '1')
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span class="badge badge-{{ $alerte->statut === 'en attente' ? 'warning' : ($alerte->statut === 'en cours' ? 'info' : 'success') }}"
                                  style="font-size: 0.875rem;">
                                {{ ucfirst($alerte->statut) }}
                            </span>
                            <a href="{{ route('admin.alertes.show', $alerte->id) }}?edit_statut=1"
                               class="action-btn"
                               style="font-size: 0.75rem;">
                                <i class="fas fa-edit"></i>
                                Modifier
                            </a>
                        </div>
                    @else
                        <form action="{{ route('admin.alertes.updateStatut', $alerte->id) }}"
                              method="POST"
                              style="display: flex; align-items: center; gap: 0.5rem;">
                            @csrf
                            @method('PUT')
                            <select name="statut"
                                    id="statut"
                                    style="padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 6px; font-family: inherit;">
                                <option value="en attente" {{ $alerte->statut === 'en attente' ? 'selected' : '' }}>En attente</option>
                                <option value="en cours" {{ $alerte->statut === 'en cours' ? 'selected' : '' }}>En cours</option>
                                <option value="terminée" {{ $alerte->statut === 'terminée' ? 'selected' : '' }}>Terminée</option>
                            </select>
                            <button type="submit"
                                    class="action-btn"
                                    style="background: var(--success-color); color: white; border: none;">
                                <i class="fas fa-check"></i>
                                Enregistrer
                            </button>
                            <a href="{{ route('admin.alertes.show', $alerte->id) }}"
                               class="action-btn"
                               style="background: #718096; color: white; border: none;">
                                Annuler
                            </a>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Motif -->
            <div class="info-item" style="margin-top: 1.5rem;">
                <div style="font-weight: 500; color: var(--gray-color); font-size: 0.875rem; margin-bottom: 0.5rem;">Motif</div>
                <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; white-space: pre-line;">
                    {{ $alerte->motif }}
                </div>
            </div>
        </div>

        <!-- Historique des actions -->
        <div class="detail-card" style="background: white; border-radius: var(--border-radius); padding: 1.5rem; box-shadow: var(--box-shadow); grid-column: span 2;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h3 style="display: flex; align-items: center; gap: 0.5rem; color: var(--primary-color); margin: 0;">
                    <i class="fas fa-history"></i>
                    Historique des actions
                </h3>
                <a href="{{ route('admin.actions.create', $alerte->id) }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i>
                    Ajouter une action
                </a>
            </div>

            @if($alerte->actions->isEmpty())
                <div style="text-align: center; padding: 3rem; color: var(--gray-color);">
                    <i class="fas fa-clipboard-list" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                    <p>Aucune action enregistrée pour cette alerte.</p>
                </div>
            @else
                <div class="timeline" style="position: relative; padding-left: 2rem;">
                    @foreach($alerte->actions as $action)
                        <div class="timeline-item" style="position: relative; margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0;">
                            <div class="timeline-marker" style="position: absolute; left: -2rem; top: 0.25rem; width: 16px; height: 16px; border-radius: 50%; background: var(--secondary-color);"></div>
                            <div class="timeline-content">
                                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.5rem;">
                                    <div>
                                        <h4 style="font-weight: 600; color: var(--dark-color); margin-bottom: 0.25rem;">
                                            {{ $action->intitule }}
                                        </h4>
                                        <div style="color: var(--gray-color); font-size: 0.875rem;">
                                            Ajouté le {{ $action->created_at->format('d/m/Y à H:i') }}
                                        </div>
                                    </div>
                                    <div>
                                        <a href="#" class="action-btn">
                                            <i class="fas fa-edit"></i>
                                            Modifier
                                        </a>
                                    </div>
                                </div>
                                <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; margin-top: 0.5rem;">
                                    {{ $action->detail }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
@endsection

@push('styles')
<style>
    @media (max-width: 768px) {
        .alerte-details-grid {
            grid-template-columns: 1fr !important;
        }

        .detail-card {
            grid-column: span 1 !important;
        }
    }
</style>
@endpush
