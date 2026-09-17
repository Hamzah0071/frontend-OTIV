<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mon activité — OTIV DIANA</title>
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
      <h1>Mon activité</h1>
      <p>Historique de vos actions et connexions sur votre espace documentaire.</p>
    </div>
  </div>

  <div class="otiv-settings">
    <!-- Navigation latérale -->
      <?php require __DIR__ . '/../includes/header-nav.php'; ?>

    <!-- Contenu -->
    <div>

      <div class="otiv-filter-bar">
        <select aria-label="Filtrer par type d'action">
          <option>Tous les types d'action</option>
          <option>Connexions</option>
          <option>Documents créés / modifiés</option>
          <option>Partages</option>
          <option>Suppressions</option>
        </select>
        <select aria-label="Filtrer par période">
          <option>7 derniers jours</option>
          <option>30 derniers jours</option>
          <option>Cette année</option>
        </select>
        <div class="otiv-filter-bar__spacer"></div>
      </div>

      <div class="otiv-panel">
        <div style="padding: 6px 22px 4px;">
          <div class="otiv-log-list">

            <div class="otiv-log-row">
              <span class="otiv-log-row__icon is-edit"><i class="fa-solid fa-pen"></i></span>
              <div>
                <div class="otiv-log-row__text">Vous avez modifié <b>teste.md</b></div>
                <div class="otiv-log-row__time">Aujourd'hui à 14:32 · Chrome sur Windows</div>
              </div>
            </div>

            <div class="otiv-log-row">
              <span class="otiv-log-row__icon is-login"><i class="fa-solid fa-right-to-bracket"></i></span>
              <div>
                <div class="otiv-log-row__text">Vous vous êtes connecté</div>
                <div class="otiv-log-row__time">Aujourd'hui à 08:02 · Chrome sur Windows</div>
              </div>
            </div>

            <div class="otiv-log-row">
              <span class="otiv-log-row__icon is-edit"><i class="fa-solid fa-share-nodes"></i></span>
              <div>
                <div class="otiv-log-row__text"><b>Rindra</b> a partagé <b>budget-2027.docx</b> avec vous</div>
                <div class="otiv-log-row__time">Hier à 17:10</div>
              </div>
            </div>

            <div class="otiv-log-row">
              <span class="otiv-log-row__icon is-create"><i class="fa-solid fa-plus"></i></span>
              <div>
                <div class="otiv-log-row__text">Vous avez créé le document <b>doc.md</b></div>
                <div class="otiv-log-row__time">Hier à 11:47 · Chrome sur Windows</div>
              </div>
            </div>

            <div class="otiv-log-row">
              <span class="otiv-log-row__icon is-delete"><i class="fa-solid fa-trash"></i></span>
              <div>
                <div class="otiv-log-row__text">Vous avez déplacé <b>ancien-rapport.md</b> vers la corbeille</div>
                <div class="otiv-log-row__time">Il y a 2 jours à 09:14 · Chrome sur Windows</div>
              </div>
            </div>

            <div class="otiv-log-row">
              <span class="otiv-log-row__icon is-login"><i class="fa-solid fa-mobile-screen"></i></span>
              <div>
                <div class="otiv-log-row__text">Connexion depuis un nouvel appareil</div>
                <div class="otiv-log-row__time">Il y a 3 jours à 20:05 · Safari sur iPhone</div>
              </div>
            </div>

            <div class="otiv-log-row">
              <span class="otiv-log-row__icon is-edit"><i class="fa-solid fa-star"></i></span>
              <div>
                <div class="otiv-log-row__text">Vous avez ajouté <b>teste.md</b> à vos favoris</div>
                <div class="otiv-log-row__time">Il y a 4 jours à 15:22</div>
              </div>
            </div>

          </div>
        </div>

        <div class="otiv-pagination">
          <span>Affichage de 1 à 7 sur 23 événements</span>
          <div class="otiv-pagination__pages">
            <button class="is-active">1</button>
            <button>2</button>
            <button>3</button>
          </div>
        </div>
      </div>

    </div>
  </div>

</main>
</body>
</html>
