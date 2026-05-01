<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Location</title>
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
.total{background:#eff6ff;color:#1d4ed8;border:1px solid #bfdbfe;border-radius:8px;padding:14px;margin-top:12px;font-weight:700}
@media(max-width:680px){.row{grid-template-columns:1fr}}
</style>
</head>
<body>
<div class="container">
    <div class="card">
        <h1>Edit location</h1>
        @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
        @endif
        <form action="{{ route('locations.update',$location->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label>Client</label>
            <select name="user_id">
                @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id',$location->user_id) == $user->id ? 'selected' : '' }}>{{ $user->firstname }} {{ $user->lastname }} - {{ $user->email }}</option>
                @endforeach
            </select>
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
            <div class="actions">
                <button>Save</button>
                <a class="btn" href="{{ route('locations.index') }}">Back</a>
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
