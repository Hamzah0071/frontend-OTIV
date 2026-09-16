<?php
// Récupère le nom du fichier actuel (ex: "documents.php")
$currentPage = basename($_SERVER['SCRIPT_NAME']);

// Configuration des liens du menu
$navLinks = [
    ['href' => 'accueil.php', 'icon' => 'fa-house', 'label' => 'Accueil'],
    ['href' => 'documents.php', 'icon' => 'fa-folder', 'label' => 'Documents'],
    ['href' => 'partages.php', 'icon' => 'fa-share-nodes', 'label' => 'Partages'],
    ['href' => 'departement.php', 'icon' => 'fa-building', 'label' => 'Departement'],
    ['href' => 'messages.php', 'icon' => 'fa-comments', 'label' => 'Messages'],
    ['href' => 'corbeille.php', 'icon' => 'fa-trash', 'label' => 'Corbeille'],
];
?>
<link rel="shortcut icon" href="../icon/sans-fond.png" type="image/x-icon">
</nav>
<nav class="otiv-nav">
    <div class="otiv-nav__brand">
        <span class="otiv-nav__brand-mark">
        <img src="../icon/sans-fond.png" alt="O">
        </span>OTIV<span>DIANA</span>
    </div>

    <div class="otiv-nav__links">
        <?php foreach ($navLinks as $link): ?>
            <?php $isActive = ($currentPage === $link['href']) ? 'is-active' : ''; ?>
            <a href="<?= $link['href'] ?>" class="otiv-nav__link <?= $isActive ?>">
                <i class="otiv-icon fa-solid <?= $link['icon'] ?>"></i> <?= $link['label'] ?>
            </a>
        <?php endforeach; ?>
    </div>

<!-- Barre de recherche connectée -->
  <div class="otiv-nav__search">
    <i class="otiv-icon fa-solid fa-magnifying-glass"></i>
    <input type="text" id="searchInput" placeholder="Rechercher par nom, format (pdf), date..." autocomplete="off">
  </div>

  <button class="otiv-nav__icon-btn" aria-label="Notifications">
    <i class="otiv-icon fa-solid fa-bell"></i>
    <span class="otiv-nav__badge">1</span>
  </button>

  <a href="./profil.php" class="otiv-nav__user">
    <!-- initiale -->
    <span class="otiv-nav__avatar"></span>
    <!-- name -->
    <span class="otiv-nav__user-name"></span>
  </a>
</nav>