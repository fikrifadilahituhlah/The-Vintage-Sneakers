@extends('layouts.app')

@section('title', 'THE VINTAGE SNEAKERS — The Vault')

@section('content')

@include('partials.navbar')

<div class="splash-overlay" id="splashOverlay">
  <div class="splash-logo">
    <img src="{{ asset('images/logo.png') }}" alt="The Vintage Sneakers logo">
    <div>The Vintage Sneakers</div>
  </div>
</div>

<header class="hero">
  <div class="wrap hero-grid">
    <div class="hero-copy">
      <div class="eyebrow">The Vintage Sneakers · Bandung, Est. 2016</div>
      <h1>Never<br><em>reissued</em>.<br>Only survived.</h1>
      <p class="lede">Every pair in the Vault is an original — sourced, hand-authenticated, and restored, never remade. No reproductions. No restocks. Once a pair sells, that release is gone from the Vault for good.</p>
      <div class="hero-actions">
        <a href="#showcase" class="btn-primary">Browse The Vault</a>
        <a href="#story" class="btn-ghost">How We Authenticate</a>
      </div>
    </div>
    <div class="hero-visual">
      <div class="hero-photo-frame">
        <img src="{{ asset('images/hero.png') }}" alt="A pair of vintage sneakers displayed beside their original box">
      </div>
      <div class="hero-tag">Pair No. 00214 — Verified Deadstock</div>
    </div>
  </div>
  <div class="scroll-cue"><span>Scroll</span><span class="line"></span></div>
</header>

<div class="marquee">
  <div class="marquee-track" id="marqueeTrack"></div>
</div>

<section class="story" id="story">
  <div class="wrap">
    <div class="story-grid">
      <div class="story-quote">
        “We don't sell shoes. We confirm that a piece of sneaker history made it out intact, and we hand it forward.”
        <cite>— Head Authenticator, The Vintage Sneakers</cite>
      </div>
      <div class="story-body">
        <p class="story-headline">Preserving sneaker history, one authenticated pair at a time.</p>
        <p>The Vintage Sneakers started in Bandung in 2016, after founder Oktapia Putri Anggraeni made a chance find — a forgotten deadstock cache that had sat untouched for decades. What began as one collector's rescue mission grew into something bigger: a place where rare pairs are sourced, verified, and handed on to people who understand what they're holding, not just anonymous stock pulled off a shelf.</p>
        <p>Too many great pairs get lost to bad information — sold as something they're not, stripped of their story, or passed around without anyone checking if they're real. We exist to fix that. Every pair that comes through the Vault is authenticated, documented, and, where needed, restored with the same care it would have left the factory with.</p>
        <ul class="story-benefits">
          <li>Trusted authentication, no reproductions</li>
          <li>Period-correct restoration only</li>
          <li>Lifetime authenticity guarantee</li>
        </ul>
        <p class="story-note">4,300+ pairs authenticated since 2016, every one shipped with a full provenance file.</p>
        <p>Nothing in the Vault has been repainted, resewn from parts, or reproduced. The repairs we do make — foxing tape, laces, cracked foam — use only period-correct materials, and every intervention is logged on the pair's provenance file, so buyers always know exactly what's original and what's been touched.</p>
        <div class="story-stats">
          <div><h4>4,300+</h4><p>Pairs Authenticated</p></div>
          <div><h4>1978</h4><p>Oldest Verified Release</p></div>
          <div><h4>6 hrs</h4><p>Avg. Authentication Time</p></div>
        </div>
        <p class="story-legal">Officially registered as PT The Vintage Sneakers, Bandung · Founder &amp; CEO Oktapia Putri Anggraeni</p>
        <a href="{{ route('workshop') }}" class="btn-ghost" style="margin-top:34px; display:inline-block;">See Inside The Workshop →</a>
      </div>
    </div>
  </div>
</section>

<section class="certifications" id="certifications">
  <div class="wrap">
    <div class="certifications-grid">
      <div class="certifications-copy">
        <div class="eyebrow">Proof Behind The Vault</div>
        <h2>Every claim has a paper trail.</h2>
        <p>Our legal registration and operational standards are documented, so trust in The Vintage Sneakers is built on more than a good-looking pair.</p>
        <div class="certificate-count" aria-live="polite"><span id="certificateCurrent">01</span> / 03</div>
      </div>
      <div class="certificate-slider" aria-label="Certificate gallery">
        <div class="certificate-stage">
          <figure class="certificate-slide is-active">
            <img src="{{ asset('images/surat-pengesahan.png') }}" alt="Certificate of incorporation for PT The Vintage Sneakers">
            <figcaption>Certificate of Incorporation</figcaption>
          </figure>
          <figure class="certificate-slide">
            <img src="{{ asset('images/sertifikat_quality.jpeg') }}" alt="Quality certificate for The Vintage Sneakers">
            <figcaption>Quality Certification</figcaption>
          </figure>
          <figure class="certificate-slide">
            <img src="{{ asset('images/sertifikat_production.jpeg') }}" alt="Production certificate for The Vintage Sneakers">
            <figcaption>Production Certification</figcaption>
          </figure>
        </div>
        <div class="certificate-controls">
          <button type="button" class="certificate-arrow" id="certificatePrev" aria-label="Previous certificate">&larr;</button>
          <div class="certificate-dots" role="tablist" aria-label="Choose certificate">
            <button type="button" class="certificate-dot is-active" role="tab" aria-label="Show certificate 1" aria-selected="true"></button>
            <button type="button" class="certificate-dot" role="tab" aria-label="Show certificate 2" aria-selected="false"></button>
            <button type="button" class="certificate-dot" role="tab" aria-label="Show certificate 3" aria-selected="false"></button>
          </div>
          <button type="button" class="certificate-arrow" id="certificateNext" aria-label="Next certificate">&rarr;</button>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="profile-modal-overlay" id="profileModal" aria-hidden="true">
  <div class="auth-modal" role="dialog" aria-modal="true" aria-labelledby="profileModalTitle">
    <button type="button" class="auth-close" id="profileClose" aria-label="Close profile dialog">×</button>
    <div class="auth-panel">
      <div class="auth-intro">
        <div class="eyebrow">Vault Member</div>
        <h2 id="profileModalTitle">Member Profile</h2>
        <p>Review your current account details and update your display name.</p>
      </div>
      <div class="profile-details">
        <div class="profile-field">
          <span>Name</span>
          <input id="profileNameInput" class="profile-name-input" type="text" placeholder="Enter your display name">
        </div>
        <div class="profile-field">
          <span>Email</span>
          <input id="profileEmailInput" class="profile-name-input" type="text" readonly>
        </div>
        <div class="profile-edit">
          <button id="saveProfileName" class="btn-primary">Save changes</button>
          <p class="profile-message" aria-live="polite"></p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="vision-mission" id="vision-mission">
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">Company Profile</div>
      <h2>Vision &amp; Mission</h2>
    </div>
    <div class="vision-grid">
      <article class="vision-card">
        <h3>Vision</h3>
        <p>To become the most trusted destination for preserving and celebrating vintage sneaker culture by connecting collectors, restorers, and enthusiasts with authentic stories, rare finds, and lasting knowledge.</p>
      </article>
      <article class="vision-card">
        <h3>Mission</h3>
        <p>To source, verify, restore, and present original vintage sneakers with integrity, transparency, and expert care — making history wearable while protecting the legacy of every pair.</p>
      </article>
    </div>
    <div class="organization-structure">
      <div class="section-head organization-heading">
        <div class="eyebrow">The Team</div>
        <h2>Organization Structure</h2>
      </div>
      <div class="org-chart">
        <article class="org-card org-ceo">
          <span class="org-role">CEO</span>
          <h3>Oktapia Putri Anggraeni</h3>
        </article>
        <div class="org-branches">
          <article class="org-card">
            <span class="org-role">HRD</span>
            <h3>Fikri Fadilah</h3>
          </article>
          <article class="org-card">
            <span class="org-role">Head of Production</span>
            <h3>Siti Hanifah N.</h3>
          </article>
        </div>
        <article class="org-card org-staff">
          <span class="org-role">Staff</span>
          <h3>55 Team Members</h3>
          <p>Supporting daily operations, retail, restoration, and customer experience.</p>
        </article>
      </div>
    </div>
    <div class="floorplan-gallery">
      <div class="section-head floorplan-heading">
        <div class="eyebrow">Our Space</div>
        <h2>Site Plans</h2>
      </div>
      <div class="floorplan-grid">
        <figure class="floorplan-card">
          <img src="{{ asset('images/denahtoko.jpg') }}" alt="Office floor plan">
          <figcaption>Office</figcaption>
        </figure>
        <figure class="floorplan-card">
          <img src="{{ asset('images/denahtokolantai1.jpg') }}" alt="First-floor store plan">
          <figcaption>Store, floor 1</figcaption>
        </figure>
        <figure class="floorplan-card">
          <img src="{{ asset('images/denahcafelantai2.jpg') }}" alt="Second-floor cafe plan">
          <figcaption>Cafe, floor 2</figcaption>
        </figure>
        <figure class="floorplan-card">
          <img src="{{ asset('images/denahproduksi.jpg') }}" alt="Production area plan">
          <figcaption>Production area</figcaption>
        </figure>
      </div>
    </div>
  </div>
</section>

<section class="showcase" id="showcase">
  <div class="wrap">
    <div class="section-head" style="display:flex; align-items:flex-end; justify-content:space-between; gap:24px; flex-wrap:wrap;">
      <div>
        <div class="eyebrow">Currently In The Vault</div>
        <h2>Three pairs, one archive.</h2>
      </div>
      <a href="{{ route('shop') }}" class="btn-ghost">View Full Catalog →</a>
    </div>
    <div class="showcase-grid">

      @foreach ($featured as $item)
      <article class="tag-card">
        <div class="tag-visual">
          <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }} vintage sneaker">
        </div>
        <div class="tag-body">
          <div class="row"><span class="tag">{{ $item['type'] }}</span><span class="grade">{{ $item['grade'] }}</span></div>
          <h3>{{ $item['name'] }}</h3>
          <p>{{ $item['description'] }}</p>
          <div class="tag-foot">
            <span class="price">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
            <a href="#membership">View File →</a>
          </div>
        </div>
      </article>
      @endforeach

    </div>
  </div>
</section>

<section class="values" id="values">
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">What We Won't Compromise On</div>
      <h2>The vault standard.</h2>
    </div>
  </div>
  <div class="wrap" style="padding:0;">
    <div class="values-rail">
      <div class="value-cell">
        <svg class="mark" viewBox="0 0 34 34"><circle cx="17" cy="17" r="15" fill="none" stroke="#d1583c" stroke-width="1.6"/><path d="M11 18 L15 22 L24 12" fill="none" stroke="#d1583c" stroke-width="2"/></svg>
        <div>
          <h3>Provenance</h3>
          <p>Every pair ships with a file: box codes, purchase history, and the checks our authenticators ran to confirm it's original.</p>
        </div>
      </div>
      <div class="value-cell">
        <svg class="mark" viewBox="0 0 34 34"><rect x="6" y="6" width="22" height="22" rx="3" fill="none" stroke="#d1583c" stroke-width="1.6"/><path d="M11 17 h12 M17 11 v12" stroke="#d1583c" stroke-width="1.6"/></svg>
        <div>
          <h3>Restoration</h3>
          <p>Where a pair needs work, we repair with period-correct materials and log every touch — never a repaint, never a rebuild.</p>
        </div>
      </div>
      <div class="value-cell">
        <svg class="mark" viewBox="0 0 34 34"><path d="M17 5 L27 12 V22 L17 29 L7 22 V12 Z" fill="none" stroke="#d1583c" stroke-width="1.6"/></svg>
        <div>
          <h3>Rarity</h3>
          <p>We list what we personally source. No restocks, no reordering a colorway — once a pair sells, it's out of the Vault.</p>
        </div>
      </div>
      <div class="value-cell">
        <svg class="mark" viewBox="0 0 34 34"><path d="M9 25 L17 6 L25 25 Z" fill="none" stroke="#d1583c" stroke-width="1.6"/><circle cx="17" cy="19" r="2" fill="#d1583c"/></svg>
        <div>
          <h3>Guarantee</h3>
          <p>Lifetime authenticity guarantee on every pair. If a pair we sold is ever proven inauthentic, it's a full refund — no exceptions.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="membership" id="membership">
  <div class="wrap">
    <div class="member-panel">
      <div class="member-copy">
        <div class="eyebrow">By Application Only</div>
        <h2>Vault Access</h2>
        <p>A standing list of collectors who see new pairs before they're listed publicly, and who can put in a sourcing request for a specific release, size, or colorway we'll go hunt down.</p>
        <div class="discount-card" id="discountCard">
          <strong>Voucher savings at checkout.</strong>
          <p>Apply an active voucher at checkout to receive savings on your next Vault purchase.</p>
        </div>
        <ul class="member-list">
          <li>48-hour early access to every new Vault drop</li>
          <li>Personal sourcing requests — tell us the grail, we go find it</li>
          <li>Free authentication review on pairs already in your own collection</li>
          <li>Insured, signature-required shipping on every order</li>
          <li>Invites to Vault meetups and trade nights — see <a href="{{ route('events') }}" style="color:var(--rust-bright); text-decoration:underline;">what's coming up →</a></li>
        </ul>
      </div>
      <div class="member-form">
        <div class="eyebrow">Request Consideration</div>
        <form id="vaultRequestForm">
          <input id="vaultName" name="name" type="text" placeholder="Full name" required>
          <input id="vaultEmail" name="email" type="email" placeholder="Email address" required>
          <input id="vaultRequest" name="request" type="text" placeholder="What are you hunting for? (optional)">
          <button type="submit" class="btn-primary">Submit Request</button>
          <p class="form-message" aria-live="polite"></p>
          <p class="fine">Applications are reviewed monthly. Access does not guarantee stock of any specific release.</p>
        </form>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script type="module" src="{{ asset('js/firebase-init.js') }}"></script>
<script type="module">
  const words = ["DEADSTOCK","OG ALL","HAND AUTHENTICATED","BOX + TAGS INCLUDED","NEVER REPRODUCED","GRADED 9/10+","TRADING SINCE 2016","ONE PAIR, ONE OWNER"];
  const track = document.getElementById('marqueeTrack');
  const full = [...words, ...words];
  full.forEach((w,i) => {
    const s = document.createElement('span');
    s.textContent = w;
    track.appendChild(s);
    if(i < full.length - 1){
      const dot = document.createElement('span');
      dot.className = 'dot';
      dot.textContent = '◆';
      track.appendChild(dot);
    }
  });

  // subtle parallax on hero photo following pointer
  const heroPhoto = document.querySelector('.hero-photo-frame img');
  window.addEventListener('pointermove', (e) => {
    const x = (e.clientX / window.innerWidth - 0.5) * 16;
    const y = (e.clientY / window.innerHeight - 0.5) * 16;
    heroPhoto.style.transform = `translate(${x}px, ${y}px) scale(1.06)`;
  });

  const certificateSlides = Array.from(document.querySelectorAll('.certificate-slide'));
  const certificateDots = Array.from(document.querySelectorAll('.certificate-dot'));
  const certificateCurrent = document.getElementById('certificateCurrent');
  let certificateIndex = 0;
  let certificateTimer;

  const showCertificate = (index) => {
    certificateIndex = (index + certificateSlides.length) % certificateSlides.length;
    certificateSlides.forEach((slide, slideIndex) => {
      slide.classList.toggle('is-active', slideIndex === certificateIndex);
    });
    certificateDots.forEach((dot, dotIndex) => {
      const isActive = dotIndex === certificateIndex;
      dot.classList.toggle('is-active', isActive);
      dot.setAttribute('aria-selected', String(isActive));
    });
    certificateCurrent.textContent = String(certificateIndex + 1).padStart(2, '0');
  };

  const resetCertificateTimer = () => {
    window.clearInterval(certificateTimer);
    certificateTimer = window.setInterval(() => showCertificate(certificateIndex + 1), 6000);
  };

  document.getElementById('certificatePrev')?.addEventListener('click', () => {
    showCertificate(certificateIndex - 1);
    resetCertificateTimer();
  });
  document.getElementById('certificateNext')?.addEventListener('click', () => {
    showCertificate(certificateIndex + 1);
    resetCertificateTimer();
  });
  certificateDots.forEach((dot, dotIndex) => {
    dot.addEventListener('click', () => {
      showCertificate(dotIndex);
      resetCertificateTimer();
    });
  });
  resetCertificateTimer();

  // splash screen hide after half a second, show only once per session
  const splash = document.getElementById('splashOverlay');
  const splashSessionKey = 'vintage_splash_seen';
  const firstLoadSessionKey = 'vintage_first_load';
  const hasSeenSplash = sessionStorage.getItem(splashSessionKey) === 'true';
  const hasFirstLoad = sessionStorage.getItem(firstLoadSessionKey) === 'true';

  if (hasSeenSplash) {
    splash.classList.add('hide');
  }

  window.addEventListener('load', () => {
    if (!hasFirstLoad) {
      sessionStorage.setItem(firstLoadSessionKey, 'true');
    }

    if (!hasSeenSplash) {
      setTimeout(() => {
        splash.classList.add('hide');
        sessionStorage.setItem(splashSessionKey, 'true');
      }, 500);
    }
  });

  // Vault request form submits through FormSubmit and clears fields
  const requestForm = document.getElementById('vaultRequestForm');
  const messageEl = document.querySelector('.form-message');
  const successToast = document.getElementById('successToast');
  let toastTimer;

  const showSuccessToast = () => {
    window.clearTimeout(toastTimer);
    successToast.classList.add('is-visible');
    successToast.setAttribute('aria-hidden', 'false');
    toastTimer = window.setTimeout(() => {
      successToast.classList.remove('is-visible');
      successToast.setAttribute('aria-hidden', 'true');
    }, 5000);
  };

  requestForm.addEventListener('submit', async (event) => {
    event.preventDefault();

    const submitUrl = 'https://formsubmit.co/ajax/thevintagesneakers@gmail.com';
    const formData = new FormData(requestForm);
    formData.append('_subject', 'Vault Access Request');
    formData.append('_captcha', 'false');

    messageEl.textContent = 'Sending request...';

    try {
      const response = await fetch(submitUrl, {
        method: 'POST',
        body: formData,
      });

      if (!response.ok) {
        throw new Error('Submission failed');
      }

      const result = await response.json();
      if (result.success) {
        messageEl.textContent = 'Request sent. Thank you!';
        requestForm.reset();
        showSuccessToast();
      } else {
        throw new Error(result.message || 'Send failed');
      }
    } catch (error) {
      messageEl.textContent = 'Unable to send. Please try again later.';
      console.error(error);
    }
  });


  // Authentication (Firebase Auth + Firestore via window.VintageAuth)
  const authButton = document.getElementById('authButton');
  const authModal = document.getElementById('authModal');
  const authClose = document.getElementById('authClose');
  const authTitle = document.getElementById('authModalTitle');
  const showSignupButton = document.getElementById('showSignup');
  const showLoginButton = document.getElementById('showLogin');
  const discountCard = document.getElementById('discountCard');
  const loginForm = document.getElementById('loginForm');
  const signupForm = document.getElementById('signupForm');
  const priceEls = Array.from(document.querySelectorAll('.price'));
  const formatIDR = (value) => new Intl.NumberFormat('id-ID').format(value);

  let currentUser = null; // { uid, email, name } or null when signed out

  const getOriginalPrice = (el) => {
    if (!el.dataset.originalPrice) {
      const match = el.textContent.match(/Rp\s*([\d\.]+)/);
      const rawDigits = match ? match[1].replace(/\./g, '') : '0';
      el.dataset.originalPrice = rawDigits || '0';
    }
    return parseInt(el.dataset.originalPrice, 10) || 0;
  };

  const refreshProductPrices = () => {
    priceEls.forEach((el) => {
      const original = getOriginalPrice(el);
      el.textContent = `Rp ${formatIDR(original)}`;
    });
  };

  const openAuthModal = () => {
    authModal.classList.add('active');
    authModal.setAttribute('aria-hidden', 'false');
  };

  const closeAuthModal = () => {
    authModal.classList.remove('active');
    authModal.setAttribute('aria-hidden', 'true');
  };

  authButton.addEventListener('click', () => {
    openAuthModal();
  });

  const accountMenu = document.getElementById('accountMenu');
  const accountButton = document.getElementById('accountButton');
  const accountDropdown = document.getElementById('accountDropdown');

  const closeAccountDropdown = () => {
    accountDropdown.classList.remove('show');
    accountDropdown.setAttribute('aria-hidden', 'true');
  };

  const openAccountDropdown = () => {
    accountDropdown.classList.add('show');
    accountDropdown.setAttribute('aria-hidden', 'false');
  };

  accountButton?.addEventListener('click', () => {
    if (accountDropdown.classList.contains('show')) {
      closeAccountDropdown();
    } else {
      openAccountDropdown();
    }
  });

  const profileModal = document.getElementById('profileModal');
  const profileClose = document.getElementById('profileClose');
  const profileEmailInput = document.getElementById('profileEmailInput');
  const profileNameInput = document.getElementById('profileNameInput');
  const saveProfileName = document.getElementById('saveProfileName');
  const profileMessage = document.querySelector('.profile-message');

  const openProfileModal = (user) => {
    profileEmailInput.value = user.email;
    profileNameInput.value = user.name;
    profileMessage.textContent = '';
    profileModal.classList.add('active');
    profileModal.setAttribute('aria-hidden', 'false');
    profileNameInput.focus();
  };

  const closeProfileModal = () => {
    profileModal.classList.remove('active');
    profileModal.setAttribute('aria-hidden', 'true');
  };

  const updateAuthDisplay = () => {
    if (currentUser) {
      authButton.style.display = 'none';
      accountMenu.style.display = 'inline-block';
      const firstName = currentUser.name.split(' ')[0];
      const initials = firstName.slice(0, 1).toUpperCase();
      accountButton.innerHTML = `<span class="account-avatar">${initials}</span><span>${firstName}</span> ▾`;
      accountDropdown.innerHTML = `
        <div class="account-summary">
          <strong>${currentUser.name}</strong><br>
          <span>${currentUser.email}</span>
        </div>
        <button class="account-link" id="profileButton">Profile</button>
        <button class="account-link" id="logoutButton">Sign Out</button>
      `;
      discountCard.innerHTML = `<strong>Welcome back, ${currentUser.name.split(' ')[0]}!</strong><p>Apply an active voucher at checkout to receive savings.</p>`;
      refreshProductPrices();
      return;
    }
    authButton.style.display = 'inline-block';
    accountMenu.style.display = 'none';
    authButton.textContent = 'Sign In';
    discountCard.innerHTML = `<strong>Voucher savings at checkout.</strong><p>Apply an active voucher code during checkout to receive savings.</p>`;
    refreshProductPrices();
  };

  // Fires immediately with current state, then again on every login/logout
  window.VintageAuth.onChange((user) => {
    currentUser = user;
    updateAuthDisplay();
  });

  saveProfileName?.addEventListener('click', async (event) => {
    event.preventDefault();
    if (!currentUser) return;
    const newName = profileNameInput.value.trim();
    if (!newName) {
      profileMessage.textContent = 'Please enter a display name.';
      return;
    }
    try {
      await window.VintageAuth.updateName(newName);
      currentUser.name = newName;
      accountButton.textContent = `${newName.split(' ')[0]} ▾`;
      updateAuthDisplay();
      closeProfileModal();
    } catch (error) {
      console.error(error);
      profileMessage.textContent = 'Failed to save changes. Please try again.';
    }
  });

  accountDropdown.addEventListener('click', async (event) => {
    const target = event.target;

    if (target.id === 'logoutButton') {
      event.preventDefault();
      if (!(await window.showLogoutConfirm())) return;
      await window.VintageAuth.signOutUser();
      closeAccountDropdown();
      authModal.classList.remove('active');
      authModal.setAttribute('aria-hidden', 'true');
      return;
    }

    if (target.id === 'profileButton') {
      event.preventDefault();
      if (!currentUser) return;
      openProfileModal(currentUser);
      return;
    }
  });

  document.addEventListener('click', (event) => {
    if (!accountMenu.contains(event.target)) {
      closeAccountDropdown();
    }
  });

  profileClose.addEventListener('click', closeProfileModal);
  profileModal.addEventListener('click', (event) => {
    if (event.target === profileModal) closeProfileModal();
  });

  authClose.addEventListener('click', closeAuthModal);
  authModal.addEventListener('click', (event) => {
    if (event.target === authModal) closeAuthModal();
  });

  const showLogin = () => {
    authTitle.textContent = 'Sign In';
    loginForm.classList.add('active');
    loginForm.setAttribute('aria-hidden', 'false');
    signupForm.classList.remove('active');
    signupForm.setAttribute('aria-hidden', 'true');
  };

  const showSignup = () => {
    authTitle.textContent = 'Create Account';
    signupForm.classList.add('active');
    signupForm.setAttribute('aria-hidden', 'false');
    loginForm.classList.remove('active');
    loginForm.setAttribute('aria-hidden', 'true');
  };

  showSignupButton?.addEventListener('click', showSignup);
  showLoginButton?.addEventListener('click', showLogin);

  loginForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    const email = document.getElementById('loginEmail').value.trim().toLowerCase();
    const password = document.getElementById('loginPassword').value;
    const message = loginForm.querySelector('.form-message');

    message.textContent = 'Signing in...';
    try {
      await window.VintageAuth.signIn(email, password);
      message.textContent = 'Signed in successfully. Your discount is available!';
      loginForm.reset();
      closeAuthModal();
    } catch (error) {
      console.error(error);
      message.textContent = 'Email or password do not match.';
    }
  });

  signupForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    const name = document.getElementById('signupName').value.trim();
    const email = document.getElementById('signupEmail').value.trim().toLowerCase();
    const password = document.getElementById('signupPassword').value;
    const message = signupForm.querySelector('.form-message');

    if (!name || !email || !password) {
      message.textContent = 'Please complete all fields first.';
      return;
    }

    message.textContent = 'Creating account...';
    try {
      await window.VintageAuth.signUp(name, email, password);
      message.textContent = 'Account created successfully. Your discount is now ready!';
      loginForm.reset();
      signupForm.reset();
      closeAuthModal();
    } catch (error) {
      console.error(error);
      if (error.code === 'auth/email-already-in-use') {
        message.textContent = 'Email already registered, please sign in.';
      } else if (error.code === 'auth/weak-password') {
        message.textContent = 'Password should be at least 6 characters.';
      } else if (error.code === 'auth/invalid-email') {
        message.textContent = 'Please enter a valid email address.';
      } else {
        message.textContent = 'Failed to create account. Please try again.';
      }
    }
  });
</script>
@endsection
