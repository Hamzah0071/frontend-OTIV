<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administration — Paramètres système — OTIV DIANA</title>
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
      <h1>Paramètres système</h1>
      <p>Réglages globaux qui s'appliquent à tous les utilisateurs de OTIV DIANA.</p>
    </div>
  </div>

  <div class="otiv-settings">

<!-- lien vers le includes ou tout les outis detachable -->
<?php require __DIR__ . '/../includes/header-admin.php'; ?>

    <!-- Contenu -->
    <div>

      <div class="otiv-card">
        <p class="otiv-card__title">Stockage</p>
        <p class="otiv-card__subtitle">Quotas et limites d'envoi appliqués à toute la plateforme.</p>

        <div class="otiv-field-row">
          <div class="otiv-field">
            <label for="quota-defaut">Quota par défaut par utilisateur</label>
            <input type="text" id="quota-defaut" value="4 Go">
          </div>
          <div class="otiv-field">
            <label for="taille-max">Taille maximale par fichier</label>
            <input type="text" id="taille-max" value="100 Mo">
          </div>
        </div>

        <div class="otiv-usage-bar">
          <div class="otiv-usage-bar__fill" style="width: 6%;"></div>
        </div>
        <div class="otiv-usage-meta">
          <span>128 Go utilisés</span>
          <span>4 To au total</span>
        </div>
      </div>

      <div class="otiv-card">
        <p class="otiv-card__title">Sécurité et accès</p>
        <p class="otiv-card__subtitle">Politique de mot de passe et règles de connexion.</p>

        <div class="otiv-field-row">
          <div class="otiv-field">
            <label for="longueur-mdp">Longueur minimale du mot de passe</label>
            <input type="text" id="longueur-mdp" value="8 caractères">
          </div>
          <div class="otiv-field">
            <label for="expiration-session">Expiration de session</label>
            <select id="expiration-session">
              <option>30 minutes</option>
              <option selected>2 heures</option>
              <option>8 heures</option>
              <option>Jamais</option>
            </select>
          </div>
        </div>

        <div class="otiv-setting-row">
          <div>
            <div class="otiv-setting-row__label">Exiger une majuscule et un chiffre</div>
            <div class="otiv-setting-row__desc">Renforce la robustesse des mots de passe à la création du compte.</div>
          </div>
          <label class="otiv-toggle">
            <input type="checkbox" checked>
            <span class="otiv-toggle__track"></span>
          </label>
        </div>

        <div class="otiv-setting-row">
          <div>
            <div class="otiv-setting-row__label">Verrouiller le compte après 5 échecs de connexion</div>
            <div class="otiv-setting-row__desc">Protège contre les tentatives de connexion répétées.</div>
          </div>
          <label class="otiv-toggle">
            <input type="checkbox" checked>
            <span class="otiv-toggle__track"></span>
          </label>
        </div>

        <div class="otiv-setting-row">
          <div>
            <div class="otiv-setting-row__label">Double authentification obligatoire</div>
            <div class="otiv-setting-row__desc">Demande un code supplémentaire à chaque connexion.</div>
          </div>
          <label class="otiv-toggle">
            <input type="checkbox">
            <span class="otiv-toggle__track"></span>
          </label>
        </div>
      </div>

      <div class="otiv-card">
        <p class="otiv-card__title">Corbeille et conservation</p>
        <p class="otiv-card__subtitle">Durée de rétention des éléments supprimés.</p>

        <div class="otiv-field">
          <label for="retention">Suppression définitive après</label>
          <select id="retention">
            <option>15 jours</option>
            <option selected>30 jours</option>
            <option>60 jours</option>
            <option>90 jours</option>
          </select>
        </div>

        <div class="otiv-setting-row">
          <div>
            <div class="otiv-setting-row__label">Vidage automatique de la corbeille</div>
            <div class="otiv-setting-row__desc">Supprime automatiquement les éléments arrivés à expiration.</div>
          </div>
          <label class="otiv-toggle">
            <input type="checkbox" checked>
            <span class="otiv-toggle__track"></span>
          </label>
        </div>
      </div>

      <div class="otiv-card">
        <p class="otiv-card__title">Notifications globales</p>
        <p class="otiv-card__subtitle">Alertes envoyées automatiquement par le système à l'ensemble des utilisateurs.</p>

        <div class="otiv-setting-row">
          <div>
            <div class="otiv-setting-row__label">Alerte de maintenance planifiée</div>
            <div class="otiv-setting-row__desc">Prévenir tous les utilisateurs avant une coupure de service.</div>
          </div>
          <label class="otiv-toggle">
            <input type="checkbox" checked>
            <span class="otiv-toggle__track"></span>
          </label>
        </div>

        <div class="otiv-setting-row">
          <div>
            <div class="otiv-setting-row__label">Rapport hebdomadaire aux responsables de département</div>
            <div class="otiv-setting-row__desc">Résumé de l'activité du département envoyé chaque lundi.</div>
          </div>
          <label class="otiv-toggle">
            <input type="checkbox">
            <span class="otiv-toggle__track"></span>
          </label>
        </div>
      </div>

      <div class="otiv-card__footer" style="border-top:none; padding-top:0; margin-top:0;">
        <button class="otiv-btn otiv-btn--ghost">Annuler</button>
        <button class="otiv-btn otiv-btn--primary">
          <i class="fa-regular fa-floppy-disk"></i> Enregistrer les paramètres
        </button>
      </div>

    </div>
  </div>

</main>
</body>
</html>
