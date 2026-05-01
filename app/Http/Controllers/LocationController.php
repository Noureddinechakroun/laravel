<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\User;
use App\Models\Voiture;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::with(['user', 'voiture'])->latest()->get();
        return view('locations.index', compact('locations'));
    }

    public function create()
    {
        return view('locations.create', [
            'users' => User::where('role', 'client')->orderBy('firstname')->get(),
            'voitures' => Voiture::where('statut', 'disponible')->orderBy('marque')->orderBy('modele')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', Rule::exists('users', 'id')->where('role', 'client')],
            'voiture_id' => 'required|exists:table_voiture,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'statut' => 'required|string|in:en_cours,terminee,annulee',
        ]);

        $validated['prix_total'] = $this->calculateTotal($validated['voiture_id'], $validated['date_debut'], $validated['date_fin']);

        Location::create($validated);
        $this->updateVoitureStatus($validated['voiture_id'], $validated['statut']);

        return redirect()->route('locations.index')->with('success', 'Location ajoutee avec succes.');
    }

    public function edit(Location $location)
    {
        return view('locations.edit', [
            'location' => $location,
            'users' => User::where('role', 'client')->orderBy('firstname')->get(),
            'voitures' => Voiture::where(function ($query) use ($location) {
                $query->where('statut', 'disponible')
                    ->orWhere('id', $location->voiture_id);
            })->orderBy('marque')->orderBy('modele')->get(),
        ]);
    }

    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'user_id' => ['required', Rule::exists('users', 'id')->where('role', 'client')],
            'voiture_id' => 'required|exists:table_voiture,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'statut' => 'required|string|in:en_cours,terminee,annulee',
        ]);

        $validated['prix_total'] = $this->calculateTotal($validated['voiture_id'], $validated['date_debut'], $validated['date_fin']);

        $oldVoitureId = $location->voiture_id;

        $location->update($validated);
        $this->updateVoitureStatus($oldVoitureId, 'terminee');
        $this->updateVoitureStatus($validated['voiture_id'], $validated['statut']);

        return redirect()->route('locations.index')->with('success', 'Location modifiee avec succes.');
    }

    public function destroy(Location $location)
    {
        $voitureId = $location->voiture_id;

        $location->delete();
        $this->updateVoitureStatus($voitureId, 'terminee');

        return redirect()->route('locations.index')->with('success', 'Location supprimee avec succes.');
    }

    private function calculateTotal($voitureId, $dateDebut, $dateFin)
    {
        $voiture = Voiture::findOrFail($voitureId);
        $days = Carbon::parse($dateDebut)->diffInDays(Carbon::parse($dateFin)) + 1;

        return $days * $voiture->prix_jour;
    }

    private function updateVoitureStatus($voitureId, $locationStatus)
    {
        $voiture = Voiture::findOrFail($voitureId);
        $voiture->update([
            'statut' => $locationStatus === 'en_cours' ? 'louee' : 'disponible',
        ]);
    }
}
