@extends('admin.dashboard')

@section('content')
    <!-- Contenu spécifique des pages -->
    <div class="section-card">
        <div class="section-header">
            <h2>@yield('page-title', 'Gestion')</h2>
            @hasSection('page-actions')
                <div class="page-actions">
                    @yield('page-actions')
                </div>
            @endif
        </div>

        @if(session('success'))
            <div class="alert alert-success" style="background: linear-gradient(135deg, #c6f6d5 0%, #9ae6b4 100%);
                border: 1px solid #68d391; color: #22543d; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error" style="background: linear-gradient(135deg, #fed7d7 0%, #feb2b2 100%);
                border: 1px solid #fc8181; color: #c53030; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @yield('page-content')
    </div>
@endsection
