<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\User;
use App\Models\Voiture;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::with(['user', 'voiture'])->latest()->get();
        return view('locations.index', compact('locations'));
    }

    public function create(Voiture $voiture = null)
    {
        return view('locations.create', [
            'voiture' => $voiture,
            'users' => User::where('role', 'client')->orderBy('firstname')->get(),
            'voitures' => Voiture::where('statut', 'disponible')->orderBy('marque')->get(),
        ]);
    }

    public function store(Request $request, Voiture $voiture = null)
    {
        $isClientRequest = $request->routeIs('client.locations.store');

        $validated = $request->validate([
            'user_id' => $isClientRequest ? 'nullable' : ['required', Rule::exists('users', 'id')->where('role', 'client')],
            'voiture_id' => $isClientRequest ? 'nullable' : 'required|exists:table_voiture,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'statut' => $isClientRequest ? 'nullable' : 'required|string|in:en_cours,terminee,annulee',
        ]);

        if ($isClientRequest) {
            $validated['user_id'] = auth()->id();
            $validated['voiture_id'] = $voiture->id;
            $validated['statut'] = 'en_cours';
        }

        $validated['prix_total'] = $this->calculateTotal(
            $validated['voiture_id'],
            $validated['date_debut'],
            $validated['date_fin']
        );

        if ($validated['statut'] === 'annulee') {
            $validated['prix_total'] = 0;
        }

        Location::create($validated);
        $this->updateVoitureStatus($validated['voiture_id'], $validated['statut']);

        if ($isClientRequest) {
            return redirect()->route('locations.client')->with('success', 'Location ajoutee avec succes.');
        }

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

        if ($validated['statut'] === 'annulee') {
            $validated['prix_total'] = 0;
        }

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

    public function clientIndex()
    {
        $locations = Location::with('voiture')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('locations', compact('locations'));
    }

    public function facture($id)
    {
        $location = Location::with(['voiture', 'user'])->findOrFail($id);

        if ($location->user_id != auth()->id()) {
            abort(403);
        }

        return view('facture', compact('location'));
    }

    public function derniereFacture()
    {
        $location = Location::where('user_id', auth()->id())
            ->latest()
            ->first();

        if (!$location) {
            return redirect()->route('locations.client')
                ->with('error', 'Aucune facture disponible.');
        }

        return redirect()->route('locations.facture', $location->id);
    }

    public function clientEdit(Location $location)
    {
        $this->authorizeClientLocation($location);

        if ($location->statut !== 'en_cours') {
            return redirect()->route('locations.client')
                ->with('error', 'Seules les locations en cours peuvent etre modifiees.');
        }

        return view('locations.edit', [
            'location' => $location,
            'users' => collect([auth()->user()]),
            'voitures' => Voiture::where(function ($query) use ($location) {
                $query->where('statut', 'disponible')
                    ->orWhere('id', $location->voiture_id);
            })->orderBy('marque')->orderBy('modele')->get(),
            'isClientPage' => true,
        ]);
    }

    public function clientUpdate(Request $request, Location $location)
    {
        $this->authorizeClientLocation($location);

        if ($location->statut !== 'en_cours') {
            return redirect()->route('locations.client')
                ->with('error', 'Seules les locations en cours peuvent etre modifiees.');
        }

        $validated = $request->validate([
            'voiture_id' => [
                'required',
                'exists:table_voiture,id',
                Rule::exists('table_voiture', 'id')->where(function ($query) use ($location) {
                    $query->where('statut', 'disponible')
                        ->orWhere('id', $location->voiture_id);
                }),
            ],
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['statut'] = 'en_cours';
        $validated['prix_total'] = $this->calculateTotal(
            $validated['voiture_id'],
            $validated['date_debut'],
            $validated['date_fin']
        );

        $oldVoitureId = $location->voiture_id;

        $location->update($validated);
        $this->updateVoitureStatus($oldVoitureId, 'terminee');
        $this->updateVoitureStatus($validated['voiture_id'], 'en_cours');

        return redirect()->route('locations.client')->with('success', 'Location modifiee avec succes.');
    }

    public function clientCancel(Location $location)
    {
        $this->authorizeClientLocation($location);

        if ($location->statut !== 'en_cours') {
            return redirect()->route('locations.client')
                ->with('error', 'Seules les locations en cours peuvent etre annulees.');
        }

        $location->update([
            'statut' => 'annulee',
            'prix_total' => 0,
        ]);
        $this->updateVoitureStatus($location->voiture_id, 'annulee');

        return redirect()->route('locations.client')->with('success', 'Location annulee avec succes.');
    }

    private function authorizeClientLocation(Location $location)
    {
        if ($location->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
