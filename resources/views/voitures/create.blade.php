<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Voiture</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/carrental.css') }}">
<link rel="stylesheet" href="{{ asset('css/voitures/create.css') }}">
</head>
<body>
<div class="container">
    <div class="card">
        <h1>Add voiture</h1>
        @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
        @endif
        <form action="{{ route('voitures.store') }}" method="POST">
            @csrf
            <div class="row">
                <div>
                    <label>Marque</label>
                    <input type="text" name="marque" value="{{ old('marque') }}">
                </div>
                <div>
                    <label>Modele</label>
                    <input type="text" name="modele" value="{{ old('modele') }}">
                </div>
            </div>
            <div class="row">
                <div>
                    <label>Annee</label>
                    <input type="number" name="annee" value="{{ old('annee') }}">
                </div>
                <div>
                    <label>Couleur</label>
                    <input type="text" name="couleur" value="{{ old('couleur') }}">
                </div>
            </div>
            <label>Image URL</label>
            <input type="text" name="path_image" value="{{ old('path_image') }}" placeholder="/images/cars/bmw.jpg">
            <div class="row">
                <div>
                    <label>Kilometrage</label>
                    <input type="number" step="0.01" name="kilometrage" value="{{ old('kilometrage') }}">
                </div>
                <div>
                    <label>Prix par jour</label>
                    <input type="number" step="0.01" name="prix_jour" value="{{ old('prix_jour') }}">
                </div>
            </div>
            <label>Statut</label>
            <select name="statut">
                <option value="disponible">Disponible</option>
                <option value="louee">Louee</option>
                <option value="maintenance">Maintenance</option>
            </select>
            <div class="actions">
                <button>Add</button>
                <a class="btn" href="{{ route('voitures.index') }}">Back</a>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('js/carrental.js') }}"></script>
</body>
</html>
