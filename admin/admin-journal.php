<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administration — Journal d'activité — OTIV DIANA</title>
<link rel="shortcut icon" href="../icon/sans-fond.png" type="image/x-icon">
<link rel="stylesheet" href="../icon/fontAwesome/all.min.css">
<link rel="stylesheet" href="../css/common.css">
<link rel="stylesheet" href="../css/admin.css">
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
      <h1>Journal d'activité</h1>
      <p>Historique complet des actions effectuées sur la plateforme.</p>
    </div>
    <button class="otiv-btn otiv-btn--ghost">
      <i class="fa-solid fa-download"></i> Exporter (.csv)
    </button>
  </div>

  <div class="otiv-settings">
<!-- lien vers le includes ou tout les outis detachable -->
<?php require __DIR__ . '/../includes/header-admin.php'; ?>
    <!-- Contenu -->
    <div>

      <div class="otiv-filter-bar">
        <div class="otiv-filter-bar__search">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" placeholder="Rechercher un utilisateur ou un fichier...">
        </div>
        <select aria-label="Filtrer par type d'action">
          <option>Tous les types d'action</option>
          <option>Connexion</option>
          <option>Création</option>
          <option>Modification</option>
          <option>Suppression</option>
        </select>
        <select aria-label="Filtrer par période">
          <option>7 derniers jours</option>
          <option>30 derniers jours</option>
          <option>Cette année</option>
        </select>
      </div>

      <div class="otiv-panel">
        <div style="padding: 6px 22px 4px;">
          <div class="otiv-log-list">

            <div class="otiv-log-row">
              <span class="otiv-log-row__icon is-create"><i class="fa-solid fa-plus"></i></span>
              <div>
                <div class="otiv-log-row__text"><b>Rindra</b> a créé le document <b>budget-2027.docx</b> dans <b>Comptabilité</b></div>
                <div class="otiv-log-row__time">Aujourd'hui à 14:32 · IP 41.188.20.4</div>
              </div>
            </div>

            <div class="otiv-log-row">
              <span class="otiv-log-row__icon is-login"><i class="fa-solid fa-right-to-bracket"></i></span>
              <div>
                <div class="otiv-log-row__text"><b>Fenosoa</b> s'est connecté</div>
                <div class="otiv-log-row__time">Aujourd'hui à 13:54 · IP 41.188.20.11</div>
              </div>
            </div>

            <div class="otiv-log-row">
              <span class="otiv-log-row__icon is-delete"><i class="fa-solid fa-trash"></i></span>
              <div>
                <div class="otiv-log-row__text"><b>Hamzah</b> a supprimé le dossier <b>archives-2023</b></div>
                <div class="otiv-log-row__time">Aujourd'hui à 09:14 · IP 41.188.20.2</div>
              </div>
            </div>

            <div class="otiv-log-row">
              <span class="otiv-log-row__icon is-edit"><i class="fa-solid fa-pen"></i></span>
              <div>
                <div class="otiv-log-row__text"><b>Admin</b> a modifié les permissions du département <b>Crédit</b></div>
                <div class="otiv-log-row__time">Hier à 17:02 · IP 41.188.20.2</div>
              </div>
            </div>

            <div class="otiv-log-row">
              <span class="otiv-log-row__icon is-create"><i class="fa-solid fa-user-plus"></i></span>
              <div>
                <div class="otiv-log-row__text"><b>Admin</b> a invité <b>Tovo</b> (Ressources Humaines)</div>
                <div class="otiv-log-row__time">Hier à 11:20 · IP 41.188.20.2</div>
              </div>
            </div>

            <div class="otiv-log-row">
              <span class="otiv-log-row__icon is-delete"><i class="fa-solid fa-triangle-exclamation"></i></span>
              <div>
                <div class="otiv-log-row__text">Échec de connexion pour <b>lova@otivdiana.mg</b> (mot de passe incorrect)</div>
                <div class="otiv-log-row__time">Hier à 08:47 · IP 154.126.7.90</div>
              </div>
            </div>

            <div class="otiv-log-row">
              <span class="otiv-log-row__icon is-edit"><i class="fa-solid fa-share-nodes"></i></span>
              <div>
                <div class="otiv-log-row__text"><b>Rindra</b> a partagé <b>teste.md</b> avec <b>Jack</b></div>
                <div class="otiv-log-row__time">Il y a 2 jours · IP 41.188.20.11</div>
              </div>
            </div>

          </div>
        </div>

        <div class="otiv-pagination">
          <span>Affichage de 1 à 7 sur 342 événements</span>
          <div class="otiv-pagination__pages">
            <button class="is-active">1</button>
            <button>2</button>
            <button>3</button>
            <button>…</button>
            <button>49</button>
          </div>
        </div>
      </div>

    </div>
  </div>

</main>
</body>
</html>
