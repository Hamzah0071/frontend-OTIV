  document.addEventListener('DOMContentLoaded', () => {
  const modal       = document.getElementById('requestModal');
  const deptNameEl   = document.getElementById('requestDeptName');
  const docInput     = document.getElementById('requestDocName');
  const messageInput = document.getElementById('requestMessage');
  const confirmBtn   = document.getElementById('requestConfirm');

  let currentDept = null;

  // Intercepte le clic sur les cartes qui ne sont PAS le département de l'utilisateur
  document.querySelectorAll('.otiv-dept-card[data-mine="false"]').forEach(card => {
    card.addEventListener('click', (e) => {
      e.preventDefault();
      currentDept = card.dataset.dept;
      openModal(currentDept);
    });
  });

  document.addEventListener('click', (e) => {
    if (e.target.closest('[data-action="close-request"]') || e.target === modal) {
      closeModal();
    }
  });

  confirmBtn.addEventListener('click', () => {
    const docName = docInput.value.trim();
    if (!docName) {
      docInput.focus();
      return;
    }
    submitRequest(currentDept, docName, messageInput.value.trim());
  });

  function openModal(dept) {
    deptNameEl.textContent = dept;
    docInput.value = '';
    messageInput.value = '';
    modal.hidden = false;
    setTimeout(() => docInput.focus(), 50);
  }

  function closeModal() {
    modal.hidden = true;
    currentDept = null;
  }

  function submitRequest(dept, docName, message) {
    // TODO: endpoint réel côté PHP (ex: POST /apps/ged_interface/share-requests)
    fetch('/apps/ged_interface/share-requests', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        requesttoken: OC.requestToken
      },
      body: JSON.stringify({ department: dept, document: docName, message })
    })
      .then(res => res.json())
      .then(() => {
        closeModal();
        alert(`Votre demande pour "${docName}" a été envoyée au département ${dept}.`);
      })
      .catch(err => {
        console.error('Erreur envoi demande', err);
        alert("Impossible d'envoyer la demande pour le moment.");
      });
  }
});
