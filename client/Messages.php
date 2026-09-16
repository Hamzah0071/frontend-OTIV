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

<script>
document.addEventListener('DOMContentLoaded', () => {
  /* ---------------------------------------------------------
     Données factices — à remplacer par l'API (Nextcloud Talk OCS
     ou table de messages custom si Talk n'est pas retenu)
     --------------------------------------------------------- */
  const CONVERSATIONS = {
    'dept-credit': {
      name: 'Crédit', type: 'dept', sub: 'Groupe de département · 6 membres', icon: 'fa-building',
      messages: [
        { from: 'other', author: 'Rakoto', text: 'Le rapport est prêt pour la réunion de demain.', time: '10:38' },
        { from: 'me',    author: 'Hamzah', text: 'Parfait, je le relis cet après-midi.', time: '10:40' },
        { from: 'other', author: 'Rakoto', text: 'le rapport est prêt pour...', time: '10:42' },
      ]
    },
    'dept-compta': {
      name: 'Comptabilité', type: 'dept', sub: 'Groupe de département · 4 membres', icon: 'fa-building',
      messages: [
        { from: 'other', author: 'Lucie', text: 'On a besoin du justificatif de la semaine dernière.', time: 'Hier 16:02' },
        { from: 'me',    author: 'Hamzah', text: 'merci, c\'est noté', time: 'Hier 16:10' },
      ]
    },
    'dept-rh': {
      name: 'Ressources Humaines', type: 'dept', sub: 'Groupe de département · 3 membres', icon: 'fa-building',
      messages: [
        { from: 'other', author: 'Sarah', text: 'Nouvelle note de service disponible dans Documents > RH.', time: 'Lun 09:00' },
      ]
    },
    'dept-info': {
      name: 'Informatique', type: 'dept', sub: 'Groupe de département · 2 membres', icon: 'fa-building',
      messages: [
        { from: 'other', author: 'Toky', text: 'Maintenance prévue ce soir 22h, prévoyez une coupure de 15 min.', time: 'Ven 14:20' },
      ]
    },
    'dept-dg': {
      name: 'Direction Générale', type: 'dept', sub: 'Groupe de département · 2 membres', icon: 'fa-building',
      messages: [
        { from: 'other', author: 'Directeur', text: 'La réunion est reportée à jeudi 14h.', time: '12 sept.' },
      ]
    },
    'user-jack': {
      name: 'Jack', type: 'person', sub: 'Département Crédit', icon: null, avatarLetter: 'J',
      messages: [
        { from: 'me',    author: 'Hamzah', text: 'Tu peux jeter un œil au fichier partagé ?', time: '09:10' },
        { from: 'other', author: 'Jack',   text: 'Ok je regarde ça ce matin', time: '09:15' },
      ]
    },
    'user-rakoto': {
      name: 'Rakoto', type: 'person', sub: 'Département Comptabilité', icon: null, avatarLetter: 'R',
      messages: [
        { from: 'other', author: 'Rakoto', text: 'Le budget T3 est validé.', time: 'Hier' },
      ]
    },
    'user-sarah': {
      name: 'Sarah', type: 'person', sub: 'Département Ressources Humaines', icon: null, avatarLetter: 'S',
      messages: [
        { from: 'me',    author: 'Hamzah', text: 'Merci pour le document, tout est en ordre.', time: 'Mar' },
        { from: 'other', author: 'Sarah',  text: 'Merci pour le document', time: 'Mar' },
      ]
    },
  };

  let currentConvId = 'dept-credit';

  const threadName   = document.getElementById('threadName');
  const threadSub     = document.getElementById('threadSub');
  const threadAvatar  = document.getElementById('threadAvatar');
  const threadBody    = document.getElementById('threadBody');
  const messageInput  = document.getElementById('messageInput');
  const sendBtn        = document.getElementById('sendBtn');

  /* ---------------------------------------------------------
     Bascule Départements / Contacts
     --------------------------------------------------------- */
  const tabs = document.querySelectorAll('.otiv-msg-tab');
  const listDepartments = document.getElementById('listDepartments');
  const listPeople = document.getElementById('listPeople');

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.remove('is-active'));
      tab.classList.add('is-active');
      const scope = tab.dataset.scope;
      listDepartments.hidden = scope !== 'departments';
      listPeople.hidden = scope !== 'people';
    });
  });

  /* ---------------------------------------------------------
     Recherche de conversation (filtre les deux listes)
     --------------------------------------------------------- */
  document.getElementById('convSearch').addEventListener('input', (e) => {
    const q = e.target.value.trim().toLowerCase();
    document.querySelectorAll('.otiv-conv-item').forEach(item => {
      const name = item.dataset.name.toLowerCase();
      item.style.display = name.includes(q) ? '' : 'none';
    });
  });

  /* ---------------------------------------------------------
     Sélection d'une conversation
     --------------------------------------------------------- */
  document.querySelectorAll('.otiv-conv-item').forEach(item => {
    item.addEventListener('click', () => {
      document.querySelectorAll('.otiv-conv-item').forEach(i => i.classList.remove('is-active'));
      item.classList.add('is-active');
      openConversation(item.dataset.convId);
    });
  });

  function openConversation(convId) {
    currentConvId = convId;
    const conv = CONVERSATIONS[convId];
    if (!conv) return;

    threadName.textContent = conv.name;
    threadSub.textContent = conv.sub;

    if (conv.type === 'dept') {
      threadAvatar.className = 'otiv-conv-avatar is-group';
      threadAvatar.innerHTML = `<i class="fa-solid ${conv.icon}"></i>`;
    } else {
      threadAvatar.className = 'otiv-conv-avatar';
      threadAvatar.textContent = conv.avatarLetter;
    }

    renderMessages(conv.messages);
  }

  function renderMessages(messages) {
    threadBody.innerHTML = messages.map(m => `
      <div class="otiv-msg-bubble-row ${m.from === 'me' ? 'is-me' : ''}">
        ${m.from !== 'me' ? `<span class="otiv-conv-avatar otiv-conv-avatar--sm">${m.author.charAt(0)}</span>` : ''}
        <div class="otiv-msg-bubble">
          ${m.from !== 'me' ? `<div class="otiv-msg-bubble__author">${m.author}</div>` : ''}
          <div class="otiv-msg-bubble__text">${escapeHtml(m.text)}</div>
          <div class="otiv-msg-bubble__time">${m.time}</div>
        </div>
      </div>
    `).join('');
    threadBody.scrollTop = threadBody.scrollHeight;
  }

  function escapeHtml(str) {
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
  }

  /* ---------------------------------------------------------
     Envoi de message
     --------------------------------------------------------- */
  function sendMessage() {
    const text = messageInput.value.trim();
    if (!text) return;

    const conv = CONVERSATIONS[currentConvId];
    const now = new Date();
    const time = now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0');

    conv.messages.push({ from: 'me', author: 'Hamzah', text, time });
    renderMessages(conv.messages);
    messageInput.value = '';

    // TODO: envoyer réellement le message.
    // Si Nextcloud Talk est retenu : POST /ocs/v2.php/apps/spreed/api/v1/chat/{token}
    // Sinon : endpoint custom POST /apps/ged_interface/messages
    fetch('/apps/ged_interface/messages', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        requesttoken: OC.requestToken
      },
      body: JSON.stringify({ conversationId: currentConvId, text })
    }).catch(err => console.error('Erreur envoi message', err));
  }

  sendBtn.addEventListener('click', sendMessage);
  messageInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') sendMessage();
  });

  // Chargement initial
  openConversation(currentConvId);
});
</script>
</body>
</html>