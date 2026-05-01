<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Voiture</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/carrental.css') }}">
<style>
*{box-sizing:border-box;font-family:Poppins,Arial,sans-serif}
body{background:#f4f6f9;color:#111827;padding:24px}
.container{max-width:760px;margin:auto}
.card{background:white;border-radius:8px;padding:24px;box-shadow:0 6px 18px rgba(15,23,42,.08)}
h1{margin-top:0}
label{display:block;margin-top:12px;font-weight:600}
input,select{width:100%;padding:11px;margin-top:6px;border-radius:8px;border:1px solid #d1d5db}
.row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.actions{display:flex;gap:10px;margin-top:18px}
button,.btn{border:none;border-radius:8px;padding:10px 14px;color:white;text-decoration:none;cursor:pointer}
button{background:#2563eb}.btn{background:#64748b}
.error{background:#fee2e2;color:#991b1b;padding:10px;border-radius:8px;margin-bottom:12px}
@media(max-width:680px){.row{grid-template-columns:1fr}}
</style>
</head>
<body>
<div class="container">
    <div class="card">
        <h1>Edit voiture</h1>
        @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
        @endif
        <form action="{{ route('voitures.update',$voiture->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div>
                    <label>Marque</label>
                    <input type="text" name="marque" value="{{ old('marque',$voiture->marque) }}">
                </div>
                <div>
                    <label>Modele</label>
                    <input type="text" name="modele" value="{{ old('modele',$voiture->modele) }}">
                </div>
            </div>
            <div class="row">
                <div>
                    <label>Annee</label>
                    <input type="number" name="annee" value="{{ old('annee',$voiture->annee) }}">
                </div>
                <div>
                    <label>Couleur</label>
                    <input type="text" name="couleur" value="{{ old('couleur',$voiture->couleur) }}">
                </div>
            </div>
            <label>Image URL</label>
            <input type="text" name="path_image" value="{{ old('path_image',$voiture->path_image) }}">
            <div class="row">
                <div>
                    <label>Kilometrage</label>
                    <input type="number" step="0.01" name="kilometrage" value="{{ old('kilometrage',$voiture->kilometrage) }}">
                </div>
                <div>
                    <label>Prix par jour</label>
                    <input type="number" step="0.01" name="prix_jour" value="{{ old('prix_jour',$voiture->prix_jour) }}">
                </div>
            </div>
            <label>Statut</label>
            <select name="statut">
                <option value="disponible" {{ old('statut',$voiture->statut) == 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="louee" {{ old('statut',$voiture->statut) == 'louee' ? 'selected' : '' }}>Louee</option>
                <option value="maintenance" {{ old('statut',$voiture->statut) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>
            <div class="actions">
                <button>Save</button>
                <a class="btn" href="{{ route('voitures.index') }}">Back</a>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('js/carrental.js') }}"></script>
</body>
</html>
