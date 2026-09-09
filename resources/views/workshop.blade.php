@extends('layouts.app')

@section('title', 'The Workshop — THE VINTAGE SNEAKERS')
@section('pages-css', true)

@section('content')

@include('partials.navbar')

<header class="subhero">
  <div class="wrap">
    <div class="subhero-breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Workshop</span></div>
    <div class="eyebrow">Behind The Vault</div>
    <h1>Inside the<br><em>workshop</em>.</h1>
    <p class="lede">Every pair that enters the Vault passes through the same bench before it ever reaches a listing. Here's exactly what happens between the moment a pair arrives and the moment it's cleared for sale.</p>
  </div>
</header>

<section class="process" id="process">
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">The Authentication Line</div>
      <h2>Five checks. No shortcuts.</h2>
    </div>
    <div class="process-rail">

      @foreach ($steps as $step)
      <div class="process-step">
        <div class="process-num">{{ $step['num'] }}</div>
        <div class="process-copy">
          <div class="eyebrow">{{ $step['eyebrow'] }}</div>
          <h3>{{ $step['title'] }}</h3>
          <p>{{ $step['body'] }}</p>
        </div>
        <div class="process-detail">
          <h4>{{ $step['detail_title'] }}</h4>
          <ul>
            @foreach ($step['detail_items'] as $item)
            <li>{{ $item }}</li>
            @endforeach
          </ul>
        </div>
      </div>
      @endforeach

    </div>
  </div>
</section>

<section class="materials" style="background:var(--ink-2);">
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">On The Bench</div>
      <h2>What restoration actually means here.</h2>
    </div>
  </div>
  <div class="wrap" style="padding:0;">
    <div class="values-rail">
      <div class="value-cell">
        <svg class="mark" viewBox="0 0 34 34"><circle cx="17" cy="17" r="15" fill="none" stroke="#d1583c" stroke-width="1.6"/><path d="M11 18 L15 22 L24 12" fill="none" stroke="#d1583c" stroke-width="2"/></svg>
        <div>
          <h3>Never Repainted</h3>
          <p>Discoloration and yellowing are left as-is unless they threaten the material's integrity. Patina is part of the object.</p>
        </div>
      </div>
      <div class="value-cell">
        <svg class="mark" viewBox="0 0 34 34"><rect x="6" y="6" width="22" height="22" rx="3" fill="none" stroke="#d1583c" stroke-width="1.6"/><path d="M11 17 h12 M17 11 v12" stroke="#d1583c" stroke-width="1.6"/></svg>
        <div>
          <h3>Never Resewn From Parts</h3>
          <p>We don't rebuild a pair from donor components. If it can't be honestly repaired, it doesn't enter the Vault.</p>
        </div>
      </div>
      <div class="value-cell">
        <svg class="mark" viewBox="0 0 34 34"><path d="M17 5 L27 12 V22 L17 29 L7 22 V12 Z" fill="none" stroke="#d1583c" stroke-width="1.6"/></svg>
        <div>
          <h3>Period-Correct Materials</h3>
          <p>Foxing tape, laces, and foam are sourced to match the original era, not swapped for modern equivalents.</p>
        </div>
      </div>
      <div class="value-cell">
        <svg class="mark" viewBox="0 0 34 34"><path d="M9 25 L17 6 L25 25 Z" fill="none" stroke="#d1583c" stroke-width="1.6"/><circle cx="17" cy="19" r="2" fill="#d1583c"/></svg>
        <div>
          <h3>Logged, Not Hidden</h3>
          <p>Every repair is dated and disclosed on the provenance file. What's original and what's been touched is never a mystery.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ba" id="restorations">
  <style>
    .ba-strip{display:grid;grid-template-columns:repeat(3,1fr);gap:28px;margin-top:40px;}
    @media (max-width:900px){.ba-strip{grid-template-columns:1fr;}}
    .ba-card{background:#151210;border:1px solid rgba(255,255,255,.08);border-radius:10px;overflow:hidden;}
    .ba-card .ba-img-wrap{position:relative;}
    .ba-card img{width:100%;display:block;}
    .ba-card .ba-cap{position:absolute;left:50%;bottom:18px;transform:translateX(-50%) rotate(-1.5deg);
      background:#8a6a3f;color:#f4ead9;font-family:'IBM Plex Mono',monospace;font-size:.62rem;letter-spacing:.06em;
      text-transform:uppercase;padding:6px 14px;border-radius:2px;box-shadow:0 3px 6px rgba(0,0,0,.4);white-space:nowrap;}
    .ba-card .ba-cap span{display:none;}
    .ba-card .ba-cap::after{content:attr(data-tag);}
    .ba-details{display:grid;grid-template-columns:1fr 1fr;border-top:1px solid rgba(255,255,255,.08);}
    .ba-details > div{padding:18px 20px;font-family:'Archivo',sans-serif;font-size:.82rem;line-height:1.45;color:#cfc7bd;}
    .ba-details > div:first-child{border-right:1px solid rgba(255,255,255,.08);}
    .ba-details strong{display:block;font-family:'Big Shoulders Display',sans-serif;font-weight:700;
      letter-spacing:.04em;color:#fff;font-size:.78rem;text-transform:uppercase;margin-bottom:4px;}
  </style>
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">Recent Bench Work</div>
      <h2>Before the bench, after the bench.</h2>
    </div>
    <div class="ba-strip">
      @foreach ($restorations as $r)
      <div class="ba-card">
        <div class="ba-img-wrap">
          <img src="{{ asset('images/' . $r['image']) }}" alt="{{ $r['name'] }} before and after {{ $r['tag'] }}">
          <div class="ba-cap" data-tag="{{ $r['name'] }}"><span>{{ $r['name'] }}</span><span>{{ $r['tag'] }}</span></div>
        </div>
        <div class="ba-details">
          <div><strong>Before:</strong>{{ $r['before'] }}</div>
          <div><strong>After:</strong>{{ $r['after'] }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<section class="membership" style="padding-top:0;">
  <div class="wrap">
    <div class="member-panel" style="grid-template-columns:1fr; text-align:center; padding:70px 60px;">
      <div class="member-copy" style="max-width:640px; margin:0 auto;">
        <div class="eyebrow" style="justify-content:center;">Curious What's In Yours?</div>
        <h2>We'll review a pair you already own.</h2>
        <p style="margin:0 auto 30px;">Vault members get a free authentication review on pairs already in their own collection — same bench, same process, no obligation to sell.</p>
        <a href="{{ route('home') }}#membership" class="btn-primary">Request Vault Access</a>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script type="module" src="{{ asset('js/firebase-init.js') }}"></script>
<script type="module">
  const authButton = document.getElementById('authButton');
  const authModal = document.getElementById('authModal');
  const authClose = document.getElementById('authClose');
  const authTitle = document.getElementById('authModalTitle');
  const showSignupButton = document.getElementById('showSignup');
  const showLoginButton = document.getElementById('showLogin');
  const loginForm = document.getElementById('loginForm');
  const signupForm = document.getElementById('signupForm');

  const openAuthModal = () => {
    authModal.classList.add('active');
    authModal.setAttribute('aria-hidden', 'false');
  };

  const closeAuthModal = () => {
    authModal.classList.remove('active');
    authModal.setAttribute('aria-hidden', 'true');
  };

  authButton?.addEventListener('click', openAuthModal);
  authClose?.addEventListener('click', closeAuthModal);
  authModal?.addEventListener('click', (event) => {
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

  const accountMenu = document.getElementById('accountMenu');
  const accountButton = document.getElementById('accountButton');
  const accountDropdown = document.getElementById('accountDropdown');

  const closeAccountDropdown = () => {
    accountDropdown?.classList.remove('show');
    accountDropdown?.setAttribute('aria-hidden', 'true');
  };

  const openAccountDropdown = () => {
    accountDropdown?.classList.add('show');
    accountDropdown?.setAttribute('aria-hidden', 'false');
  };

  accountButton?.addEventListener('click', (event) => {
    event.stopPropagation();
    if (accountDropdown?.classList.contains('show')) {
      closeAccountDropdown();
    } else {
      openAccountDropdown();
    }
  });

  accountDropdown?.addEventListener('click', async (event) => {
    if (event.target.id === 'logoutButton') {
      event.preventDefault();
      if (!(await window.showLogoutConfirm())) return;
      await window.VintageAuth.signOutUser();
      closeAccountDropdown();
      authModal.classList.remove('active');
      authModal.setAttribute('aria-hidden', 'true');
    }
  });

  document.addEventListener('click', (event) => {
    if (accountMenu && !accountMenu.contains(event.target)) {
      closeAccountDropdown();
    }
  });

  window.VintageAuth.onChange((user) => {
    if (!authButton) return;
    if (user) {
      const firstName = user.name.split(' ')[0];
      const initials = firstName.slice(0, 1).toUpperCase();
      authButton.style.display = 'none';
      accountMenu.style.display = 'inline-block';
      accountButton.innerHTML = `<span class="account-avatar">${initials}</span><span>${firstName}</span> ▾`;
      accountDropdown.innerHTML = `
        <div class="account-summary">
          <strong>${user.name}</strong>
        </div>
        <button class="account-link" id="logoutButton">Sign Out</button>
      `;
      return;
    }
    authButton.style.display = 'inline-block';
    accountMenu.style.display = 'none';
  });

  loginForm?.addEventListener('submit', async (event) => {
    event.preventDefault();
    const email = document.getElementById('loginEmail').value.trim().toLowerCase();
    const password = document.getElementById('loginPassword').value;
    const message = loginForm.querySelector('.form-message');

    message.textContent = 'Signing in...';
    try {
      await window.VintageAuth.signIn(email, password);
      message.textContent = 'Signed in successfully.';
      loginForm.reset();
      closeAuthModal();
    } catch (error) {
      console.error(error);
      message.textContent = 'Email or password do not match.';
    }
  });

  signupForm?.addEventListener('submit', async (event) => {
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
      message.textContent = 'Account created successfully.';
      signupForm.reset();
      closeAuthModal();
    } catch (error) {
      console.error(error);
      if (error.code === 'auth/email-already-in-use') {
        message.textContent = 'Email already registered, please sign in.';
      } else if (error.code === 'auth/weak-password') {
        message.textContent = 'Password should be at least 6 characters.';
      } else {
        message.textContent = 'Failed to create account. Please try again.';
      }
    }
  });
</script>
@endsection
