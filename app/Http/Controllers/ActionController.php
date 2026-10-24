<?php

namespace App\Http\Controllers;

use App\Models\Alerte;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function create($alerteId)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $alerte = Alerte::findOrFail($alerteId);

        return view('admin.actions.create', compact('alerte'));
    }

    public function store(Request $request, $alerteId)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'intitule' => 'required|string|max:255',
            'detail' => 'required|string',
        ]);

        $alerte = Alerte::findOrFail($alerteId);

        $alerte->actions()->create([
            'intitule' => $request->intitule,
            'detail' => $request->detail,
        ]);

        return redirect()
            ->route('admin.alertes.show', $alerteId)
            ->with('success', 'Action ajoutée avec succès');
    }

}
