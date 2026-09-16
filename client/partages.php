<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Partages — OTIV DIANA</title>
<link rel="shortcut icon" href="icon/sans-fond.png" type="image/x-icon">
<link rel="stylesheet" href="../icon/fontAwesome/all.min.css">
<link rel="stylesheet" href="../css/common.css">
<link rel="stylesheet" href="../css/partages.css">


</head>
<body class="otiv-body">

  <!-- header -->
   <?php require __DIR__ . '/../includes/header.php'; ?>

<main class="otiv-page">

  <div class="otiv-section-head">
    <div>
      <h1>Partages</h1>
      <p>Documents que vous avez partagés ou reçus.</p>
    </div>
  </div>

  <div class="otiv-tabs">
    <button class="otiv-tabs__btn is-active" data-tab="by-me">Partagés par moi</button>
    <button class="otiv-tabs__btn" data-tab="with-me">Partagés avec moi</button>
  </div>

  <!-- Onglet : Partagés PAR moi -->
  <div class="otiv-panel otiv-tab-panel" id="tab-by-me">
    <table class="otiv-table">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Partagé avec</th>
          <th>Modifié</th>
          <th class="otiv-table__col-actions">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <a href="edition.html" class="otiv-file-name">
              <i class="otiv-icon is-file fa-regular fa-file-lines"></i>
              teste.md
            </a>
          </td>
          <td>
            <div class="otiv-people">
              <span class="otiv-people__avatar">J</span>
              <span class="otiv-people__avatar">R</span>
            </div>
          </td>
          <td class="otiv-cell-muted">Aujourd'hui</td>
          <td class="otiv-table__col-actions">
            <div class="otiv-row-actions">
              <button class="otiv-icon-action" aria-label="Télécharger"><i class="otiv-icon fa-solid fa-download"></i></button>
              <button class="otiv-icon-action" aria-label="Gérer le partage"><i class="otiv-icon fa-solid fa-share-nodes"></i></button>
              <button class="otiv-icon-action is-danger" aria-label="Arrêter le partage"><i class="otiv-icon fa-solid fa-trash"></i></button>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <a href="#" class="otiv-file-name">
              <i class="otiv-icon is-folder fa-solid fa-folder"></i>
              dossier-teste
            </a>
          </td>
          <td>
            <span class="otiv-tag">Département Crédit</span>
          </td>
          <td class="otiv-cell-muted">Hier</td>
          <td class="otiv-table__col-actions">
            <div class="otiv-row-actions">
              <button class="otiv-icon-action" aria-label="Gérer le partage"><i class="otiv-icon fa-solid fa-share-nodes"></i></button>
              <button class="otiv-icon-action is-danger" aria-label="Arrêter le partage"><i class="otiv-icon fa-solid fa-trash"></i></button>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <a href="edition.html" class="otiv-file-name">
              <i class="otiv-icon is-file fa-regular fa-file-lines"></i>
              doc.md
            </a>
          </td>
          <td>
            <div class="otiv-people">
              <span class="otiv-people__avatar">H</span>
            </div>
          </td>
          <td class="otiv-cell-muted">Il y a 2 jours</td>
          <td class="otiv-table__col-actions">
            <div class="otiv-row-actions">
              <button class="otiv-icon-action" aria-label="Télécharger"><i class="otiv-icon fa-solid fa-download"></i></button>
              <button class="otiv-icon-action" aria-label="Gérer le partage"><i class="otiv-icon fa-solid fa-share-nodes"></i></button>
              <button class="otiv-icon-action is-danger" aria-label="Arrêter le partage"><i class="otiv-icon fa-solid fa-trash"></i></button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Onglet : Partagés AVEC moi -->
  <div class="otiv-panel otiv-tab-panel" id="tab-with-me" hidden>
    <table class="otiv-table">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Partagé par</th>
          <th>Modifié</th>
          <th class="otiv-table__col-actions">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <a href="edition.html" class="otiv-file-name">
              <i class="otiv-icon is-file fa-regular fa-file-lines"></i>
              budget-previsionnel.xlsx
            </a>
          </td>
          <td>
            <div class="otiv-people">
              <span class="otiv-people__avatar">R</span>
              <span class="otiv-people__name">Rakoto</span>
            </div>
          </td>
          <td class="otiv-cell-muted">Aujourd'hui</td>
          <td class="otiv-table__col-actions">
            <div class="otiv-row-actions">
              <button class="otiv-icon-action" aria-label="Télécharger"><i class="otiv-icon fa-solid fa-download"></i></button>
              <button class="otiv-icon-action is-favorite" aria-label="Favori"><i class="otiv-icon fa-regular fa-star"></i></button>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <a href="#" class="otiv-file-name">
              <i class="otiv-icon is-folder fa-solid fa-folder"></i>
              archives-2025
            </a>
          </td>
          <td>
            <span class="otiv-tag">Département Comptabilité</span>
          </td>
          <td class="otiv-cell-muted">Il y a 3 jours</td>
          <td class="otiv-table__col-actions">
            <div class="otiv-row-actions">
              <button class="otiv-icon-action is-favorite" aria-label="Favori"><i class="otiv-icon fa-regular fa-star"></i></button>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <a href="edition.html" class="otiv-file-name">
              <i class="otiv-icon is-file fa-regular fa-file-lines"></i>
              procedure-interne.docx
            </a>
          </td>
          <td>
            <div class="otiv-people">
              <span class="otiv-people__avatar">J</span>
              <span class="otiv-people__name">Jack</span>
            </div>
          </td>
          <td class="otiv-cell-muted">La semaine dernière</td>
          <td class="otiv-table__col-actions">
            <div class="otiv-row-actions">
              <button class="otiv-icon-action" aria-label="Télécharger"><i class="otiv-icon fa-solid fa-download"></i></button>
              <button class="otiv-icon-action is-favorite" aria-label="Favori"><i class="otiv-icon fa-regular fa-star"></i></button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

</main>
<script src="../js/common.js"></script>
<script src="../js/accueil.js"></script>
</body>
</html>