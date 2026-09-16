<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administration — Utilisateurs — OTIV DIANA</title>
<link rel="stylesheet" href="../icon/fontAwesome/all.min.css">
<link rel="stylesheet" href="../css/common.css">
<link rel="stylesheet" href="../css/admin.css">
</head>
<body class="otiv-body">



<div class="otiv-admin-bar">
  <div class="otiv-admin-bar__label">
    <i class="fa-solid fa-user-shield"></i> Panneau d'administration
  </div>
  <a href="accueil.html"><i class="fa-solid fa-arrow-left"></i> Retour à l'application</a>
</div>

<main class="otiv-page">

  <div class="otiv-section-head">
    <div>
      <h1>Utilisateurs</h1>
      <p>Gérez les comptes, les rôles et l'accès des employés de OTIV DIANA.</p>
    </div>
    <button class="otiv-btn otiv-btn--primary">
      <i class="fa-solid fa-plus"></i> Ajouter un utilisateur
    </button>
  </div>

  <div class="otiv-settings">

<!-- lien vers le includes ou tout les outis detachable -->
<?php require __DIR__ . '/../includes/header-admin.php'; ?>

    <!-- Contenu -->
    <div>

      <div class="otiv-filter-bar">
        <div class="otiv-filter-bar__search">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" placeholder="Rechercher un utilisateur...">
        </div>
        <select aria-label="Filtrer par département">
          <option>Tous les départements</option>
          <option>Crédit</option>
          <option>Comptabilité</option>
          <option>Ressources Humaines</option>
          <option>Informatique</option>
          <option>Direction Générale</option>
        </select>
        <select aria-label="Filtrer par rôle">
          <option>Tous les rôles</option>
          <option>Administrateur</option>
          <option>Responsable</option>
          <option>Utilisateur</option>
        </select>
      </div>

      <div class="otiv-panel">
        <table class="otiv-table">
          <thead>
            <tr>
              <th>Utilisateur</th>
              <th>Département</th>
              <th>Rôle</th>
              <th>Statut</th>
              <th class="otiv-table__col-actions">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <div class="otiv-person">
                  <span class="otiv-person__avatar">H</span>
                  <div>
                    <div class="otiv-person__name">Hamzah</div>
                    <div class="otiv-person__email">hamzah@otivdiana.mg</div>
                  </div>
                </div>
              </td>
              <td class="otiv-cell-muted">Informatique</td>
              <td><span class="otiv-badge-role is-admin"><i class="fa-solid fa-user-shield"></i> Administrateur</span></td>
              <td><span class="otiv-badge-status is-active"><i class="fa-solid fa-circle"></i> Actif</span></td>
              <td class="otiv-table__col-actions">
                <div class="otiv-row-actions">
                  <button class="otiv-icon-action" aria-label="Modifier"><i class="fa-solid fa-pen"></i></button>
                  <button class="otiv-icon-action is-danger" aria-label="Désactiver"><i class="fa-solid fa-ban"></i></button>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="otiv-person">
                  <span class="otiv-person__avatar">J</span>
                  <div>
                    <div class="otiv-person__name">Jack</div>
                    <div class="otiv-person__email">jack@otivdiana.mg</div>
                  </div>
                </div>
              </td>
              <td class="otiv-cell-muted">Informatique</td>
              <td><span class="otiv-badge-role is-admin"><i class="fa-solid fa-user-shield"></i> Administrateur</span></td>
              <td><span class="otiv-badge-status is-active"><i class="fa-solid fa-circle"></i> Actif</span></td>
              <td class="otiv-table__col-actions">
                <div class="otiv-row-actions">
                  <button class="otiv-icon-action" aria-label="Modifier"><i class="fa-solid fa-pen"></i></button>
                  <button class="otiv-icon-action is-danger" aria-label="Désactiver"><i class="fa-solid fa-ban"></i></button>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="otiv-person">
                  <span class="otiv-person__avatar">R</span>
                  <div>
                    <div class="otiv-person__name">Rindra</div>
                    <div class="otiv-person__email">rindra@otivdiana.mg</div>
                  </div>
                </div>
              </td>
              <td class="otiv-cell-muted">Comptabilité</td>
              <td><span class="otiv-badge-role is-manager"><i class="fa-solid fa-star"></i> Responsable</span></td>
              <td><span class="otiv-badge-status is-active"><i class="fa-solid fa-circle"></i> Actif</span></td>
              <td class="otiv-table__col-actions">
                <div class="otiv-row-actions">
                  <button class="otiv-icon-action" aria-label="Modifier"><i class="fa-solid fa-pen"></i></button>
                  <button class="otiv-icon-action is-danger" aria-label="Désactiver"><i class="fa-solid fa-ban"></i></button>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="otiv-person">
                  <span class="otiv-person__avatar">F</span>
                  <div>
                    <div class="otiv-person__name">Fenosoa</div>
                    <div class="otiv-person__email">fenosoa@otivdiana.mg</div>
                  </div>
                </div>
              </td>
              <td class="otiv-cell-muted">Crédit</td>
              <td><span class="otiv-badge-role is-user"><i class="fa-regular fa-user"></i> Utilisateur</span></td>
              <td><span class="otiv-badge-status is-active"><i class="fa-solid fa-circle"></i> Actif</span></td>
              <td class="otiv-table__col-actions">
                <div class="otiv-row-actions">
                  <button class="otiv-icon-action" aria-label="Modifier"><i class="fa-solid fa-pen"></i></button>
                  <button class="otiv-icon-action is-danger" aria-label="Désactiver"><i class="fa-solid fa-ban"></i></button>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="otiv-person">
                  <span class="otiv-person__avatar">T</span>
                  <div>
                    <div class="otiv-person__name">Tovo</div>
                    <div class="otiv-person__email">tovo@otivdiana.mg</div>
                  </div>
                </div>
              </td>
              <td class="otiv-cell-muted">Ressources Humaines</td>
              <td><span class="otiv-badge-role is-user"><i class="fa-regular fa-user"></i> Utilisateur</span></td>
              <td><span class="otiv-badge-status is-pending"><i class="fa-solid fa-circle"></i> Invitation envoyée</span></td>
              <td class="otiv-table__col-actions">
                <div class="otiv-row-actions">
                  <button class="otiv-icon-action" aria-label="Renvoyer l'invitation"><i class="fa-solid fa-paper-plane"></i></button>
                  <button class="otiv-icon-action is-danger" aria-label="Annuler l'invitation"><i class="fa-solid fa-trash"></i></button>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="otiv-person">
                  <span class="otiv-person__avatar">L</span>
                  <div>
                    <div class="otiv-person__name">Lova</div>
                    <div class="otiv-person__email">lova@otivdiana.mg</div>
                  </div>
                </div>
              </td>
              <td class="otiv-cell-muted">Direction Générale</td>
              <td><span class="otiv-badge-role is-user"><i class="fa-regular fa-user"></i> Utilisateur</span></td>
              <td><span class="otiv-badge-status is-inactive"><i class="fa-solid fa-circle"></i> Désactivé</span></td>
              <td class="otiv-table__col-actions">
                <div class="otiv-row-actions">
                  <button class="otiv-icon-action" aria-label="Réactiver"><i class="fa-solid fa-rotate-left"></i></button>
                  <button class="otiv-icon-action is-danger" aria-label="Supprimer"><i class="fa-solid fa-trash"></i></button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="otiv-pagination">
          <span>Affichage de 1 à 6 sur 47 utilisateurs</span>
          <div class="otiv-pagination__pages">
            <button class="is-active">1</button>
            <button>2</button>
            <button>3</button>
            <button>…</button>
            <button>8</button>
          </div>
        </div>
      </div>

    </div>
  </div>

</main>
</body>
</html>
