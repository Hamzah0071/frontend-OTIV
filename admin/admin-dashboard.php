<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administration — Tableau de bord — OTIV DIANA</title>
<link rel="shortcut icon" href="../icon/sans-fond.png" type="image/x-icon">
<link rel="stylesheet" href="../icon/fontAwesome/all.min.css">
<link rel="stylesheet" href="../css/common.css">
<link rel="stylesheet" href="../css/admin.css">
</head>
<body class="otiv-body">

<div class="otiv-admin-bar">
  <div class="otiv-admin-bar__label">
    <i class="fa-solid fa-user-shield"></i> Panneau d'administration
  </div>
  <!-- pouvoir voir revenir dans la page d'utilisateur simple -->
  <a href="#"><i class="fa-solid fa-arrow-left"></i> Retour à l'application</a>
</div>

<main class="otiv-page">

  <div class="otiv-section-head">
    <div>
      <h1>Tableau de bord</h1>
      <p>Vue d'ensemble de l'activité et de l'état du système GED 2.0.</p>
    </div>
  </div>

  <div class="otiv-settings">
<!-- lien vers le includes ou tout les outis detachable -->
<?php require __DIR__ . '/../includes/header-admin.php'; ?>
    <!-- Contenu -->
    <div>

      <div class="otiv-stat-grid">
        <div class="otiv-stat-card">
          <span class="otiv-stat-card__icon is-green"><i class="fa-solid fa-users"></i></span>
          <div>
            <div class="otiv-stat-card__value">47</div>
            <div class="otiv-stat-card__label">Utilisateurs actifs</div>
            <div class="otiv-stat-card__trend is-up"><i class="fa-solid fa-arrow-up"></i> +3 ce mois-ci</div>
          </div>
        </div>
        <div class="otiv-stat-card">
          <span class="otiv-stat-card__icon is-navy"><i class="fa-regular fa-file-lines"></i></span>
          <div>
            <div class="otiv-stat-card__value">1 284</div>
            <div class="otiv-stat-card__label">Documents stockés</div>
            <div class="otiv-stat-card__trend is-up"><i class="fa-solid fa-arrow-up"></i> +56 cette semaine</div>
          </div>
        </div>
        <div class="otiv-stat-card">
          <span class="otiv-stat-card__icon is-amber"><i class="fa-solid fa-database"></i></span>
          <div>
            <div class="otiv-stat-card__value">128 Go</div>
            <div class="otiv-stat-card__label">Espace utilisé / 500 Go</div>
            <div class="otiv-stat-card__trend">26 % de la capacité totale</div>
          </div>
        </div>
        <div class="otiv-stat-card">
          <span class="otiv-stat-card__icon is-red"><i class="fa-solid fa-triangle-exclamation"></i></span>
          <div>
            <div class="otiv-stat-card__value">5</div>
            <div class="otiv-stat-card__label">Connexions échouées (24h)</div>
            <div class="otiv-stat-card__trend is-down"><i class="fa-solid fa-arrow-down"></i> -2 vs hier</div>
          </div>
        </div>
      </div>

      <div class="otiv-card">
        <p class="otiv-card__title">Répartition par département</p>
        <p class="otiv-card__subtitle">Nombre d'utilisateurs et de documents par département.</p>

        <table class="otiv-table">
          <thead>
            <tr>
              <th>Département</th>
              <th>Utilisateurs</th>
              <th>Documents</th>
              <th>Espace utilisé</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="otiv-file-name"><i class="fa-solid fa-building"></i> Crédit</td>
              <td class="otiv-cell-muted">12</td>
              <td class="otiv-cell-muted">318</td>
              <td class="otiv-cell-muted">34 Go</td>
            </tr>
            <tr>
              <td class="otiv-file-name"><i class="fa-solid fa-building"></i> Comptabilité</td>
              <td class="otiv-cell-muted">9</td>
              <td class="otiv-cell-muted">402</td>
              <td class="otiv-cell-muted">51 Go</td>
            </tr>
            <tr>
              <td class="otiv-file-name"><i class="fa-solid fa-building"></i> Ressources Humaines</td>
              <td class="otiv-cell-muted">6</td>
              <td class="otiv-cell-muted">96</td>
              <td class="otiv-cell-muted">9 Go</td>
            </tr>
            <tr>
              <td class="otiv-file-name"><i class="fa-solid fa-building"></i> Informatique</td>
              <td class="otiv-cell-muted">8</td>
              <td class="otiv-cell-muted">214</td>
              <td class="otiv-cell-muted">27 Go</td>
            </tr>
            <tr>
              <td class="otiv-file-name"><i class="fa-solid fa-building"></i> Direction Générale</td>
              <td class="otiv-cell-muted">4</td>
              <td class="otiv-cell-muted">254</td>
              <td class="otiv-cell-muted">7 Go</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="otiv-card">
        <p class="otiv-card__title">Activité récente</p>
        <p class="otiv-card__subtitle">Derniers événements enregistrés sur la plateforme.</p>

        <div class="otiv-log-list">
          <div class="otiv-log-row">
            <span class="otiv-log-row__icon is-create"><i class="fa-solid fa-plus"></i></span>
            <div>
              <div class="otiv-log-row__text"><b>Rindra</b> a créé le document <b>budget-2027.docx</b></div>
              <div class="otiv-log-row__time">Il y a 12 minutes</div>
            </div>
          </div>
          <div class="otiv-log-row">
            <span class="otiv-log-row__icon is-login"><i class="fa-solid fa-right-to-bracket"></i></span>
            <div>
              <div class="otiv-log-row__text"><b>Fenosoa</b> s'est connecté depuis Antsiranana</div>
              <div class="otiv-log-row__time">Il y a 40 minutes</div>
            </div>
          </div>
          <div class="otiv-log-row">
            <span class="otiv-log-row__icon is-delete"><i class="fa-solid fa-trash"></i></span>
            <div>
              <div class="otiv-log-row__text"><b>Hamzah</b> a supprimé le dossier <b>archives-2023</b></div>
              <div class="otiv-log-row__time">Aujourd'hui à 09:14</div>
            </div>
          </div>
          <div class="otiv-log-row">
            <span class="otiv-log-row__icon is-edit"><i class="fa-solid fa-pen"></i></span>
            <div>
              <div class="otiv-log-row__text"><b>Admin</b> a modifié les permissions du département <b>Crédit</b></div>
              <div class="otiv-log-row__time">Hier à 17:02</div>
            </div>
          </div>
        </div>

        <div class="otiv-card__footer">
          <a href="admin-journal.html" class="otiv-btn otiv-btn--ghost">
            Voir tout le journal d'activité <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>
      </div>

    </div>
  </div>

</main>
</body>
</html>
