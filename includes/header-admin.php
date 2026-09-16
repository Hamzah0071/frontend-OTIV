<?php $currentPage = basename($_SERVER['SCRIPT_NAME']); ?>

<link rel="stylesheet" href="../icon/fontAwesome/all.min.css">
<link rel="stylesheet" href="../css/common.css">
<link rel="stylesheet" href="../css/admin.css">


<!-- Navigation admin -->
<div class="otiv-settings-nav">
  <a href="admin-dashboard.php" class="otiv-settings-nav__link <?= ($currentPage === 'admin-dashboard.php') ? 'is-active' : '' ?>">
    <i class="fa-solid fa-gauge-high"></i> Tableau de bord
  </a>
  <a href="admin-utilisateurs.php" class="otiv-settings-nav__link <?= ($currentPage === 'admin-utilisateurs.php') ? 'is-active' : '' ?>">
    <i class="fa-solid fa-users"></i> Utilisateurs
  </a>
  <a href="admin-departements.php" class="otiv-settings-nav__link <?= ($currentPage === 'admin-departements.php') ? 'is-active' : '' ?>">
    <i class="fa-solid fa-building"></i> Départements
  </a>
  <a href="admin-Messages.php" class="otiv-settings-nav__link <?= ($currentPage === 'admin-Messages.php') ? 'is-active' : '' ?>">
    <i class="otiv-icon fa-solid fa-comments"></i> SMS
  </a>
  <a href="admin-journal.php" class="otiv-settings-nav__link <?= ($currentPage === 'admin-journal.php') ? 'is-active' : '' ?>">
    <i class="fa-solid fa-clock-rotate-left"></i> Journal d'activité
  </a>
  <a href="admin-parametres.php" class="otiv-settings-nav__link <?= ($currentPage === 'admin-parametres.php') ? 'is-active' : '' ?>">
    <i class="fa-solid fa-sliders"></i> Paramètres système
  </a>
  <!-- Lien fixe de déconnexion -->
  <a href="../login.php" class="otiv-nav__link is-danger">
   <i class="otiv-icon fa-solid fa-right-from-bracket"></i> Déconnexion
  </a>
</div>