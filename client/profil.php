<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mon profil — OTIV DIANA</title>
<link rel="shortcut icon" href="../icon/sans-fond.png" type="image/x-icon">
<link rel="stylesheet" href="../icon/fontAwesome/all.min.css">
<link rel="stylesheet" href="../css/common.css">
<link rel="stylesheet" href="../css/admin.css">

<link rel="stylesheet" href="../css/responsive.css">
<script src="../js/mobile-menu.js" defer></script>

</head>
<body class="otiv-body">


  <!-- header -->
   <?php require __DIR__ . '/../includes/header.php'; ?>


<main class="otiv-page">

  <div class="otiv-section-head">
    <div>
      <h1>Mon profil</h1>
      <p>Gérez vos informations personnelles et votre sécurité.</p>
    </div>
  </div>

  <div class="otiv-settings">

    <!-- Navigation latérale -->
      <?php require __DIR__ . '/../includes/header-nav.php'; ?>

    <!-- Contenu -->
    <div>

      <div class="otiv-card">
        <div class="otiv-profile-head">
          <span class="otiv-avatar-lg">H</span>
          <div>
            <p class="otiv-profile-head__name">Hamzah</p>
            <p class="otiv-profile-head__role">Développeur — Departement Informatique</p>
            <span class="otiv-badge"><i class="fa-solid fa-circle-check"></i> Compte actif</span>
          </div>
        </div>
        <div class="otiv-card__footer">
          <button class="otiv-btn otiv-btn--ghost">
            <i class="fa-solid fa-camera"></i> Changer la photo
          </button>
        </div>
      </div>

      <div class="otiv-card">
        <p class="otiv-card__title">Informations personnelles</p>
        <p class="otiv-card__subtitle">Ces informations sont visibles par les autres membres de OTIV DIANA.</p>

        <div class="otiv-field-row">
          <div class="otiv-field">
            <label for="nom">Nom complet</label>
            <input type="text" id="nom" value="Hamzah">
          </div>
          <div class="otiv-field">
            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" value="hamzah@otivdiana.mg">
          </div>
        </div>

        <div class="otiv-field-row">
          <div class="otiv-field">
            <label for="telephone">Téléphone</label>
            <input type="tel" id="telephone" value="+261 32 00 000 00">
          </div>
          <div class="otiv-field">
            <label for="departement">Departement</label>
            <select id="departement">
              <option>Informatique</option>
              <option>Crédit</option>
              <option>Comptabilité</option>
              <option>Ressources Humaines</option>
              <option>Direction Générale</option>
            </select>
          </div>
        </div>

        <div class="otiv-field">
          <label for="bio">À propos</label>
          <textarea id="bio">Chargé du développement de l'interface documentaire GED 2.0.</textarea>
        </div>

        <div class="otiv-card__footer">
          <button class="otiv-btn otiv-btn--ghost">Annuler</button>
          <button class="otiv-btn otiv-btn--primary">
            <i class="fa-regular fa-floppy-disk"></i> Enregistrer les modifications
          </button>
        </div>
      </div>

      <div class="otiv-card" id="securite">
        <p class="otiv-card__title">Sécurité</p>
        <p class="otiv-card__subtitle">Modifiez votre mot de passe régulièrement pour protéger votre compte.</p>

        <div class="otiv-field">
          <label for="mdp-actuel">Mot de passe actuel</label>
          <input type="password" id="mdp-actuel" placeholder="••••••••">
        </div>
        <div class="otiv-field-row">
          <div class="otiv-field">
            <label for="mdp-nouveau">Nouveau mot de passe</label>
            <input type="password" id="mdp-nouveau" placeholder="••••••••">
          </div>
          <div class="otiv-field">
            <label for="mdp-confirme">Confirmer le mot de passe</label>
            <input type="password" id="mdp-confirme" placeholder="••••••••">
          </div>
        </div>
        <p class="otiv-field-hint">Minimum 8 caractères, avec au moins une majuscule et un chiffre.</p>

        <div class="otiv-card__footer">
          <button class="otiv-btn otiv-btn--primary">
            <i class="fa-solid fa-lock"></i> Mettre à jour le mot de passe
          </button>
        </div>
      </div>

    </div>
  </div>
<script src="../js/common.js"></script>
<script src="../js/accueil.js"></script>
</main>
</body>
</html>