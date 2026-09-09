@extends('layouts.app')

@section('title', 'The Catalog — THE VINTAGE SNEAKERS')
@section('pages-css', true)

@section('content')

@include('partials.navbar')

<header class="subhero">
  <div class="wrap">
    <div class="subhero-breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Shop</span></div>
    <div class="eyebrow">The Full Catalog</div>
    <h1>Everything<br>currently <em>in stock</em>.</h1>
    <p class="lede">Every pair below is on hand, authenticated, and ready to ship. Filter by silhouette or condition grade — once a pair sells, it comes off this page for good.</p>
  </div>
</header>

<section class="shop" id="catalog" style="padding-top:80px;">
  <div class="wrap">

    <div class="filter-bar">
      <div class="catalog-tools">
        <label class="catalog-search"><span class="filter-label">Search</span><input id="productSearch" type="search" placeholder="Search the vault..." aria-label="Search products"></label>
        <label class="catalog-sort"><span class="filter-label">Sort</span><select id="productSort" aria-label="Sort products"><option value="featured">Featured</option><option value="price-asc">Price: Low to high</option><option value="price-desc">Price: High to low</option><option value="name">Name: A to Z</option></select></label>
      </div>
      <div class="filter-group" id="typeFilters">
        <span class="filter-label">Type</span>
        <button class="filter-btn active" data-type="all">All</button>
        <button class="filter-btn" data-type="high-top">High-Top</button>
        <button class="filter-btn" data-type="low-top">Low-Top</button>
        <button class="filter-btn" data-type="premium">Premium</button>
      </div>
      <div class="filter-group" id="gradeFilters">
        <span class="filter-label">Grade</span>
        <button class="filter-btn active" data-grade="all">All</button>
        <button class="filter-btn" data-grade="ds">Deadstock</button>
        <button class="filter-btn" data-grade="vnds">VNDS</button>
      </div>
      <div class="filter-count" id="filterCount">{{ count($products) }} pairs</div>
    </div>

    <div class="shop-grid" id="shopGrid">

      @foreach ($products as $product)
      <article class="tag-card" data-type="{{ $product['type'] }}" data-grade="{{ $product['grade'] }}" data-stock="{{ $product['stock'] }}" data-index="{{ $loop->index }}" tabindex="0" role="button" aria-label="View details for {{ $product['name'] }}">
        <div class="tag-visual">
          <span class="status">{{ $product['stock'] }} available</span>
          <img src="{{ asset('images/' . $product['image']) }}" alt="{{ $product['name'] }} vintage sneaker">
        </div>
        <div class="tag-body">
          <div class="row">
            <span class="tag">{{ $product['type_label'] }}</span>
            <span class="product-rating" aria-label="Rating {{ $product['rating'] }} dari 5">
              <span aria-hidden="true">@for ($star = 1; $star <= 5; $star++)@if ($star <= $product['rating'])&#9733;@else&#9734;@endif @endfor</span>
            </span>
          </div>
          <h3>{{ $product['name'] }}</h3>
          <p>{{ $product['description'] }}</p>
          <div class="product-card-price">Rp {{ number_format($product['price'], 0, ',', '.') }}</div>
          <div class="tag-foot"><button type="button" class="view-product-btn">View File →</button></div>
        </div>
      </article>
      @endforeach

    </div>

    <div class="shop-empty" id="shopEmpty">No pairs match that combination right now — try a different filter.</div>

  </div>
</section>

<div class="product-modal-overlay" id="productModal" aria-hidden="true">
  <div class="product-modal" role="dialog" aria-modal="true" aria-labelledby="productModalTitle">
    <button type="button" class="product-modal-close" id="productModalClose" aria-label="Close product details">×</button>
    <div class="product-modal-media">
      <img id="productModalImage" src="" alt="">
    </div>
    <div class="product-modal-copy">
      <div class="eyebrow" id="productModalMeta">Vintage pair</div>
      <h2 id="productModalTitle">Product name</h2>
      <div class="product-modal-meta-row">
        <span id="productModalType">Type</span>
        <span id="productModalGrade">Grade</span>
      </div>
      <p id="productModalDescription">Product description.</p>

      <div class="product-size-block">
        <span class="product-size-label">Select size</span>
        <div class="product-size-row" id="productModalSizes"></div>
      </div>

      <div class="product-modal-footer">
        <div class="product-modal-price" id="productModalPrice">Rp 0</div>
        <div class="product-modal-actions">
          <button type="button" class="btn-secondary" id="addToCartButton">Add to Cart</button>
          <button type="button" class="btn-primary" id="buyNowButton">Buy Now</button>
        </div>
      </div>
    </div>
  </div>
</div>

<section class="login-notice-overlay" id="loginNoticeOverlay" aria-hidden="true">
  <div class="login-notice-modal" role="dialog" aria-modal="true" aria-labelledby="loginNoticeTitle">
    <button type="button" class="login-notice-close" id="loginNoticeClose" aria-label="Close login notice">×</button>
    <div class="login-notice-mark" aria-hidden="true">↗</div>
    <div class="eyebrow">Vault Member Access</div>
    <h2 id="loginNoticeTitle">Sign in to make it yours.</h2>
    <p>Log in first to add this pair to your cart or continue to checkout.</p>
    <div class="login-notice-actions">
      <button type="button" class="btn-primary" id="loginNoticeAction">Sign In Now</button>
      <button type="button" class="login-notice-dismiss" id="loginNoticeDismiss">Maybe Later</button>
    </div>
  </div>
</section>

<style>
  .login-notice-overlay{position:fixed;inset:0;z-index:400;display:flex;align-items:center;justify-content:center;padding:20px;background:rgba(10,9,8,.78);opacity:0;visibility:hidden;pointer-events:none;transition:opacity .25s ease,visibility .25s ease}
  .login-notice-overlay.active{opacity:1;visibility:visible;pointer-events:auto}
  .login-notice-modal{position:relative;width:min(460px,100%);padding:42px 38px 36px;background:#241d14;color:#fff;border:1px solid rgba(231,217,186,.34);border-radius:12px;box-shadow:0 24px 70px rgba(0,0,0,.55);text-align:center}
  .login-notice-close{position:absolute;top:14px;right:17px;width:34px;height:34px;border:1px solid rgba(231,217,186,.2);border-radius:50%;background:transparent;color:#fff;font-size:23px;line-height:1;cursor:pointer}
  .login-notice-close:hover{border-color:#d1583c;color:#d1583c}
  .login-notice-mark{width:50px;height:50px;margin:0 auto 22px;display:grid;place-items:center;border:1px solid #d1583c;border-radius:50%;color:#d1583c;font:25px 'Big Shoulders Display',sans-serif}
  .login-notice-modal h2{margin:12px auto 12px;font-size:38px;line-height:1;max-width:330px}
  .login-notice-modal p{margin:0 auto;color:rgba(255,255,255,.68);font-size:13.5px;line-height:1.65;max-width:340px}
  .login-notice-actions{display:flex;justify-content:center;align-items:center;gap:16px;margin-top:28px}
  .login-notice-actions .btn-primary{margin:0}
  .login-notice-dismiss{border:0;background:transparent;color:rgba(255,255,255,.62);font:10.5px 'IBM Plex Mono',monospace;letter-spacing:.08em;text-transform:uppercase;cursor:pointer}
  .login-notice-dismiss:hover{color:#e0b458}
  @media(max-width:600px){.login-notice-modal{padding:38px 22px 28px}.login-notice-modal h2{font-size:32px}.login-notice-actions{flex-direction:column;gap:18px}.login-notice-actions .btn-primary{width:100%}}
  @media(prefers-reduced-motion:reduce){.login-notice-overlay{transition:none}}
  .direct-checkout-overlay{position:fixed;inset:0;z-index:300;display:flex;align-items:center;justify-content:center;padding:20px;background:rgba(10,9,8,.8);opacity:0;visibility:hidden;pointer-events:none;transition:opacity .2s ease,visibility .2s ease}
  .direct-checkout-overlay.active{opacity:1;visibility:visible;pointer-events:auto}
  .direct-checkout-modal{position:relative;width:min(560px,100%);max-height:calc(100vh - 40px);overflow:auto;padding:28px;background:#241d14;color:#fff;border:1px solid rgba(231,217,186,.34);border-radius:12px}
  .direct-checkout-close{position:absolute;top:12px;right:18px;border:0;background:none;color:#fff;font-size:28px;cursor:pointer}
  .direct-checkout-modal h2{font-size:36px;margin:8px 0 22px}.direct-checkout-total{display:flex;justify-content:space-between;padding-bottom:16px;margin-bottom:20px;border-bottom:1px solid rgba(231,217,186,.16);font:12px 'IBM Plex Mono',monospace;color:rgba(255,255,255,.7)}
  .direct-checkout-total strong{color:#fff;font-size:17px}.direct-checkout-field{display:block;margin-bottom:15px;color:rgba(255,255,255,.7);font:10px 'IBM Plex Mono',monospace;letter-spacing:.08em;text-transform:uppercase}.direct-checkout-field input,.direct-checkout-field select{display:block;width:100%;margin-top:7px;padding:12px;background:#17130f;border:1px solid rgba(231,217,186,.2);border-radius:5px;color:#fff;font:14px Archivo,sans-serif}.direct-checkout-field select{cursor:pointer}.direct-checkout-fields{display:grid;grid-template-columns:1fr 1fr;gap:12px}.direct-voucher{display:flex;align-items:end;gap:10px}.direct-voucher .direct-checkout-field{flex:1;margin-bottom:0}.direct-voucher-apply{height:40px;padding:0 13px;border:1px solid #e0b458;border-radius:5px;background:transparent;color:#e0b458;cursor:pointer;font:10px 'IBM Plex Mono',monospace;text-transform:uppercase}.direct-voucher-apply:hover{background:rgba(224,180,88,.12)}.direct-voucher-message{min-height:16px;margin:7px 0 12px;color:#e0b458;font:10px 'IBM Plex Mono',monospace}.direct-voucher-message.invalid{color:#d1583c}
  .direct-payment-options{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin:8px 0 20px}.direct-payment-option{padding:13px 8px;border:1px solid rgba(231,217,186,.2);border-radius:5px;background:transparent;color:#fff;cursor:pointer;font:10px 'IBM Plex Mono',monospace}.direct-payment-option.selected{border-color:#d1583c;background:rgba(209,88,60,.16)}.direct-payment-option:disabled{opacity:.45;cursor:not-allowed}
  .direct-gateway-panel{display:none;margin-bottom:18px;padding:15px;background:#17130f;border:1px solid rgba(231,217,186,.2);border-radius:6px;font-size:12px;line-height:1.6}.direct-gateway-panel.active{display:block}.direct-gateway-panel strong{display:block;margin-bottom:4px}.direct-gateway-code{display:inline-block;margin-top:8px;padding:8px 10px;border:1px dashed #d1583c;color:#e0b458;font-family:'IBM Plex Mono',monospace}.direct-checkout-submit{width:100%;padding:14px;border:0;border-radius:5px;background:#d1583c;color:#fff;cursor:pointer;font:600 11px 'IBM Plex Mono',monospace;letter-spacing:.06em;text-transform:uppercase}.direct-checkout-submit:disabled{opacity:.45;cursor:not-allowed}.direct-payment-success{display:none;text-align:center}.direct-payment-success.active{display:block}.direct-success-mark{width:54px;height:54px;margin:0 auto 16px;border-radius:50%;display:grid;place-items:center;background:#33463a;font-size:26px}.direct-receipt{margin:20px 0;padding:20px;background:#17130f;border:1px dashed rgba(231,217,186,.3);text-align:left;font:11px/1.6 'IBM Plex Mono',monospace}.direct-receipt-head{display:flex;align-items:center;gap:10px;padding-bottom:14px;margin-bottom:12px;border-bottom:1px solid rgba(231,217,186,.16);color:#e0b458;font-size:10px;letter-spacing:.1em;text-transform:uppercase}.direct-receipt-head svg{width:18px;height:18px;flex:none}.direct-receipt-row{display:flex;justify-content:space-between;gap:18px;padding:5px 0;color:rgba(255,255,255,.62)}.direct-receipt-row strong{color:#fff;text-align:right}.direct-receipt-total{display:flex;justify-content:space-between;gap:18px;margin-top:10px;padding-top:12px;border-top:1px dashed rgba(231,217,186,.22);color:#e0b458}.direct-receipt-total strong{color:#fff;font-size:15px;text-align:right}.direct-warranty-link{display:inline-flex;align-items:center;justify-content:center;gap:9px;margin:0 0 18px;padding:12px 16px;border:1px solid rgba(209,88,60,.7);border-radius:5px;color:#fff;background:rgba(209,88,60,.12);font:11px 'IBM Plex Mono',monospace;text-decoration:none;text-transform:uppercase;letter-spacing:.06em;transition:background .2s ease,border-color .2s ease}.direct-warranty-link:hover{background:rgba(209,88,60,.25);border-color:#d1583c}.direct-warranty-link svg{width:16px;height:16px;flex:none}
  @media(max-width:600px){.direct-payment-options{grid-template-columns:1fr}}
</style>

<style>
  .direct-success-actions{display:flex;justify-content:center;gap:10px;flex-wrap:wrap;margin-bottom:18px}
  .direct-success-actions button,.direct-success-actions .direct-warranty-link{display:inline-flex;align-items:center;justify-content:center;box-sizing:border-box;width:248px;min-height:62px;margin:0;padding:12px 16px;border:1px solid rgba(209,88,60,.7);border-radius:5px;background:rgba(209,88,60,.12);color:#fff;cursor:pointer;font:10px 'IBM Plex Mono',monospace;letter-spacing:.06em;text-transform:uppercase;text-decoration:none}
  .direct-success-actions button:hover{background:rgba(209,88,60,.24)}
  .direct-success-actions .direct-warranty-link:hover{background:rgba(209,88,60,.24)}
</style>

<section class="direct-checkout-overlay" id="directCheckoutOverlay" aria-hidden="true">
  <div class="direct-checkout-modal" role="dialog" aria-modal="true" aria-labelledby="directCheckoutTitle">
    <button type="button" class="direct-checkout-close" id="directCheckoutClose" aria-label="Close checkout">×</button>
    <div id="directCheckoutForm">
      <div class="eyebrow">Buy Now</div><h2 id="directCheckoutTitle">Complete your purchase.</h2>
      <div class="direct-checkout-total"><span id="directProductName">Product</span><strong id="directCheckoutTotal">Rp 0</strong></div>
      <label class="direct-checkout-field">Customer name<input id="directCheckoutName" type="text" required></label>
      <label class="direct-checkout-field">WhatsApp number<input id="directCheckoutPhone" type="tel" placeholder="08xxxxxxxxxx" required></label>
      <label class="direct-checkout-field">Shipping address<input id="directCheckoutAddress" type="text" placeholder="Street name, house number" required></label>
      <div class="direct-checkout-fields"><label class="direct-checkout-field">City<input id="directCheckoutCity" type="text" placeholder="City" required></label><label class="direct-checkout-field">Postal code<input id="directCheckoutPostalCode" type="text" inputmode="numeric" placeholder="401xx" required></label></div>
      <label class="direct-checkout-field">Courier<select id="directCheckoutCourier" required><option value="">Select a courier</option><option value="JNE">JNE</option><option value="SiCepat">SiCepat</option><option value="GoSend">GoSend</option></select></label>
      <div class="direct-voucher"><label class="direct-checkout-field">Voucher code<input id="directVoucherCode" type="text" placeholder="Example: ONGKIRGRATIS"></label><button type="button" class="direct-voucher-apply" id="directApplyVoucher">Apply voucher</button></div>
      <label class="direct-checkout-field">Choose discount<select id="directVoucherSelect"><option value="">Choose a voucher</option></select></label>
      <p class="direct-voucher-message" id="directVoucherMessage" aria-live="polite"></p>
      <div class="direct-checkout-field">Select a payment method</div>
      <div class="direct-payment-options" id="directPaymentOptions"><button type="button" class="direct-payment-option selected" data-method="QRIS">QRIS</button><button type="button" class="direct-payment-option" data-method="Transfer Bank">Transfer Bank</button><button type="button" class="direct-payment-option" data-method="Tunai" disabled>Tunai</button></div>
      <div class="direct-gateway-panel" id="directGatewayPanel"></div>
      <button type="button" class="direct-checkout-submit" id="directConfirmPayment">Continue to Payment</button>
    </div>
    <div class="direct-payment-success" id="directPaymentSuccess"><div class="direct-success-mark">✓</div><div class="eyebrow">Payment successful</div><h2>Thank you.</h2><div class="direct-receipt"><div class="direct-receipt-head"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M6 3h12v18l-3-2-3 2-3 2V3Z"></path><path d="M9 7h6M9 11h6"></path></svg><span>Official purchase receipt</span></div><div class="direct-receipt-row"><span>Transaction ID</span><strong id="directReceiptId"></strong></div><div class="direct-receipt-row"><span>Time</span><strong id="directReceiptTime"></strong></div><div class="direct-receipt-row"><span>Product</span><strong id="directReceiptProduct"></strong></div><div class="direct-receipt-row"><span>Method</span><strong id="directReceiptMethod"></strong></div><div class="direct-receipt-total"><span>Total paid</span><strong id="directReceiptTotal"></strong></div></div><div class="direct-success-actions"><button type="button" id="directPrintReceipt">View / Download Receipt</button><a class="direct-warranty-link" id="directWarrantyLink" href="#" target="_blank" rel="noopener"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 3 19 6v5c0 4.5-2.9 7.7-7 10-4.1-2.3-7-5.5-7-10V6l7-3Z"></path><path d="m9 12 2 2 4-4"></path></svg><span>Open warranty card</span></a></div></div>
  </div>
</section>

<section class="membership" style="padding-top:0;">
  <div class="wrap">
    <div class="member-panel" style="grid-template-columns:1fr; text-align:center; padding:70px 60px;">
      <div class="member-copy" style="max-width:640px; margin:0 auto;">
        <div class="eyebrow" style="justify-content:center;">Looking For Something Specific?</div>
        <h2>Put in a sourcing request.</h2>
        <p style="margin:0 auto 30px;">Not seeing the release, size, or colorway you're after? Vault members can put in a personal sourcing request and we'll go hunt it down.</p>
        <a href="{{ route('home') }}#membership" class="btn-primary">Buy Now</a>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script type="module" src="{{ asset('js/firebase-init.js') }}"></script>
<script id="product-data" type="application/json">@json($products)</script>
<script type="module" src="{{ asset('js/promotions.js') }}"></script>
<script type="module">
  const productData = JSON.parse(document.getElementById('product-data').textContent);
  const productModal = document.getElementById('productModal');
  const productModalClose = document.getElementById('productModalClose');
  const productModalImage = document.getElementById('productModalImage');
  const productModalMeta = document.getElementById('productModalMeta');
  const productModalTitle = document.getElementById('productModalTitle');
  const productModalType = document.getElementById('productModalType');
  const productModalGrade = document.getElementById('productModalGrade');
  const productModalDescription = document.getElementById('productModalDescription');
  const productModalPrice = document.getElementById('productModalPrice');
  const productModalSizes = document.getElementById('productModalSizes');
  const addToCartButton = document.getElementById('addToCartButton');
  const buyNowButton = document.getElementById('buyNowButton');
  const directCheckoutOverlay = document.getElementById('directCheckoutOverlay');
  const loginNoticeOverlay = document.getElementById('loginNoticeOverlay');
  const loginNoticeClose = document.getElementById('loginNoticeClose');
  const loginNoticeAction = document.getElementById('loginNoticeAction');
  const loginNoticeDismiss = document.getElementById('loginNoticeDismiss');
  const directCheckoutClose = document.getElementById('directCheckoutClose');
  const directCheckoutForm = document.getElementById('directCheckoutForm');
  const directPaymentSuccess = document.getElementById('directPaymentSuccess');
  const directPrintReceipt = document.getElementById('directPrintReceipt');
  const directProductName = document.getElementById('directProductName');
  const directCheckoutTotal = document.getElementById('directCheckoutTotal');
  const directCheckoutName = document.getElementById('directCheckoutName');
  const directCheckoutPhone = document.getElementById('directCheckoutPhone');
  const directCheckoutAddress = document.getElementById('directCheckoutAddress');
  const directCheckoutCity = document.getElementById('directCheckoutCity');
  const directCheckoutPostalCode = document.getElementById('directCheckoutPostalCode');
  const directCheckoutCourier = document.getElementById('directCheckoutCourier');
  const directVoucherCode = document.getElementById('directVoucherCode');
  const directVoucherSelect = document.getElementById('directVoucherSelect');
  const directApplyVoucher = document.getElementById('directApplyVoucher');
  const directVoucherMessage = document.getElementById('directVoucherMessage');
  const directGatewayPanel = document.getElementById('directGatewayPanel');
  const directConfirmPayment = document.getElementById('directConfirmPayment');
  const directWarrantyLink = document.getElementById('directWarrantyLink');
  const normalizeCustomerName = (value) => String(value || '').replace(/\s+/g, ' ').trim().toLowerCase().replace(/\b([a-z])/g, (letter) => letter.toUpperCase());

  directCheckoutName?.addEventListener('input', () => {
    directCheckoutName.value = normalizeCustomerName(directCheckoutName.value);
  });

  const renderDirectVoucherOptions = () => {
    const choices = window.getAvailableVouchers ? window.getAvailableVouchers() : [];
    if (!directVoucherSelect) return;
    directVoucherSelect.innerHTML = `<option value="">Choose a voucher</option>${choices.map((voucher) => `<option value="${voucher.code}">${voucher.code} · ${voucher.label}</option>`).join('')}`;
  };

  const applyDirectVoucherSelection = () => {
    if (!directVoucherSelect || !directVoucherSelect.value) return;
    directVoucherCode.value = directVoucherSelect.value;
    directApplyVoucher?.click();
  };
  const printDirectReceipt = () => {
    const receiptWindow = window.open('', '_blank', 'width=520,height=700');
    if (!receiptWindow) return;
    receiptWindow.document.write(`<!doctype html><html lang="en"><head><title>Receipt ${document.getElementById('directReceiptId').textContent}</title><style>body{font:14px Arial,sans-serif;max-width:420px;margin:40px auto;color:#17130f}h1{font-size:24px;border-bottom:2px solid #17130f;padding-bottom:16px}p{line-height:1.7}.total{border-top:1px solid #999;margin-top:20px;padding-top:14px;font-weight:bold;display:flex;justify-content:space-between}</style></head><body><h1>THE VINTAGE SNEAKERS</h1><p><strong>PAYMENT SUCCESSFUL</strong></p><p>Transaction ID: ${document.getElementById('directReceiptId').textContent}<br>Time: ${document.getElementById('directReceiptTime').textContent}<br>Product: ${document.getElementById('directReceiptProduct').textContent}<br>Method: ${document.getElementById('directReceiptMethod').textContent}</p><p class="total"><span>Total paid</span><span>${document.getElementById('directReceiptTotal').textContent}</span></p><script>window.onload=()=>window.print();<\/script></body></html>`);
    receiptWindow.document.close();
  };
  directPrintReceipt?.addEventListener('click', printDirectReceipt);
  let directPaymentMethod = 'QRIS';
  let directPaymentStarted = false;
  let directSubtotal = 0;
  const directShippingFee = 25000;
  let directPromotion = { valid: false };

  const updateDirectTotal = () => {
    directPromotion = window.calculatePromotion(directVoucherCode.value, directSubtotal, directShippingFee);
    const total = directPromotion.valid ? directPromotion.total : directSubtotal + directShippingFee;
    directCheckoutTotal.textContent = `Rp ${new Intl.NumberFormat('id-ID').format(total)}`;
  };

  const defaultSizes = ['39', '40', '41', '42', '43'];
  let currentProduct = null;
  let selectedSize = null;

  const renderSizeOptions = (product) => {
    const sizes = product?.sizes || defaultSizes;
    selectedSize = sizes[0];
    productModalSizes.innerHTML = sizes.map((size) => `
      <button type="button" class="size-option ${size === selectedSize ? 'selected' : ''}" data-size="${size}">${size}</button>
    `).join('');

    productModalSizes.querySelectorAll('.size-option').forEach((button) => {
      button.addEventListener('click', () => {
        selectedSize = button.dataset.size;
        productModalSizes.querySelectorAll('.size-option').forEach((option) => {
          option.classList.toggle('selected', option.dataset.size === selectedSize);
        });
      });
    });
  };

  const openProductModal = (product) => {
    if (!product) return;
    currentProduct = product;
    productModalImage.src = `{{ asset('images') }}/${product.image}`;
    productModalImage.alt = `${product.name} vintage sneaker`;
    productModalMeta.textContent = `${product.type_label} · ${product.grade_label}`;
    productModalTitle.textContent = product.name;
    productModalType.textContent = product.type_label;
    productModalGrade.textContent = product.grade_label;
    productModalDescription.textContent = product.description;
    renderProductPrice(productModalPrice, product.price);
    renderSizeOptions(product);
    addToCartButton.textContent = 'Add to Cart';
    productModal.classList.add('active');
    productModal.setAttribute('aria-hidden', 'false');
  };

  const closeProductModal = () => {
    productModal.classList.remove('active');
    productModal.setAttribute('aria-hidden', 'true');
  };

  productModalClose?.addEventListener('click', closeProductModal);
  productModal?.addEventListener('click', (event) => {
    if (event.target === productModal) closeProductModal();
  });

  addToCartButton?.addEventListener('click', async () => {
    if (!currentProduct || !selectedSize) return;
    if (!requireLogin()) return;

    addToCartButton.disabled = true;
    addToCartButton.textContent = 'Adding...';

    const success = await window.VintageCart.addItem(currentProduct, selectedSize);
    if (success) window.refreshCartBadge?.();

    if (success) {
      addToCartButton.textContent = 'Added!';
      setTimeout(() => {
        addToCartButton.textContent = 'Add to Cart';
        addToCartButton.disabled = false;
      }, 1200);
    } else {
      addToCartButton.textContent = 'Add to Cart';
      addToCartButton.disabled = false;
    }
  });

  buyNowButton?.addEventListener('click', async () => {
    if (!currentProduct || !selectedSize) return;
    if (!requireLogin()) return;

    buyNowButton.disabled = true;
    buyNowButton.textContent = 'Opening payment...';
    directSubtotal = Number(currentProduct.price);
    directProductName.textContent = `${currentProduct.name} / Size ${selectedSize}`;
    directVoucherCode.value = '';
    directVoucherSelect.value = '';
    directVoucherMessage.textContent = '';
    directVoucherMessage.classList.remove('invalid');
    directPromotion = { valid: false };
    renderDirectVoucherOptions();
    updateDirectTotal();
    directCheckoutName.value = window.shopUser?.name || '';
    directCheckoutPhone.value = '';
    directCheckoutAddress.value = '';
    directCheckoutCity.value = '';
    directCheckoutPostalCode.value = '';
    directCheckoutCourier.value = '';
    directPaymentMethod = 'QRIS';
    directPaymentStarted = false;
    directGatewayPanel.classList.remove('active');
    directConfirmPayment.disabled = false;
    directConfirmPayment.textContent = 'Continue to Payment';
    directCheckoutForm.style.display = 'block';
    directPaymentSuccess.classList.remove('active');
    directCheckoutOverlay.classList.add('active');
    directCheckoutOverlay.setAttribute('aria-hidden', 'false');
    buyNowButton.disabled = false;
    buyNowButton.textContent = 'Buy Now';
  });

  directCheckoutClose?.addEventListener('click', () => {
    directCheckoutOverlay.classList.remove('active');
    directCheckoutOverlay.setAttribute('aria-hidden', 'true');
  });
  directVoucherSelect?.addEventListener('change', applyDirectVoucherSelection);
  document.querySelectorAll('.direct-payment-option').forEach((option) => {
    option.addEventListener('click', () => {
      directPaymentMethod = option.dataset.method;
      directPaymentStarted = false;
      directGatewayPanel.classList.remove('active');
      directConfirmPayment.textContent = 'Continue to Payment';
      document.querySelectorAll('.direct-payment-option').forEach((item) => item.classList.toggle('selected', item === option));
    });
  });

  directApplyVoucher?.addEventListener('click', async () => {
    await window.promotionReady;
    directPromotion = window.calculatePromotion(directVoucherCode.value, directSubtotal, directShippingFee);
    if (!directPromotion.valid) {
      directVoucherMessage.textContent = directPromotion.message || 'Voucher code not found.';
      directVoucherMessage.classList.add('invalid');
    } else {
      directVoucherMessage.textContent = `${directPromotion.label} applied.`;
      directVoucherMessage.classList.remove('invalid');
    }
    updateDirectTotal();
  });

  directConfirmPayment?.addEventListener('click', async () => {
    if (!directCheckoutName.value.trim() || !directCheckoutPhone.value.trim() || !directCheckoutAddress.value.trim() || !directCheckoutCity.value.trim() || !directCheckoutPostalCode.value.trim() || !directCheckoutCourier.value) {
      directCheckoutName.reportValidity();
      directCheckoutPhone.reportValidity();
      directCheckoutAddress.reportValidity();
      directCheckoutCity.reportValidity();
      directCheckoutPostalCode.reportValidity();
      directCheckoutCourier.reportValidity();
      return;
    }
    if (!directPaymentStarted) {
      directGatewayPanel.innerHTML = directPaymentMethod === 'QRIS'
        ? '<strong>QRIS Demo</strong><span>Scan kode pembayaran demo untuk melanjutkan.</span><div class="direct-gateway-code">TVS-QRIS-2026</div>'
        : '<strong>Transfer Bank Demo</strong><span>Transfer ke rekening demo berikut.</span><div class="direct-gateway-code">BCA 1234 5678 90</div>';
      directGatewayPanel.classList.add('active');
      directPaymentStarted = true;
      directConfirmPayment.textContent = 'I Have Paid';
      return;
    }
    directConfirmPayment.disabled = true;
    directConfirmPayment.textContent = 'Memproses...';
    try {
      await window.refreshPromotions();
      directPromotion = window.calculatePromotion(directVoucherCode.value, directSubtotal, directShippingFee);
      const transactionId = `TVS-${Date.now().toString().slice(-8)}`;
      const transactionTime = new Intl.DateTimeFormat('en-GB', { dateStyle: 'medium', timeStyle: 'short' }).format(new Date());
      const directTotal = directPromotion.valid ? directPromotion.total : directSubtotal + directShippingFee;
      const orderSaved = await window.VintageCart.saveOrder({
      transaction_id: transactionId,
      customer: directCheckoutName.value.trim(),
      phone: directCheckoutPhone.value.trim(),
      shipping: { address: directCheckoutAddress.value.trim(), city: directCheckoutCity.value.trim(), postal_code: directCheckoutPostalCode.value.trim(), courier: directCheckoutCourier.value },
      voucher: directPromotion.valid ? { code: directPromotion.code, label: directPromotion.label, discount: directPromotion.discount, cashback: directPromotion.cashback, shipping_discount: directPromotion.shippingDiscount } : null,
      items: [{ ...currentProduct, size: selectedSize, price: directTotal, qty: 1 }],
      total: directTotal,
      payment_method: directPaymentMethod,
      status: 'paid',
      });
      if (!orderSaved) {
        alert('The transaction could not be saved to Firebase. Make sure you are signed in and Firebase Rules allow orders to be written.');
        directConfirmPayment.disabled = false;
        directConfirmPayment.textContent = 'I Have Paid';
        return;
      }
      directCheckoutForm.style.display = 'none';
      directPaymentSuccess.classList.add('active');
      document.getElementById('directReceiptId').textContent = transactionId;
      document.getElementById('directReceiptTime').textContent = transactionTime;
      document.getElementById('directReceiptProduct').textContent = directProductName.textContent;
      document.getElementById('directReceiptMethod').textContent = directPaymentMethod;
      document.getElementById('directReceiptTotal').textContent = directCheckoutTotal.textContent;
      const warrantyUrl = new URL('{{ route("warranty.card") }}', window.location.origin);
      warrantyUrl.search = new URLSearchParams({ purchase_id: transactionId, name: currentProduct.name, size: selectedSize, customer: directCheckoutName.value.trim(), email: window.shopUser?.email || '' });
      directWarrantyLink.href = warrantyUrl.toString();
    } catch (error) {
      console.error('Checkout failed:', error);
      alert('Checkout could not be processed. Please try again.');
      directConfirmPayment.disabled = false;
      directConfirmPayment.textContent = 'I Have Paid';
      return;
    }
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && productModal?.classList.contains('active')) {
      closeProductModal();
    }
  });

  const shopCards = document.querySelectorAll('#shopGrid .tag-card');
  shopCards.forEach((card) => {
    const openFromCard = (event) => {
      if (event.target.closest('.view-product-btn')) return;
      const product = productData[Number(card.dataset.index)];
      openProductModal(product);
    };

    card.addEventListener('click', openFromCard);
    card.addEventListener('keydown', (event) => {
      if (event.key === 'Enter' || event.key === ' ') {
        event.preventDefault();
        const product = productData[Number(card.dataset.index)];
        openProductModal(product);
      }
    });

    const button = card.querySelector('.view-product-btn');
    button?.addEventListener('click', (event) => {
      event.stopPropagation();
      const product = productData[Number(card.dataset.index)];
      openProductModal(product);
    });
  });

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

  const closeLoginNotice = () => {
    loginNoticeOverlay.classList.remove('active');
    loginNoticeOverlay.setAttribute('aria-hidden', 'true');
  };

  const openLoginNotice = () => {
    loginNoticeOverlay.classList.add('active');
    loginNoticeOverlay.setAttribute('aria-hidden', 'false');
  };

  const requireLogin = () => {
    if (window.shopUser) return true;
    openLoginNotice();
    return false;
  };

  showSignupButton?.addEventListener('click', showSignup);
  showLoginButton?.addEventListener('click', showLogin);
  loginNoticeClose?.addEventListener('click', closeLoginNotice);
  loginNoticeDismiss?.addEventListener('click', closeLoginNotice);
  loginNoticeAction?.addEventListener('click', () => {
    closeLoginNotice();
    openAuthModal();
    showLogin();
  });
  loginNoticeOverlay?.addEventListener('click', (event) => {
    if (event.target === loginNoticeOverlay) closeLoginNotice();
  });

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

  // ---- Shop filtering ----
  const shopGrid = document.getElementById('shopGrid');
  const cards = Array.from(document.querySelectorAll('#shopGrid .tag-card'));
  const typeButtons = document.querySelectorAll('#typeFilters .filter-btn');
  const gradeButtons = document.querySelectorAll('#gradeFilters .filter-btn');
  const countEl = document.getElementById('filterCount');
  const emptyEl = document.getElementById('shopEmpty');
  const productSearch = document.getElementById('productSearch');
  const productSort = document.getElementById('productSort');

  let activeType = 'all';
  let activeGrade = 'all';
  let searchTerm = '';

  function applyFilters(){
    const sortedCards = [...cards].sort((firstCard, secondCard) => {
      const first = productData[Number(firstCard.dataset.index)];
      const second = productData[Number(secondCard.dataset.index)];
      if (productSort.value === 'price-asc') return first.price - second.price;
      if (productSort.value === 'price-desc') return second.price - first.price;
      if (productSort.value === 'name') return first.name.localeCompare(second.name);
      return Number(firstCard.dataset.index) - Number(secondCard.dataset.index);
    });
    sortedCards.forEach((card) => shopGrid.appendChild(card));

    let visible = 0;
    cards.forEach(card => {
      const product = productData[Number(card.dataset.index)];
      const matchesType = activeType === 'all' || card.dataset.type === activeType;
      const matchesGrade = activeGrade === 'all' || card.dataset.grade === activeGrade;
      const matchesSearch = !searchTerm || product.name.toLowerCase().includes(searchTerm);
      const show = matchesType && matchesGrade && matchesSearch;
      card.classList.toggle('hidden', !show);
      if(show) visible++;
    });
    countEl.textContent = `${visible} pair${visible === 1 ? '' : 's'}`;
    emptyEl.classList.toggle('show', visible === 0);
  }

  typeButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      typeButtons.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      activeType = btn.dataset.type;
      applyFilters();
    });
  });

  gradeButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      gradeButtons.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      activeGrade = btn.dataset.grade;
      applyFilters();
    });
  });

  productSearch?.addEventListener('input', () => {
    searchTerm = productSearch.value.trim().toLowerCase();
    applyFilters();
  });
  productSort?.addEventListener('change', applyFilters);
  applyFilters();

  const priceEls = Array.from(document.querySelectorAll('.product-card-price'));
  const formatIDR = (value) => new Intl.NumberFormat('id-ID').format(value);
  const renderProductPrice = (element, price) => {
    element.textContent = `Rp ${formatIDR(price)}`;
  };

  const refreshProductPrices = () => {
    priceEls.forEach((el) => renderProductPrice(el, el.textContent.replace(/[^0-9]/g, '')));
    if (currentProduct && productModal.classList.contains('active')) {
      renderProductPrice(productModalPrice, currentProduct.price);
    }
  };

  // Reflects Firebase login state (fires immediately, then on every login/logout)
  window.VintageAuth.onChange((user) => {
    window.shopUser = user;
    refreshProductPrices();
  });
</script>
@endsection
