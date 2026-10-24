@extends('layouts.layout')

@section('title', 'Déclarer une alerte | SanA')

@push('styles')
<style>
/* Multi-step form */
.form-progress {
    display: flex;
    justify-content: space-between;
    margin: 2rem 0 3rem;
    position: relative;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.form-progress::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 2px;
    background: var(--gray-300);
    transform: translateY(-50%);
    z-index: 1;
}

.progress-step {
    position: relative;
    z-index: 2;
    text-align: center;
    flex: 1;
}

.step-number {
    width: 2.5rem;
    height: 2.5rem;
    background: var(--white);
    border: 2px solid var(--gray-300);
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.5rem;
    font-weight: 600;
    color: var(--gray-500);
    transition: all var(--transition-normal);
}

.step-label {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--gray-500);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.progress-step.active .step-number {
    background: var(--primary-main);
    border-color: var(--primary-main);
    color: var(--white);
}

.progress-step.active .step-label {
    color: var(--primary-main);
}

.progress-step.completed .step-number {
    background: var(--success);
    border-color: var(--success);
    color: var(--white);
}

/* Form steps */
.form-step {
    display: none;
    animation: fadeIn 0.5s ease-out;
}

.form-step.active {
    display: block;
}

.form-navigation {
    display: flex;
    justify-content: space-between;
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 2px solid var(--gray-200);
}

/* File upload */
.file-upload {
    border: 2px dashed var(--gray-300);
    border-radius: var(--radius-lg);
    padding: 2rem;
    text-align: center;
    background: var(--gray-50);
    cursor: pointer;
    transition: all var(--transition-normal);
}

.file-upload:hover {
    border-color: var(--primary-main);
    background: var(--gray-100);
}

.file-upload.dragover {
    border-color: var(--success);
    background: var(--success);
    color: var(--white);
}

.file-upload input[type="file"] {
    display: none;
}

.file-preview {
    margin-top: 1rem;
}

.preview-image {
    max-width: 200px;
    max-height: 200px;
    object-fit: cover;
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-md);
}

/* Form sections */
.form-section {
    margin-bottom: 2.5rem;
}

.form-section:last-child {
    margin-bottom: 0;
}

.section-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--gray-200);
}

.section-icon {
    width: 3rem;
    height: 3rem;
    background: linear-gradient(135deg, var(--primary-light), var(--accent));
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: var(--white);
}

.section-title {
    font-size: 1.25rem;
    color: var(--gray-900);
    margin: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .form-navigation {
        flex-direction: column;
        gap: 1rem;
    }

    .btn {
        width: 100%;
        justify-content: center;
    }

    .section-header {
        flex-direction: column;
        text-align: center;
        gap: 0.75rem;
    }

    .section-icon {
        width: 2.5rem;
        height: 2.5rem;
        font-size: 1.25rem;
    }
}
</style>
@endpush

@section('content')
<div class="fade-in">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="hero-title mb-4">Déclarer une alerte sanitaire</h1>
            <p class="text-gray-600">
                Signalez un problème lié à un produit alimentaire en remplissant ce formulaire.
                Toutes les informations fournies restent confidentielles.
            </p>
        </div>

        <!-- Progress Bar -->
        <div class="form-progress">
            <div class="progress-step active" data-step="1">
                <div class="step-number">1</div>
                <div class="step-label">Identité</div>
            </div>
            <div class="progress-step" data-step="2">
                <div class="step-number">2</div>
                <div class="step-label">Produit</div>
            </div>
            <div class="progress-step" data-step="3">
                <div class="step-number">3</div>
                <div class="step-label">Détails</div>
            </div>
        </div>

        <!-- Form -->
        <div class="card p-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-error mb-6">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-circle mt-1 mr-3"></i>
                        <div>
                            <strong class="block mb-1">Veuillez corriger les erreurs suivantes :</strong>
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('alertes.store') }}" enctype="multipart/form-data" id="alerteForm">
                @csrf

                <!-- Step 1: Personal Information -->
                <div class="form-step active" id="step-1">
                    <div class="form-section">
                        <div class="section-header">
                            <div class="section-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <h2 class="section-title">Votre identité</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label for="nom" class="form-label">
                                    Nom complet
                                    <span class="required">*</span>
                                </label>
                                <input type="text"
                                       id="nom"
                                       name="nom"
                                       value="{{ old('nom') }}"
                                       required
                                       class="form-control"
                                       placeholder="Jean Dupont">
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">
                                    Adresse email
                                    <span class="required">*</span>
                                </label>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required
                                       class="form-control"
                                       placeholder="jean.dupont@email.com">
                            </div>

                            <div class="form-group">
                                <label for="adresse" class="form-label">
                                    Adresse
                                    <span class="required">*</span>
                                </label>
                                <input type="text"
                                       id="adresse"
                                       name="adresse"
                                       value="{{ old('adresse') }}"
                                       required
                                       class="form-control"
                                       placeholder="Votre adresse complète">
                            </div>

                            <div class="form-group">
                                <label for="numeroTelephone" class="form-label">
                                    Téléphone
                                    <span class="required">*</span>
                                </label>
                                <input type="tel"
                                       id="numeroTelephone"
                                       name="numeroTelephone"
                                       value="{{ old('numeroTelephone') }}"
                                       required
                                       class="form-control"
                                       placeholder="(+229) XX XX XX XX">
                            </div>
                        </div>
                    </div>

                    <div class="form-navigation">
                        <div></div> <!-- Empty div for spacing -->
                        <button type="button" class="btn btn-primary btn-next-step">
                            Suivant
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Product Information -->
                <div class="form-step" id="step-2">
                    <div class="form-section">
                        <div class="section-header">
                            <div class="section-icon">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                            <h2 class="section-title">Informations produit</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label for="matrice_id" class="form-label">
                                    Matrice
                                    <span class="required">*</span>
                                </label>
                                <select id="matrice_id" name="matrice_id" required class="form-control">
                                    <option value="">Sélectionnez une matrice</option>
                                    @foreach ($matrices as $matrice)
                                        <option value="{{ $matrice->id }}" {{ old('matrice_id') == $matrice->id ? 'selected' : '' }}>
                                            {{ $matrice->libelle }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nomProduit" class="form-label">
                                    Nom du produit
                                    <span class="required">*</span>
                                </label>
                                <input type="text"
                                       id="nomProduit"
                                       name="nomProduit"
                                       value="{{ old('nomProduit') }}"
                                       required
                                       class="form-control"
                                       placeholder="Nom exact du produit">
                            </div>

                            <div class="form-group">
                                <label for="marqueProduit" class="form-label">
                                    Marque
                                    <span class="required">*</span>
                                </label>
                                <input type="text"
                                       id="marqueProduit"
                                       name="marqueProduit"
                                       value="{{ old('marqueProduit') }}"
                                       required
                                       class="form-control"
                                       placeholder="Marque du produit">
                            </div>

                            <div class="form-group">
                                <label for="distributeur" class="form-label">
                                    Distributeur
                                    <span class="required">*</span>
                                </label>
                                <input type="text"
                                       id="distributeur"
                                       name="distributeur"
                                       value="{{ old('distributeur') }}"
                                       required
                                       class="form-control"
                                       placeholder="Nom du point de vente">
                            </div>
                        </div>

                        <!-- Photo Upload -->
                        <div class="form-group mt-6">
                            <label class="form-label">
                                Photo du produit (optionnel)
                            </label>
                            <div class="file-upload" id="fileUploadArea">
                                <input type="file"
                                       id="photoProduit"
                                       name="photoProduit"
                                       accept="image/*">
                                <label for="photoProduit" class="cursor-pointer">
                                    <i class="fas fa-cloud-upload-alt text-3xl mb-3 text-gray-400"></i>
                                    <p class="font-medium mb-1">Cliquez pour télécharger une photo</p>
                                    <p class="text-sm text-gray-500">ou glissez-déposez le fichier ici</p>
                                    <p class="text-xs text-gray-400 mt-2">JPG, PNG, JPEG (max 5MB)</p>
                                </label>
                            </div>
                            <div id="filePreview" class="file-preview"></div>
                        </div>
                    </div>

                    <div class="form-navigation">
                        <button type="button" class="btn btn-secondary btn-prev-step">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Retour
                        </button>
                        <button type="button" class="btn btn-primary btn-next-step">
                            Suivant
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 3: Alert Details -->
                <div class="form-step" id="step-3">
                    <div class="form-section">
                        <div class="section-header">
                            <div class="section-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h2 class="section-title">Détails de l'alerte</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label for="type_alerte_id" class="form-label">
                                    Type d'alerte
                                    <span class="required">*</span>
                                </label>
                                <select id="type_alerte_id" name="type_alerte_id" required class="form-control">
                                    <option value="">Sélectionnez un type</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}" {{ old('type_alerte_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->nom_alerte }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="departement" class="form-label">
                                    Département
                                    <span class="required">*</span>
                                </label>
                                <select id="departement" name="departement" required class="form-control">
                                    <option value="">Sélectionnez un département</option>
                                    <option value="Alibori" {{ old('departement') == 'Alibori' ? 'selected' : '' }}>Alibori</option>
                                    <option value="Atacora" {{ old('departement') == 'Atacora' ? 'selected' : '' }}>Atacora</option>
                                    <option value="Atlantique" {{ old('departement') == 'Atlantique' ? 'selected' : '' }}>Atlantique</option>
                                    <option value="Borgou" {{ old('departement') == 'Borgou' ? 'selected' : '' }}>Borgou</option>
                                    <option value="Collines" {{ old('departement') == 'Collines' ? 'selected' : '' }}>Collines</option>
                                    <option value="Couffo" {{ old('departement') == 'Couffo' ? 'selected' : '' }}>Couffo</option>
                                    <option value="Donga" {{ old('departement') == 'Donga' ? 'selected' : '' }}>Donga</option>
                                    <option value="Littoral" {{ old('departement') == 'Littoral' ? 'selected' : '' }}>Littoral</option>
                                    <option value="Mono" {{ old('departement') == 'Mono' ? 'selected' : '' }}>Mono</option>
                                    <option value="Ouémé" {{ old('departement') == 'Ouémé' ? 'selected' : '' }}>Ouémé</option>
                                    <option value="Plateau" {{ old('departement') == 'Plateau' ? 'selected' : '' }}>Plateau</option>
                                    <option value="Zou" {{ old('departement') == 'Zou' ? 'selected' : '' }}>Zou</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="motif" class="form-label">
                                Motif de l'alerte
                                <span class="required">*</span>
                            </label>
                            <textarea id="motif"
                                      name="motif"
                                      required
                                      class="form-control"
                                      rows="6"
                                      placeholder="Décrivez en détail le problème rencontré...">{{ old('motif') }}</textarea>
                            <p class="text-xs text-gray-500 mt-2">
                                Soyez aussi précis que possible. Incluez les symptômes, la date d'achat,
                                la date de consommation, et tout autre détail pertinent.
                            </p>
                        </div>
                    </div>

                    <div class="form-navigation">
                        <button type="button" class="btn btn-secondary btn-prev-step">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Retour
                        </button>
                        <button type="submit" class="btn btn-accent">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Soumettre la déclaration
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Information Card -->
        <div class="card p-6 mt-6 bg-blue-50 border-blue-200">
            <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-600 text-xl mt-1 mr-3"></i>
                <div>
                    <h4 class="text-blue-900 font-semibold mb-2">Informations importantes</h4>
                    <ul class="text-blue-800 space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-blue-500 mt-1 mr-2"></i>
                            <span>Votre déclaration sera traitée dans un délai de 48 heures ouvrables.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-blue-500 mt-1 mr-2"></i>
                            <span>Vous recevrez un numéro de suivi par email pour suivre l'avancement.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-blue-500 mt-1 mr-2"></i>
                            <span>Toutes les informations fournies restent confidentielles et sécurisées.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const steps = document.querySelectorAll('.form-step');
    const progressSteps = document.querySelectorAll('.progress-step');
    const form = document.getElementById('alerteForm');
    let currentStep = 0;

    // Initialize
    showStep(currentStep);

    // Next step buttons
    document.querySelectorAll('.btn-next-step').forEach(button => {
        button.addEventListener('click', function() {
            if (validateStep(currentStep)) {
                currentStep++;
                showStep(currentStep);
                updateProgress();
            }
        });
    });

    // Previous step buttons
    document.querySelectorAll('.btn-prev-step').forEach(button => {
        button.addEventListener('click', function() {
            currentStep--;
            showStep(currentStep);
            updateProgress();
        });
    });

    function showStep(step) {
        steps.forEach((stepElement, index) => {
            stepElement.classList.toggle('active', index === step);
        });

        // Scroll to top of form
        form.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function updateProgress() {
        progressSteps.forEach((stepElement, index) => {
            stepElement.classList.remove('active', 'completed');

            if (index < currentStep) {
                stepElement.classList.add('completed');
            } else if (index === currentStep) {
                stepElement.classList.add('active');
            }
        });
    }

    function validateStep(step) {
        const currentStepElement = steps[step];
        const inputs = currentStepElement.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;

        inputs.forEach(input => {
            const formGroup = input.closest('.form-group');
            const errorElement = formGroup.querySelector('.error-message');

            if (!input.value.trim()) {
                isValid = false;
                input.classList.add('error');

                if (!errorElement) {
                    const errorMsg = document.createElement('div');
                    errorMsg.className = 'error-message text-red-600 text-sm mt-1 flex items-center';
                    errorMsg.innerHTML = '<i class="fas fa-exclamation-circle mr-2"></i>Ce champ est obligatoire';
                    formGroup.appendChild(errorMsg);
                }
            } else {
                input.classList.remove('error');
                if (errorElement) {
                    errorElement.remove();
                }
            }

            // Email validation
            if (input.type === 'email' && input.value.trim()) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(input.value)) {
                    isValid = false;
                    input.classList.add('error');

                    if (!errorElement) {
                        const errorMsg = document.createElement('div');
                        errorMsg.className = 'error-message text-red-600 text-sm mt-1 flex items-center';
                        errorMsg.innerHTML = '<i class="fas fa-exclamation-circle mr-2"></i>Adresse email invalide';
                        formGroup.appendChild(errorMsg);
                    }
                }
            }
        });

        if (!isValid) {
            // Scroll to first error
            const firstError = currentStepElement.querySelector('.error');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstError.focus();
            }
        }

        return isValid;
    }

    // File upload handling
    const fileUploadArea = document.getElementById('fileUploadArea');
    const fileInput = document.getElementById('photoProduit');
    const filePreview = document.getElementById('filePreview');

    if (fileUploadArea && fileInput) {
        // Drag and drop
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight() {
            fileUploadArea.classList.add('dragover');
        }

        function unhighlight() {
            fileUploadArea.classList.remove('dragover');
        }

        // File drop
        fileUploadArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
            handleFiles(files);
        }

        // File selection
        fileInput.addEventListener('change', function() {
            handleFiles(this.files);
        });

        function handleFiles(files) {
            if (files.length > 0) {
                const file = files[0];

                // Check file type
                if (!file.type.match('image.*')) {
                    showError('Seules les images sont acceptées');
                    return;
                }

                // Check file size (5MB)
                if (file.size > 5 * 1024 * 1024) {
                    showError('La taille du fichier ne doit pas dépasser 5MB');
                    return;
                }

                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    filePreview.innerHTML = `
                        <div class="flex items-center justify-between p-3 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex items-center">
                                <img src="${e.target.result}" class="w-12 h-12 object-cover rounded mr-3">
                                <div>
                                    <p class="font-medium text-green-800">${file.name}</p>
                                    <p class="text-sm text-green-600">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                                </div>
                            </div>
                            <button type="button" class="text-red-500 hover:text-red-700" onclick="clearFile()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    `;
                };
                reader.readAsDataURL(file);
            }
        }

        // Clear file function (needs to be global)
        window.clearFile = function() {
            fileInput.value = '';
            filePreview.innerHTML = '';
        };

        function showError(message) {
            filePreview.innerHTML = `
                <div class="p-3 bg-red-50 border border-red-200 rounded-lg">
                    <p class="text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        ${message}
                    </p>
                </div>
            `;
            fileInput.value = '';
        }
    }

    // Real-time validation
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('error');
            const errorMsg = this.closest('.form-group').querySelector('.error-message');
            if (errorMsg) {
                errorMsg.remove();
            }
        });
    });
});
</script>
@endpush

@endsection
