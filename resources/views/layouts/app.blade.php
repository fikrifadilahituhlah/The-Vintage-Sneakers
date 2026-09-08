<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'THE VINTAGE SNEAKERS')</title>
<link rel="icon" href="{{ asset('images/logo.png') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@400;500;600;700;800;900&family=Archivo:wght@300;400;500;600;700&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@hasSection('pages-css')
<link rel="stylesheet" href="{{ asset('css/pages.css') }}">
@endif
@yield('extra-head')
</head>
<body>

<div class="success-toast" id="successToast" role="status" aria-live="polite" aria-hidden="true">
  <span class="success-toast-icon" aria-hidden="true">✓</span>
  <span>Request sent successfully. Thank you!</span>
</div>

@yield('content')

@include('partials.cart-checkout')

<footer>
  <div class="wrap">
    <div class="contact-bar">
      <a href="https://wa.me/628815619987?text=Hello%20Vintage%20Sneakers%2C%20I%27d%20like%20to%20chat%20about%20your%20collection." class="contact-pill" target="_blank" rel="noopener noreferrer"><img src="{{ asset('images/icon-whatsapp.png') }}" alt="WhatsApp">Chat on WhatsApp</a>
      <a href="https://www.instagram.com/the.vintagesneakers?igsh=cGIxNDg3MHA3YTNz" class="contact-pill" target="_blank" rel="noopener noreferrer"><img src="{{ asset('images/icon-instagram.png') }}" alt="Instagram">Follow on Instagram</a>
      <a href="https://www.google.com/maps/search/?api=1&query=Jl.+Braga+No.+12,+Bandung,+Jawa+Barat" class="contact-pill" target="_blank" rel="noopener noreferrer"><img src="{{ asset('images/icon-gmaps.png') }}" alt="Google Maps">Find Us on Maps</a>
    </div>
    <div class="footer-grid">
      <div class="logo"><img src="{{ asset('images/logo.png') }}" alt="The Vintage Sneakers logo"><span>The Vintage Sneakers</span></div>
      <div class="footer-links">
        <div>
          <h5>The Brand</h5>
          <a href="{{ route('home') }}#story">About Us / Archive</a>
          <a href="{{ route('home') }}#values">The Standard</a>
          <a href="#">Journal</a>
        </div>
        <div>
          <h5>Shop &amp; Bench</h5>
          <a href="{{ route('shop') }}">Full Catalog</a>
          <a href="{{ route('workshop') }}">The Workshop</a>
          <a href="{{ route('workshop') }}#restorations">Recent Restorations</a>
        </div>
        <div>
          <h5>Community</h5>
          <a href="{{ route('events') }}">Meetups &amp; Trades</a>
          <a href="{{ route('home') }}#membership">Vault Access</a>
          <a href="#">Authenticity Guarantee</a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© 2016–2026 The Vintage Sneakers. Every pair verified by hand.</span>
      <span>Jl. Braga No. 12, Bandung, Jawa Barat</span>
    </div>
  </div>
</footer>

<script>
  const navEl = document.querySelector('nav');
  window.addEventListener('scroll', () => {
    navEl.style.padding = window.scrollY > 40 ? '12px 0' : '22px 0';
  });
</script>

@yield('scripts')

<script>
  const membershipButton = document.getElementById('membershipButton');
  if (membershipButton && window.VintageAuth?.onChange) {
    window.VintageAuth.onChange((user) => {
      membershipButton.textContent = user ? 'My Vault' : 'Request Access';
    });
  }
</script>

</body>
</html>
