<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\User;
use App\Models\Voiture;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin', [
            'totalUsers' => User::count(),
            'totalVoitures' => Voiture::count(),
            'totalLocations' => Location::count(),
            'totalRevenue' => Location::where('statut', '!=', 'annulee')->sum('prix_total'),
            'latestLocations' => Location::with(['user', 'voiture'])->latest()->take(5)->get(),
        ]);
    }
}
