<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Accueil — OTIV DIANA</title>

<script src="../js/mobile-menu.js" defer></script>


<link rel="stylesheet" href="../icon/fontAwesome/all.min.css">
<link rel="shortcut icon" href="../icon/sans-fond.png" type="image/x-icon">
<link rel="stylesheet" href="../css/common.css">
<link rel="stylesheet" href="../css/accueil.css">
<link rel="stylesheet" href="../css/responsive.css">


<script src="http://localhost:8081/web-apps/apps/api/documents/api.js"></script>

</head>
<body class="otiv-body">

  <!-- header -->
   <?php require __DIR__ . '/../includes/header.php'; ?>

<main class="otiv-page">
  <!-- Bannière d'accueil -->
  <section class="otiv-hero">
    <div>
      <p class="otiv-hero__eyebrow">OTIV DIANA · ESPACE DOCUMENTAIRE</p>
      <h1 class="otiv-hero__title">Bonjour </h1>
      <p class="otiv-hero__subtitle">Retrouvez simplement vos documents et dossiers de travail.</p>
    </div>
    <div class="otiv-hero__actions">
      <!-- Bouton d'importation connecté au PC -->
      <button id="btnImportHero" class="otiv-btn otiv-btn--dark" style="cursor: pointer; border: none;">
        <i class="fa-solid fa-file-import"></i> Importation
      </button>
      <input type="file" id="heroFilePicker" style="display: none;">

      <a href="profil.php" class="otiv-btn otiv-btn--solid">
        <i class="fa-solid fa-cloud"></i> Mon profil
      </a>
    </div>
  </section>

  <!-- Actions rapides -->
  <section class="otiv-quick-actions">
    <h2 class="otiv-quick-actions__title">Actions rapides</h2>
    <div class="otiv-quick-actions__grid">
      <button class="otiv-quick-action" data-action="create-doc" data-type="docx">
        <span class="otiv-quick-action__icon is-word"><i class="fa-solid fa-file-word"></i></span>
        <span class="otiv-quick-action__label">Document Word</span>
      </button>

      <button class="otiv-quick-action" data-action="create-doc" data-type="xlsx">
        <span class="otiv-quick-action__icon is-excel"><i class="fa-solid fa-file-excel"></i></span>
        <span class="otiv-quick-action__label">Feuille Excel</span>
      </button>

      <button class="otiv-quick-action" data-action="create-doc" data-type="pptx">
        <span class="otiv-quick-action__icon is-ppt"><i class="fa-solid fa-file-powerpoint"></i></span>
        <span class="otiv-quick-action__label">Présentation PowerPoint</span>
      </button>

      <button class="otiv-quick-action" data-action="create-doc" data-type="folder">
        <span class="otiv-quick-action__icon is-folder"><i class="fa-solid fa-folder-plus"></i></span>
        <span class="otiv-quick-action__label">Nouveau dossier</span>
      </button>
    </div>
  </section>

  <!-- Modal création de document / dossier -->
  <div class="otiv-modal-overlay" id="createDocModal" hidden>
    <div class="otiv-modal otiv-modal--sm">
      <div class="otiv-modal__header">
        <h3 class="otiv-modal__title">
          <i class="otiv-icon fa-solid" id="createDocIcon"></i>
          <span id="createDocTitle">Nouveau document</span>
        </h3>
        <button class="otiv-modal__close" data-action="close-create-doc" aria-label="Fermer">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <div class="otiv-modal__body">
        <div class="otiv-field">
          <label id="createDocLabel">Nom du document :</label>
          <input type="text" id="createDocInput" placeholder="Nom">
        </div>
      </div>

      <div class="otiv-modal__footer">
        <button class="otiv-btn otiv-btn--ghost" data-action="close-create-doc">Annuler</button>
        <button class="otiv-btn otiv-btn--solid" id="createDocConfirm">OK</button>
      </div>
    </div>
  </div>

  <nav class="otiv-breadcrumb">
    <i class="otiv-icon fa-solid fa-house"></i>
    <span class="otiv-breadcrumb__crumb is-current" id="sectionLabel">Documents récents</span>
  </nav>

  <!-- Zone de statut de recherche -->
  <div id="searchStatusBar" class="search-status-bar" style="display: none;">
    <span id="searchResultText"></span>
    <button class="btn-reset-search" onclick="resetSearch()">Effacer la recherche</button>
  </div>

  <!-- Tableau des documents récents -->
  <div class="otiv-panel">
    <table class="otiv-table">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Taille</th>
          <th>Modifié / Créé</th>
          <th class="otiv-table__col-actions">Actions</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        <tr>
          <td colspan="4" style="text-align: center; padding: 20px;">Chargement...</td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Modal historique des activités / versions -->
  <div class="otiv-modal-overlay" id="historyModal" hidden>
    <div class="otiv-modal">
      <div class="otiv-modal__header">
        <h3 class="otiv-modal__title">
          <i class="otiv-icon fa-solid fa-clock-rotate-left"></i>
          Historique d'activité — <span id="historyFileName">document</span>
        </h3>
        <button class="otiv-modal__close" data-action="close-history" aria-label="Fermer">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <div class="otiv-modal__body">
        <ul class="otiv-history-list" id="historyList">
          <!-- Rempli dynamiquement depuis MariaDB -->
        </ul>
      </div>
    </div>
  </div>

  <!-- MODALE PLEIN ÉCRAN UNIVERSELLE ONLYOFFICE & MÉDIAS -->
  <!-- Le display:none/flex reste géré en JS (accueil.js) via style.display,
       tout le reste de l'apparence vient maintenant de accueil.css (.otiv-preview)
       afin de pouvoir l'adapter aux petits écrans. -->
  <div id="previewModal" class="otiv-preview" style="display: none;">
    <!-- Barre d'en-tête compacte -->
    <div class="otiv-preview__header">
      <div class="otiv-preview__info">
        <i id="modalFileIcon" class="fa-solid fa-file otiv-preview__icon"></i>
        <h3 id="modalFileTitle" class="otiv-preview__title">Nom du document</h3>
        <span class="otiv-preview__tag">Espace Sécurisé OTIV DIANA</span>
      </div>
      <div class="otiv-preview__actions">
        <a id="modalDownloadBtn" href="#" class="otiv-btn otiv-btn--ghost otiv-preview__download" download>
          <i class="fa-solid fa-download"></i> <span>Télécharger</span>
        </a>
        <button class="otiv-preview__close" onclick="closePreviewModal()" title="Fermer l'éditeur (Échap)">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
    </div>
    <!-- Zone de travail OnlyOffice occupant 100% de la hauteur restante -->
    <div id="modalBody" class="otiv-preview__body"></div>
  </div>
</main>

<script src="../js/common.js"></script>
<script src="../js/accueil.js"></script>
<script src="http://localhost:8081/web-apps/apps/api/documents/api.js"></script>

</body>
</html>