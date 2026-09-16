<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Corbeille — OTIV DIANA</title>
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
      <h1>Corbeille</h1>
      <p>Les éléments supprimés restent ici 30 jours avant suppression définitive.</p>
    </div>
    <button class="otiv-btn otiv-btn--ghost" id="btnEmptyTrash" style="color:var(--otiv-red); border-color:var(--otiv-red);">
      <i class="otiv-icon fa-solid fa-trash"></i> Vider la corbeille
    </button>
  </div>

  <div class="otiv-panel">
    <table class="otiv-table">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Emplacement d'origine</th>
          <th>Supprimé</th>
          <th class="otiv-table__col-actions">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr class="otiv-trash-row" data-item-id="ancien-rapport" data-name="ancien-rapport.md" data-type="file">
          <td>
            <span class="otiv-file-name">
              <i class="otiv-icon is-file fa-regular fa-file-lines"></i>
              ancien-rapport.md
            </span>
          </td>
          <td class="otiv-cell-muted">Documents</td>
          <td class="otiv-cell-muted">Il y a 2 jours</td>
          <td class="otiv-table__col-actions">
            <div class="otiv-row-actions">
              <button class="otiv-icon-action" aria-label="Restaurer" data-action="restore-item"><i class="otiv-icon fa-solid fa-rotate-left"></i></button>
              <button class="otiv-icon-action is-danger" aria-label="Supprimer définitivement" data-action="delete-forever"><i class="otiv-icon fa-solid fa-trash"></i></button>
            </div>
          </td>
        </tr>
        <tr class="otiv-trash-row" data-item-id="dossier-archive" data-name="dossier-archive" data-type="folder">
          <td>
            <span class="otiv-file-name">
              <i class="otiv-icon is-folder fa-solid fa-folder"></i>
              dossier-archive
            </span>
          </td>
          <td class="otiv-cell-muted">Departement · Comptabilité</td>
          <td class="otiv-cell-muted">Il y a 6 jours</td>
          <td class="otiv-table__col-actions">
            <div class="otiv-row-actions">
              <button class="otiv-icon-action" aria-label="Restaurer" data-action="restore-item"><i class="otiv-icon fa-solid fa-rotate-left"></i></button>
              <button class="otiv-icon-action is-danger" aria-label="Supprimer définitivement" data-action="delete-forever"><i class="otiv-icon fa-solid fa-trash"></i></button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

</main>

<!-- Modal : confirmation de suppression définitive (un seul élément) -->
<div class="otiv-modal-overlay" id="deleteForeverModal" hidden>
  <div class="otiv-modal otiv-modal--sm">
    <div class="otiv-modal__header">
      <h3 class="otiv-modal__title">
        <i class="otiv-icon fa-solid fa-triangle-exclamation" style="color: var(--otiv-red);"></i>
        Suppression définitive
      </h3>
      <button class="otiv-modal__close" data-action="close-delete-forever" aria-label="Fermer">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <div class="otiv-modal__body">
      <p class="otiv-modal__intro" style="margin-bottom:0;">
        Voulez-vous vraiment supprimer définitivement <strong id="deleteForeverName">cet élément</strong> ?
        Cette action est irréversible et le fichier ne pourra plus être restauré.
      </p>
    </div>

    <div class="otiv-modal__footer">
      <button class="otiv-btn otiv-btn--ghost" data-action="close-delete-forever">Annuler</button>
      <button class="otiv-btn otiv-btn--primary" id="deleteForeverConfirm" style="background: var(--otiv-red);">
        <i class="fa-solid fa-trash"></i> Supprimer définitivement
      </button>
    </div>
  </div>
</div>
<!-- pup up -->
<!-- Modal : confirmation "Vider la corbeille" (tout supprimer) -->
<div class="otiv-modal-overlay" id="emptyTrashModal" hidden>
  <div class="otiv-modal otiv-modal--sm">
    <div class="otiv-modal__header">
      <h3 class="otiv-modal__title">
        <i class="otiv-icon fa-solid fa-triangle-exclamation" style="color: var(--otiv-red);"></i>
        Vider la corbeille
      </h3>
      <button class="otiv-modal__close" data-action="close-empty-trash" aria-label="Fermer">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <div class="otiv-modal__body">
      <p class="otiv-modal__intro" style="margin-bottom:0;">
        Voulez-vous vraiment supprimer définitivement <strong id="emptyTrashCount">tous les éléments</strong> de la corbeille ?
        Cette action est irréversible.
      </p>
    </div>

    <div class="otiv-modal__footer">
      <button class="otiv-btn otiv-btn--ghost" data-action="close-empty-trash">Annuler</button>
      <button class="otiv-btn otiv-btn--primary" id="emptyTrashConfirm" style="background: var(--otiv-red);">
        <i class="fa-solid fa-trash"></i> Tout supprimer définitivement
      </button>
    </div>
  </div>
</div>

<script src="../js/common.js"></script>

</body>
</html>