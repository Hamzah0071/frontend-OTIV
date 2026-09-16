<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Corbeille — OTIV DIANA</title>
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
<script>
document.addEventListener('DOMContentLoaded', () => {
  /* ---------------------------------------------------------
     Restaurer un élément (action directe, pas de confirmation
     nécessaire car non destructive)
     --------------------------------------------------------- */
  function restoreItem(row) {
    const id = row.dataset.itemId;

    // TODO: endpoint réel — Nextcloud Trashbin WebDAV API
    // MOVE /remote.php/dav/trashbin/{userid}/trash/{id} -> Destination: /remote.php/dav/files/{userid}/{originalPath}
    fetch(`/apps/ged_interface/trash/${id}/restore`, {
      method: 'POST',
      headers: { requesttoken: OC.requestToken }
    })
      .then(() => row.remove())
      .catch(err => {
        console.error('Erreur restauration', err);
        alert("Impossible de restaurer cet élément pour le moment.");
      });
  }

  /* ---------------------------------------------------------
     Modal : suppression définitive d'un seul élément
     --------------------------------------------------------- */
  const deleteForeverModal   = document.getElementById('deleteForeverModal');
  const deleteForeverNameEl  = document.getElementById('deleteForeverName');
  const deleteForeverConfirm = document.getElementById('deleteForeverConfirm');

  let pendingRow = null;

  function openDeleteForever(row) {
    pendingRow = row;
    deleteForeverNameEl.textContent = row.dataset.name;
    deleteForeverModal.hidden = false;
  }

  function closeDeleteForever() {
    deleteForeverModal.hidden = true;
    pendingRow = null;
  }

  deleteForeverConfirm.addEventListener('click', () => {
    if (!pendingRow) return;
    const id = pendingRow.dataset.itemId;
    const row = pendingRow;

    // TODO: endpoint réel — Nextcloud Trashbin WebDAV API
    // DELETE /remote.php/dav/trashbin/{userid}/trash/{id}
    fetch(`/apps/ged_interface/trash/${id}`, {
      method: 'DELETE',
      headers: { requesttoken: OC.requestToken }
    })
      .then(() => {
        row.remove();
        closeDeleteForever();
        checkEmptyState();
      })
      .catch(err => {
        console.error('Erreur suppression définitive', err);
        alert("Impossible de supprimer cet élément pour le moment.");
      });
  });

  /* ---------------------------------------------------------
     Modal : vider toute la corbeille
     --------------------------------------------------------- */
  const emptyTrashModal   = document.getElementById('emptyTrashModal');
  const emptyTrashCountEl = document.getElementById('emptyTrashCount');
  const emptyTrashConfirm = document.getElementById('emptyTrashConfirm');
  const btnEmptyTrash     = document.getElementById('btnEmptyTrash');

  function openEmptyTrash() {
    const rows = document.querySelectorAll('.otiv-trash-row');
    if (rows.length === 0) return; // rien à vider

    emptyTrashCountEl.textContent = rows.length > 1
      ? `les ${rows.length} éléments`
      : `l'élément`;
    emptyTrashModal.hidden = false;
  }

  function closeEmptyTrash() {
    emptyTrashModal.hidden = true;
  }

  emptyTrashConfirm.addEventListener('click', () => {
    // TODO: endpoint réel — Nextcloud Trashbin WebDAV API
    // DELETE /remote.php/dav/trashbin/{userid}/trash/
    fetch('/apps/ged_interface/trash/empty', {
      method: 'DELETE',
      headers: { requesttoken: OC.requestToken }
    })
      .then(() => {
        document.querySelectorAll('.otiv-trash-row').forEach(row => row.remove());
        closeEmptyTrash();
        checkEmptyState();
      })
      .catch(err => {
        console.error('Erreur lors du vidage de la corbeille', err);
        alert("Impossible de vider la corbeille pour le moment.");
      });
  });

  btnEmptyTrash.addEventListener('click', openEmptyTrash);

  /* ---------------------------------------------------------
     État vide (affiché quand la corbeille ne contient plus rien)
     --------------------------------------------------------- */
  function checkEmptyState() {
    const tbody = document.querySelector('.otiv-table tbody');
    const panel = document.querySelector('.otiv-panel');
    if (tbody.children.length === 0 && !panel.querySelector('.otiv-empty')) {
      panel.innerHTML = `
        <div class="otiv-empty">
          <i class="fa-regular fa-trash-can"></i>
          <h3>La corbeille est vide</h3>
          <p>Les fichiers et dossiers supprimés apparaîtront ici pendant 30 jours.</p>
        </div>`;
      btnEmptyTrash.style.display = 'none';
    }
  }

  /* ---------------------------------------------------------
     Délégation d'événements globale (CSP-safe, pas d'onclick inline)
     --------------------------------------------------------- */
  document.addEventListener('click', (e) => {
    const restoreBtn = e.target.closest('[data-action="restore-item"]');
    if (restoreBtn) {
      restoreItem(restoreBtn.closest('.otiv-trash-row'));
    }

    const deleteBtn = e.target.closest('[data-action="delete-forever"]');
    if (deleteBtn) {
      openDeleteForever(deleteBtn.closest('.otiv-trash-row'));
    }

    if (e.target.closest('[data-action="close-delete-forever"]') || e.target === deleteForeverModal) {
      closeDeleteForever();
    }
    if (e.target.closest('[data-action="close-empty-trash"]') || e.target === emptyTrashModal) {
      closeEmptyTrash();
    }
  });
});
</script>
</body>
</html>