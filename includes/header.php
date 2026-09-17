<?php
$currentPage = basename($_SERVER['SCRIPT_NAME']);

$navLinks = [
    ['href' => 'accueil.php',     'icon' => 'fa-house',       'label' => 'Accueil'],
    ['href' => 'documents.php',   'icon' => 'fa-folder',      'label' => 'Documents'],
    ['href' => 'partages.php',    'icon' => 'fa-share-nodes', 'label' => 'Partages'],
    ['href' => 'departement.php', 'icon' => 'fa-building',   'label' => 'Departement'],
    ['href' => 'messages.php',    'icon' => 'fa-comments',   'label' => 'Messages'],
    ['href' => 'corbeille.php',   'icon' => 'fa-trash',      'label' => 'Corbeille'],
];

function isActivePage(string $href, string $currentPage): string {
    return $href === $currentPage ? 'is-active' : '';
}
?>

<header class="otiv-header">
  <!-- Barre desktop : conservée à partir de 768px -->
  <nav class="otiv-nav otiv-nav--desktop" aria-label="Navigation principale">
    <a class="otiv-nav__brand" href="accueil.php" aria-label="OTIV DIANA - Accueil">
      <span class="otiv-nav__brand-mark">
        <img src="../icon/sans-fond.png" alt="Logo OTIV">
      </span>
      <span class="otiv-nav__brand-text">OTIV<span style="color: black;">DIANA</span></span>
    </a>

    <div class="otiv-nav__links">
      <?php foreach ($navLinks as $link): ?>
        <a href="<?= htmlspecialchars($link['href'], ENT_QUOTES, 'UTF-8') ?>"
           class="otiv-nav__link <?= isActivePage($link['href'], $currentPage) ?>">
          <i class="otiv-icon fa-solid <?= htmlspecialchars($link['icon'], ENT_QUOTES, 'UTF-8') ?>"></i>
          <?= htmlspecialchars($link['label'], ENT_QUOTES, 'UTF-8') ?>
        </a>
      <?php endforeach; ?>
    </div>

    <label class="otiv-nav__search" for="searchInput">
      <i class="otiv-icon fa-solid fa-magnifying-glass"></i>
      <input type="search" id="searchInput" placeholder="Rechercher..." autocomplete="off">
    </label>

    <button class="otiv-nav__icon-btn" type="button" aria-label="Notifications">
      <i class="otiv-icon fa-solid fa-bell"></i>
      <span class="otiv-nav__badge">1</span>
    </button>

    <a href="profil.php" class="otiv-nav__user" aria-label="Ouvrir le profil">
      <span class="otiv-nav__avatar">H</span>
      <span class="otiv-nav__user-name">Hamzah</span>
      <i class="fa-solid fa-chevron-down"></i>
    </a>
  </nav>

  <!-- Barre mobile : visible uniquement sous 768px -->
  <div class="otiv-mobile-bar">
    <a href="accueil.php" class="otiv-mobile-bar__brand" aria-label="OTIV DIANA - Accueil">
      <img src="../icon/sans-fond.png" alt="Logo OTIV">
      <strong>OTIV <span>DIANA</span></strong>
    </a>

    <div class="otiv-mobile-bar__actions">
      <button class="otiv-nav__icon-btn" id="mobileSearchButton" type="button" aria-label="Rechercher" aria-expanded="false">
        <i class="otiv-icon fa-solid fa-magnifying-glass"></i>
      </button>
      <button class="otiv-nav__icon-btn" type="button" aria-label="Notifications">
        <i class="otiv-icon fa-solid fa-bell"></i>
        <span class="otiv-nav__badge">1</span>
      </button>
      <button class="otiv-nav__icon-btn otiv-mobile-menu-button" id="mobileMenuButton" type="button" aria-label="Ouvrir le menu" aria-controls="mobileDrawer" aria-expanded="false">
        <i class="fa-solid fa-bars"></i>
      </button>
    </div>
  </div>

  <!-- Champ de recherche mobile dépliable -->
  <div class="otiv-mobile-search" id="mobileSearchPanel" hidden>
    <i class="otiv-icon fa-solid fa-magnifying-glass"></i>
    <input type="search" id="mobileSearchInput" placeholder="Rechercher..." autocomplete="off">
  </div>

  <!-- Overlay + drawer mobile -->
  <div class="otiv-drawer-overlay" id="mobileDrawerOverlay" hidden></div>
  <aside class="otiv-drawer" id="mobileDrawer" aria-label="Menu mobile" aria-hidden="true">
    <div class="otiv-drawer__header">
      <a href="accueil.php" class="otiv-mobile-bar__brand">
        <img src="../icon/sans-fond.png" alt="Logo OTIV">
        <strong>OTIV <span>DIANA</span></strong>
      </a>
      <button class="otiv-nav__icon-btn" id="mobileDrawerClose" type="button" aria-label="Fermer le menu">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <nav class="otiv-drawer__links">
      <?php foreach ($navLinks as $link): ?>
        <a href="<?= htmlspecialchars($link['href'], ENT_QUOTES, 'UTF-8') ?>"
           class="otiv-drawer__link <?= isActivePage($link['href'], $currentPage) ?>">
          <i class="otiv-icon fa-solid <?= htmlspecialchars($link['icon'], ENT_QUOTES, 'UTF-8') ?>"></i>
          <span><?= htmlspecialchars($link['label'], ENT_QUOTES, 'UTF-8') ?></span>
        </a>
      <?php endforeach; ?>
    </nav>

    <div class="otiv-drawer__footer">
      <a href="profil.php" class="otiv-drawer__profile">
        <span class="otiv-nav__avatar">H</span>
        <span><strong>Hamzah</strong><small>Agent de Crédit Diego</small></span>
      </a>
      <a href="profil.php" class="otiv-drawer__link">
        <i class="fa-regular fa-user"></i><span>Profil</span>
      </a>
    </div>
  </aside>
</header>
