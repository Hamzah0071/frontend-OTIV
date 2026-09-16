(function() {
    let currentFolderId = null;
    let currentScope = 'all'; // 'all', 'dept' ou 'private'
    let docEditorInstance = null;

    const user = typeof currentUser !== 'undefined' ? currentUser : JSON.parse(localStorage.getItem('currentUser') || '{}');

    // 1. DÉFINIR LE NOM DU DÉPARTEMENT SUR LE BOUTON
    const deptLabel = document.getElementById('deptQuickAccessName');
    if (deptLabel && user && user.departement) {
        deptLabel.textContent = `Espace ${user.departement}`;
    }

    function formatBytes(bytes) {
        if (!bytes || bytes === 0) return '--';
        const k = 1024;
        const sizes = ['Octets', 'Ko', 'Mo', 'Go'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
    }

    // 2. CHARGEMENT D'UN DOSSIER
    window.loadFolder = async function(folderId, scope = null) {
        if (scope !== null) currentScope = scope;
        currentFolderId = folderId;
        const searchBar = document.getElementById('searchAlertBar');
        if (searchBar) searchBar.style.display = 'none';

        const tbody = document.getElementById('tableBody');
        tbody.innerHTML = '<tr><td colspan="4" style="text-align: center; padding: 20px;"><i class="fa-solid fa-spinner fa-spin"></i> Chargement...</td></tr>';

        try {
            let url = `/api/explorer?scope=${currentScope}`;
            if (folderId) url += `&folder_id=${folderId}`;

            const response = await fetch(url);
            const data = await response.json();

            updateBreadcrumb(data.breadcrumb);
            renderTable(data.dossiers, data.fichiers);
        } catch (err) {
            tbody.innerHTML = '<tr><td colspan="4" style="text-align: center; color: #dc2626;">Erreur de chargement.</td></tr>';
        }
    };

    // 3. FIL D'ARIANE DYNAMIQUE
    function updateBreadcrumb(trail) {
        const container = document.getElementById('breadcrumbContainer');
        const activeLabel = (currentScope === 'dept') ? `Département ${user.departement || ''}` : 'Racine';
        
        container.innerHTML = `<a href="#" onclick="loadFolder(null, 'all'); return false;" class="otiv-breadcrumb__crumb"><i class="otiv-icon fa-solid fa-house"></i> ${activeLabel}</a>`;

        if (trail && trail.length > 0) {
            trail.forEach((item, index) => {
                const isLast = (index === trail.length - 1);
                if (isLast) {
                    container.innerHTML += ` <span class="otiv-breadcrumb__crumb is-current">/ ${item.nom}</span>`;
                } else {
                    container.innerHTML += ` <a href="#" onclick="loadFolder(${item.id}); return false;" class="otiv-breadcrumb__crumb">/ ${item.nom}</a>`;
                }
            });
        }
    }

    // 4. RENDU DU TABLEAU
    function renderTable(dossiers, fichiers) {
        const tbody = document.getElementById('tableBody');
        tbody.innerHTML = '';

        if (dossiers.length === 0 && fichiers.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4" style="text-align: center; padding: 30px; color: #8a9b92;"><i class="fa-regular fa-folder-open" style="font-size: 24px; margin-bottom: 8px; display: block;"></i> Aucun élément ici</td></tr>';
            return;
        }

        // Dossiers
        dossiers.forEach(d => {
            const tr = document.createElement('tr');
            const isPrivate = (d.departement_id === null || d.type_espace === 'PERSONNEL');
            const tagHtml = isPrivate 
                ? '<span class="otiv-visibility-tag is-private"><i class="fa-solid fa-lock"></i> Privé</span>'
                : '<span class="otiv-visibility-tag is-dept"><i class="fa-solid fa-building"></i> Département</span>';

            tr.innerHTML = `
              <td>
                <a href="#" onclick="loadFolder(${d.id}); return false;" class="otiv-file-name">
                  <i class="otiv-icon is-folder fa-solid fa-folder"></i>
                  <strong>${d.nom}</strong>
                </a>
                ${tagHtml}
              </td>
              <td class="otiv-cell-muted">--</td>
              <td class="otiv-cell-muted">${new Date(d.created_at).toLocaleDateString('fr-FR')}</td>
              <td class="otiv-table__col-actions">
                <div class="otiv-row-actions">
                  <button class="otiv-icon-action" onclick="shareItem('dossier', '${d.nom}')" title="Partager"><i class="otiv-icon fa-solid fa-share-nodes"></i></button>
                  <button class="otiv-icon-action is-danger" onclick="deleteToTrash('dossier', ${d.id}, '${d.nom}')" title="Supprimer"><i class="otiv-icon fa-solid fa-trash"></i></button>
                </div>
              </td>
            `;
            tbody.appendChild(tr);
        });

        // Fichiers
        fichiers.forEach(f => {
            const tr = document.createElement('tr');
            const ext = f.format ? f.format.toLowerCase() : '';
            let fileIcon = 'fa-file-lines';
            let iconColor = '#52645b';

            if (['docx', 'doc'].includes(ext)) { fileIcon = 'fa-file-word'; iconColor = '#2b579a'; }
            else if (['xlsx', 'xls', 'csv'].includes(ext)) { fileIcon = 'fa-file-excel'; iconColor = '#217346'; }
            else if (['pptx', 'ppt'].includes(ext)) { fileIcon = 'fa-file-powerpoint'; iconColor = '#d24726'; }
            else if (ext === 'pdf') { fileIcon = 'fa-file-pdf'; iconColor = '#b30b00'; }
            else if (['jpg', 'jpeg', 'png', 'webp'].includes(ext)) { fileIcon = 'fa-file-image'; iconColor = '#00843d'; }

            const isPrivate = (f.departement_id === null || f.type_espace === 'PERSONNEL');
            const tagHtml = isPrivate 
                ? '<span class="otiv-visibility-tag is-private"><i class="fa-solid fa-lock"></i> Privé</span>'
                : '<span class="otiv-visibility-tag is-dept"><i class="fa-solid fa-building"></i> Département</span>';

            tr.innerHTML = `
              <td>
                <span class="otiv-file-name" style="cursor: pointer;" onclick="openUniversalFile(${f.id})" title="Cliquer pour ouvrir / éditer">
                  <i class="otiv-icon is-file fa-regular ${fileIcon}" style="color: ${iconColor};"></i>
                  ${f.nom_original}
                </span>
                ${tagHtml}
              </td>
              <td class="otiv-cell-muted">${formatBytes(f.taille)}</td>
              <td class="otiv-cell-muted">${new Date(f.created_at).toLocaleDateString('fr-FR')}</td>
              <td class="otiv-table__col-actions">
                <div class="otiv-row-actions">
                  <button class="otiv-icon-action" onclick="openHistoryModal(${f.id})" title="Historique"><i class="fa-solid fa-clock-rotate-left"></i></button>
                  <a href="/api/fichiers/${f.id}/stream?download=1" class="otiv-icon-action" title="Télécharger"><i class="otiv-icon fa-solid fa-download"></i></a>
                  <button class="otiv-icon-action" onclick="shareItem('fichier', '${f.nom_original}')" title="Partager"><i class="otiv-icon fa-solid fa-share-nodes"></i></button>
                  <button class="otiv-icon-action is-danger" onclick="deleteToTrash('fichier', ${f.id}, '${f.nom_original}')" title="Supprimer"><i class="otiv-icon fa-solid fa-trash"></i></button>
                </div>
              </td>
            `;
            tbody.appendChild(tr);
        });
    }

    // 5. SUPPRESSION / CORBEILLE
    window.deleteToTrash = async function(type, id, name) {
        if (!confirm(`Déplacer "${name}" vers la corbeille ?`)) return;
        try {
            const res = await fetch(`/api/corbeille/${type}/${id}`, { method: 'POST' });
            if (res.ok) loadFolder(currentFolderId);
            else alert("Erreur lors de la suppression.");
        } catch(e) { alert("Erreur réseau."); }
    };

    window.toggleFavorite = function(btn) {
        const icon = btn.querySelector('i');
        if (icon.classList.contains('fa-regular')) {
            icon.classList.replace('fa-regular', 'fa-solid');
            icon.style.color = '#eab308';
        } else {
            icon.classList.replace('fa-solid', 'fa-regular');
            icon.style.color = '';
        }
    };

    window.shareItem = function(type, name) {
        alert(`Partage de ${type} : "${name}"\nModule de gestion accessible dans "Partages".`);
    };

    // 6. IMPORTATION DE FICHIER RAPIDE
    const btnImportNav = document.getElementById('btnImportNav');
    const filePicker = document.getElementById('filePicker');
    if (btnImportNav && filePicker) {
        btnImportNav.addEventListener('click', () => filePicker.click());
        filePicker.addEventListener('change', async () => {
            if (filePicker.files.length === 0) return;
            const formData = new FormData();
            formData.append('document', filePicker.files[0]);
            if (currentFolderId) formData.append('dossier_id', currentFolderId);

            const origHtml = btnImportNav.innerHTML;
            btnImportNav.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Envoi...';

            try {
                const res = await fetch('/api/fichiers', { method: 'POST', body: formData });
                if (res.ok) loadFolder(currentFolderId);
                else alert("Erreur lors de l'envoi.");
            } catch(err) { alert("Erreur de connexion."); }
            finally {
                filePicker.value = '';
                btnImportNav.innerHTML = origHtml;
            }
        });
    }

    // 7. MODALE CRÉATION : GESTION DÉPARTEMENT VS PRIVÉ
    const createModal     = document.getElementById('createDocModal');
    const createIcon      = document.getElementById('createDocIcon');
    const createTitleEl   = document.getElementById('createDocTitle');
    const createLabelEl   = document.getElementById('createDocLabel');
    const createInput     = document.getElementById('createDocInput');
    const createConfirm   = document.getElementById('createDocConfirm');
    const pathPickerBtn   = document.getElementById('pathPickerBtn');
    const pathPickerLabel = document.getElementById('pathPickerLabel');
    const visibilityRadios = document.querySelectorAll('input[name="visibility"]');

    let currentActionType = null;
    let chosenFolderId = null;

    const CONFIG = {
        docx:   { icon: 'fa-file-word',       label: 'is-word',   title: 'Document Word',          fieldLabel: 'Nom du document :',       placeholder: 'Nouveau document' },
        xlsx:   { icon: 'fa-file-excel',      label: 'is-excel',  title: 'Feuille Excel',           fieldLabel: 'Nom de la feuille :',     placeholder: 'Nouvelle feuille' },
        pptx:   { icon: 'fa-file-powerpoint', label: 'is-ppt',    title: 'Présentation PowerPoint', fieldLabel: 'Nom de la présentation :',placeholder: 'Nouvelle présentation' },
        folder: { icon: 'fa-folder-plus',     label: 'is-folder', title: 'Nouveau dossier',         fieldLabel: 'Nom du dossier :',        placeholder: 'Nouveau dossier' },
    };

    // Met à jour l'interface de la modale selon que l'agent choisit Département ou Privé
    function updateModalVisibilityUI() {
        const selectedVis = document.querySelector('input[name="visibility"]:checked')?.value || 'dept';

        if (selectedVis === 'dept') {
            // VERROUILLÉ SUR LE DÉPARTEMENT (NON CLIQUABLE)
            pathPickerLabel.textContent = `Département ${user.departement || 'Général'}`;
            pathPickerBtn.style.pointerEvents = 'none';
            pathPickerBtn.style.opacity = '0.65';
            pathPickerBtn.style.background = '#f1f5f9';
            pathPickerBtn.style.cursor = 'not-allowed';
            chosenFolderId = null;
        } else {
            // CLIQUABLE POUR CHOISIR PARMI LES DOSSIERS PERSONNELS
            pathPickerBtn.style.pointerEvents = 'auto';
            pathPickerBtn.style.opacity = '1';
            pathPickerBtn.style.background = '';
            pathPickerBtn.style.cursor = 'pointer';
            pathPickerLabel.textContent = chosenFolderId ? browsingFolderName : "Racine privée";
        }
    }

    visibilityRadios.forEach(r => r.addEventListener('change', updateModalVisibilityUI));

    document.querySelectorAll('[data-action="create-doc"]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            currentActionType = btn.dataset.type;
            const cfg = CONFIG[currentActionType];
            if (!cfg || !createModal) return;

            createIcon.className = `otiv-icon fa-solid ${cfg.icon} ${cfg.label}`;
            createTitleEl.textContent = cfg.title;
            createLabelEl.textContent = cfg.fieldLabel;
            createInput.placeholder = cfg.placeholder;
            createInput.value = cfg.placeholder;

            // Par défaut : Département coché
            const defaultRadio = document.querySelector('input[name="visibility"][value="dept"]');
            if (defaultRadio) defaultRadio.checked = true;

            chosenFolderId = null;
            updateModalVisibilityUI();

            createModal.hidden = false;
            createModal.style.display = 'flex';
            setTimeout(() => { createInput.focus(); createInput.select(); }, 50);
        });
    });

    function closeCreateModal() {
        if (!createModal) return;
        createModal.hidden = true;
        createModal.style.display = 'none';
    }

    document.querySelectorAll('[data-action="close-create-doc"]').forEach(btn => btn.addEventListener('click', closeCreateModal));
    if (createModal) createModal.addEventListener('click', (e) => { if (e.target === createModal) closeCreateModal(); });

    createConfirm.addEventListener('click', async () => {
        const name = createInput.value.trim();
        if (!name) { createInput.focus(); return; }

        const actionType = currentActionType;
        const targetFolderId = chosenFolderId;
        const visibility = document.querySelector('input[name="visibility"]:checked')?.value || 'dept';

        closeCreateModal();

        if (actionType === 'folder') {
            try {
                const res = await fetch('/api/dossiers', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ nom: name, parent_id: targetFolderId, visibility: visibility })
                });
                if (res.ok) loadFolder(currentFolderId);
                else alert("Erreur lors de la création du dossier.");
            } catch(err) { alert("Erreur de connexion."); }
        } else {
            try {
                const res = await fetch('/api/fichiers/creer-office', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ nom: name, type: actionType, dossier_id: targetFolderId, visibility: visibility })
                });
                const data = await res.json();
                if (res.ok) {
                    loadFolder(currentFolderId);
                } else {
                    alert(data.error || "Erreur de création.");
                }
            } catch (err) { alert("Erreur de connexion."); }
        }
    });

    // =========================================================================
    // 8. SÉLECTEUR D'EMPLACEMENT PERSONNEL (FOLDER PICKER INTERACTIF)
    // =========================================================================
    const folderPickerModal  = document.getElementById('folderPickerModal');
    const pickerBreadcrumb   = document.getElementById('pickerBreadcrumb');
    const pickerList         = document.getElementById('pickerList');
    const pickerConfirm      = document.getElementById('pickerConfirm');
    
    let browsingFolderId     = null; // Dossier actuellement ouvert dans l'explorateur
    let selectedPickerId     = null; // Dossier sélectionné pour la création
    let selectedPickerName   = "Racine privée";

    // CHARGER LES DOSSIERS PERSONNELS (Filtrage strict scope=private)
    window.loadPickerFolders = async function(folderId) {
        browsingFolderId = folderId;
        pickerList.innerHTML = '<li style="padding:20px; text-align:center; color:#64748b;"><i class="fa-solid fa-spinner fa-spin fa-2x"></i><br><br>Chargement de vos dossiers personnels...</li>';

        try {
            let url = `/api/explorer?scope=private`;
            if (folderId) url += `&folder_id=${folderId}`;

            const res = await fetch(url);
            const data = await res.json();

            // 1. Mettre à jour le fil d'Ariane du sélecteur
            pickerBreadcrumb.innerHTML = `
                <span class="otiv-picker-breadcrumb__crumb ${!folderId ? 'is-current' : ''}" 
                      style="cursor:pointer; font-weight:600;" 
                      onclick="window.loadPickerFolders(null)">
                    <i class="fa-solid fa-lock"></i> Racine privée
                </span>`;

            if (data.breadcrumb && data.breadcrumb.length > 0) {
                data.breadcrumb.forEach(b => {
                    pickerBreadcrumb.innerHTML += ` / <span class="otiv-picker-breadcrumb__crumb" 
                          style="cursor:pointer; font-weight:600;" 
                          onclick="window.loadPickerFolders(${b.id})">${b.nom}</span>`;
                });
            }

            // 2. Si aucun sous-dossier personnel
            if (!data.dossiers || data.dossiers.length === 0) {
                pickerList.innerHTML = `
                    <li style="padding:30px; text-align:center; color:#94a3b8;">
                        <i class="fa-regular fa-folder-open" style="font-size:26px; margin-bottom:8px; display:block;"></i>
                        Aucun sous-dossier personnel à cet endroit.<br>
                        <small>Vous pouvez choisir l'emplacement actuel ci-dessous.</small>
                    </li>`;
                return;
            }

            // 3. Afficher les dossiers avec bouton Sélectionner + bouton Ouvrir (>)
            pickerList.innerHTML = data.dossiers.map(d => `
                <li class="picker-folder-item" data-id="${d.id}" data-name="${d.nom}" 
                    style="display:flex; justify-content:space-between; align-items:center; padding:12px 16px; border-radius:8px; margin-bottom:8px; cursor:pointer; border:1px solid #e2e8f0; background:white; transition:all 0.2s;">
                    
                    <div style="display:flex; align-items:center; gap:12px; flex:1;">
                        <i class="fa-solid fa-folder" style="color:#00843d; font-size:18px;"></i>
                        <span style="font-weight:600; color:#1e293b;">${d.nom}</span>
                    </div>

                    <div style="display:flex; align-items:center; gap:8px;">
                        <button type="button" class="btn-select-this otiv-btn otiv-btn--sm" 
                                style="background:#e8f5ed; color:#00843d; border:1px solid #00843d; border-radius:6px; padding:4px 10px; font-size:12px; font-weight:700; cursor:pointer;">
                            Choisir
                        </button>
                        <button type="button" class="btn-enter-this" title="Ouvrir ce sous-dossier" 
                                style="background:#f1f5f9; border:none; border-radius:6px; color:#475569; width:28px; height:28px; display:flex; align-items:center; justify-content:center; cursor:pointer;">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
                </li>
            `).join('');

        } catch(e) {
            pickerList.innerHTML = '<li style="color:#dc2626; padding:15px; text-align:center;">Erreur de chargement des dossiers.</li>';
        }
    };

    // GESTIONNAIRE DE CLIC DANS LA LISTE DES DOSSIERS
    pickerList.addEventListener('click', (e) => {
        const item = e.target.closest('.picker-folder-item');
        if (!item) return;

        const id = parseInt(item.dataset.id);
        const name = item.dataset.name;

        // A. Clic sur la flèche > ➔ On entre dans le sous-dossier
        if (e.target.closest('.btn-enter-this')) {
            e.stopPropagation();
            window.loadPickerFolders(id);
            return;
        }

        // B. Clic sur la ligne ou sur "Choisir" ➔ On sélectionne ce dossier
        document.querySelectorAll('.picker-folder-item').forEach(el => {
            el.style.borderColor = '#e2e8f0';
            el.style.background = 'white';
        });

        item.style.borderColor = '#00843d';
        item.style.background = '#e8f5ed';

        selectedPickerId = id;
        selectedPickerName = name;

        // Met à jour le texte du bouton de confirmation en bas
        pickerConfirm.innerHTML = `<i class="fa-solid fa-check"></i> Choisir "${name}"`;
    });

    // OUVRIR LE SÉLECTEUR D'EMPLACEMENT
    if (pathPickerBtn) {
        pathPickerBtn.addEventListener('click', () => {
            folderPickerModal.hidden = false;
            folderPickerModal.style.display = 'flex';
            
            // Réinitialiser la sélection à la racine privée au départ
            selectedPickerId = null;
            selectedPickerName = "Racine privée";
            pickerConfirm.innerHTML = `<i class="fa-solid fa-check"></i> Choisir Racine privée`;

            window.loadPickerFolders(null);
        });
    }

    function closeFolderPicker() {
        if (folderPickerModal) {
            folderPickerModal.hidden = true;
            folderPickerModal.style.display = 'none';
        }
    }

    document.querySelectorAll('[data-action="close-folder-picker"]').forEach(btn => btn.addEventListener('click', closeFolderPicker));
    if (folderPickerModal) {
        folderPickerModal.addEventListener('click', (e) => {
            if (e.target === folderPickerModal) closeFolderPicker();
        });
    }

    // CONFIRMATION DU DOSSIER CHOISI
    if (pickerConfirm) {
        pickerConfirm.addEventListener('click', () => {
            // Applique le dossier choisi à la modale de création
            chosenFolderId = selectedPickerId;
            pathPickerLabel.textContent = selectedPickerName;
            closeFolderPicker();
        });
    }

    // 9. MODALE HISTORIQUE DES VERSIONS / ACTIVITÉS
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

    // 10. OUVERTURE DANS NOTRE PROPRE MODALE PLEIN ÉCRAN ONLYOFFICE & MÉDIAS
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

            // CAS BUREAUTIQUE (ONLYOFFICE PLEIN ÉCRAN 100%)
            if (data.type === 'onlyoffice') {
                modalBody.style.display = 'block';
                modalBody.innerHTML = `<div id="onlyoffice-editor-box" style="width: 100%; height: 100%;"></div>`;

                if (typeof DocsAPI === 'undefined') {
                    modalBody.innerHTML = `<p style="color: #dc2626; padding: 40px; text-align: center;">Service OnlyOffice indisponible.</p>`;
                    return;
                }

                docEditorInstance = new DocsAPI.DocEditor("onlyoffice-editor-box", data.config);
            } 
            else if (data.type === 'image') {
                modalBody.innerHTML = `<img src="${data.file_url}" style="max-width: 95vw; max-height: 90vh; object-fit: contain;">`;
            } 
            else if (data.type === 'video') {
                modalBody.innerHTML = `<video controls autoplay style="max-width: 95vw; max-height: 90vh;"><source src="${data.file_url}"></video>`;
            } 
            else {
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

        if (typeof currentFolderId !== 'undefined') {
            loadFolder(currentFolderId);
        }
    };

    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closePreviewModal();
    });

    // =========================================================================
    // RECHERCHE EN DIRECT ET RECHERCHE ENTRANTE DANS DOCUMENTS.HTML
    // =========================================================================
    window.performSearchInDocuments = async function(query) {
        if (!query || query.trim() === '') {
            clearSearch();
            return;
        }

        isSearchMode = true;
        const alertBar = document.getElementById('searchAlertBar');
        const alertText = document.getElementById('searchAlertText');
        const tbody = document.getElementById('tableBody');

        if (alertBar) alertBar.style.display = 'flex';
        if (alertText) alertText.innerHTML = `<i class="fa-solid fa-magnifying-glass"></i> Recherche pour : "<strong>${query}</strong>"...`;
        if (tbody) tbody.innerHTML = '<tr><td colspan="4" style="text-align:center; padding:20px;"><i class="fa-solid fa-spinner fa-spin"></i> Recherche en cours...</td></tr>';

        try {
            const res = await fetch(`/api/recherche?q=${encodeURIComponent(query)}`);
            const data = await res.json();

            if (alertText) alertText.innerHTML = `<i class="fa-solid fa-magnifying-glass"></i> ${data.total} résultat(s) pour "<strong>${data.query}</strong>"`;
            renderTable(data.dossiers, data.fichiers);
        } catch (err) {
            if (alertText) alertText.textContent = "Erreur lors de la recherche.";
        }
    };

    window.clearSearch = function() {
        const navInput = document.querySelector('.otiv-nav__search input');
        if (navInput) navInput.value = '';
        const alertBar = document.getElementById('searchAlertBar');
        if (alertBar) alertBar.style.display = 'none';
        
        // Nettoyer l'URL sans recharger
        window.history.pushState({}, '', 'documents.html');
        loadFolder(currentFolderId);
    };

    // Écoute de la frappe en direct sur documents.html
    const navSearchDocInput = document.querySelector('.otiv-nav__search input');
    let searchDebounceDoc = null;
    if (navSearchDocInput) {
        navSearchDocInput.addEventListener('input', () => {
            clearTimeout(searchDebounceDoc);
            searchDebounceDoc = setTimeout(() => {
                const term = navSearchDocInput.value.trim();
                if (term.length > 0) {
                    performSearchInDocuments(term);
                } else if (isSearchMode) {
                    clearSearch();
                }
            }, 300);
        });
    }

    // DÉTECTION AU CHARGEMENT : Est-ce qu'on arrive avec un ?q=... ou un ?folder_id=... ?
    const urlParamsOnLoad = new URLSearchParams(window.location.search);
    const initialSearchQuery = urlParamsOnLoad.get('q');
    const initialFolder = urlParamsOnLoad.get('folder_id');

    if (initialSearchQuery) {
        // Si on vient d'une autre page avec une recherche
        performSearchInDocuments(initialSearchQuery);
    } else if (initialFolder) {
        loadFolder(parseInt(initialFolder));
    } else {
        loadFolder(null);
    }

})();

