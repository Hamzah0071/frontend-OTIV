<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administration — Utilisateurs — OTIV DIANA</title>
<link rel="shortcut icon" href="../icon/sans-fond.png" type="image/x-icon">
<link rel="stylesheet" href="../icon/fontAwesome/all.min.css">
<link rel="stylesheet" href="../css/common.css">
<link rel="stylesheet" href="../css/messages.css">

<link rel="stylesheet" href="../css/responsive.css">
<script src="../js/mobile-menu.js" defer></script>

</head>
<body class="otiv-body">


  <!-- header -->
   <?php require __DIR__ . '/../includes/header.php'; ?>


<main class="otiv-page otiv-page--messages">

  <div class="otiv-section-head">
    <div>
      <h1>Messages</h1>
      <p>Communiquez avec votre département ou avec une personne, dans n'importe quel service.</p>
    </div>
  </div>

  <div class="otiv-messenger">

    <!-- ============ Colonne gauche : conversations ============ -->
    <aside class="otiv-msg-sidebar">
      <div class="otiv-msg-search">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" id="convSearch" placeholder="Rechercher une conversation...">
      </div>

      <div class="otiv-msg-tabs">
        <button class="otiv-msg-tab is-active" data-scope="departments">
          <i class="fa-solid fa-building"></i> Départements
        </button>
        <button class="otiv-msg-tab" data-scope="people">
          <i class="fa-solid fa-user"></i> Contacts
        </button>
      </div>

      <!-- Groupes de département -->
      <ul class="otiv-conv-list" id="listDepartments">
        <li class="otiv-conv-item is-active" data-conv-id="dept-credit" data-name="Crédit" data-type="dept">
          <span class="otiv-conv-avatar is-group"><i class="fa-solid fa-building"></i></span>
          <div class="otiv-conv-info">
            <div class="otiv-conv-name">Crédit <span class="otiv-conv-tag">Mon département</span></div>
            <div class="otiv-conv-preview">Rakoto : le rapport est prêt pour...</div>
          </div>
          <div class="otiv-conv-meta">
            <span class="otiv-conv-time">10:42</span>
          </div>
        </li>

        <li class="otiv-conv-item" data-conv-id="dept-compta" data-name="Comptabilité" data-type="dept">
          <span class="otiv-conv-avatar is-group"><i class="fa-solid fa-building"></i></span>
          <div class="otiv-conv-info">
            <div class="otiv-conv-name">Comptabilité</div>
            <div class="otiv-conv-preview">Vous : merci, c'est noté</div>
          </div>
          <div class="otiv-conv-meta">
            <span class="otiv-conv-time">Hier</span>
          </div>
        </li>

        <li class="otiv-conv-item" data-conv-id="dept-rh" data-name="Ressources Humaines" data-type="dept">
          <span class="otiv-conv-avatar is-group"><i class="fa-solid fa-building"></i></span>
          <div class="otiv-conv-info">
            <div class="otiv-conv-name">Ressources Humaines</div>
            <div class="otiv-conv-preview">Nouvelle note de service disponible</div>
          </div>
          <div class="otiv-conv-meta">
            <span class="otiv-conv-time">Lun</span>
            <span class="otiv-conv-badge">2</span>
          </div>
        </li>

        <li class="otiv-conv-item" data-conv-id="dept-info" data-name="Informatique" data-type="dept">
          <span class="otiv-conv-avatar is-group"><i class="fa-solid fa-building"></i></span>
          <div class="otiv-conv-info">
            <div class="otiv-conv-name">Informatique</div>
            <div class="otiv-conv-preview">Maintenance prévue ce soir 22h</div>
          </div>
          <div class="otiv-conv-meta">
            <span class="otiv-conv-time">Ven</span>
          </div>
        </li>

        <li class="otiv-conv-item" data-conv-id="dept-dg" data-name="Direction Générale" data-type="dept">
          <span class="otiv-conv-avatar is-group"><i class="fa-solid fa-building"></i></span>
          <div class="otiv-conv-info">
            <div class="otiv-conv-name">Direction Générale</div>
            <div class="otiv-conv-preview">Réunion reportée à jeudi</div>
          </div>
          <div class="otiv-conv-meta">
            <span class="otiv-conv-time">12 sept.</span>
          </div>
        </li>
      </ul>

      <!-- Contacts individuels -->
      <ul class="otiv-conv-list" id="listPeople" hidden>
        <li class="otiv-conv-item" data-conv-id="user-jack" data-name="Jack" data-type="person" data-dept="Crédit">
          <span class="otiv-conv-avatar">J</span>
          <div class="otiv-conv-info">
            <div class="otiv-conv-name">Jack <span class="otiv-conv-dept">Crédit</span></div>
            <div class="otiv-conv-preview">Ok je regarde ça ce matin</div>
          </div>
          <div class="otiv-conv-meta">
            <span class="otiv-conv-time">09:15</span>
          </div>
        </li>

        <li class="otiv-conv-item" data-conv-id="user-rakoto" data-name="Rakoto" data-type="person" data-dept="Comptabilité">
          <span class="otiv-conv-avatar">R</span>
          <div class="otiv-conv-info">
            <div class="otiv-conv-name">Rakoto <span class="otiv-conv-dept">Comptabilité</span></div>
            <div class="otiv-conv-preview">Le budget T3 est validé</div>
          </div>
          <div class="otiv-conv-meta">
            <span class="otiv-conv-time">Hier</span>
          </div>
        </li>

        <li class="otiv-conv-item" data-conv-id="user-sarah" data-name="Sarah" data-type="person" data-dept="Ressources Humaines">
          <span class="otiv-conv-avatar">S</span>
          <div class="otiv-conv-info">
            <div class="otiv-conv-name">Sarah <span class="otiv-conv-dept">RH</span></div>
            <div class="otiv-conv-preview">Merci pour le document</div>
          </div>
          <div class="otiv-conv-meta">
            <span class="otiv-conv-time">Mar</span>
          </div>
        </li>
      </ul>
    </aside>

    <!-- ============ Colonne droite : fil de discussion ============ -->
    <section class="otiv-msg-thread">
      <div class="otiv-msg-thread__header">
        <div class="otiv-msg-thread__who">
          <span class="otiv-conv-avatar is-group" id="threadAvatar"><i class="fa-solid fa-building"></i></span>
          <div>
            <div class="otiv-msg-thread__name" id="threadName">Crédit</div>
            <div class="otiv-msg-thread__sub" id="threadSub">Groupe de département · 6 membres</div>
          </div>
        </div>
        <div class="otiv-msg-thread__actions">
          <button class="otiv-icon-action" aria-label="Partager un document"><i class="fa-solid fa-paperclip"></i></button>
          <button class="otiv-icon-action" aria-label="Informations"><i class="fa-solid fa-circle-info"></i></button>
        </div>
      </div>

      <div class="otiv-msg-thread__body" id="threadBody">
        <!-- rempli en JS -->
      </div>

      <div class="otiv-msg-composer">
        <button class="otiv-icon-action" aria-label="Joindre un document">
          <i class="fa-solid fa-paperclip"></i>
        </button>
        <input type="text" id="messageInput" placeholder="Écrire un message...">
        <button class="otiv-btn otiv-btn--solid" id="sendBtn">
          <i class="fa-solid fa-paper-plane"></i>
        </button>
      </div>
    </section>
  </div>

</main>
<script src="../js/common.js"></script>
<script src="../js/messages.js"></script>
</body>
</html>