<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CarRental - Mes informations</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>

<aside class="sidebar">
  <div class="sidebar-header">
    <div class="logo">Car<span>Rental</span></div>
  </div>
  <div class="sidebar-user">
    <div class="user-avatar">{{ strtoupper(substr($user->firstname ?? 'U', 0, 1)) }}</div>
    <div class="user-name">{{ $user->firstname }} {{ $user->lastname }}</div>
    <div class="user-role">Client</div>
  </div>
  <nav>
    <a href="{{ route('client') }}">
      <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
      Accueil
    </a>
    <a href="{{ route('locations.client') }}">
      <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
      Mes locations
    </a>
    <a href="{{ route('facture.derniere') }}">
      <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
      Factures
    </a>
    <a href="{{ route('client.profile.edit') }}" class="active">
      <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5.121 17.804A8 8 0 1118.879 17.8M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
      Mes informations
    </a>
  </nav>
  <div class="sidebar-footer">
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="logout-btn">logout</button>
    </form>
  </div>
</aside>

<main class="main">
  <div class="page-header">
    <h1>Mes informations</h1>
    <p>Modifiez vos informations personnelles.</p>
  </div>

  @if(session('success'))
    <div class="alert success">{{ session('success') }}</div>
  @endif
  @if($errors->any())
    <div class="alert error">{{ $errors->first() }}</div>
  @endif

  <div class="form-card">
    <form action="{{ route('client.profile.update') }}" method="POST">
      @csrf
      @method('PUT')

      <div class="row">
        <div>
          <label>Prénom</label>
          <input type="text" name="firstname" value="{{ old('firstname', $user->firstname) }}">
        </div>
        <div>
          <label>Nom</label>
          <input type="text" name="lastname" value="{{ old('lastname', $user->lastname) }}">
        </div>
      </div>

      <div class="row">
        <div>
          <label>Date de naissance</label>
          <input type="date" name="datenaissance" value="{{ old('datenaissance', $user->datenaissance) }}">
        </div>
        <div>
          <label>Genre</label>
          <select name="gender">
            <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Homme</option>
            <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Femme</option>
          </select>
        </div>
      </div>

      <label>Email</label>
      <input type="email" name="email" value="{{ old('email', $user->email) }}">

      <div class="password-section">
        <h2>Changer le mot de passe</h2>
        <p>Laissez ces champs vides pour garder votre mot de passe actuel.</p>
      </div>

      <div class="row">
        <div>
          <label>Nouveau mot de passe</label>
          <input type="password" name="password" autocomplete="new-password">
        </div>
        <div>
          <label>Confirmer le mot de passe</label>
          <input type="password" name="password_confirmation" autocomplete="new-password">
        </div>
      </div>

      <div class="actions">
        <button type="submit">Enregistrer</button>
        <a class="btn" href="{{ route('client') }}">Retour</a>
      </div>
    </form>
  </div>
</main>

</body>
</html>
