/**
 * OTIV DIANA - GED Interne
 * Script global partagé par toutes les pages
 */

// 1. VÉRIFICATION DE SESSION
const savedUser = localStorage.getItem('currentUser');
if (!savedUser && !window.location.pathname.endsWith('login.php')) {
    window.location.href = 'login.php';
}

const currentUser = savedUser ? JSON.parse(savedUser) : null;

document.addEventListener('DOMContentLoaded', () => {

    // 2. PROFIL UTILISATEUR DANS LA BARRE DU HAUT
    if (currentUser && currentUser.nom) {
        const userNameEl = document.querySelector('.otiv-nav__user-name');
        const userAvatarEl = document.querySelector('.otiv-nav__avatar');
        if (userNameEl) userNameEl.textContent = currentUser.nom;
        if (userAvatarEl) userAvatarEl.textContent = currentUser.nom.charAt(0).toUpperCase();
    }

    // 3. DÉCONNEXION UNIVERSELLE
    const logoutBtn = document.getElementById('btnLogout') || document.querySelector('.otiv-nav__link.is-danger');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', async (e) => {
            e.preventDefault();
            try { await fetch('/api/logout', { method: 'POST' }); } catch (err) {}
            localStorage.removeItem('currentUser');
            window.location.href = 'login.php';
        });
    }

    // 4. MOTEUR DE RECHERCHE UNIVERSEL DANS LA BARRE DU HAUT
    const navSearchContainer = document.querySelector('.otiv-nav__search');
    const navSearchInput = navSearchContainer ? navSearchContainer.querySelector('input') : null;
    const navSearchIcon = navSearchContainer ? navSearchContainer.querySelector('i') : null;

    if (navSearchInput) {
        // Si une recherche 'q' est déjà présente dans l'URL, on pré-remplit la barre
        const urlParams = new URLSearchParams(window.location.search);
        const queryFromUrl = urlParams.get('q');
        if (queryFromUrl) {
            navSearchInput.value = queryFromUrl;
        }

        // Fonction déclenchant la recherche
        const executeGlobalSearch = () => {
            const term = navSearchInput.value.trim();
            if (!term) return;

            const pathname = window.location.pathname;
            const isAccueil = pathname.endsWith('accueil.html') || pathname.endsWith('/');
            const isDocuments = pathname.endsWith('documents.html');

            if (isAccueil && typeof performSearch === 'function') {
                performSearch(term);
            } else if (isDocuments && typeof performSearchInDocuments === 'function') {
                performSearchInDocuments(term);
            } else {
                // Depuis n'importe quelle autre page (département, partages, corbeille...)
                // On redirige vers documents.html avec la requête !
                window.location.href = `documents.html?q=${encodeURIComponent(term)}`;
            }
        };

        // Déclencheur 1 : Touche Entrée
        navSearchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                executeGlobalSearch();
            }
        });

        // Déclencheur 2 : Clic sur la loupe
        if (navSearchIcon) {
            navSearchIcon.style.cursor = 'pointer';
            navSearchIcon.title = "Cliquer pour rechercher";
            navSearchIcon.addEventListener('click', executeGlobalSearch);
        }
    }
});

// avant de
document.addEventListener('DOMContentLoaded', function() {
    // Ce code s'exécute une fois le DOM prêt
    // Il peut utiliser les fonctions ou variables définies dans partages.js
    if (typeof maFonctionPartage === 'function') {
        maFonctionPartage();
    }
});