<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Location</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/locations/create.css') }}">
</head>
<body>
@php
    $isClientPage = request()->routeIs('client.locations.create');
    $selectedVoiture = $voiture;
@endphp

<div class="container">
    <div class="card">
        <h1>Add location</h1>

        @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
        @endif

        <form action="{{ $isClientPage ? route('client.locations.store', $selectedVoiture->id) : route('locations.store') }}" method="POST">
            @csrf

            @if($isClientPage)
                <input type="hidden" name="voiture_id" value="{{ $selectedVoiture->id }}">
                <input type="hidden" name="statut" value="en_cours">

                <div class="selected-car">
                    <span>Voiture</span>
                    <strong>{{ $selectedVoiture->marque }} {{ $selectedVoiture->modele }}</strong>
                    <small>{{ number_format($selectedVoiture->prix_jour, 2) }} DT/day</small>
                </div>
            @else
                <label>Client</label>
                <select name="user_id">
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->firstname }} {{ $user->lastname }} - {{ $user->email }}
                    </option>
                    @endforeach
                </select>

                <label>Voiture</label>
                <select name="voiture_id" id="voiture_id">
                    @foreach($voitures as $car)
                    <option value="{{ $car->id }}" data-price="{{ $car->prix_jour }}" {{ old('voiture_id') == $car->id ? 'selected' : '' }}>
                        {{ $car->marque }} {{ $car->modele }} - {{ number_format($car->prix_jour, 2) }} DT/day
                    </option>
                    @endforeach
                </select>
            @endif

            <div class="row">
                <div>
                    <label>Start date</label>
                    <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut') }}">
                </div>
                <div>
                    <label>End date</label>
                    <input type="date" name="date_fin" id="date_fin" value="{{ old('date_fin') }}">
                </div>
            </div>

            <input type="hidden" name="prix_total" id="prix_total" value="0">
            <div
                class="total"
                id="total_box"
                @if($isClientPage) data-price="{{ $selectedVoiture->prix_jour }}" @endif
            >
                Total: 0.00 DT
            </div>

            @if(!$isClientPage)
            <label>Status</label>
            <select name="statut">
                <option value="en_cours" {{ old('statut') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                <option value="terminee" {{ old('statut') == 'terminee' ? 'selected' : '' }}>Terminee</option>
                <option value="annulee" {{ old('statut') == 'annulee' ? 'selected' : '' }}>Annulee</option>
            </select>
            @endif

            <div class="actions">
                <button>Add</button>
                <a class="btn" href="{{ $isClientPage ? route('client') : route('locations.index') }}">Back</a>
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

function getPrice() {
    if (voitureSelect) {
        const option = voitureSelect.options[voitureSelect.selectedIndex];
        return Number(option.dataset.price || 0);
    }

    return Number(totalBox.dataset.price || 0);
}

function calculateTotal() {
    const price = getPrice();
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

if (voitureSelect) {
    voitureSelect.addEventListener('change', calculateTotal);
}

startInput.addEventListener('change', calculateTotal);
endInput.addEventListener('change', calculateTotal);
calculateTotal();
</script>
</body>
</html>
