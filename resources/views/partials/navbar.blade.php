<style>
  .cart-badge{
    position:absolute; top:-4px; right:-6px;
    background:#d1583c; color:#fff;
    font-family:'IBM Plex Mono',monospace; font-size:.65rem;
    min-width:16px; height:16px; border-radius:8px;
    display:flex; align-items:center; justify-content:center;
    padding:0 4px; line-height:1;
  }
  .cart-dropdown{
    position:absolute; top:calc(100% + 12px); right:0;
    width:320px; max-height:420px; overflow-y:auto;
    background:#151210; border:1px solid rgba(255,255,255,.1);
    border-radius:10px; padding:16px;
    box-shadow:0 12px 30px rgba(0,0,0,.5);
    display:none; z-index:50;
  }
  .cart-dropdown.show{ display:block; }
  .cart-dropdown .cd-empty{
    font-family:'Archivo',sans-serif; color:#8a8378; font-size:.85rem; text-align:center; padding:20px 0;
  }
  .cart-dropdown .cd-item{
    display:grid; grid-template-columns:48px 1fr auto; gap:10px; align-items:center;
    padding:10px 0; border-bottom:1px solid rgba(255,255,255,.06);
  }
  .cart-dropdown .cd-item:last-of-type{ border-bottom:none; }
  .cart-dropdown .cd-item img{ width:48px; height:48px; object-fit:cover; border-radius:6px; }
  .cart-dropdown .cd-item h4{ font-family:'Big Shoulders Display',sans-serif; font-size:.9rem; color:#fff; margin:0 0 2px; }
  .cart-dropdown .cd-item p{ font-family:'IBM Plex Mono',monospace; font-size:.68rem; color:#8a8378; margin:0 0 6px; }
  .cart-dropdown .cd-qty{ display:flex; align-items:center; gap:6px; }
  .cart-dropdown .cd-qty button{
    width:20px; height:20px; border-radius:4px; border:1px solid rgba(255,255,255,.15);
    background:transparent; color:#fff; cursor:pointer; font-size:.8rem; line-height:1;
  }
  .cart-dropdown .cd-qty span{ font-family:'IBM Plex Mono',monospace; color:#fff; font-size:.75rem; min-width:14px; text-align:center; }
  .cart-dropdown .cd-price{ font-family:'Big Shoulders Display',sans-serif; color:#fff; font-size:.85rem; text-align:right; }
  .cart-dropdown .cd-remove{
    background:none; border:none; color:#8a8378; font-family:'IBM Plex Mono',monospace;
    font-size:.65rem; cursor:pointer; padding:0; margin-top:4px;
  }
  .cart-dropdown .cd-remove:hover{ color:#d1583c; }
  .cart-dropdown .cd-footer{
    margin-top:12px; padding-top:12px; border-top:1px solid rgba(255,255,255,.1);
    display:flex; justify-content:space-between; align-items:center;
  }
  .cart-dropdown .cd-total-label{ font-family:'IBM Plex Mono',monospace; color:#8a8378; font-size:.72rem; text-transform:uppercase; }
  .cart-dropdown .cd-total-value{ font-family:'Big Shoulders Display',sans-serif; color:#fff; font-size:1.2rem; }
  .cart-dropdown .cd-checkout{
    display:block; width:100%; text-align:center;
    margin-top:14px; box-sizing:border-box;
  }
  .cart-dropdown .cd-view-all{
    display:block; text-align:center; margin-top:12px;
    font-family:'IBM Plex Mono',monospace; font-size:.72rem; color:#d1583c; text-decoration:underline;
  }
  .google-signin-btn{width:100%;min-height:48px;display:flex;align-items:center;justify-content:center;gap:10px;margin-top:12px;
    padding:13px 16px;border:1px solid rgba(255,255,255,.16);border-radius:5px;background:#fff;color:#17130f;
    font-family:'IBM Plex Mono',monospace;font-size:.78rem;cursor:pointer;}
  .google-signin-btn:hover{background:#f0ece5;}
  .google-signin-btn:disabled{opacity:.65;cursor:wait;}
  .google-mark{width:19px;height:19px;display:block;flex:none;}
  .logout-confirm-overlay{position:fixed;inset:0;z-index:10000;display:flex;align-items:center;justify-content:center;padding:20px;background:rgba(10,9,8,.78);opacity:0;visibility:hidden;pointer-events:none;transition:opacity .2s ease,visibility .2s ease;}
  .logout-confirm-overlay.active{opacity:1;visibility:visible;pointer-events:auto;}
  .logout-confirm-modal{width:min(420px,100%);padding:30px;background:#241d14;color:#fff;border:1px solid rgba(231,217,186,.34);border-radius:10px;box-shadow:0 24px 60px rgba(0,0,0,.5);text-align:center;}
  .logout-confirm-modal h2{margin:8px 0 10px;font-size:30px;}
  .logout-confirm-modal p{margin:0;color:rgba(255,255,255,.68);font-size:13px;line-height:1.6;}
  .logout-confirm-actions{display:flex;gap:10px;margin-top:24px;}
  .logout-confirm-actions button{flex:1;padding:13px;border-radius:5px;cursor:pointer;font:600 10px 'IBM Plex Mono',monospace;letter-spacing:.06em;text-transform:uppercase;}
  .logout-cancel{border:1px solid rgba(231,217,186,.25);background:transparent;color:#fff;}.logout-cancel:hover{border-color:#e0b458;color:#e0b458;}
  .logout-submit{border:1px solid #d1583c;background:#d1583c;color:#fff;}.logout-submit:hover{background:#e06b4f;}
</style>

<nav>
  <div class="navbar">
    <div class="logo">
      <img src="{{ asset('images/logo.png') }}" alt="The Vintage Sneakers logo">
      <span>The Vintage Sneakers</span>
    </div>
    <div class="nav-links">
      <a href="{{ route('home') }}#story" class="{{ request()->routeIs('home') ? 'active' : '' }}" aria-current="{{ request()->routeIs('home') ? 'page' : '' }}">About Us</a>
      <a href="{{ route('workshop') }}" class="{{ request()->routeIs('workshop') ? 'active' : '' }}" aria-current="{{ request()->routeIs('workshop') ? 'page' : '' }}">Workshop</a>
      <a href="{{ route('shop') }}" class="{{ request()->routeIs('shop') ? 'active' : '' }}" aria-current="{{ request()->routeIs('shop') ? 'page' : '' }}">Shop</a>
      <a href="{{ route('events') }}" class="{{ request()->routeIs('events') ? 'active' : '' }}" aria-current="{{ request()->routeIs('events') ? 'page' : '' }}">Meetups</a>
    </div>
    <button type="button" class="nav-menu-toggle" id="navMenuToggle" aria-label="Open navigation" aria-expanded="false" aria-controls="mobileNavMenu">
      <span></span><span></span><span></span>
    </button>
    <div class="nav-actions">
      <div class="cart-menu" id="cartMenu" style="position:relative;display:inline-flex;align-items:center;">
        <button type="button" id="cartButton" class="{{ request()->routeIs('cart') ? 'active' : '' }}" aria-label="Cart" style="background:none;border:none;cursor:pointer;display:inline-flex;align-items:center;position:relative;color:inherit;padding:6px;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="9" cy="21" r="1"></circle>
            <circle cx="20" cy="21" r="1"></circle>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
          </svg>
          <span id="cartBadge" class="cart-badge" style="display:none;">0</span>
        </button>
        <div class="cart-dropdown" id="cartDropdown" aria-hidden="true"></div>
      </div>
      <a href="{{ route('home') }}#membership" class="nav-cta" id="membershipButton">Request Access</a>
      <button type="button" id="authButton" class="nav-cta">Sign In</button>
      <div class="account-menu" id="accountMenu" style="display:none;">
        <button type="button" id="accountButton" class="nav-cta"><span class="account-avatar">A</span><span>Account</span> ▾</button>
        <div class="account-dropdown" id="accountDropdown" aria-hidden="true"></div>
      </div>
    </div>
  </div>
  <div class="mobile-nav-menu" id="mobileNavMenu" aria-hidden="true">
    <a href="{{ route('home') }}#story">About Us</a>
    <a href="{{ route('workshop') }}">Workshop</a>
    <a href="{{ route('shop') }}">Shop</a>
    <a href="{{ route('events') }}">Meetups</a>
  </div>
</nav>

<section class="auth-modal-overlay" id="authModal" aria-hidden="true">
  <div class="auth-modal" role="dialog" aria-modal="true" aria-labelledby="authModalTitle">
    <button type="button" class="auth-close" id="authClose" aria-label="Close authentication dialog">×</button>
    <div class="auth-panel">
      <div class="auth-intro">
        <div class="eyebrow">Vault Member</div>
        <h2 id="authModalTitle">Sign In</h2>
        <p>Access your account for exclusive discounts and early previews.</p>
      </div>
      <div class="auth-forms">
        <form id="loginForm" class="auth-form active" aria-hidden="false">
          <label for="loginEmail">Email</label>
          <input id="loginEmail" name="email" type="email" placeholder="Email address" required>
          <label for="loginPassword">Password</label>
          <input id="loginPassword" name="password" type="password" placeholder="Password" required>
          <button type="submit" class="btn-primary">Sign In</button>
          <button type="button" class="google-signin-btn" id="googleSignInButton">
            <svg class="google-mark" viewBox="0 0 24 24" aria-hidden="true"><path fill="#4285F4" d="M21.35 12.27c0-.68-.06-1.34-.17-1.97H12v3.73h5.24a4.48 4.48 0 0 1-1.94 2.94v2.45h3.14c1.84-1.69 2.91-4.18 2.91-7.15Z"/><path fill="#34A853" d="M12 21.67c2.63 0 4.84-.87 6.45-2.35l-3.14-2.45c-.87.58-1.98.92-3.31.92-2.54 0-4.69-1.72-5.46-4.03H3.3v2.53A9.74 9.74 0 0 0 12 21.67Z"/><path fill="#FBBC05" d="M6.54 13.76A5.85 5.85 0 0 1 6.23 12c0-.61.1-1.2.31-1.76V7.71H3.3A9.75 9.75 0 0 0 2.25 12c0 1.57.38 3.05 1.05 4.29l3.24-2.53Z"/><path fill="#EA4335" d="M12 6.21c1.43 0 2.71.49 3.72 1.45l2.79-2.79C16.84 3.31 14.63 2.33 12 2.33a9.74 9.74 0 0 0-8.7 5.38l3.24 2.53C7.31 7.93 9.46 6.21 12 6.21Z"/></svg> Continue with Google
          </button>
          <p class="form-message" aria-live="polite"></p>
          <div class="auth-footer">
            <span>New here? <button type="button" id="showSignup" class="auth-link">Create an account</button></span>
          </div>
        </form>
        <form id="signupForm" class="auth-form" aria-hidden="true">
          <label for="signupName">Full Name</label>
          <input id="signupName" name="name" type="text" placeholder="Full name" required>
          <label for="signupEmail">Email</label>
          <input id="signupEmail" name="email" type="email" placeholder="Email address" required>
          <label for="signupPassword">Password</label>
          <input id="signupPassword" name="password" type="password" placeholder="Password" required>
          <button type="submit" class="btn-primary">Create Account</button>
          <p class="form-message" aria-live="polite"></p>
          <div class="auth-footer">
            <span>Already have an account? <button type="button" id="showLogin" class="auth-link">Sign In</button></span>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<section class="logout-confirm-overlay" id="logoutConfirmOverlay" aria-hidden="true">
  <div class="logout-confirm-modal" role="dialog" aria-modal="true" aria-labelledby="logoutConfirmTitle">
    <div class="eyebrow">Vault account</div>
    <h2 id="logoutConfirmTitle">Sign out?</h2>
    <p>You will need to sign in again to access your cart and account.</p>
    <div class="logout-confirm-actions">
      <button type="button" class="logout-cancel" id="logoutCancel">Cancel</button>
      <button type="button" class="logout-submit" id="logoutSubmit">Sign Out</button>
    </div>
  </div>
</section>

<script type="module" src="{{ asset('js/firebase-init.js') }}"></script>
<script type="module">
  const navMenuToggle = document.getElementById('navMenuToggle');
  const mobileNavMenu = document.getElementById('mobileNavMenu');
  navMenuToggle?.addEventListener('click', () => {
    const isOpen = navMenuToggle.getAttribute('aria-expanded') === 'true';
    navMenuToggle.setAttribute('aria-expanded', String(!isOpen));
    navMenuToggle.setAttribute('aria-label', isOpen ? 'Open navigation' : 'Close navigation');
    mobileNavMenu?.classList.toggle('show', !isOpen);
    mobileNavMenu?.setAttribute('aria-hidden', String(isOpen));
  });
  mobileNavMenu?.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => navMenuToggle?.click());
  });

  const cartButton = document.getElementById('cartButton');
  const cartDropdown = document.getElementById('cartDropdown');
  const cartBadge = document.getElementById('cartBadge');
  const cartMenu = document.getElementById('cartMenu');

  const formatIDR = (value) => new Intl.NumberFormat('id-ID').format(value);

  const renderCartDropdown = (items) => {
    if (!items.length) {
      cartDropdown.innerHTML = `
        <div class="cd-empty">Your cart is empty.</div>
        <a href="{{ route('shop') }}" class="cd-view-all">View Catalog</a>
      `;
      return;
    }

    let total = 0;
    const rows = items.map((item) => {
      total += item.price * item.qty;
      return `
        <div class="cd-item" data-id="${item.id}">
          <img src="{{ asset('images') }}/${item.image}" alt="${item.name}">
          <div>
            <h4>${item.name}</h4>
            <p>Size ${item.size}</p>
            <div class="cd-qty">
              <button type="button" class="cd-minus" aria-label="Decrease quantity">−</button>
              <span>${item.qty}</span>
              <button type="button" class="cd-plus" aria-label="Increase quantity">+</button>
            </div>
          </div>
          <div>
            <div class="cd-price">Rp ${formatIDR(item.price * item.qty)}</div>
            <button type="button" class="cd-remove">Remove</button>
          </div>
        </div>
      `;
    }).join('');

    cartDropdown.innerHTML = `
      ${rows}
      <div class="cd-footer">
        <span class="cd-total-label">Total</span>
        <span class="cd-total-value">Rp ${formatIDR(total)}</span>
      </div>
      <button type="button" class="btn-primary cd-checkout" id="cartCheckout">Checkout</button>
    `;

    cartDropdown.querySelectorAll('.cd-item').forEach((el) => {
      const itemId = el.dataset.id;
      const item = items.find((i) => i.id === itemId);

      el.querySelector('.cd-plus').addEventListener('click', async (event) => {
        event.stopPropagation();
        await window.VintageCart.updateQty(itemId, item.qty + 1);
        refreshCartPopup();
      });

      el.querySelector('.cd-minus').addEventListener('click', async (event) => {
        event.stopPropagation();
        await window.VintageCart.updateQty(itemId, item.qty - 1);
        refreshCartPopup();
      });

      el.querySelector('.cd-remove').addEventListener('click', async (event) => {
        event.stopPropagation();
        await window.VintageCart.removeItem(itemId);
        refreshCartPopup();
      });
    });
  };

  async function refreshCartPopup() {
    const items = await window.VintageCart.getItems();
    const totalQty = items.reduce((sum, item) => sum + item.qty, 0);

    if (totalQty > 0) {
      cartBadge.textContent = totalQty;
      cartBadge.style.display = 'flex';
    } else {
      cartBadge.style.display = 'none';
    }

    renderCartDropdown(items);
  }

  // dipanggil dari halaman lain (shop.blade.php, cart.blade.php) abis nambah/ubah/hapus item
  window.refreshCartBadge = refreshCartPopup;

  cartButton?.addEventListener('click', (event) => {
    event.stopPropagation();
    const isOpen = cartDropdown.classList.contains('show');
    if (isOpen) {
      cartDropdown.classList.remove('show');
      cartDropdown.setAttribute('aria-hidden', 'true');
    } else {
      refreshCartPopup();
      cartDropdown.classList.add('show');
      cartDropdown.setAttribute('aria-hidden', 'false');
    }
  });

  document.addEventListener('click', (event) => {
    if (cartMenu && !cartMenu.contains(event.target)) {
      cartDropdown.classList.remove('show');
      cartDropdown.setAttribute('aria-hidden', 'true');
    }
  });

  window.VintageAuth.onChange((user) => {
    if (user) {
      refreshCartPopup();
    } else {
      cartBadge.style.display = 'none';
      cartDropdown.innerHTML = '';
      cartDropdown.classList.remove('show');
    }
  });
</script>
<script type="module">
  const googleSignInButton = document.getElementById('googleSignInButton');
  const googleLoginForm = document.getElementById('loginForm');
  const googleAuthModal = document.getElementById('authModal');
  googleSignInButton?.addEventListener('click', async () => {
    const message = googleLoginForm.querySelector('.form-message');
    googleSignInButton.disabled = true;
    googleSignInButton.textContent = 'Connecting...';
    message.textContent = '';
    try {
      await window.VintageAuth.signInWithGoogle();
      googleAuthModal.classList.remove('active');
      googleAuthModal.setAttribute('aria-hidden', 'true');
    } catch (error) {
      console.error(error);
      message.textContent = error.code === 'auth/popup-closed-by-user'
        ? 'Sign-in cancelled.'
        : 'Google sign-in failed. Enable the Google provider in Firebase Authentication.';
      googleSignInButton.disabled = false;
      googleSignInButton.innerHTML = '<span class="google-mark">G</span> Continue with Google';
    }
  });
</script>
<script>
  const logoutConfirmOverlay = document.getElementById('logoutConfirmOverlay');
  const logoutCancel = document.getElementById('logoutCancel');
  const logoutSubmit = document.getElementById('logoutSubmit');
  let logoutConfirmResolve;

  window.showLogoutConfirm = () => new Promise((resolve) => {
    logoutConfirmResolve = resolve;
    logoutConfirmOverlay.classList.add('active');
    logoutConfirmOverlay.setAttribute('aria-hidden', 'false');
  });

  const finishLogoutConfirm = (confirmed) => {
    logoutConfirmOverlay.classList.remove('active');
    logoutConfirmOverlay.setAttribute('aria-hidden', 'true');
    logoutConfirmResolve?.(confirmed);
    logoutConfirmResolve = null;
  };

  logoutCancel?.addEventListener('click', () => finishLogoutConfirm(false));
  logoutSubmit?.addEventListener('click', () => finishLogoutConfirm(true));
  logoutConfirmOverlay?.addEventListener('click', (event) => {
    if (event.target === logoutConfirmOverlay) finishLogoutConfirm(false);
  });
</script>
