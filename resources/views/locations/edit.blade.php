<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Location</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/carrental.css') }}">
<link rel="stylesheet" href="{{ asset('css/locations/edit.css') }}">
</head>
<body>
@php
    $isClientPage = $isClientPage ?? request()->routeIs('client.locations.edit');
@endphp
<div class="container">
    <div class="card">
        <h1>{{ $isClientPage ? 'Modifier ma location' : 'Edit location' }}</h1>
        @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
        @endif
        <form action="{{ $isClientPage ? route('client.locations.update',$location->id) : route('locations.update',$location->id) }}" method="POST">
            @csrf
            @method('PUT')
            @if($isClientPage)
            <div class="selected-car">
                <span>Client</span>
                <strong>{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</strong>
                <small>{{ auth()->user()->email }}</small>
            </div>
            @else
            <label>Client</label>
            <select name="user_id">
                @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id',$location->user_id) == $user->id ? 'selected' : '' }}>{{ $user->firstname }} {{ $user->lastname }} - {{ $user->email }}</option>
                @endforeach
            </select>
            @endif
            <label>Voiture</label>
            <select name="voiture_id" id="voiture_id">
                @foreach($voitures as $voiture)
                <option value="{{ $voiture->id }}" data-price="{{ $voiture->prix_jour }}" {{ old('voiture_id',$location->voiture_id) == $voiture->id ? 'selected' : '' }}>{{ $voiture->marque }} {{ $voiture->modele }} - {{ number_format($voiture->prix_jour, 2) }} DT/day</option>
                @endforeach
            </select>
            <div class="row">
                <div>
                    <label>Start date</label>
                    <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut',$location->date_debut->format('Y-m-d')) }}">
                </div>
                <div>
                    <label>End date</label>
                    <input type="date" name="date_fin" id="date_fin" value="{{ old('date_fin',$location->date_fin->format('Y-m-d')) }}">
                </div>
            </div>
            <input type="hidden" name="prix_total" id="prix_total" value="{{ old('prix_total',$location->prix_total) }}">
            <div class="total" id="total_box">Total: {{ number_format($location->prix_total, 2) }} DT</div>
            @if(!$isClientPage)
            <div class="row">
                <div>
                    <label>Status</label>
                    <select name="statut">
                        <option value="en_cours" {{ old('statut',$location->statut) == 'en_cours' ? 'selected' : '' }}>En cours</option>
                        <option value="terminee" {{ old('statut',$location->statut) == 'terminee' ? 'selected' : '' }}>Terminee</option>
                        <option value="annulee" {{ old('statut',$location->statut) == 'annulee' ? 'selected' : '' }}>Annulee</option>
                    </select>
                </div>
                <div>
                </div>
            </div>
            @endif
            <div class="actions">
                <button>{{ $isClientPage ? 'Enregistrer' : 'Save' }}</button>
                <a class="btn" href="{{ $isClientPage ? route('locations.client') : route('locations.index') }}">Back</a>
            </div>
        </form>
    </div>
</div>
<script>
const voitureSelect = document.getElementById('voiture_id');
const startInput = document.getElementById('date_debut');
const endInput = document.getElementById('date_fin');
const totalInput = document.getElementById('prix_total');
const totalBox = document.getElementById('total_box');

function calculateTotal() {
    const option = voitureSelect.options[voitureSelect.selectedIndex];
    const price = Number(option.dataset.price || 0);
    const start = new Date(startInput.value);
    const end = new Date(endInput.value);
    let days = 0;

    if (startInput.value && endInput.value && end >= start) {
        days = Math.floor((end - start) / 86400000) + 1;
    }

    const total = days * price;
    totalInput.value = total.toFixed(2);
    totalBox.textContent = 'Total: ' + total.toFixed(2) + ' DT (' + days + ' day(s))';
}

voitureSelect.addEventListener('change', calculateTotal);
startInput.addEventListener('change', calculateTotal);
endInput.addEventListener('change', calculateTotal);
calculateTotal();
</script>
<script src="{{ asset('js/carrental.js') }}"></script>
</body>
</html>
