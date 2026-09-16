# rsponsive

# headre
n'est pas adapet au petit ecrant on est obliger de scroller pour povoir attendre un nav
l'espage recherche est pas responsive
#  document 
la route de dossier racine n'est pas adepete

en fait tout les pages

-------------------------------------------------------------
#
auth_check.php
```

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header('Location: /login.php');
    exit;
}
```

redirect_helper.php
```
<?php
/**
 * Retourne le chemin de redirection selon le rôle de l'utilisateur en session.
 */
function getRedirectUrlForUser(array $user): string
{
    return match ($user['role'] ?? 'client') {
        'admin' => '../admin/admin-dashboard.php',   // adapte au vrai chemin
        'client' => '../client/accueil.php',   // adapte au vrai chemin
        default => '/backend/public/client/accueil.php',
    };
}
```
logout.php
```
<?php
session_start();
session_destroy();
header('location : /login.php');
?>
```
accueil.php
```
<?php 
$requiredRole = 'client';
require __DIR__ . '/../includes/redirect_helper.php';
require __DIR__ . '/../includes/auth_check.php';
?>
```