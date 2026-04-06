/* ═══════════════════════════════════════════════════════════
   FoodFusion — Main JavaScript
═══════════════════════════════════════════════════════════ */

document.addEventListener('DOMContentLoaded', () => {

  /* ─── THEME TOGGLE ─────────────────────────────────── */
  const html       = document.documentElement;
  const themeBtn   = document.getElementById('themeToggle');
  const themeIcon  = document.getElementById('themeIcon');

  const applyTheme = (theme) => {
    html.setAttribute('data-theme', theme);
    if (themeIcon) {
      themeIcon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
    }
  };

  const savedTheme = localStorage.getItem('ff-theme') || 'light';
  applyTheme(savedTheme);

  if (themeBtn) {
    themeBtn.addEventListener('click', () => {
      const next = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
      applyTheme(next);
      localStorage.setItem('ff-theme', next);
    });
  }

  /* ─── NAVBAR SCROLL + HAMBURGER ────────────────────── */
  const navbar    = document.getElementById('navbar');
  const hamburger = document.getElementById('hamburger');
  const navLinks  = document.getElementById('navLinks');

  window.addEventListener('scroll', () => {
    if (navbar) navbar.classList.toggle('scrolled', window.scrollY > 40);
  });

  if (hamburger && navLinks) {
    const setMenuState = (isOpen) => {
      navLinks.classList.toggle('open', isOpen);
      hamburger.setAttribute('aria-expanded', String(isOpen));
      document.body.classList.toggle('nav-open', isOpen);

      const spans = hamburger.querySelectorAll('span');
      if (isOpen) {
        spans[0].style.transform = 'rotate(45deg) translate(5px,5px)';
        spans[1].style.opacity   = '0';
        spans[2].style.transform = 'rotate(-45deg) translate(5px,-5px)';
      } else {
        spans.forEach(s => { s.style.transform = ''; s.style.opacity = ''; });
      }
    };
    const resetHamburger = () => {
      setMenuState(false);
    };
    const closeMenu = () => {
      resetHamburger();
    };

    hamburger.addEventListener('click', () => {
      setMenuState(!navLinks.classList.contains('open'));
    });
    // Close menu when a link is clicked
    navLinks.querySelectorAll('a').forEach(a => {
      a.addEventListener('click', closeMenu);
    });
    navLinks.querySelectorAll('button').forEach(button => {
      button.addEventListener('click', closeMenu);
    });
    window.addEventListener('resize', () => {
      if (window.innerWidth > 768) closeMenu();
    });
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeMenu();
    });
    window.addEventListener('orientationchange', closeMenu);
  }

  /* ─── ACTIVE NAV LINK ───────────────────────────────── */
  const currentPath = window.location.pathname;
  document.querySelectorAll('.nav-links a').forEach(a => {
    if (a.getAttribute('href') && currentPath.includes(a.getAttribute('href').split('/').pop().replace('.php',''))) {
      a.classList.add('active');
    }
  });

  /* ─── JOIN US MODAL ─────────────────────────────────── */
  const joinModal    = document.getElementById('joinModal');
  const openJoinBtns = document.querySelectorAll('.js-open-join-modal');
  const closeJoinBtn = document.getElementById('closeJoinModal');

  const openModal = (modal) => { if (modal) modal.classList.add('active'); document.body.style.overflow='hidden'; };
  const closeModal= (modal) => { if (modal) modal.classList.remove('active'); document.body.style.overflow=''; };

  openJoinBtns.forEach(btn => {
    btn.addEventListener('click', () => openModal(joinModal));
  });
  if (closeJoinBtn) closeJoinBtn.addEventListener('click', () => closeModal(joinModal));
  if (joinModal) {
    joinModal.addEventListener('click', (e) => {
      if (e.target === joinModal) closeModal(joinModal);
    });
  }
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeModal(joinModal);
  });

  // Auto-open modal if ?signup=1 in URL
  if (new URLSearchParams(window.location.search).get('signup') === '1') {
    setTimeout(() => openModal(joinModal), 600);
  }

  /* ─── CAROUSEL ──────────────────────────────────────── */
  const track  = document.querySelector('.carousel-track');
  const slides = document.querySelectorAll('.carousel-slide');
  const prev   = document.querySelector('.carousel-prev');
  const next   = document.querySelector('.carousel-next');
  const dots   = document.querySelectorAll('.carousel-dot');
  let   cur    = 0;
  let   timer;

  const goTo = (i) => {
    cur = (i + slides.length) % slides.length;
    if (track) track.style.transform = `translateX(-${cur * 100}%)`;
    dots.forEach((d, idx) => d.classList.toggle('active', idx === cur));
  };

  const startAuto = () => { timer = setInterval(() => goTo(cur + 1), 4500); };
  const stopAuto  = () => { clearInterval(timer); };

  if (track && slides.length) {
    goTo(0);
    startAuto();
    if (prev) prev.addEventListener('click', () => { stopAuto(); goTo(cur - 1); startAuto(); });
    if (next) next.addEventListener('click', () => { stopAuto(); goTo(cur + 1); startAuto(); });
    dots.forEach((d, i) => d.addEventListener('click', () => { stopAuto(); goTo(i); startAuto(); }));
  }

  /* ─── COOKIE BANNER ─────────────────────────────────── */
  const cookieBanner  = document.getElementById('cookieBanner');
  const acceptCookies = document.getElementById('acceptCookies');
  const declineCookies= document.getElementById('declineCookies');

  if (cookieBanner && !localStorage.getItem('ff-cookies')) {
    setTimeout(() => cookieBanner.classList.add('visible'), 1200);
  }
  const dismissCookies = (choice) => {
    localStorage.setItem('ff-cookies', choice);
    if (cookieBanner) {
      cookieBanner.classList.remove('visible');
      setTimeout(() => cookieBanner.remove(), 400);
    }
  };
  if (acceptCookies)  acceptCookies.addEventListener('click',  () => dismissCookies('accepted'));
  if (declineCookies) declineCookies.addEventListener('click', () => dismissCookies('declined'));

  /* ─── RECIPE FILTER ─────────────────────────────────── */
  document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const group = btn.dataset.group || 'filter';
      document.querySelectorAll(`.filter-btn[data-group="${group}"]`).forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const val = btn.dataset.filter;
      document.querySelectorAll('.recipe-item').forEach(card => {
        if (val === 'all') {
          card.style.display = '';
        } else {
          const match = card.dataset.cuisine === val || card.dataset.difficulty === val || card.dataset.diet === val;
          card.style.display = match ? '' : 'none';
        }
      });
    });
  });

  /* ─── SCROLL REVEAL ─────────────────────────────────── */
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.style.opacity = '1';
        e.target.style.transform = 'translateY(0)';
        observer.unobserve(e.target);
      }
    });
  }, { threshold: .1 });

  document.querySelectorAll('.card, .resource-card, .team-card, .feature-item').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(30px)';
    el.style.transition = 'opacity .5s ease, transform .5s ease';
    observer.observe(el);
  });

  /* ─── FLASH MESSAGE AUTO-DISMISS ────────────────────── */
  document.querySelectorAll('.alert').forEach(alert => {
    setTimeout(() => {
      alert.style.transition = 'opacity .4s';
      alert.style.opacity = '0';
      setTimeout(() => alert.remove(), 400);
    }, 4500);
  });

});
