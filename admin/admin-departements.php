<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administration — Départements — OTIV DIANA</title>
<link rel="shortcut icon" href="../icon/sans-fond.png" type="image/x-icon">
<link rel="stylesheet" href="../icon/fontAwesome/all.min.css">
<link rel="stylesheet" href="../css/common.css">
<link rel="stylesheet" href="../css/admin.css">
<link rel="stylesheet" href="../css/departement.css">

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
      <h1>Départements</h1>
      <p>Organisez les espaces documentaires par département.</p>
    </div>
    <button class="otiv-btn otiv-btn--primary" id="btnNewDept">
      <i class="fa-solid fa-plus"></i> Nouveau département
    </button>
  </div>

  <div class="otiv-settings">
<!-- lien vers le includes ou tout les outis detachable -->
<?php require __DIR__ . '/../includes/header-admin.php'; ?>
    <!-- Contenu -->
    <div>

      <div class="otiv-dept-grid">

        <div class="otiv-admin-dept-card" data-dept-id="credit" data-name="Crédit" data-resp="Fenosoa">
          <div class="otiv-admin-dept-card__head">
            <div>
              <p class="otiv-admin-dept-card__name">Crédit</p>
              <p class="otiv-admin-dept-card__resp">Responsable : Fenosoa</p>
            </div>
            <div class="otiv-row-actions">
              <button class="otiv-icon-action" aria-label="Modifier" data-action="edit-dept"><i class="fa-solid fa-pen"></i></button>
              <button class="otiv-icon-action is-danger" aria-label="Supprimer" data-action="delete-dept"><i class="fa-solid fa-trash"></i></button>
            </div>
          </div>
          <div class="otiv-admin-dept-card__stats">
            <div>
              <div class="otiv-admin-dept-card__stat-value">12</div>
              <div class="otiv-admin-dept-card__stat-label">Utilisateurs</div>
            </div>
            <div>
              <div class="otiv-admin-dept-card__stat-value">318</div>
              <div class="otiv-admin-dept-card__stat-label">Documents</div>
            </div>
            <div>
              <div class="otiv-admin-dept-card__stat-value">34 Go</div>
              <div class="otiv-admin-dept-card__stat-label">Stockage</div>
            </div>
          </div>
        </div>

        <div class="otiv-admin-dept-card" data-dept-id="compta" data-name="Comptabilité" data-resp="Rindra">
          <div class="otiv-admin-dept-card__head">
            <div>
              <p class="otiv-admin-dept-card__name">Comptabilité</p>
              <p class="otiv-admin-dept-card__resp">Responsable : Rindra</p>
            </div>
            <div class="otiv-row-actions">
              <button class="otiv-icon-action" aria-label="Modifier" data-action="edit-dept"><i class="fa-solid fa-pen"></i></button>
              <button class="otiv-icon-action is-danger" aria-label="Supprimer" data-action="delete-dept"><i class="fa-solid fa-trash"></i></button>
            </div>
          </div>
          <div class="otiv-admin-dept-card__stats">
            <div>
              <div class="otiv-admin-dept-card__stat-value">9</div>
              <div class="otiv-admin-dept-card__stat-label">Utilisateurs</div>
            </div>
            <div>
              <div class="otiv-admin-dept-card__stat-value">402</div>
              <div class="otiv-admin-dept-card__stat-label">Documents</div>
            </div>
            <div>
              <div class="otiv-admin-dept-card__stat-value">51 Go</div>
              <div class="otiv-admin-dept-card__stat-label">Stockage</div>
            </div>
          </div>
        </div>

        <div class="otiv-admin-dept-card" data-dept-id="rh" data-name="Ressources Humaines" data-resp="Tovo">
          <div class="otiv-admin-dept-card__head">
            <div>
              <p class="otiv-admin-dept-card__name">Ressources Humaines</p>
              <p class="otiv-admin-dept-card__resp">Responsable : Tovo</p>
            </div>
            <div class="otiv-row-actions">
              <button class="otiv-icon-action" aria-label="Modifier" data-action="edit-dept"><i class="fa-solid fa-pen"></i></button>
              <button class="otiv-icon-action is-danger" aria-label="Supprimer" data-action="delete-dept"><i class="fa-solid fa-trash"></i></button>
            </div>
          </div>
          <div class="otiv-admin-dept-card__stats">
            <div>
              <div class="otiv-admin-dept-card__stat-value">6</div>
              <div class="otiv-admin-dept-card__stat-label">Utilisateurs</div>
            </div>
            <div>
              <div class="otiv-admin-dept-card__stat-value">96</div>
              <div class="otiv-admin-dept-card__stat-label">Documents</div>
            </div>
            <div>
              <div class="otiv-admin-dept-card__stat-value">9 Go</div>
              <div class="otiv-admin-dept-card__stat-label">Stockage</div>
            </div>
          </div>
        </div>

        <div class="otiv-admin-dept-card" data-dept-id="info" data-name="Informatique" data-resp="Hamzah">
          <div class="otiv-admin-dept-card__head">
            <div>
              <p class="otiv-admin-dept-card__name">Informatique</p>
              <p class="otiv-admin-dept-card__resp">Responsable : Hamzah</p>
            </div>
            <div class="otiv-row-actions">
              <button class="otiv-icon-action" aria-label="Modifier" data-action="edit-dept"><i class="fa-solid fa-pen"></i></button>
              <button class="otiv-icon-action is-danger" aria-label="Supprimer" data-action="delete-dept"><i class="fa-solid fa-trash"></i></button>
            </div>
          </div>
          <div class="otiv-admin-dept-card__stats">
            <div>
              <div class="otiv-admin-dept-card__stat-value">8</div>
              <div class="otiv-admin-dept-card__stat-label">Utilisateurs</div>
            </div>
            <div>
              <div class="otiv-admin-dept-card__stat-value">214</div>
              <div class="otiv-admin-dept-card__stat-label">Documents</div>
            </div>
            <div>
              <div class="otiv-admin-dept-card__stat-value">27 Go</div>
              <div class="otiv-admin-dept-card__stat-label">Stockage</div>
            </div>
          </div>
        </div>

        <div class="otiv-admin-dept-card" data-dept-id="dg" data-name="Direction Générale" data-resp="Lova">
          <div class="otiv-admin-dept-card__head">
            <div>
              <p class="otiv-admin-dept-card__name">Direction Générale</p>
              <p class="otiv-admin-dept-card__resp">Responsable : Lova</p>
            </div>
            <div class="otiv-row-actions">
              <button class="otiv-icon-action" aria-label="Modifier" data-action="edit-dept"><i class="fa-solid fa-pen"></i></button>
              <button class="otiv-icon-action is-danger" aria-label="Supprimer" data-action="delete-dept"><i class="fa-solid fa-trash"></i></button>
            </div>
          </div>
          <div class="otiv-admin-dept-card__stats">
            <div>
              <div class="otiv-admin-dept-card__stat-value">4</div>
              <div class="otiv-admin-dept-card__stat-label">Utilisateurs</div>
            </div>
            <div>
              <div class="otiv-admin-dept-card__stat-value">254</div>
              <div class="otiv-admin-dept-card__stat-label">Documents</div>
            </div>
            <div>
              <div class="otiv-admin-dept-card__stat-value">7 Go</div>
              <div class="otiv-admin-dept-card__stat-label">Stockage</div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>

</main>

<!-- Modal création / édition de département -->
<div class="otiv-modal-overlay" id="deptModal" hidden>
  <div class="otiv-modal otiv-modal--sm">
    <div class="otiv-modal__header">
      <h3 class="otiv-modal__title">
        <i class="otiv-icon fa-solid fa-building" id="deptModalIcon"></i>
        <span id="deptModalTitle">Nouveau département</span>
      </h3>
      <button class="otiv-modal__close" data-action="close-dept-modal" aria-label="Fermer">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <div class="otiv-modal__body">
      <div class="otiv-field">
        <label for="deptNameInput">Nom du département :</label>
        <input type="text" id="deptNameInput" placeholder="Ex : Marketing">
      </div>

      <div class="otiv-field">
        <label for="deptRespSelect">Responsable :</label>
        <select id="deptRespSelect">
          <option value="">Aucun responsable pour le moment</option>
          <option value="hamzah">Hamzah</option>
          <option value="jack">Jack</option>
          <option value="rindra">Rindra</option>
          <option value="fenosoa">Fenosoa</option>
          <option value="tovo">Tovo</option>
          <option value="lova">Lova</option>
        </select>
      </div>

      <div class="otiv-field">
        <label for="deptDescInput">Description (optionnel) :</label>
        <textarea id="deptDescInput" placeholder="Rôle et périmètre du département..."></textarea>
      </div>
    </div>

    <div class="otiv-modal__footer">
      <button class="otiv-btn otiv-btn--ghost" data-action="close-dept-modal">Annuler</button>
      <button class="otiv-btn otiv-btn--solid" id="deptModalConfirm">
        <i class="fa-solid fa-check"></i> <span id="deptModalConfirmLabel">Créer</span>
      </button>
    </div>
  </div>
</div>

<!-- Modal confirmation de suppression -->
<div class="otiv-modal-overlay" id="deptDeleteModal" hidden>
  <div class="otiv-modal otiv-modal--sm">
    <div class="otiv-modal__header">
      <h3 class="otiv-modal__title">
        <i class="otiv-icon fa-solid fa-triangle-exclamation" style="color: var(--otiv-red);"></i>
        Supprimer le département
      </h3>
      <button class="otiv-modal__close" data-action="close-dept-delete" aria-label="Fermer">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <div class="otiv-modal__body">
      <p class="otiv-modal__intro" style="margin-bottom:0;">
        Voulez-vous vraiment supprimer <strong id="deptDeleteName">ce département</strong> ?
        Les documents qu'il contient ne seront pas supprimés mais devront être réattribués.
      </p>
    </div>

    <div class="otiv-modal__footer">
      <button class="otiv-btn otiv-btn--ghost" data-action="close-dept-delete">Annuler</button>
      <button class="otiv-btn otiv-btn--primary" id="deptDeleteConfirm" style="background: var(--otiv-red);">
        <i class="fa-solid fa-trash"></i> Supprimer
      </button>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  /* ---------------------------------------------------------
     Modal : création / édition d'un département
     --------------------------------------------------------- */
  const deptModal          = document.getElementById('deptModal');
  const deptModalIcon       = document.getElementById('deptModalIcon');
  const deptModalTitle      = document.getElementById('deptModalTitle');
  const deptNameInput       = document.getElementById('deptNameInput');
  const deptRespSelect      = document.getElementById('deptRespSelect');
  const deptDescInput       = document.getElementById('deptDescInput');
  const deptModalConfirm    = document.getElementById('deptModalConfirm');
  const deptModalConfirmLabel = document.getElementById('deptModalConfirmLabel');

  let editingDeptId = null; // null = création, sinon id du département en édition

  function openDeptModal(mode, card) {
    if (mode === 'edit' && card) {
      editingDeptId = card.dataset.deptId;
      deptModalIcon.className = 'otiv-icon fa-solid fa-pen';
      deptModalTitle.textContent = 'Modifier le département';
      deptModalConfirmLabel.textContent = 'Enregistrer';
      deptNameInput.value = card.dataset.name;
      deptDescInput.value = '';

      // pré-sélectionne le responsable actuel si présent dans la liste
      const respName = card.dataset.resp.toLowerCase();
      const opt = [...deptRespSelect.options].find(o => o.text.toLowerCase() === respName);
      deptRespSelect.value = opt ? opt.value : '';
    } else {
      editingDeptId = null;
      deptModalIcon.className = 'otiv-icon fa-solid fa-building';
      deptModalTitle.textContent = 'Nouveau département';
      deptModalConfirmLabel.textContent = 'Créer';
      deptNameInput.value = '';
      deptDescInput.value = '';
      deptRespSelect.value = '';
    }

    deptModal.hidden = false;
    setTimeout(() => deptNameInput.focus(), 50);
  }

  function closeDeptModal() {
    deptModal.hidden = true;
    editingDeptId = null;
  }

  deptModalConfirm.addEventListener('click', () => {
    const name = deptNameInput.value.trim();
    if (!name) {
      deptNameInput.focus();
      return;
    }

    const payload = {
      name,
      responsible: deptRespSelect.value,
      description: deptDescInput.value.trim()
    };

    if (editingDeptId) {
      updateDepartment(editingDeptId, payload);
    } else {
      createDepartment(payload);
    }
  });

  deptNameInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') deptModalConfirm.click();
    if (e.key === 'Escape') closeDeptModal();
  });

  // TODO: endpoint réel à créer côté PHP (ex: OccController / AdminController)
  function createDepartment(payload) {
    fetch('/apps/ged_interface/admin/departments', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', requesttoken: OC.requestToken },
      body: JSON.stringify(payload)
    })
      .then(res => res.json())
      .then(() => location.reload())
      .catch(err => {
        console.error('Erreur création département', err);
        alert("Impossible de créer le département pour le moment.");
      });
  }

  function updateDepartment(id, payload) {
    fetch(`/apps/ged_interface/admin/departments/${id}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json', requesttoken: OC.requestToken },
      body: JSON.stringify(payload)
    })
      .then(res => res.json())
      .then(() => location.reload())
      .catch(err => {
        console.error('Erreur modification département', err);
        alert("Impossible de modifier le département pour le moment.");
      });
  }

  /* ---------------------------------------------------------
     Modal : confirmation de suppression
     --------------------------------------------------------- */
  const deleteModal   = document.getElementById('deptDeleteModal');
  const deleteNameEl  = document.getElementById('deptDeleteName');
  const deleteConfirm = document.getElementById('deptDeleteConfirm');

  let deletingDeptId = null;

  function openDeleteModal(card) {
    deletingDeptId = card.dataset.deptId;
    deleteNameEl.textContent = card.dataset.name;
    deleteModal.hidden = false;
  }

  function closeDeleteModal() {
    deleteModal.hidden = true;
    deletingDeptId = null;
  }

  deleteConfirm.addEventListener('click', () => {
    if (!deletingDeptId) return;

    // TODO: endpoint réel de suppression
    fetch(`/apps/ged_interface/admin/departments/${deletingDeptId}`, {
      method: 'DELETE',
      headers: { requesttoken: OC.requestToken }
    })
      .then(() => location.reload())
      .catch(err => {
        console.error('Erreur suppression département', err);
        alert("Impossible de supprimer le département pour le moment.");
      });
  });

  /* ---------------------------------------------------------
     Délégation d'événements globale (CSP-safe, pas d'onclick inline)
     --------------------------------------------------------- */
  document.getElementById('btnNewDept').addEventListener('click', () => openDeptModal('create'));

  document.addEventListener('click', (e) => {
    const editBtn = e.target.closest('[data-action="edit-dept"]');
    if (editBtn) {
      openDeptModal('edit', editBtn.closest('.otiv-admin-dept-card'));
    }

    const deleteBtn = e.target.closest('[data-action="delete-dept"]');
    if (deleteBtn) {
      openDeleteModal(deleteBtn.closest('.otiv-admin-dept-card'));
    }

    if (e.target.closest('[data-action="close-dept-modal"]') || e.target === deptModal) {
      closeDeptModal();
    }
    if (e.target.closest('[data-action="close-dept-delete"]') || e.target === deleteModal) {
      closeDeleteModal();
    }
  });
});
</script>
</body>
</html>