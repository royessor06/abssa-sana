<?php

namespace App\Http\Controllers;

use App\Models\Alerte;
use Illuminate\Http\Request;
use App\Models\Action;
use App\Models\TypeAlerte;

class AdminController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $alertes = Alerte::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $pendingCount = Alerte::where('statut', 'en attente')->count();
        $inProgressCount = Alerte::where('statut', 'en cours')->count();
        $resolvedCount = Alerte::where('statut', 'terminée')->count();

        $typesAlerte = TypeAlerte::all();

        return view('admin.alertes.index', compact(
            'alertes',
            'pendingCount',
            'inProgressCount',
            'resolvedCount',
            'typesAlerte'
        ));
    }

    public function dashboard()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $totalAlertes = Alerte::count();
        $pendingAlertes = Alerte::where('statut', 'en attente')->count();
        $inProgressAlertes = Alerte::where('statut', 'en cours')->count();
        $resolvedAlertes = Alerte::where('statut', 'terminée')->count();

        $recentAlertes = Alerte::with('user')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $recentActivities = Action::with('alerte')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function($action) {
                return (object) [
                    'description' => "Action ajoutée à l'alerte #{$action->alerte->numeroSuivi}",
                    'created_at' => $action->created_at,
                    'icon' => 'clipboard-check'
                ];
            });

        return view('admin.dashboard', compact(
            'totalAlertes',
            'pendingAlertes',
            'inProgressAlertes',
            'resolvedAlertes',
            'recentAlertes',
            'recentActivities'
        ));
    }

    public function show($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $alerte = Alerte::with(['user','matrice','typeAlerte','actions'])
            ->findOrFail($id);

        return view('admin.alertes.show', compact('alerte'));
    }

    public function updateStatut(Request $request, $id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'statut' => 'required|in:en attente,en cours,terminée',
        ]);

        $alerte = Alerte::findOrFail($id);
        $alerte->update([
            'statut' => $request->statut
        ]);

        return redirect()
            ->route('admin.alertes.show', $id)
            ->with('success', 'Statut mis à jour');
    }

}
