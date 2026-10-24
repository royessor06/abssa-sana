@extends('admin.dashboard')

@section('title', 'Gestion des Alertes')

@section('page-title', 'Gestion des Alertes')

@section('page-actions')
    <div style="display: flex; gap: 0.75rem;">
        <button type="button" class="btn btn-primary" id="filterToggle" style="background: #718096; color: white; border: none;">
            <i class="fas fa-filter"></i> Filtres
        </button>
        <a href="#" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Nouvelle Alerte
        </a>
        <a href="#" class="btn" style="background: #38b2ac; color: white; border: none;">
            <i class="fas fa-file-export"></i> Exporter
        </a>
    </div>
@endsection

@section('page-content')
    <!-- Filtres -->
    <div id="filterPanel" style="background: white; border-radius: var(--border-radius); padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: var(--box-shadow); display: none;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: var(--gray-color);">Statut</label>
                <select class="form-control" style="width: 100%; padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 6px;">
                    <option value="">Tous les statuts</option>
                    <option value="en attente">En attente</option>
                    <option value="en cours">En cours</option>
                    <option value="terminée">Terminée</option>
                </select>
            </div>
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: var(--gray-color);">Type</label>
                <select class="form-control" style="width: 100%; padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 6px;">
                    <option value="">Tous les types</option>
                    @foreach($typesAlerte ?? [] as $type)
                        <option value="{{ $type->id }}">{{ $type->nom_alerte }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: var(--gray-color);">Date de</label>
                <input type="date" class="form-control" style="width: 100%; padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 6px;">
            </div>
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: var(--gray-color);">Date à</label>
                                <input type="date" class="form-control" style="width: 100%; padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 6px;">
            </div>
        </div>
        <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">
            <button type="button" class="btn" style="background: #e2e8f0; color: var(--dark-color);" onclick="resetFilters()">
                <i class="fas fa-redo"></i> Réinitialiser
            </button>
            <button type="button" class="btn btn-primary">
                <i class="fas fa-search"></i> Appliquer
            </button>
        </div>
    </div>

    <!-- Stats rapides -->
    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
        <div style="background: white; padding: 1rem; border-radius: var(--border-radius); box-shadow: var(--box-shadow); text-align: center;">
            <div style="font-size: 0.875rem; color: var(--gray-color); margin-bottom: 0.5rem;">Total</div>
            <div style="font-size: 1.5rem; font-weight: 600; color: var(--primary-color);">{{ $alertes->total() }}</div>
        </div>
        <div style="background: white; padding: 1rem; border-radius: var(--border-radius); box-shadow: var(--box-shadow); text-align: center;">
            <div style="font-size: 0.875rem; color: var(--gray-color); margin-bottom: 0.5rem;">En attente</div>
            <div style="font-size: 1.5rem; font-weight: 600; color: #dd6b20;">{{ $pendingCount ?? 0 }}</div>
        </div>
        <div style="background: white; padding: 1rem; border-radius: var(--border-radius); box-shadow: var(--box-shadow); text-align: center;">
            <div style="font-size: 0.875rem; color: var(--gray-color); margin-bottom: 0.5rem;">En cours</div>
            <div style="font-size: 1.5rem; font-weight: 600; color: #3182ce;">{{ $inProgressCount ?? 0 }}</div>
        </div>
        <div style="background: white; padding: 1rem; border-radius: var(--border-radius); box-shadow: var(--box-shadow); text-align: center;">
            <div style="font-size: 0.875rem; color: var(--gray-color); margin-bottom: 0.5rem;">Terminées</div>
            <div style="font-size: 1.5rem; font-weight: 600; color: #38a169;">{{ $resolvedCount ?? 0 }}</div>
        </div>
    </div>

    <!-- Tableau des alertes -->
    <div class="section-card" style="background: white; border-radius: var(--border-radius); box-shadow: var(--box-shadow); overflow: hidden;">
        <div class="table-responsive">
            <table class="data-table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                        <th style="padding: 1rem; text-align: left; font-weight: 600; color: var(--dark-color);">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-hashtag"></i>
                                ID
                            </div>
                        </th>
                        <th style="padding: 1rem; text-align: left; font-weight: 600; color: var(--dark-color);">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-box"></i>
                                Produit
                            </div>
                        </th>
                        <th style="padding: 1rem; text-align: left; font-weight: 600; color: var(--dark-color);">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-user"></i>
                                Déclarant
                            </div>
                        </th>
                        <th style="padding: 1rem; text-align: left; font-weight: 600; color: var(--dark-color);">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-tag"></i>
                                Type
                            </div>
                        </th>
                        <th style="padding: 1rem; text-align: left; font-weight: 600; color: var(--dark-color);">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-chart-line"></i>
                                Statut
                            </div>
                        </th>
                        <th style="padding: 1rem; text-align: left; font-weight: 600; color: var(--dark-color);">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-calendar"></i>
                                Date
                            </div>
                        </th>
                        <th style="padding: 1rem; text-align: left; font-weight: 600; color: var(--dark-color);">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-cogs"></i>
                                Actions
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alertes as $alerte)
                        <tr style="border-bottom: 1px solid #e2e8f0; transition: background-color 0.2s ease;">
                            <td style="padding: 1rem;">
                                <div style="font-weight: 500; color: var(--primary-color);">#{{ $alerte->numeroSuivi ?? $alerte->id }}</div>
                            </td>
                            <td style="padding: 1rem;">
                                <div style="font-weight: 500; color: var(--dark-color);">{{ $alerte->nomProduit }}</div>
                                <div style="font-size: 0.875rem; color: var(--gray-color); margin-top: 0.25rem;">
                                    {{ $alerte->marqueProduit }}
                                </div>
                            </td>
                            <td style="padding: 1rem;">
                                <div style="font-weight: 500;">{{ $alerte->user->nom ?? 'N/A' }}</div>
                                <div style="font-size: 0.875rem; color: var(--gray-color); margin-top: 0.25rem;">
                                    {{ $alerte->user->email ?? '' }}
                                </div>
                            </td>
                            <td style="padding: 1rem;">
                                <div style="display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.25rem 0.75rem; background: #f0f7ff; border-radius: 6px; font-size: 0.875rem;">
                                    <i class="fas fa-{{ $alerte->typeAlerte->icon ?? 'exclamation-circle' }}"></i>
                                    {{ $alerte->typeAlerte->nom_alerte ?? 'Non défini' }}
                                </div>
                            </td>
                            <td style="padding: 1rem;">
                                <span class="badge badge-{{ $alerte->statut === 'en attente' ? 'warning' : ($alerte->statut === 'en cours' ? 'info' : 'success') }}"
                                      style="padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600; display: inline-block;">
                                    <i class="fas fa-{{ $alerte->statut === 'en attente' ? 'clock' : ($alerte->statut === 'en cours' ? 'spinner' : 'check-circle') }} mr-1"></i>
                                    {{ ucfirst($alerte->statut) }}
                                </span>
                            </td>
                            <td style="padding: 1rem;">
                                <div style="font-weight: 500;">{{ $alerte->created_at->format('d/m/Y') }}</div>
                                <div style="font-size: 0.875rem; color: var(--gray-color);">{{ $alerte->created_at->format('H:i') }}</div>
                            </td>
                            <td style="padding: 1rem;">
                                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                    <a href="{{ route('alertes.show', $alerte->id) }}"
                                       class="action-btn"
                                       style="padding: 0.375rem 0.75rem; border-radius: 6px; border: 1px solid #e2e8f0; background: white; color: var(--gray-color); text-decoration: none; display: inline-flex; align-items: center; gap: 0.25rem; font-size: 0.875rem; transition: all 0.2s ease;">
                                        <i class="fas fa-eye"></i>
                                        Voir
                                    </a>
                                    <a href="#"
                                       class="action-btn"
                                       style="padding: 0.375rem 0.75rem; border-radius: 6px; border: 1px solid #e2e8f0; background: white; color: var(--gray-color); text-decoration: none; display: inline-flex; align-items: center; gap: 0.25rem; font-size: 0.875rem; transition: all 0.2s ease;">
                                        <i class="fas fa-edit"></i>
                                        Éditer
                                    </a>
                                    <form action="#"
                                          method="POST"
                                          style="display: inline;"
                                          onsubmit="return confirmDelete(event)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="action-btn"
                                                style="padding: 0.375rem 0.75rem; border-radius: 6px; border: 1px solid #fee2e2; background: #fee; color: #dc2626; cursor: pointer; display: inline-flex; align-items: center; gap: 0.25rem; font-size: 0.875rem; transition: all 0.2s ease;">
                                            <i class="fas fa-trash-alt"></i>
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="padding: 3rem; text-align: center; color: var(--gray-color);">
                                <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                                <p style="font-size: 1.125rem; margin-bottom: 0.5rem;">Aucune alerte trouvée</p>
                                <p style="font-size: 0.875rem;">Commencez par créer votre première alerte</p>
                                <a href="{{ route('alertes.create') }}" class="btn btn-primary" style="margin-top: 1rem;">
                                    <i class="fas fa-plus-circle"></i>
                                    Créer une alerte
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($alertes->hasPages())
            <div style="padding: 1.5rem; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                <div style="font-size: 0.875rem; color: var(--gray-color);">
                    Affichage de {{ $alertes->firstItem() ?? 0 }} à {{ $alertes->lastItem() ?? 0 }} sur {{ $alertes->total() }} alertes
                </div>
                <div style="display: flex; gap: 0.5rem;">
                    @if($alertes->onFirstPage())
                        <span style="padding: 0.5rem 1rem; background: #f8fafc; color: #cbd5e0; border-radius: 6px; cursor: not-allowed;">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $alertes->previousPageUrl() }}"
                           style="padding: 0.5rem 1rem; background: white; color: var(--primary-color); border: 1px solid #e2e8f0; border-radius: 6px; text-decoration: none; transition: all 0.2s ease;">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    @foreach($alertes->getUrlRange(1, $alertes->lastPage()) as $page => $url)
                        @if($page == $alertes->currentPage())
                            <span style="padding: 0.5rem 1rem; background: var(--primary-color); color: white; border-radius: 6px; font-weight: 500;">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               style="padding: 0.5rem 1rem; background: white; color: var(--dark-color); border: 1px solid #e2e8f0; border-radius: 6px; text-decoration: none; transition: all 0.2s ease;">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    @if($alertes->hasMorePages())
                        <a href="{{ $alertes->nextPageUrl() }}"
                           style="padding: 0.5rem 1rem; background: white; color: var(--primary-color); border: 1px solid #e2e8f0; border-radius: 6px; text-decoration: none; transition: all 0.2s ease;">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span style="padding: 0.5rem 1rem; background: #f8fafc; color: #cbd5e0; border-radius: 6px; cursor: not-allowed;">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    @endif
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle des filtres
        const filterToggle = document.getElementById('filterToggle');
        const filterPanel = document.getElementById('filterPanel');

        if (filterToggle && filterPanel) {
            filterToggle.addEventListener('click', function() {
                const isVisible = filterPanel.style.display === 'block';
                filterPanel.style.display = isVisible ? 'none' : 'block';
                filterToggle.innerHTML = isVisible ?
                    '<i class="fas fa-filter"></i> Filtres' :
                    '<i class="fas fa-times"></i> Fermer';
                filterToggle.style.background = isVisible ? '#718096' : '#dc2626';
            });
        }

        // Animation des lignes du tableau
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateX(-10px)';

            setTimeout(() => {
                row.style.transition = 'all 0.4s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateX(0)';
            }, index * 50);
        });
    });

    function resetFilters() {
        const inputs = document.querySelectorAll('#filterPanel input, #filterPanel select');
        inputs.forEach(input => {
            if (input.type === 'date' || input.type === 'text') {
                input.value = '';
            } else if (input.tagName === 'SELECT') {
                input.selectedIndex = 0;
            }
        });
    }

    function confirmDelete(event) {
        event.preventDefault();
        const form = event.target;

        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#718096',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });

        return false;
    }

    // Ajout de SweetAlert si pas déjà inclus
    if (typeof Swal === 'undefined') {
        const script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
        document.head.appendChild(script);
    }
</script>

<style>
    .action-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .badge-warning {
        background: #fffaf0 !important;
        color: #dd6b20 !important;
    }

    .badge-info {
        background: #ebf8ff !important;
        color: #3182ce !important;
    }

    .badge-success {
        background: #f0fff4 !important;
        color: #38a169 !important;
    }

    tbody tr:hover {
        background: #f8fafc !important;
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr) !important;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .data-table th,
        .data-table td {
            white-space: nowrap;
            min-width: 120px;
        }

        .page-actions {
            flex-direction: column;
            gap: 0.5rem !important;
        }
    }
</style>
@endpush
