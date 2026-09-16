<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Favoris — OTIV DIANA</title>
<link rel="shortcut icon" href="../icon/sans-fond.png" type="image/x-icon">
<link rel="stylesheet" href="../icon/fontAwesome/all.min.css">
<link rel="stylesheet" href="../css/common.css">
</head>
<body class="otiv-body">


  <!-- header -->
   <?php require __DIR__ . '/../includes/header.php'; ?>


<main class="otiv-page">

  <div class="otiv-section-head">
    <div>
      <h1>Favoris</h1>
      <p>Vos fichiers et dossiers marqués comme importants.</p>
    </div>
  </div>

  <div class="otiv-panel">
    <table class="otiv-table">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Emplacement</th>
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
          <td class="otiv-cell-muted">Documents</td>
          <td class="otiv-cell-muted">Aujourd'hui</td>
          <td class="otiv-table__col-actions">
            <div class="otiv-row-actions">
              <button class="otiv-icon-action" aria-label="Télécharger"><i class="otiv-icon fa-solid fa-download"></i></button>
              <button class="otiv-icon-action is-favorite" aria-label="Retirer des favoris"><i class="otiv-icon fa-solid fa-star"></i></button>
              <button class="otiv-icon-action" aria-label="Partager"><i class="otiv-icon fa-solid fa-share-nodes"></i></button>
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
          <td class="otiv-cell-muted">Departement · Crédit</td>
          <td class="otiv-cell-muted">Hier</td>
          <td class="otiv-table__col-actions">
            <div class="otiv-row-actions">
              <button class="otiv-icon-action is-favorite" aria-label="Retirer des favoris"><i class="otiv-icon fa-solid fa-star"></i></button>
              <button class="otiv-icon-action" aria-label="Partager"><i class="otiv-icon fa-solid fa-share-nodes"></i></button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Etat vide (à afficher à la place du tableau lorsqu'il n'y a aucun favori) -->
    <!--
    <div class="otiv-empty">
      <i class="fa-regular fa-star"></i>
      <h3>Aucun favori pour l'instant</h3>
      <p>Cliquez sur l'étoile d'un fichier ou d'un dossier pour le retrouver ici rapidement.</p>
    </div>
    -->
  </div>

</main>
<script src="../js/common.js"></script>
</body>
</html>
