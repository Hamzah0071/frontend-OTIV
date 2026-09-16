(function() {
    // 1. UTILISATEUR CONNECTÉ
    const user = typeof currentUser !== 'undefined' ? currentUser : JSON.parse(localStorage.getItem('currentUser') || '{}');

    if (user && user.nom) {
        const heroTitle = document.querySelector('.otiv-hero__title');
        const heroSubtitle = document.querySelector('.otiv-hero__subtitle');
        if (heroTitle) heroTitle.innerHTML = `Bonjour, ${user.nom} `+`<i class="fa-solid fa-hand-spock fa-shake" style="color: rgb(255, 212, 59);"></i>`;
        if (heroSubtitle && user.departement) {
            heroSubtitle.textContent = `Espace documentaire · Département ${user.departement}`;
        }
    }

    // 2. FORMATAGE TAILLE
    function formatBytes(bytes) {
        if (!bytes || bytes === 0) return '--';
        const k = 1024;
        const sizes = ['Octets', 'Ko', 'Mo', 'Go'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
    }

    // 3. RECHERCHE ET RENDU COMPLET DU TABLEAU
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('tableBody');
    const searchStatusBar = document.getElementById('searchStatusBar');
    const searchResultText = document.getElementById('searchResultText');
    const sectionLabel = document.getElementById('sectionLabel');

    let debounceTimer = null;
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            const query = searchInput.value.trim();
            debounceTimer = setTimeout(() => { performSearch(query); }, 300);
        });
    }

    async function performSearch(query = '') {
        if (!tableBody) return;
        tableBody.innerHTML = '<tr><td colspan="4" style="text-align: center; padding: 20px;"><i class="fa-solid fa-spinner fa-spin"></i> Chargement...</td></tr>';

        try {
            const url = query ? `/api/recherche?q=${encodeURIComponent(query)}` : '/api/recherche';
            const response = await fetch(url);
            const data = await response.json();

            if (data.mode === 'recherche') {
                if (searchStatusBar) searchStatusBar.style.display = 'flex';
                if (searchResultText) searchResultText.innerHTML = `<i class="fa-solid fa-magnifying-glass"></i> ${data.total} résultat(s) pour "<strong>${data.query}</strong>"`;
                if (sectionLabel) sectionLabel.textContent = `Résultats de recherche (${data.total})`;
            } else {
                if (searchStatusBar) searchStatusBar.style.display = 'none';
                if (sectionLabel) sectionLabel.textContent = "Documents récents";
            }

            tableBody.innerHTML = '';

            if ((!data.dossiers || data.dossiers.length === 0) && (!data.fichiers || data.fichiers.length === 0)) {
                tableBody.innerHTML = `
                  <tr>
                    <td colspan="4" style="text-align: center; padding: 40px; color: #8a9b92;">
                      <i class="fa-regular fa-folder-open" style="font-size: 28px; margin-bottom: 10px; display: block;"></i>
                      Aucun document récent pour le moment.
                    </td>
                  </tr>`;
                return;
            }

            // DOSSIERS AVEC TOUTES LES ACTIONS (Ouvrir, Partager, Supprimer)
            if (data.dossiers) {
                data.dossiers.forEach(d => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                      <td>
                        <a href="documents.html?folder_id=${d.id}" class="otiv-file-name">
                          <i class="otiv-icon is-folder fa-solid fa-folder"></i>
                          <strong>${d.nom}</strong>
                        </a>
                      </td>
                      <td class="otiv-cell-muted">--</td>
                      <td class="otiv-cell-muted">${new Date(d.created_at).toLocaleDateString('fr-FR')}</td>
                      <td class="otiv-table__col-actions">
                        <div class="otiv-row-actions">
                          <a href="documents.html?folder_id=${d.id}" class="otiv-icon-action" title="Ouvrir le dossier">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                          </a>
                          <button class="otiv-icon-action" onclick="shareItem('dossier', '${d.nom}')" title="Partager">
                            <i class="otiv-icon fa-solid fa-share-nodes"></i>
                          </button>
                          <button class="otiv-icon-action is-danger" onclick="deleteToTrash('dossier', ${d.id}, '${d.nom}')" title="Supprimer">
                            <i class="otiv-icon fa-solid fa-trash"></i>
                          </button>
                        </div>
                      </td>
                    `;
                    tableBody.appendChild(tr);
                });
            }

            // FICHIERS AVEC TOUTES LES ACTIONS (Historique, Télécharger, Partager, Supprimer)
            // FICHIERS AVEC CLIC DIRECT SUR ONLYOFFICE !
            if (data.fichiers) {
                data.fichiers.forEach(f => {
                    const tr = document.createElement('tr');
                    const ext = f.format ? f.format.toLowerCase() : '';
                    let fileIcon = 'fa-file-lines';
                    let iconColor = '#52645b';

                    if (['docx', 'doc'].includes(ext)) { fileIcon = 'fa-file-word'; iconColor = '#2b579a'; }
                    else if (['xlsx', 'xls', 'csv'].includes(ext)) { fileIcon = 'fa-file-excel'; iconColor = '#217346'; }
                    else if (['pptx', 'ppt'].includes(ext)) { fileIcon = 'fa-file-powerpoint'; iconColor = '#d24726'; }
                    else if (ext === 'pdf') { fileIcon = 'fa-file-pdf'; iconColor = '#b30b00'; }
                    else if (['jpg', 'jpeg', 'png', 'webp'].includes(ext)) { fileIcon = 'fa-file-image'; iconColor = '#00843d'; }

                    tr.innerHTML = `
                      <td>
                        <span class="otiv-file-name" style="cursor: pointer;" onclick="openUniversalFile(${f.id})" title="Cliquer pour ouvrir directement dans OnlyOffice">
                          <i class="otiv-icon is-file fa-regular ${fileIcon}" style="color: ${iconColor};"></i>
                          <strong>${f.nom_original}</strong>
                        </span>
                      </td>
                      <td class="otiv-cell-muted">${formatBytes(f.taille)}</td>
                      <td class="otiv-cell-muted">${new Date(f.created_at).toLocaleDateString('fr-FR')}</td>
                      <td class="otiv-table__col-actions">
                        <div class="otiv-row-actions">
                          <button class="otiv-icon-action" onclick="window.openHistoryModal(${f.id})" title="Historique"><i class="fa-solid fa-clock-rotate-left"></i></button>
                          <a href="/api/fichiers/${f.id}/stream?download=1" class="otiv-icon-action" title="Télécharger"><i class="otiv-icon fa-solid fa-download"></i></a>
                          <button class="otiv-icon-action" onclick="shareItem('fichier', '${f.nom_original}')" title="Partager"><i class="otiv-icon fa-solid fa-share-nodes"></i></button>
                          <button class="otiv-icon-action is-danger" onclick="deleteToTrash('fichier', ${f.id}, '${f.nom_original}')" title="Supprimer"><i class="otiv-icon fa-solid fa-trash"></i></button>
                        </div>
                      </td>
                    `;
                    tableBody.appendChild(tr);
                });
            }

        } catch (err) {
            tableBody.innerHTML = '<tr><td colspan="4" style="text-align: center; color: #dc2626;">Erreur de chargement.</td></tr>';
        }
    }

    performSearch('');

    // 4. GESTION DES INTERACTIONS D'ACTION (Favori, Partager, Supprimer)

    window.shareItem = function(type, name) {
        alert(`Partage de ${type} : "${name}"\n\nLe module de gestion des partages est accessible depuis le menu "Partages".`);
    };

    window.deleteToTrash = async function(type, id, name) {
        if (!confirm(`Êtes-vous sûr de vouloir déplacer "${name}" vers la corbeille ?`)) {
            return;
        }

        try {
            const res = await fetch(`/api/corbeille/${type}/${id}`, { method: 'POST' });
            const data = await res.json();
            if (res.ok && data.status === 'success') {
                performSearch(''); // Rafraîchit le tableau immédiatement
            } else {
                alert(data.error || "Erreur lors de la suppression.");
            }
        } catch(err) {
            alert("Erreur de communication avec le serveur.");
        }
    };

    // 5. IMPORTATION DIRECTE
    const btnImportHero = document.getElementById('btnImportHero');
    const heroFilePicker = document.getElementById('heroFilePicker');
    if (btnImportHero && heroFilePicker) {
        btnImportHero.addEventListener('click', (e) => { e.preventDefault(); heroFilePicker.click(); });
        heroFilePicker.addEventListener('change', async () => {
            if (heroFilePicker.files.length === 0) return;
            const formData = new FormData();
            formData.append('document', heroFilePicker.files[0]);

            const originalHtml = btnImportHero.innerHTML;
            btnImportHero.disabled = true;
            btnImportHero.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Envoi...';

            try {
                const res = await fetch('/api/fichiers', { method: 'POST', body: formData });
                if (res.ok) performSearch('');
                else alert("Erreur lors de l'envoi.");
            } catch(err) {
                alert("Erreur de connexion.");
            } finally {
                heroFilePicker.value = '';
                btnImportHero.disabled = false;
                btnImportHero.innerHTML = originalHtml;
            }
        });
    }

    // 6. MODALE CRÉATION ACTIONS RAPIDES
    const createModal  = document.getElementById('createDocModal');
    const createIcon   = document.getElementById('createDocIcon');
    const createTitle  = document.getElementById('createDocTitle');
    const createLabel  = document.getElementById('createDocLabel');
    const createInput  = document.getElementById('createDocInput');
    const confirmBtn   = document.getElementById('createDocConfirm');
    let currentActionType = null;

    const CONFIG = {
        docx:   { icon: 'fa-file-word',       label: 'is-word',   title: 'Nouveau Document Word',        fieldLabel: 'Nom du document :',       placeholder: 'Nouveau document' },
        xlsx:   { icon: 'fa-file-excel',      label: 'is-excel',  title: 'Nouvelle Feuille Excel',        fieldLabel: 'Nom de la feuille :',     placeholder: 'Nouvelle feuille' },
        pptx:   { icon: 'fa-file-powerpoint', label: 'is-ppt',    title: 'Nouvelle Présentation PowerPoint', fieldLabel: 'Nom de la présentation :', placeholder: 'Nouvelle présentation' },
        folder: { icon: 'fa-folder-plus',     label: 'is-folder', title: 'Nouveau dossier',              fieldLabel: 'Nom du dossier :',        placeholder: 'Nouveau dossier' },
    };

    document.querySelectorAll('[data-action="create-doc"]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            currentActionType = btn.dataset.type;
            const cfg = CONFIG[currentActionType];
            if (!cfg || !createModal) return;

            createIcon.className = `otiv-icon fa-solid ${cfg.icon} ${cfg.label}`;
            createTitle.textContent = cfg.title;
            createLabel.textContent = cfg.fieldLabel;
            createInput.placeholder = cfg.placeholder;
            createInput.value = cfg.placeholder;

            createModal.hidden = false;
            createModal.style.display = 'flex';
            setTimeout(() => { createInput.focus(); createInput.select(); }, 50);
        });
    });

    function closeCreateModal() {
        if (!createModal) return;
        createModal.hidden = true;
        createModal.style.display = 'none';
        currentActionType = null;
    }

    document.querySelectorAll('[data-action="close-create-doc"]').forEach(btn => btn.addEventListener('click', closeCreateModal));
    if (createModal) createModal.addEventListener('click', (e) => { if (e.target === createModal) closeCreateModal(); });
if (confirmBtn) {
        confirmBtn.addEventListener('click', async () => {
            const name = createInput.value.trim();
            if (!name) { createInput.focus(); return; }

            // 1. SAUVEGARDER LE TYPE AVANT DE FERMER LA MODALE
            const targetType = currentActionType;
            closeCreateModal();

            // 2. CAS A : CRÉATION D'UN DOSSIER
            if (targetType === 'folder') {
                try {
                    const res = await fetch('/api/dossiers', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                        body: JSON.stringify({ nom: name, parent_id: null })
                    });
                    const data = await res.json();
                    
                    if (res.ok) {
                        performSearch(''); // Rafraîchit les récents
                    } else {
                        alert("Erreur dossier (" + res.status + ") : " + (data.error || data.message || "Erreur"));
                    }
                } catch(err) {
                    alert("Erreur de connexion avec le serveur.");
                }
            } 
            // 3. CAS B : CRÉATION D'UN DOCUMENT OFFICE (Word, Excel, PPT)
            else {
                try {
                    const res = await fetch('/api/fichiers/creer-office', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                        body: JSON.stringify({ nom: name, type: targetType }) // targetType vaut bien 'docx', 'xlsx' ou 'pptx' !
                    });
                    const data = await res.json();
                    
                    if (res.ok) {
                        // Redirige vers documents.html où le nouveau document apparaît !
                        window.location.href = 'documents.html';
                    } else {
                        alert("Erreur document (" + res.status + ") : " + (data.error || data.message || "Erreur"));
                    }
                } catch (err) {
                    alert("Erreur de connexion avec le serveur.");
                }
            }
        });
    }
    // 7. MODALE HISTORIQUE DES VERSIONS / ACTIVITÉS
    const historyModal = document.getElementById('historyModal');
    const historyFileNameEl = document.getElementById('historyFileName');
    const historyListEl = document.getElementById('historyList');

    window.openHistoryModal = async function(fileId) {
        if (!historyModal) return;
        historyModal.hidden = false;
        historyModal.style.display = 'flex';
        historyListEl.innerHTML = '<li style="text-align: center; padding: 20px; color: #8a9b92;"><i class="fa-solid fa-spinner fa-spin"></i> Chargement...</li>';

        try {
            const res = await fetch(`/api/fichiers/${fileId}/historique`);
            const data = await res.json();

            if (res.ok && data.status === 'success') {
                historyFileNameEl.textContent = data.nom_original;
                if (!data.logs || data.logs.length === 0) {
                    historyListEl.innerHTML = '<li style="text-align: center; padding: 20px; color: #8a9b92;">Aucune activité enregistrée.</li>';
                    return;
                }
                historyListEl.innerHTML = data.logs.map((log, index) => {
                    const dateFormatted = new Date(log.created_at).toLocaleString('fr-FR', { dateStyle: 'medium', timeStyle: 'short' });
                    return `
                      <li class="otiv-history-item ${index === 0 ? 'is-current' : ''}">
                        <div class="otiv-history-item__info">
                          <span class="otiv-history-item__date">${dateFormatted}</span>
                          <span class="otiv-history-item__meta">${log.user_name || 'Système'} · <strong>${log.action}</strong></span>
                          <small style="color: #8a9b92; display: block; margin-top: 3px;">${log.details || ''}</small>
                        </div>
                        <div class="otiv-history-item__actions">
                          <a href="/api/fichiers/${fileId}/stream?download=1" class="otiv-icon-action" title="Télécharger">
                            <i class="otiv-icon fa-solid fa-download"></i>
                          </a>
                        </div>
                      </li>`;
                }).join('');
            } else {
                historyListEl.innerHTML = '<li style="text-align: center; color: #dc2626;">Erreur de récupération.</li>';
            }
        } catch (err) {
            historyListEl.innerHTML = '<li style="text-align: center; color: #dc2626;">Erreur de connexion.</li>';
        }
    };

    document.querySelectorAll('[data-action="close-history"]').forEach(btn => {
        btn.addEventListener('click', () => {
            if (historyModal) { historyModal.hidden = true; historyModal.style.display = 'none'; }
        });
    });
})();
// GESTIONNAIRE ONLYOFFICE PLEIN ÉCRAN SUR L'ACCUEIL
    let docEditorInstance = null;

    window.openUniversalFile = async function(fileId) {
        const modal = document.getElementById('previewModal');
        const modalBody = document.getElementById('modalBody');
        const modalTitle = document.getElementById('modalFileTitle');
        const downloadBtn = document.getElementById('modalDownloadBtn');

        if (!modal || !modalBody) return;

        modal.style.display = 'flex';
        modalBody.style.display = 'flex';
        modalBody.innerHTML = `
            <div style="text-align: center; color: #52645b;">
                <i class="fa-solid fa-spinner fa-spin fa-3x" style="color: #00843d; margin-bottom: 15px;"></i>
                <p style="font-weight: 600; font-size: 16px;">Ouverture du document en plein écran...</p>
            </div>`;
        
        downloadBtn.href = `/api/fichiers/${fileId}/stream?download=1`;

        if (docEditorInstance) {
            try { docEditorInstance.destroyEditor(); } catch(e) {}
            docEditorInstance = null;
        }

        try {
            const res = await fetch(`/api/fichiers/${fileId}/preview`);
            const data = await res.json();

            if (!res.ok) throw new Error(data.error || "Impossible d'accéder au document");

            modalTitle.textContent = data.title;

            if (data.type === 'onlyoffice') {
                modalBody.style.display = 'block';
                modalBody.innerHTML = `<div id="onlyoffice-editor-box" style="width: 100%; height: 100%;"></div>`;

                if (typeof DocsAPI === 'undefined') {
                    modalBody.innerHTML = `<p style="color: #dc2626; padding: 40px; text-align: center;">Service OnlyOffice indisponible.</p>`;
                    return;
                }

                docEditorInstance = new DocsAPI.DocEditor("onlyoffice-editor-box", data.config);
            } else if (data.type === 'image') {
                modalBody.innerHTML = `<img src="${data.file_url}" style="max-width: 95vw; max-height: 90vh; object-fit: contain;">`;
            } else if (data.type === 'video') {
                modalBody.innerHTML = `<video controls autoplay style="max-width: 95vw; max-height: 90vh;"><source src="${data.file_url}"></video>`;
            } else {
                window.location.href = `/api/fichiers/${fileId}/stream?download=1`;
                closePreviewModal();
            }

        } catch (err) {
            modalBody.innerHTML = `<p style="color: #dc2626; padding: 40px; text-align: center;">${err.message}</p>`;
        }
    };

    window.closePreviewModal = function() {
        const modal = document.getElementById('previewModal');
        if (modal) modal.style.display = 'none';

        if (docEditorInstance) {
            try { docEditorInstance.destroyEditor(); } catch(e) {}
            docEditorInstance = null;
        }

        const modalBody = document.getElementById('modalBody');
        if (modalBody) modalBody.innerHTML = '';
        performSearch(''); // Rafraîchit les récents au cas où le document a été modifié
    };

    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closePreviewModal();
    });
