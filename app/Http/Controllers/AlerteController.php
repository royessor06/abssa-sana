<?php

namespace App\Http\Controllers;

use App\Models\Alerte;
use App\Models\Matrice;
use App\Models\TypeAlerte;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AlerteController extends Controller
{
    /**
     * Affiche le formulaire de déclaration d'alerte.
     */
    public function create()
    {
        $matrices = Matrice::all();
        $types = TypeAlerte::all();

        return view('alertes.create', compact('matrices', 'types'));
    }

    /**
     * Enregistre une nouvelle alerte sanitaire.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|max:255',
            'numeroTelephone' => 'required|string|max:20',
            'matrice_id' => 'required|exists:matrices,id',
            'marqueProduit' => 'required|string|max:255',
            'nomProduit' => 'required|string|max:255',
            'photoProduit' => 'nullable|image|max:2048',
            'distributeur' => 'required|string|max:255',
            'type_alerte_id' => 'required|exists:type_alertes,id',
            'motif' => 'required|string',
            'departement' => 'required|string|max:255',
        ]);

        // Vérifie si l'utilisateur existe déjà par email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $user = User::create([
                'nom' => $request->nom,
                'adresse' => $request->adresse,
                'email' => $request->email,
                'numeroTelephone' => $request->numeroTelephone,
            ]);
        }

        // Upload image du produit
        $photoPath = null;
        if ($request->hasFile('photoProduit') && $request
        ->file('photoProduit')->isValid()) {
            $photoPath = $request->file('photoProduit')
            ->store('photos_produits', 'public');
        }


        // Génère un numéro de suivi unique
        do {
            $numeroSuivi = 'SANA-' . strtoupper(Str::random(8));
        } while (
            Alerte::where(
                'numeroSuivi', $numeroSuivi
            )->exists());

        // Création de l’alerte
        Alerte::create([
            'user_id' => $user->id,
            'matrice_id' => $request->matrice_id,
            'marqueProduit' => $request->marqueProduit,
            'nomProduit' => $request->nomProduit,
            'photoProduit' => $photoPath,
            'distributeur' => $request->distributeur,
            'type_alerte_id' => $request->type_alerte_id,
            'motif' => $request->motif,
            'departement' => $request->departement,
            'statut' => 'en attente',
            'numeroSuivi' => $numeroSuivi,
        ]);

        // ✅ ENVOYER L'EMAIL SIMPLE
        try {
            Mail::send('emails.confirmation', [
                'numeroSuivi' => $numeroSuivi,
                'nomProduit' => $request->nomProduit,
                'dateDeclaration' => now()->format('d/m/Y H:i'),
            ], function ($message) use ($user, $numeroSuivi) {
                $message->to($user->email)
                        ->subject('Confirmation alerte ABSSA - ' . $numeroSuivi);
            });

            $emailStatus = "Un email de confirmation vous a été envoyé.";
        } catch (\Exception $e) {
            // Si l'email échoue, on continue quand même
            $emailStatus = "Note : L'email de confirmation n'a pas pu être envoyé.";
        }

        return back()->with('success',
            'Alerte enregistrée avec succès. Numéro de suivi : ' . $numeroSuivi .
            '. ' . $emailStatus);
    }

    public function follow(){

        return view('alertes.follow');
    }

    public function show(Request $request)
    {
        $request->validate([
            'numeroSuivi' => 'required|string|max:255',
        ]);

        $alerte = Alerte::with('actions')
        ->where('numeroSuivi', $request->numeroSuivi)->first();

        if ($alerte) {
            return view('alertes.resultat',
            compact('alerte'));
        } else {
            return redirect()->back()->with('error',
            'Aucune alerte trouvée avec ce numéro.');
        }
    }
}
