<?php
// Récupère le fichier PHP courant (ex: profil.php)
$currentPage = basename($_SERVER['SCRIPT_NAME']);

// Configuration des liens du menu
$settingsNavLinks = [
    ['href' => 'profil.php',     'icon' => 'fa-regular fa-user',          'label' => 'Profil'],
    ['href' => 'parametres.php', 'icon' => 'fa-solid fa-gear',            'label' => 'Paramètres'],
    ['href' => 'journal.php',    'icon' => 'fa-solid fa-clock-rotate-left', 'label' => 'Mon activité'],
];
?>

<!-- Navigation latérale -->
<div class="otiv-settings-nav">
    <?php foreach ($settingsNavLinks as $link): ?>
        <?php $isActive = ($currentPage === $link['href']) ? 'is-active' : ''; ?>
        <a href="<?= $link['href'] ?>" class="otiv-settings-nav__link <?= $isActive ?>">
            <i class="<?= $link['icon'] ?>"></i> <?= $link['label'] ?>
        </a>
    <?php endforeach; ?>

    <!-- Lien fixe de déconnexion -->
    <a href="../login.php" class="otiv-nav__link is-danger">
        <i class="otiv-icon fa-solid fa-right-from-bracket"></i> Déconnexion
    </a>
</div>