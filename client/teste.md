<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Accueil — OTIV DIANA</title>
<link rel="stylesheet" href="../icon/fontAwesome/all.min.css">
<link rel="shortcut icon" href="../icon/sans-fond.png" type="image/x-icon">
<link rel="stylesheet" href="../css/common.css">
<link rel="stylesheet" href="../css/accueil.css">
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
<div id="previewModal" style="display: none; position: fixed; inset: 0; width: 100vw; height: 100vh; background: #0f241a; z-index: 99999; flex-direction: column; overflow: hidden;">
  <!-- Barre d'en-tête compacte (52px) -->
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
      <button onclick="closePreviewModal()" title="Fermer l'éditeur (Échap)" style="background: rgba(255,255,255,0.1); border: none; color: white; width: 34px; height: 34px; border-radius: 8px; font-size: 18px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" onmouseover="this.style.background='rgba(220,38,38,0.85)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>
  </div>
  <!-- Zone de travail OnlyOffice occupant 100% de la hauteur restante -->
  <div id="modalBody" style="flex: 1; width: 100%; height: calc(100vh - 52px); background: #f8fbf9; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative;">
  </div>
</div>
</main>

<script src="../js/common.js"></script>
<script src="../js/accueil.js"></script>
<script src="http://localhost:8081/web-apps/apps/api/documents/api.js"></script>

</body>
</html>

-------

css

/* =========================================================
   accueil.css — page d'accueil uniquement
   ========================================================= */

.otiv-hero{
  background: linear-gradient(115deg, var(--otiv-navy) 0%, var(--otiv-navy-light) 45%, var(--otiv-green-dark) 100%);
  border-radius: var(--otiv-radius-lg);
  padding: 34px 36px;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 24px;
  color: var(--otiv-white);
}

.otiv-hero__eyebrow{
  font-size: 12px;
  font-weight: 700;
  letter-spacing: .03em;
  color: #B7F0CC;
  margin: 0 0 10px;
}

.otiv-hero__title{
  font-size: 27px;
  font-weight: 800;
  margin: 0 0 8px;
  display: flex;
  align-items: center;
  gap: 10px;
}

.otiv-hero__subtitle{
  margin: 0;
  color: #D8DEEA;
  font-size: 14px;
  max-width: 480px;
}

.otiv-hero__actions{
  display: flex;
  gap: 10px;
  flex-shrink: 0;
}

@media (max-width: 720px){
  .otiv-hero{ flex-direction: column; align-items: flex-start; }
}
/* ---------------------------------------------------------
   Actions rapides
   --------------------------------------------------------- */
.otiv-quick-actions{ margin: 24px 0; }

.otiv-quick-actions__title{
  font-size: 13.5px;
  font-weight: 700;
  color: var(--otiv-navy);
  margin: 0 0 12px;
}

.otiv-quick-actions__grid{
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 14px;
}

.otiv-quick-action{
  display: flex;
  align-items: center;
  gap: 12px;
  background: var(--otiv-white);
  border: 1px solid var(--otiv-border);
  border-radius: var(--otiv-radius-lg);
  box-shadow: var(--otiv-shadow-card);
  padding: 16px;
  cursor: pointer;
  text-align: left;
  transition: transform .12s ease, box-shadow .12s ease, border-color .12s ease;
}
.otiv-quick-action:hover{
  transform: translateY(-2px);
  border-color: var(--otiv-green);
  box-shadow: var(--otiv-shadow-pop);
}

.otiv-quick-action__icon{
  width: 38px;
  height: 38px;
  border-radius: var(--otiv-radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 17px;
  color: var(--otiv-white);
  flex-shrink: 0;
}
.otiv-quick-action__icon.is-word{   background: #2B579A; }
.otiv-quick-action__icon.is-excel{  background: #217346; }
.otiv-quick-action__icon.is-ppt{    background: #D24726; }
.otiv-quick-action__icon.is-folder{ background: var(--otiv-navy); }

.otiv-quick-action__label{
  font-size: 13px;
  font-weight: 600;
  color: var(--otiv-text);
}

@media (max-width: 900px){
  .otiv-quick-actions__grid{ grid-template-columns: repeat(2, 1fr); }
}

-------- css en commnu 
/* =========================================================
   OTIV DIANA — GED 2.0
   common.css — design tokens + shared layout (header, nav,
   breadcrumb, table, buttons). Loaded on every page.
   ========================================================= */

:root{
  --otiv-green:        #088f0b;
  --otiv-green-dark:    #08980a;
  /* bleu */
  --otiv-navy:          #088f0b;
  --otiv-navy-light:    #015203;
  /*  */
  --otiv-gray:          #ECF0F4;
  --otiv-gray-dark:     #DDE3EA;
  --otiv-border:        #E1E6EC;
  --otiv-text:          #1D2333;
  --otiv-text-soft:     #667085;
  --otiv-text-faint:    #9AA3B2;
  --otiv-white:         #FFFFFF;
  --otiv-amber:         #F5A524;
  --otiv-red:           #E4483A;

  --otiv-radius-sm:     6px;
  --otiv-radius-md:     10px;
  --otiv-radius-lg:     16px;

  --otiv-shadow-card:   0 1px 2px rgba(24,31,72,.04), 0 8px 24px rgba(24,31,72,.06);
  --otiv-shadow-pop:    0 12px 32px rgba(24,31,72,.14);

  --otiv-font: -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
}

*, *::before, *::after{ box-sizing: border-box; }

html, body{
  margin: 0;
  padding: 0;
  height: 100%;
}

body.otiv-body{
  font-family: var(--otiv-font);
  background: var(--otiv-gray);
  color: var(--otiv-text);
  font-size: 14px;
  line-height: 1.5;
  -webkit-font-smoothing: antialiased;
}

a{ color: inherit; text-decoration: none; }
button{ font-family: inherit; }

.otiv-icon{
  display: inline-block;
  line-height: 1;
  vertical-align: -0.1em;
  flex-shrink: 0;
}

/* ---------------------------------------------------------
   Top navigation
   --------------------------------------------------------- */
.otiv-nav{
  display: flex;
  align-items: center;
  gap: 20px;
  background: var(--otiv-white);
  border-bottom: 1px solid var(--otiv-border);
  padding: 10px 24px;
  position: sticky;
  top: 0;
  z-index: 20;
  width: 100%;
}

.otiv-nav__brand{
  display: flex;
  align-items: center;
  gap: 10px;
  font-weight: 700;
  font-size: 16px;
  color: var(--otiv-navy);
  white-space: nowrap;
  flex-shrink: 0;
}

.otiv-nav__brand-mark{
  width: auto;
  height: 36px;
  border: none;
  border-radius: 0;
  background: transparent;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0;
}

.otiv-nav__brand-mark img{
  height: 36px;
  width: auto;
  display: block;
  object-fit: contain;
}

.otiv-nav__brand span{ color: var(--otiv-green); }

.otiv-nav__links{
  display: flex;
  align-items: center;
  gap: 4px;
  flex: 1 1 auto;
  min-width: 0;           /* autorise le flex-item à rétrécir sous son contenu */
  overflow-x: auto;
  scrollbar-width: none;  /* Firefox */
}
.otiv-nav__links::-webkit-scrollbar{ display: none; } /* Chrome/Safari/Edge */

.otiv-nav__link{
  display: flex;
  align-items: center;
  gap: 7px;
  padding: 9px 14px;
  border-radius: 20px;
  font-size: 13.5px;
  font-weight: 600;
  color: var(--otiv-text-soft);
  white-space: nowrap;
  flex-shrink: 0;
  transition: background .15s ease, color .15s ease;
}

.otiv-nav__link:hover{
  background: var(--otiv-gray);
  color: var(--otiv-navy);
}

.otiv-nav__link.is-active{
  background: var(--otiv-green);
  color: var(--otiv-white);
}

.otiv-nav__link.is-danger{
  color: var(--otiv-red);
  margin-left: 4px;
}
.otiv-nav__link.is-danger:hover{
  background: rgba(228,72,58,.08);
  color: var(--otiv-red);
}

.otiv-nav__search{
  display: flex;
  align-items: center;
  gap: 8px;
  background: var(--otiv-gray);
  border: 1px solid transparent;
  border-radius: 20px;
  padding: 8px 14px;
  width: 180px;
  min-width: 0;
  flex-shrink: 1;
  color: var(--otiv-text-faint);
  transition: border-color .15s ease, width .15s ease;
}
.otiv-nav__search:focus-within{
  border-color: var(--otiv-green);
  width: 220px;
}
.otiv-nav__search input{
  border: none;
  background: transparent;
  outline: none;
  font-size: 13.5px;
  color: var(--otiv-text);
  width: 100%;
}
.otiv-nav__search input::placeholder{ color: var(--otiv-text-faint); }

.otiv-nav__icon-btn{
  position: relative;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  border: none;
  background: transparent;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--otiv-text-soft);
  font-size: 17px;
  cursor: pointer;
  flex-shrink: 0;
}
.otiv-nav__icon-btn:hover{ background: var(--otiv-gray); color: var(--otiv-navy); }

.otiv-nav__badge{
  position: absolute;
  top: 2px;
  right: 2px;
  min-width: 15px;
  height: 15px;
  padding: 0 3px;
  border-radius: 999px;
  background: var(--otiv-red);
  color: var(--otiv-white);
  font-size: 9.5px;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
}

.otiv-nav__user{
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 4px 10px 4px 4px;
  border-radius: 20px;
  cursor: pointer;
  flex-shrink: 0;
}
.otiv-nav__user:hover{ background: var(--otiv-gray); }

.otiv-nav__avatar{
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background: var(--otiv-green);
  color: var(--otiv-white);
  font-weight: 700;
  font-size: 13px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.otiv-nav__user-name{
  font-weight: 600;
  font-size: 13.5px;
  color: var(--otiv-text);
  white-space: nowrap;
}
.otiv-nav__user i{ color: var(--otiv-text-faint); font-size: 12px; }

/* ---------------------------------------------------------
   Page shell
   --------------------------------------------------------- */
.otiv-page{
  max-width: 1180px;
  margin: 0 auto;
  padding: 24px 28px 60px;
}

/* ---------------------------------------------------------
   Breadcrumb
   --------------------------------------------------------- */
.otiv-breadcrumb{
  display: flex;
  align-items: center;
  gap: 8px;
  background: var(--otiv-white);
  border: 1px solid var(--otiv-border);
  border-radius: var(--otiv-radius-md);
  padding: 12px 18px;
  margin-bottom: 14px;
  font-size: 13.5px;
  font-weight: 600;
  color: var(--otiv-text-soft);
}
.otiv-breadcrumb i{ color: var(--otiv-green); font-size: 15px; }
.otiv-breadcrumb__crumb{ color: var(--otiv-text-soft); }
.otiv-breadcrumb__crumb:hover{ color: var(--otiv-navy); }
.otiv-breadcrumb__sep{ color: var(--otiv-text-faint); }
.otiv-breadcrumb__crumb.is-current{ color: var(--otiv-navy); }

/* ---------------------------------------------------------
   File / folder table (shared by Documents, Departement,
   Partages, Favoris, Corbeille)
   --------------------------------------------------------- */
.otiv-panel{
  background: var(--otiv-white);
  border: 1px solid var(--otiv-border);
  border-radius: var(--otiv-radius-lg);
  box-shadow: var(--otiv-shadow-card);
  overflow: hidden;
}

.otiv-table{
  width: 100%;
  border-collapse: collapse;
}

.otiv-table thead th{
  text-align: left;
  font-size: 11.5px;
  font-weight: 700;
  letter-spacing: .04em;
  color: var(--otiv-text-faint);
  padding: 14px 22px;
  border-bottom: 1px solid var(--otiv-border);
}

.otiv-table th.otiv-table__col-actions,
.otiv-table td.otiv-table__col-actions{ text-align: right; }

.otiv-table tbody tr{
  border-bottom: 1px solid var(--otiv-border);
  transition: background .12s ease;
}
.otiv-table tbody tr:last-child{ border-bottom: none; }
.otiv-table tbody tr:hover{ background: #FAFBFC; }

.otiv-table td{
  padding: 13px 22px;
  vertical-align: middle;
  color: var(--otiv-text);
}

.otiv-file-name{
  display: flex;
  align-items: center;
  gap: 11px;
  font-weight: 600;
}

.otiv-file-name i{ font-size: 18px; }
.otiv-file-name .otiv-icon.is-folder{ color: var(--otiv-green); }
.otiv-file-name .otiv-icon.is-file{ color: var(--otiv-green); }

.otiv-table td.otiv-cell-muted{ color: var(--otiv-text-soft); }

.otiv-row-actions{
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.otiv-icon-action{
  width: 32px;
  height: 32px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 8px;
  border: none;
  background: transparent;
  color: var(--otiv-text-faint);
  font-size: 15px;
  cursor: pointer;
  transition: background .12s ease, color .12s ease;
}
.otiv-icon-action:hover{ background: var(--otiv-gray); color: var(--otiv-navy); }
.otiv-icon-action.is-danger:hover{ background: rgba(228,72,58,.1); color: var(--otiv-red); }
.otiv-icon-action.is-favorite{ color: var(--otiv-amber); }
.otiv-icon-action.is-favorite:hover{ background: rgba(245,165,36,.12); }

/* Empty state, used by Corbeille / Favoris / Partages when empty */
.otiv-empty{
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 10px;
  padding: 70px 20px;
  text-align: center;
}
.otiv-empty i{
  font-size: 40px;
  color: var(--otiv-gray-dark);
}
.otiv-empty h3{ margin: 0; font-size: 15px; color: var(--otiv-navy); }
.otiv-empty p{ margin: 0; color: var(--otiv-text-soft); font-size: 13.5px; max-width: 320px; }

/* ---------------------------------------------------------
   Buttons
   --------------------------------------------------------- */
.otiv-btn{
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 18px;
  border-radius: 999px;
  border: none;
  font-size: 13.5px;
  font-weight: 600;
  cursor: pointer;
  white-space: nowrap;
  transition: transform .1s ease, opacity .12s ease;
}
.otiv-btn:active{ transform: translateY(1px); }

.otiv-btn--dark{
  background: rgba(255,255,255,.14);
  color: var(--otiv-white);
  border: 1px solid rgba(255,255,255,.28);
}
.otiv-btn--dark:hover{ background: rgba(255,255,255,.22); }

.otiv-btn--solid{
  background: var(--otiv-white);
  color: var(--otiv-navy);
}
.otiv-btn--solid:hover{ opacity: .9; }

.otiv-btn--primary{
  background: var(--otiv-green);
  color: var(--otiv-white);
}
.otiv-btn--primary:hover{ background: var(--otiv-green-dark); }

.otiv-btn--ghost{
  background: transparent;
  color: var(--otiv-text-soft);
  border: 1px solid var(--otiv-border);
}
.otiv-btn--ghost:hover{ background: var(--otiv-gray); color: var(--otiv-navy); }

/* ---------------------------------------------------------
   Section heading used above panels on secondary pages
   --------------------------------------------------------- */
.otiv-section-head{
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 14px;
}
.otiv-section-head h1{
  font-size: 19px;
  margin: 0 0 3px;
  color: var(--otiv-navy);
}
.otiv-section-head p{
  margin: 0;
  color: var(--otiv-text-soft);
  font-size: 13.5px;
}

/* ---------------------------------------------------------
   Scrollbar polish (optional, harmless if unsupported)
   --------------------------------------------------------- */
::-webkit-scrollbar{ width: 10px; height: 10px; }
::-webkit-scrollbar-thumb{ background: var(--otiv-gray-dark); border-radius: 999px; }
::-webkit-scrollbar-track{ background: transparent; }

/* ---------------------------------------------------------
   Two-column settings layout (Profil, Paramètres)
   --------------------------------------------------------- */
.otiv-settings{
  display: grid;
  grid-template-columns: 240px 1fr;
  gap: 20px;
  align-items: start;
}

.otiv-settings-nav{
  background: var(--otiv-white);
  border: 1px solid var(--otiv-border);
  border-radius: var(--otiv-radius-lg);
  box-shadow: var(--otiv-shadow-card);
  padding: 10px;
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.otiv-settings-nav__link{
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px 12px;
  border-radius: 8px;
  font-size: 13.5px;
  font-weight: 600;
  color: var(--otiv-text-soft);
}
.otiv-settings-nav__link:hover{ background: var(--otiv-gray); color: var(--otiv-navy); }
.otiv-settings-nav__link.is-active{ background: var(--otiv-gray); color: var(--otiv-green-dark); }
.otiv-settings-nav__link i{ width: 16px; text-align: center; color: var(--otiv-text-faint); }
.otiv-settings-nav__link.is-active i{ color: var(--otiv-green-dark); }

.otiv-card{
  background: var(--otiv-white);
  border: 1px solid var(--otiv-border);
  border-radius: var(--otiv-radius-lg);
  box-shadow: var(--otiv-shadow-card);
  padding: 26px 28px;
  margin-bottom: 18px;
}

.otiv-card__title{
  font-size: 15px;
  font-weight: 700;
  color: var(--otiv-navy);
  margin: 0 0 3px;
}
.otiv-card__subtitle{
  font-size: 12.5px;
  color: var(--otiv-text-soft);
  margin: 0 0 20px;
}

/* Form fields */
.otiv-field-row{
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
  margin-bottom: 16px;
}
.otiv-field{ margin-bottom: 16px; }
.otiv-field:last-child{ margin-bottom: 0; }
.otiv-field label{
  display: block;
  font-size: 12.5px;
  font-weight: 700;
  color: var(--otiv-text-soft);
  margin-bottom: 6px;
}
.otiv-field input[type="text"],
.otiv-field input[type="email"],
.otiv-field input[type="tel"],
.otiv-field input[type="password"],
.otiv-field select,
.otiv-field textarea{
  width: 100%;
  border: 1px solid var(--otiv-border);
  background: var(--otiv-white);
  border-radius: var(--otiv-radius-sm);
  padding: 10px 12px;
  font-size: 13.5px;
  color: var(--otiv-text);
  font-family: var(--otiv-font);
  outline: none;
  transition: border-color .12s ease;
}
.otiv-field input:focus,
.otiv-field select:focus,
.otiv-field textarea:focus{ border-color: var(--otiv-green); }
.otiv-field textarea{ resize: vertical; min-height: 80px; }
.otiv-field-hint{ font-size: 11.5px; color: var(--otiv-text-faint); margin-top: 5px; }

.otiv-card__footer{
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  margin-top: 20px;
  padding-top: 18px;
  border-top: 1px solid var(--otiv-border);
}

/* Toggle switch (Paramètres) */
.otiv-setting-row{
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  padding: 14px 0;
  border-bottom: 1px solid var(--otiv-border);
}
.otiv-setting-row:last-child{ border-bottom: none; padding-bottom: 0; }
.otiv-setting-row:first-child{ padding-top: 0; }
.otiv-setting-row__label{ font-size: 13.5px; font-weight: 600; color: var(--otiv-text); }
.otiv-setting-row__desc{ font-size: 12px; color: var(--otiv-text-soft); margin-top: 2px; }

.otiv-toggle{
  position: relative;
  display: inline-block;
  width: 42px;
  height: 24px;
  flex-shrink: 0;
}
.otiv-toggle input{ opacity: 0; width: 0; height: 0; }
.otiv-toggle__track{
  position: absolute;
  inset: 0;
  background: var(--otiv-gray-dark);
  border-radius: 999px;
  cursor: pointer;
  transition: background .15s ease;
}
.otiv-toggle__track::before{
  content: "";
  position: absolute;
  width: 18px; height: 18px;
  left: 3px; top: 3px;
  background: var(--otiv-white);
  border-radius: 50%;
  transition: transform .15s ease;
  box-shadow: 0 1px 3px rgba(0,0,0,.2);
}
.otiv-toggle input:checked + .otiv-toggle__track{ background: var(--otiv-green); }
.otiv-toggle input:checked + .otiv-toggle__track::before{ transform: translateX(18px); }

/* Storage usage bar (Paramètres) */
.otiv-usage-bar{
  height: 9px;
  border-radius: 999px;
  background: var(--otiv-gray);
  overflow: hidden;
  margin: 10px 0 8px;
}
.otiv-usage-bar__fill{
  height: 100%;
  background: linear-gradient(90deg, var(--otiv-green), var(--otiv-green-dark));
  border-radius: 999px;
}
.otiv-usage-meta{
  display: flex;
  justify-content: space-between;
  font-size: 12px;
  color: var(--otiv-text-soft);
}

/* Large avatar (Profil) */
.otiv-avatar-lg{
  width: 84px;
  height: 84px;
  border-radius: 50%;
  background: var(--otiv-green);
  color: var(--otiv-white);
  font-size: 30px;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.otiv-profile-head{
  display: flex;
  align-items: center;
  gap: 20px;
}
.otiv-profile-head__name{ font-size: 17px; font-weight: 700; color: var(--otiv-navy); margin: 0 0 3px; }
.otiv-profile-head__role{ font-size: 12.5px; color: var(--otiv-text-soft); margin: 0 0 10px; }

.otiv-badge{
  display: inline-flex;
  align-items: center;
  gap: 5px;
  padding: 3px 10px;
  border-radius: 999px;
  font-size: 11px;
  font-weight: 700;
  background: rgba(20,178,82,.1);
  color: var(--otiv-green-dark);
}

/* ---------------------------------------------------------
   Modal — historique des versions / création de document
   --------------------------------------------------------- */
.otiv-modal-overlay{
  position: fixed;
  inset: 0;
  background: rgba(24,31,72,.45);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 100;
}
.otiv-modal-overlay[hidden]{ display: none; }

.otiv-modal{
  background: var(--otiv-white);
  border-radius: var(--otiv-radius-lg);
  box-shadow: var(--otiv-shadow-pop);
  width: 420px;
  max-width: 92vw;
  max-height: 80vh;
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

.otiv-modal__header{
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px 20px;
  border-bottom: 1px solid var(--otiv-border);
}
.otiv-modal__title{
  font-size: 14.5px;
  font-weight: 700;
  color: var(--otiv-navy);
  margin: 0;
  display: flex;
  align-items: center;
  gap: 8px;
}
.otiv-modal__close{
  background: none;
  border: none;
  color: var(--otiv-text-faint);
  cursor: pointer;
  font-size: 14px;
  padding: 4px;
}
.otiv-modal__close:hover{ color: var(--otiv-red); }

.otiv-modal__body{
  padding: 8px 12px;
  overflow-y: auto;
}

.otiv-modal__intro{
  font-size: 13px;
  color: var(--otiv-text-soft);
  margin: 0 0 16px;
}
.otiv-modal__intro strong{ color: var(--otiv-navy); }

.otiv-history-list{
  list-style: none;
  margin: 0;
  padding: 0;
}
.otiv-history-item{
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  padding: 12px 8px;
  border-bottom: 1px solid var(--otiv-border);
}
.otiv-history-item:last-child{ border-bottom: none; }

.otiv-history-item__info{ display: flex; flex-direction: column; gap: 2px; }
.otiv-history-item__date{ font-size: 13px; font-weight: 600; color: var(--otiv-text); }
.otiv-history-item__meta{ font-size: 11.5px; color: var(--otiv-text-soft); }

.otiv-history-item__actions{ display: flex; gap: 6px; }
.otiv-history-item__actions .otiv-icon-action{ font-size: 12px; }

.otiv-history-item.is-current .otiv-history-item__date::after{
  content: "Actuelle";
  margin-left: 8px;
  font-size: 10px;
  font-weight: 700;
  color: var(--otiv-green-dark);
  background: rgba(20,178,82,.1);
  padding: 2px 8px;
  border-radius: 999px;
}

/* Modal — variante compacte + footer + ghost button */
.otiv-modal--sm{ width: 380px; }

.otiv-modal__footer{
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  padding: 14px 20px;
  border-top: 1px solid var(--otiv-border);
}

.otiv-btn--ghost{
  background: var(--otiv-gray);
  color: var(--otiv-text-soft);
  border: none;
  border-radius: var(--otiv-radius-sm);
  padding: 9px 16px;
  font-size: 13px;
  font-weight: 600;
  cursor: pointer;
  transition: background .12s ease;
}
.otiv-btn--ghost:hover{ background: var(--otiv-gray-dark); }

/* Couleurs d'icône selon le type de document */
#createDocIcon.is-word{  color: #2B579A; }
#createDocIcon.is-excel{ color: #217346; }
#createDocIcon.is-ppt{   color: #D24726; }
#createDocIcon.is-folder{ color: var(--otiv-navy); }

/* ---------------------------------------------------------
   Actions rapides
   --------------------------------------------------------- */
.otiv-quick-actions{ margin: 24px 0; }

.otiv-quick-actions__title{
  font-size: 13.5px;
  font-weight: 700;
  color: var(--otiv-navy);
  margin: 0 0 12px;
}

.otiv-quick-actions__grid{
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 14px;
}

.otiv-quick-action{
  display: flex;
  align-items: center;
  gap: 12px;
  background: var(--otiv-white);
  border: 1px solid var(--otiv-border);
  border-radius: var(--otiv-radius-lg);
  box-shadow: var(--otiv-shadow-card);
  padding: 16px;
  cursor: pointer;
  text-align: left;
  transition: transform .12s ease, box-shadow .12s ease, border-color .12s ease;
}
.otiv-quick-action:hover{
  transform: translateY(-2px);
  border-color: var(--otiv-green);
  box-shadow: var(--otiv-shadow-pop);
}

.otiv-quick-action__icon{
  width: 38px;
  height: 38px;
  border-radius: var(--otiv-radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 17px;
  color: var(--otiv-white);
  flex-shrink: 0;
}
.otiv-quick-action__icon.is-word{   background: #2B579A; }
.otiv-quick-action__icon.is-excel{  background: #217346; }
.otiv-quick-action__icon.is-ppt{    background: #D24726; }
.otiv-quick-action__icon.is-folder{ background: var(--otiv-navy); }

.otiv-quick-action__label{
  font-size: 13px;
  font-weight: 600;
  color: var(--otiv-text);
}

/* ---------------------------------------------------------
   Badges de visibilité (Département / Privé) — Documents
   --------------------------------------------------------- */
.otiv-visibility-tag{
  display: inline-flex;
  align-items: center;
  gap: 4px;
  margin-left: 10px;
  padding: 2px 9px;
  border-radius: 999px;
  font-size: 10.5px;
  font-weight: 700;
  vertical-align: middle;
}
.otiv-visibility-tag.is-dept{
  background: rgba(20,178,82,.1);
  color: var(--otiv-green-dark);
}
.otiv-visibility-tag.is-private{
  background: rgba(228,72,58,.1);
  color: var(--otiv-red);
}

/* Choix de visibilité dans le modal de création */
.otiv-visibility-choice{
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.otiv-radio-card{ cursor: pointer; }
.otiv-radio-card input{ position: absolute; opacity: 0; }

.otiv-radio-card__body{
  display: flex;
  align-items: center;
  gap: 12px;
  border: 1.5px solid var(--otiv-border);
  border-radius: var(--otiv-radius-md);
  padding: 10px 12px;
  transition: border-color .12s ease, background .12s ease;
}
.otiv-radio-card__body i{
  width: 30px;
  height: 30px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--otiv-gray);
  color: var(--otiv-text-soft);
  font-size: 13px;
  flex-shrink: 0;
}
.otiv-radio-card__body strong{
  display: block;
  font-size: 12.5px;
  color: var(--otiv-text);
}
.otiv-radio-card__body small{
  display: block;
  font-size: 11px;
  color: var(--otiv-text-soft);
}

.otiv-radio-card input:checked + .otiv-radio-card__body{
  border-color: var(--otiv-green);
  background: rgba(20,178,82,.05);
}
.otiv-radio-card input:checked + .otiv-radio-card__body i{
  background: var(--otiv-green);
  color: var(--otiv-white);
}

/* ---------------------------------------------------------
   Departement — signe distinctif + badge
   --------------------------------------------------------- */
.otiv-dept-card.is-mine{
  border: 1.5px solid var(--otiv-green);
  box-shadow: 0 0 0 3px rgba(20,178,82,.1), var(--otiv-shadow-card);
}
.otiv-dept-card.is-mine .otiv-dept-card__icon{
  background: var(--otiv-green);
  color: var(--otiv-white);
}

.otiv-dept-badge{
  display: inline-flex;
  align-items: center;
  gap: 4px;
  margin-left: 8px;
  padding: 2px 9px;
  border-radius: 999px;
  font-size: 10px;
  font-weight: 700;
  background: rgba(20,178,82,.12);
  color: var(--otiv-green-dark);
  vertical-align: middle;
}

.otiv-dept-card:not(.is-mine){ cursor: pointer; }

/* ---------------------------------------------------------
   Responsive — paliers progressifs
   --------------------------------------------------------- */

/* Écrans moyens : on resserre avant que ça casse */
@media (max-width: 1200px){
  .otiv-nav{ gap: 14px; padding: 10px 18px; }
  .otiv-nav__search{ width: 140px; }
}

/* Tablette : on cache la recherche texte, on garde l'icône */
@media (max-width: 1024px){
  .otiv-nav__search input{ display: none; }
  .otiv-nav__search{ width: auto; padding: 8px; }
  .otiv-nav__user-name{ display: none; }
  .otiv-nav__user i{ display: none; }
  .otiv-quick-actions__grid{ grid-template-columns: repeat(2, 1fr); }
  .otiv-settings{ grid-template-columns: 1fr; }
  .otiv-field-row{ grid-template-columns: 1fr; }
  .otiv-settings-nav{ flex-direction: row; overflow-x: auto; }
}

/* Mobile large : les liens passent en scroll horizontal, tout le reste se tasse */
@media (max-width: 768px){
  .otiv-nav{ gap: 10px; padding: 8px 14px; }
  .otiv-nav__brand span{ display: none; }  /* garde juste "OTIV" */
  .otiv-page{ padding: 16px 12px 40px; }

  .otiv-table thead{ display: none; }
  .otiv-table, .otiv-table tbody, .otiv-table tr, .otiv-table td{ display: block; width: 100%; }
  .otiv-table tr{ padding: 12px 16px; }
  .otiv-table td{ padding: 4px 0; border: none; }
  .otiv-table td.otiv-table__col-actions{ text-align: left; margin-top: 6px; }
}
/* accueil */
  .search-status-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #e8f5ed;
    color: #173226;
    padding: 10px 16px;
    border-radius: 8px;
    margin-bottom: 15px;
    font-size: 14px;
    font-weight: 600;
  }
  .btn-reset-search {
    background: none;
    border: none;
    color: #00843d;
    cursor: pointer;
    font-weight: 700;
    text-decoration: underline;
  }
/* de la page document */
  .search-alert-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #e8f5ed;
    color: #173226;
    padding: 10px 18px;
    border-radius: 8px;
    margin-bottom: 16px;
    font-size: 14px;
    font-weight: 600;
  }
  .btn-reset-search {
    background: none;
    border: none;
    color: #00843d;
    cursor: pointer;
    font-weight: 700;
    text-decoration: underline;
  }

/* Mobile étroit : on retire aussi le texte "OTIV" et resserre au max */
@media (max-width: 480px){
  .otiv-nav__brand-mark img{ height: 30px; }
  .otiv-nav__link{ padding: 8px 12px; font-size: 13px; }
  .otiv-nav__icon-btn{ width: 32px; height: 32px; }
}