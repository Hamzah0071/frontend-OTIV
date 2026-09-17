<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Documents — OTIV DIANA</title>
<link rel="shortcut icon" href="../icon/sans-fond.png" type="image/x-icon">
<link rel="stylesheet" href="../icon/fontAwesome/all.min.css">
<link rel="stylesheet" href="../css/common.css">
<link rel="stylesheet" href="../css/documents.css">

<link rel="stylesheet" href="../css/responsive.css">
<script src="../js/mobile-menu.js" defer></script>
<script src="http://localhost:8081/web-apps/apps/api/documents/api.js"></script>

</head>
<body class="otiv-body">

  <!-- header -->
   <?php require __DIR__ . '/../includes/header.php'; ?>

<main class="otiv-page">

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
  
  <div id="searchAlertBar" class="search-alert-bar" style="display: none;">
    <span id="searchAlertText"></span>
    <button class="btn-reset-search" onclick="clearSearch()">Quitter la recherche</button>
  </div>

  <!-- Barre de navigation d'emplacement : Fil d'Ariane + Bouton Espace Département à gauche, et Importer à droite -->
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap: 5px;">
    <div style="display: flex; align-items: center; gap: 10px; flex: 1;">
      <nav class="otiv-breadcrumb" id="breadcrumbContainer" style=" width: 300px;">
        <a href="#" onclick="loadFolder(null, 'all'); return false;" class="otiv-breadcrumb__crumb">
          <i class="otiv-icon fa-solid fa-house"></i> Racine
        </a>
      </nav>
      
      <!-- Bouton vert d'accès direct à son Département -->
      <button id="btnDeptQuickAccess" type="button" onclick="loadFolder(null, 'dept'); return false;" 
              style="background: #e8f5ed; color: #00843d; border: 1px solid #a3d9b8; padding: 6px 14px; border-radius: 20px; font-weight: 700; font-size: 13px; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-building"></i>
        <span id="deptQuickAccessName">Espace Département</span>
      </button>
    </div>

    <!-- Bouton Importer un fichier -->
    <div style="display: inline-flex; align-items: center;">
      <button id="btnImportNav" class="otiv-btn otiv-btn--solid" style="cursor: pointer;">
        <i class="fa-solid fa-file-import"></i> Importer un fichier
      </button>
      <input type="file" id="filePicker" style="display: none;">
    </div>
  </div>

  <!-- Tableau principal -->
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
          <td colspan="4" style="text-align: center; padding: 20px;">Chargement des documents...</td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Modal historique -->
  <div class="otiv-modal-overlay" id="historyModal" hidden>
    <div class="otiv-modal">
      <div class="otiv-modal__header">
        <h3 class="otiv-modal__title">
          <i class="otiv-icon fa-solid fa-clock-rotate-left"></i>
          Historique — <span id="historyFileName">document</span>
        </h3>
        <button class="otiv-modal__close" data-action="close-history" aria-label="Fermer">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      <div class="otiv-modal__body">
        <ul class="otiv-history-list" id="historyList"></ul>
      </div>
    </div>
  </div>

  <!-- Modal création avec Emplacement et Visibilité -->
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

        <div class="otiv-field">
          <label>Emplacement :</label>
          <button type="button" class="otiv-path-picker" id="pathPickerBtn">
            <i class="fa-solid fa-folder"></i>
            <span id="pathPickerLabel">Département</span>
            <i class="fa-solid fa-chevron-right otiv-path-picker__arrow"></i>
          </button>
        </div>

        <div class="otiv-field">
          <div class="otiv-field">
          <label>Visibilité :</label>
          <div class="otiv-visibility-choice">
            <label class="otiv-radio-card">
              <input type="radio" name="visibility" value="dept">
              <span class="otiv-radio-card__body">
                <i class="fa-solid fa-building"></i>
                <span>
                  <strong>Département</strong>
                  <small>Visible par tout votre département</small>
                </span>
              </span>
            </label>
            <label class="otiv-radio-card">
              <input type="radio" name="visibility" value="private" checked>
              <span class="otiv-radio-card__body">
                <i class="fa-solid fa-lock"></i>
                <span>
                  <strong>Privé (par défaut)</strong>
                  <small>Réservé à vous seul</small>
                </span>
              </span>
            </label>
          </div>
        </div>
      </div>

      <div class="otiv-modal__footer">
        <button class="otiv-btn otiv-btn--ghost" data-action="close-create-doc">Annuler</button>
        <button class="otiv-btn otiv-btn--solid" id="createDocConfirm">OK</button>
      </div>
    </div>
  </div>

  <!-- Modal choix d'emplacement personnel -->
  <div class="otiv-modal-overlay" id="folderPickerModal" hidden>
    <div class="otiv-modal">
      <div class="otiv-modal__header">
        <h3 class="otiv-modal__title">
          <i class="otiv-icon fa-solid fa-folder-open"></i>
          Choisir l'emplacement personnel
        </h3>
        <button class="otiv-modal__close" data-action="close-folder-picker" aria-label="Fermer">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      <nav class="otiv-picker-breadcrumb" id="pickerBreadcrumb"></nav>
      <div class="otiv-modal__body">
        <ul class="otiv-picker-list" id="pickerList"></ul>
      </div>
      <div class="otiv-modal__footer">
        <button class="otiv-btn otiv-btn--ghost" data-action="close-folder-picker">Annuler</button>
        <button class="otiv-btn otiv-btn--solid" id="pickerConfirm">
          <i class="fa-solid fa-check"></i> Choisir ce dossier
        </button>
      </div>
    </div>
  </div>

</main>

<!-- MODALE PLEIN ÉCRAN ONLYOFFICE & MÉDIAS -->
<div id="previewModal" style="display: none; position: fixed; inset: 0; width: 100vw; height: 100vh; background: #0f241a; z-index: 99999; flex-direction: column; overflow: hidden; padding: 0; margin: 0;">
  <div style="height: 52px; padding: 0 24px; background: #0f241a; color: white; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.1); flex-shrink: 0;">
    <div style="display: flex; align-items: center; gap: 12px;">
      <i id="modalFileIcon" class="fa-solid fa-file" style="color: #00a84e; font-size: 20px;"></i>
      <h3 id="modalFileTitle" style="margin: 0; font-size: 15px; font-weight: 600; color: #f8fbf9;">Nom du document</h3>
      <span style="font-size: 11px; background: rgba(0, 168, 78, 0.2); color: #00a84e; padding: 2px 8px; border-radius: 4px; font-weight: 600;">Espace Sécurisé OTIV DIANA</span>
    </div>
    <div style="display: flex; align-items: center; gap: 12px;">
      <a id="modalDownloadBtn" href="#" class="otiv-btn otiv-btn--ghost" style="color: white; border-color: rgba(255,255,255,0.25); padding: 6px 14px; font-size: 13px;" download>
        <i class="fa-solid fa-download"></i> Télécharger
      </a>
      <button onclick="closePreviewModal()" title="Fermer l'éditeur (Échap)" style="background: rgba(255,255,255,0.1); border: none; color: white; width: 34px; height: 34px; border-radius: 8px; font-size: 18px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>
  </div>
  <div id="modalBody" style="flex: 1; width: 100%; height: calc(100vh - 52px); background: #f8fbf9; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative;"></div>
</div>

<script src="../js/common.js"></script>
<script src="../js/documents.js"></script>
<script src="../js/accueil.js"></script>
</body>
</html>