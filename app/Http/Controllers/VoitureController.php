<?php

namespace App\Http\Controllers;

use App\Models\Voiture;
use Illuminate\Http\Request;

class VoitureController extends Controller
{
    public function index()
    {
        $voitures = Voiture::latest()->get();
        return view('voitures.index', compact('voitures'));
    }

    public function create()
    {
        return view('voitures.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'annee' => 'required|integer|min:1980|max:' . (date('Y') + 1),
            'couleur' => 'required|string|max:255',
            'path_image' => 'required|string|max:1000',
            'kilometrage' => 'required|numeric|min:0',
            'prix_jour' => 'required|numeric|min:0',
            'statut' => 'required|string|in:disponible,louee,maintenance',
        ]);

        Voiture::create($validated);

        return redirect()->route('voitures.index')->with('success', 'Voiture ajoutee avec succes.');
    }

    public function edit(Voiture $voiture)
    {
        return view('voitures.edit', compact('voiture'));
    }

    public function update(Request $request, Voiture $voiture)
    {
        $validated = $request->validate([
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'annee' => 'required|integer|min:1980|max:' . (date('Y') + 1),
            'couleur' => 'required|string|max:255',
            'path_image' => 'required|string|max:1000',
            'kilometrage' => 'required|numeric|min:0',
            'prix_jour' => 'required|numeric|min:0',
            'statut' => 'required|string|in:disponible,louee,maintenance',
        ]);

        $voiture->update($validated);

        return redirect()->route('voitures.index')->with('success', 'Voiture modifiee avec succes.');
    }

    public function destroy(Voiture $voiture)
    {
        $voiture->delete();

        return redirect()->route('voitures.index')->with('success', 'Voiture supprimee avec succes.');
    }
}