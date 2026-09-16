// donne fictife
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
