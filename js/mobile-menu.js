(() => {
  const drawer = document.getElementById('mobileDrawer');
  const overlay = document.getElementById('mobileDrawerOverlay');
  const menuButton = document.getElementById('mobileMenuButton');
  const closeButton = document.getElementById('mobileDrawerClose');
  const searchButton = document.getElementById('mobileSearchButton');
  const searchPanel = document.getElementById('mobileSearchPanel');
  const searchInput = document.getElementById('mobileSearchInput');

  if (!drawer || !overlay || !menuButton || !closeButton) return;

  function openDrawer() {
    overlay.hidden = false;
    drawer.classList.add('is-open');
    drawer.setAttribute('aria-hidden', 'false');
    menuButton.setAttribute('aria-expanded', 'true');
    document.body.classList.add('drawer-is-open');
    closeButton.focus();
  }

  function closeDrawer() {
    drawer.classList.remove('is-open');
    drawer.setAttribute('aria-hidden', 'true');
    menuButton.setAttribute('aria-expanded', 'false');
    document.body.classList.remove('drawer-is-open');
    window.setTimeout(() => { overlay.hidden = true; }, 240);
  }

  menuButton.addEventListener('click', openDrawer);
  closeButton.addEventListener('click', closeDrawer);
  overlay.addEventListener('click', closeDrawer);

  drawer.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', closeDrawer);
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
      closeDrawer();
      if (searchPanel && !searchPanel.hidden) toggleSearch(false);
    }
  });

  function toggleSearch(forceState) {
    const shouldOpen = typeof forceState === 'boolean'
      ? forceState
      : searchPanel.hidden;
    searchPanel.hidden = !shouldOpen;
    searchButton.setAttribute('aria-expanded', String(shouldOpen));
    if (shouldOpen && searchInput) searchInput.focus();
  }

  if (searchButton && searchPanel) {
    searchButton.addEventListener('click', () => toggleSearch());
  }
})();
