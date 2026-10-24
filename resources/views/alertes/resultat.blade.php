@extends('layouts.layout')

@section('title', "Résultat de l'alerte")

@section('content')

<div class="container">
    <h2>Détails de l'Alerte</h2>

    <p><strong>Numéro :</strong> {{ $alerte->numeroSuivi }}</p>
    <p><strong>Produit :</strong> {{ $alerte->nomProduit }} ({{ $alerte->marqueProduit }})</p>
    <p><strong>Distributeur :</strong> {{ $alerte->distributeur }}</p>
    <p><strong>Département :</strong> {{ $alerte->departement }}</p>
    <p><strong>Motif :</strong> {{ $alerte->motif }}</p>
    <p><strong>Type d'alerte :</strong> {{ $alerte->type_alertes->nom_alerte ?? 'Non défini' }}</p>

    @if ($alerte->photoProduit)
        <p><strong>Photo :</strong></p>
        <img src="{{ asset('storage/' . $alerte->photoProduit) }}" class="img-produit" alt="Photo du produit">
    @endif

    <button id="toggleActions" class="btn btn-primary" style="margin-top: 20px;">
        Afficher les actions effectuées sur l'alerte
    </button>
</div>

<div id="actionsContainer" class="container" style="display: none;">
    <h2>Actions effectuées</h2>
    
    @if ($alerte->actions && count($alerte->actions) > 0)
        <ul>
            @foreach ($alerte->actions as $action)
                <li>
                    <strong>{{ $action->intitule }}</strong> - 
                    {{ $action->detail }} <br>
                    <em>Le {{ $action->created_at->format('d/m/Y à H:i') }}</em>
                </li>
            @endforeach
        </ul>
    @else
        <p>Aucune action n’a encore été effectuée pour cette alerte.</p>
    @endif
</div>

@push('scripts')
<script>
    const toggleBtn = document.getElementById('toggleActions');
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            const container = document.getElementById('actionsContainer');
            container.style.display = (container.style.display === 'none') ? 'block' : 'none';
            this.textContent = container.style.display === 'block'
                ? 'Masquer les actions effectuées'
                : 'Afficher les actions effectuées sur l\'alerte';
        });
    }

</script>
@endpush

@endsection
