<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Paramètres — OTIV DIANA</title>
<link rel="stylesheet" href="../icon/fontAwesome/all.min.css">
<link rel="stylesheet" href="../css/common.css">
<link rel="stylesheet" href="../css/admin.css">
</head>
<body class="otiv-body">


  <!-- header -->
   <?php require __DIR__ . '/../includes/header.php'; ?>


<main class="otiv-page">

  <div class="otiv-section-head">
    <div>
      <h1>Paramètres</h1>
      <p>Personnalisez le fonctionnement de votre espace documentaire.</p>
    </div>
  </div>

  <div class="otiv-settings">
    
    <!-- Navigation latérale -->
      <?php require __DIR__ . '/../includes/header-nav.php'; ?>

    <!-- Contenu -->
    <div>

      <div class="otiv-card" id="general">
        <p class="otiv-card__title">Général</p>
        <p class="otiv-card__subtitle">Langue et affichage de l'interface.</p>

        <div class="otiv-field-row">
          <div class="otiv-field">
            <label for="langue">Langue</label>
            <select id="langue">
              <option>Français</option>
              <option>English</option>
              <option>Malagasy</option>
            </select>
          </div>
          <div class="otiv-field">
            <label for="fuseau">Fuseau horaire</label>
            <select id="fuseau">
              <option>(GMT+3) Antananarivo</option>
              <option>(GMT+0) UTC</option>
            </select>
          </div>
        </div>

        <div class="otiv-field">
          <label for="vue">Affichage par défaut des dossiers</label>
          <select id="vue">
            <option>Liste</option>
            <option>Grille</option>
          </select>
        </div>

        <div class="otiv-card__footer">
          <button class="otiv-btn otiv-btn--primary">
            <i class="fa-regular fa-floppy-disk"></i> Enregistrer
          </button>
        </div>
      </div>

      <div class="otiv-card" id="notifications">
        <p class="otiv-card__title">Notifications</p>
        <p class="otiv-card__subtitle">Choisissez les événements pour lesquels vous souhaitez être alerté.</p>

        <div class="otiv-setting-row">
          <div>
            <div class="otiv-setting-row__label">Nouveau document partagé avec moi</div>
            <div class="otiv-setting-row__desc">Recevoir une notification quand un fichier m'est partagé.</div>
          </div>
          <label class="otiv-toggle">
            <input type="checkbox" checked>
            <span class="otiv-toggle__track"></span>
          </label>
        </div>

        <div class="otiv-setting-row">
          <div>
            <div class="otiv-setting-row__label">Modification d'un document de mon département</div>
            <div class="otiv-setting-row__desc">Être notifié des changements dans les dossiers de mon département.</div>
          </div>
          <label class="otiv-toggle">
            <input type="checkbox" checked>
            <span class="otiv-toggle__track"></span>
          </label>
        </div>

        <div class="otiv-setting-row">
          <div>
            <div class="otiv-setting-row__label">Rappels de la corbeille</div>
            <div class="otiv-setting-row__desc">Alerte avant la suppression définitive d'un élément.</div>
          </div>
          <label class="otiv-toggle">
            <input type="checkbox">
            <span class="otiv-toggle__track"></span>
          </label>
        </div>

        <div class="otiv-setting-row">
          <div>
            <div class="otiv-setting-row__label">Notifications par e-mail</div>
            <div class="otiv-setting-row__desc">Recevoir un résumé quotidien par e-mail en plus des notifications internes.</div>
          </div>
          <label class="otiv-toggle">
            <input type="checkbox">
            <span class="otiv-toggle__track"></span>
          </label>
        </div>
      </div>

      <div class="otiv-card" id="stockage">
        <p class="otiv-card__title">Stockage</p>
        <p class="otiv-card__subtitle">Espace utilisé sur votre compte Nextcloud.</p>

        <div class="otiv-usage-bar">
          <div class="otiv-usage-bar__fill" style="width: 38%;"></div>
        </div>
        <div class="otiv-usage-meta">
          <span>3.8 Go utilisés</span>
          <span>10 Go au total</span>
        </div>

        <div class="otiv-card__footer">
          <button class="otiv-btn otiv-btn--ghost">
            <i class="fa-solid fa-trash"></i> Vider la corbeille pour libérer de l'espace
          </button>
        </div>
      </div>

    </div>
  </div>

</main>
</body>
</html>
