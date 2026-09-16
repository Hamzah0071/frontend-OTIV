<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Departement — OTIV DIANA</title>
<link rel="shortcut icon" href="../icon/sans-fond.png" type="image/x-icon">
<link rel="stylesheet" href="../icon/fontAwesome/all.min.css">
<link rel="stylesheet" href="../css/common.css">
<link rel="stylesheet" href="../css/departement.css">
</head>

<body class="otiv-body">


  <!-- header -->
   <?php require __DIR__ . '/../includes/header.php'; ?>

 

<main class="otiv-page">

  <div class="otiv-section-head">
    <div>
      <h1>Departement</h1>
      <p>Espaces documentaires partagés par département.</p>
    </div>
  </div>

    <div class="otiv-dept-grid">
    <a href="documents.php?dept=credit" class="otiv-dept-card is-mine" data-dept="Crédit" data-mine="true">
      <span class="otiv-dept-card__icon"><i class="otiv-icon fa-solid fa-building"></i></span>
      <div>
        <div class="otiv-dept-card__name">
          Crédit
          <span class="otiv-dept-badge"><i class="fa-solid fa-check"></i> Mon département</span>
        </div>
        <div class="otiv-dept-card__meta">18 documents</div>
      </div>
    </a>

    <a href="#" class="otiv-dept-card" data-dept="Comptabilité" data-mine="false">
      <span class="otiv-dept-card__icon"><i class="otiv-icon fa-solid fa-building"></i></span>
      <div>
        <div class="otiv-dept-card__name">Comptabilité</div>
        <div class="otiv-dept-card__meta">32 documents</div>
      </div>
    </a>

    <a href="#" class="otiv-dept-card" data-dept="Ressources Humaines" data-mine="false">
      <span class="otiv-dept-card__icon"><i class="otiv-icon fa-solid fa-building"></i></span>
      <div>
        <div class="otiv-dept-card__name">Ressources Humaines</div>
        <div class="otiv-dept-card__meta">9 documents</div>
      </div>
    </a>

    <a href="#" class="otiv-dept-card" data-dept="Informatique" data-mine="false">
      <span class="otiv-dept-card__icon"><i class="otiv-icon fa-solid fa-building"></i></span>
      <div>
        <div class="otiv-dept-card__name">Informatique</div>
        <div class="otiv-dept-card__meta">14 documents</div>
      </div>
    </a>

    <a href="#" class="otiv-dept-card" data-dept="Direction Générale" data-mine="false">
      <span class="otiv-dept-card__icon"><i class="otiv-icon fa-solid fa-building"></i></span>
      <div>
        <div class="otiv-dept-card__name">Direction Générale</div>
        <div class="otiv-dept-card__meta">6 documents</div>
      </div>
    </a>
  </div>

  <!--  -->

  <!-- Modal demande de partage -->
<div class="otiv-modal-overlay" id="requestModal" hidden>
  <div class="otiv-modal otiv-modal--sm">
    <div class="otiv-modal__header">
      <h3 class="otiv-modal__title">
        <i class="otiv-icon fa-solid fa-paper-plane"></i>
        Demander un partage
      </h3>
      <button class="otiv-modal__close" data-action="close-request" aria-label="Fermer">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <div class="otiv-modal__body">
      <p class="otiv-modal__intro">
        Département : <strong id="requestDeptName">—</strong>
      </p>

      <div class="otiv-field">
        <label for="requestDocName">Document souhaité :</label>
        <input type="text" id="requestDocName" placeholder="Ex : Rapport financier T3 2026">
      </div>

      <div class="otiv-field">
        <label for="requestMessage">Message (optionnel) :</label>
        <textarea id="requestMessage" placeholder="Précisez le contexte de votre demande..."></textarea>
      </div>
    </div>

    <div class="otiv-modal__footer">
      <button class="otiv-btn otiv-btn--ghost" data-action="close-request">Annuler</button>
      <button class="otiv-btn otiv-btn--solid" id="requestConfirm">
        <i class="fa-solid fa-paper-plane"></i> Envoyer la demande
      </button>
    </div>
  </div>
</div>


<script src="../js/common.js"></script>
<script src="../js/departement.js"></script>
</main>
</body>
</html>
