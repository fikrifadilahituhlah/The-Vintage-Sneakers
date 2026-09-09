@extends('layouts.app')

@section('title', 'Meetups & Trades — THE VINTAGE SNEAKERS')
@section('pages-css', true)

@section('content')

@include('partials.navbar')

<header class="subhero">
  <div class="wrap">
    <div class="subhero-breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Meetups &amp; Trades</span></div>
    <div class="eyebrow">Off The Shelf</div>
    <h1>Where collectors<br><em>actually meet</em>.</h1>
    <p class="lede">The Vault isn't just a storefront. A few times a month we open the doors, bring out pairs that aren't listed anywhere, and let people trade, talk shop, and geek out over sneakers in person.</p>
  </div>
</header>

<section class="events" id="upcoming">
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">On The Calendar</div>
      <h2>Upcoming meetups.</h2>
    </div>
    <div class="event-list">

      @foreach ($events as $event)
      <div class="event-row">
        <div class="event-date"><span class="day">{{ $event['day'] }}</span><span class="month">{{ $event['month'] }}</span></div>
        <div class="event-info">
          <h3>{{ $event['title'] }}</h3>
          <p>{{ $event['description'] }}</p>
          <div class="event-meta"><span>{{ $event['time'] }}</span><span>{{ $event['location'] }}</span><span>{{ $event['note'] }}</span></div>
        </div>
        <a href="#" class="btn-ghost event-rsvp">RSVP</a>
      </div>
      @endforeach

    </div>
  </div>
</section>

<section class="trade" id="trade-board" style="background:var(--ink-2);">
  <div class="wrap">
    <div class="trade-panel">
      <div>
        <div class="eyebrow">Community Board</div>
        <h2>The Trade Board.</h2>
        <p>A running list of what fellow collectors are hunting for. Post what you're after, or check the board before your next meetup to see who wants what you're holding.</p>
        <a href="{{ route('home') }}#membership" class="btn-primary" style="margin-top:26px; display:inline-block;">Post a Trade Request</a>
      </div>
      <div class="trade-board-list">
        @foreach ($tradeBoard as $trade)
        <div class="trade-item"><span><span class="tag-mono">{{ $trade['status'] }}</span><br><span class="want">{{ $trade['want'] }}</span></span><span class="tag-mono">{{ $trade['handle'] }}</span></div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<section class="recap" id="recap">
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">Last Time Around</div>
      <h2>From the last meetup.</h2>
    </div>
    <div class="recap-grid">
      @foreach ($recap as $photo)
      <figure>
        <img src="{{ asset('images/' . $photo['image']) }}" alt="{{ $photo['alt'] }}">
        <figcaption>{{ $photo['caption'] }}</figcaption>
      </figure>
      @endforeach
    </div>
  </div>
</section>

<section class="membership" style="padding-top:0;">
  <div class="wrap">
    <div class="member-panel" style="grid-template-columns:1fr; text-align:center; padding:70px 60px;">
      <div class="member-copy" style="max-width:640px; margin:0 auto;">
        <div class="eyebrow" style="justify-content:center;">Don't Miss The Next One</div>
        <h2>Get notified about meetups first.</h2>
        <p style="margin:0 auto 30px;">Vault members get event invites before they're posted publicly, plus early access to trade board listings.</p>
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
