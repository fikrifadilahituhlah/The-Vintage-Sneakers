<style>
  .cart-checkout-overlay{position:fixed;inset:0;z-index:300;display:flex;align-items:center;justify-content:center;padding:20px;background:rgba(10,9,8,.8);opacity:0;visibility:hidden;pointer-events:none;transition:opacity .2s ease,visibility .2s ease}
  .cart-checkout-overlay.active{opacity:1;visibility:visible;pointer-events:auto}
  .cart-checkout-modal{position:relative;width:min(560px,100%);max-height:calc(100vh - 40px);overflow:auto;padding:28px;background:#241d14;color:#fff;border:1px solid rgba(231,217,186,.34);border-radius:12px}
  .cart-checkout-close{position:absolute;top:12px;right:18px;border:0;background:none;color:#fff;font-size:28px;cursor:pointer}
  .cart-checkout-modal h2{font-size:36px;margin:8px 0 22px}.cart-checkout-total{display:flex;justify-content:space-between;padding-bottom:16px;margin-bottom:20px;border-bottom:1px solid rgba(231,217,186,.16);font:12px 'IBM Plex Mono',monospace;color:rgba(255,255,255,.7)}
  .cart-checkout-total strong{color:#fff;font-size:17px}.cart-checkout-field{display:block;margin-bottom:15px;color:rgba(255,255,255,.7);font:10px 'IBM Plex Mono',monospace;letter-spacing:.08em;text-transform:uppercase}.cart-checkout-field input,.cart-checkout-field select{display:block;width:100%;margin-top:7px;padding:12px;background:#17130f;border:1px solid rgba(231,217,186,.2);border-radius:5px;color:#fff;font:14px Archivo,sans-serif}.cart-checkout-field select{cursor:pointer}.cart-checkout-fields{display:grid;grid-template-columns:1fr 1fr;gap:12px}.cart-checkout-voucher{display:flex;align-items:end;gap:10px}.cart-checkout-voucher .cart-checkout-field{flex:1;margin-bottom:0}.cart-checkout-voucher button{height:40px;padding:0 13px;border:1px solid #e0b458;border-radius:5px;background:transparent;color:#e0b458;cursor:pointer;font:10px 'IBM Plex Mono',monospace;text-transform:uppercase}.cart-checkout-voucher button:hover{background:rgba(224,180,88,.12)}.cart-checkout-message{min-height:16px;margin:7px 0 12px;color:#e0b458;font:10px 'IBM Plex Mono',monospace}.cart-checkout-message.invalid{color:#d1583c}.cart-checkout-payment{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin:8px 0 20px}.cart-checkout-payment button{padding:13px 8px;border:1px solid rgba(231,217,186,.2);border-radius:5px;background:transparent;color:#fff;cursor:pointer;font:10px 'IBM Plex Mono',monospace}.cart-checkout-payment button.selected{border-color:#d1583c;background:rgba(209,88,60,.16)}.cart-checkout-gateway{display:none;margin-bottom:18px;padding:15px;background:#17130f;border:1px solid rgba(231,217,186,.2);border-radius:6px;font-size:12px;line-height:1.6}.cart-checkout-gateway.active{display:block}.cart-checkout-submit{width:100%;padding:14px;border:0;border-radius:5px;background:#d1583c;color:#fff;cursor:pointer;font:600 11px 'IBM Plex Mono',monospace;letter-spacing:.06em;text-transform:uppercase}.cart-checkout-submit:disabled{opacity:.45;cursor:not-allowed}.cart-checkout-success{display:none;text-align:center}.cart-checkout-success.active{display:block}.cart-checkout-success-mark{width:54px;height:54px;margin:0 auto 16px;border-radius:50%;display:grid;place-items:center;background:#33463a;font-size:26px}.cart-checkout-receipt{margin:20px 0;padding:18px;background:#17130f;border:1px dashed rgba(231,217,186,.3);text-align:left;font:11px/1.7 'IBM Plex Mono',monospace}.cart-checkout-receipt strong{color:#fff}.cart-checkout-receipt-total{display:flex;justify-content:space-between;margin-top:10px;padding-top:10px;border-top:1px solid rgba(231,217,186,.18);color:#fff}
  .cart-checkout-actions{display:flex;justify-content:center;gap:10px;flex-wrap:wrap;margin-bottom:4px}.cart-checkout-actions button,.cart-checkout-warranty{display:inline-flex;align-items:center;justify-content:center;box-sizing:border-box;width:210px;min-height:42px;padding:12px 16px;border:1px solid rgba(209,88,60,.7);border-radius:5px;background:rgba(209,88,60,.12);color:#fff;cursor:pointer;font:10px 'IBM Plex Mono',monospace;letter-spacing:.06em;text-transform:uppercase;text-decoration:none}.cart-checkout-actions button:hover,.cart-checkout-warranty:hover{background:rgba(209,88,60,.24)}
  @media(max-width:600px){.cart-checkout-fields,.cart-checkout-payment{grid-template-columns:1fr}}
</style>

<section class="cart-checkout-overlay" id="cartCheckoutOverlay" aria-hidden="true">
  <div class="cart-checkout-modal" role="dialog" aria-modal="true" aria-labelledby="cartCheckoutTitle">
    <button type="button" class="cart-checkout-close" id="cartCheckoutClose" aria-label="Close checkout">×</button>
    <div id="cartCheckoutFormView">
      <div class="eyebrow">Checkout</div><h2 id="cartCheckoutTitle">Complete your purchase.</h2>
      <div class="cart-checkout-total"><span>Order total</span><strong id="cartCheckoutTotal">Rp 0</strong></div>
      <label class="cart-checkout-field">Customer name<input id="cartCheckoutName" type="text" required></label>
      <label class="cart-checkout-field">WhatsApp number<input id="cartCheckoutPhone" type="tel" placeholder="08xxxxxxxxxx" required></label>
      <label class="cart-checkout-field">Shipping address<input id="cartCheckoutAddress" type="text" placeholder="Street name, house number" required></label>
      <div class="cart-checkout-fields"><label class="cart-checkout-field">City<input id="cartCheckoutCity" type="text" placeholder="City" required></label><label class="cart-checkout-field">Postal code<input id="cartCheckoutPostalCode" type="text" inputmode="numeric" placeholder="401xx" required></label></div>
      <label class="cart-checkout-field">Courier<select id="cartCheckoutCourier" required><option value="">Select a courier</option><option value="JNE">JNE</option><option value="SiCepat">SiCepat</option><option value="GoSend">GoSend</option></select></label>
      <div class="cart-checkout-voucher"><label class="cart-checkout-field">Voucher code<input id="cartCheckoutVoucher" type="text" placeholder="Example: ONGKIRGRATIS"></label><button type="button" id="cartCheckoutApplyVoucher">Apply voucher</button></div>
      <label class="cart-checkout-field">Choose discount<select id="cartCheckoutVoucherSelect"><option value="">Choose a voucher</option></select></label>
      <p class="cart-checkout-message" id="cartCheckoutMessage" aria-live="polite"></p>
      <div class="cart-checkout-field">Select a payment method</div><div class="cart-checkout-payment" id="cartCheckoutPayment"><button type="button" class="selected" data-method="QRIS">QRIS</button><button type="button" data-method="Bank Transfer">Bank Transfer</button><button type="button" data-method="Cash">Cash</button></div>
      <div class="cart-checkout-gateway" id="cartCheckoutGateway"></div><button type="button" class="cart-checkout-submit" id="cartCheckoutSubmit">Continue to Payment</button>
    </div>
    <div class="cart-checkout-success" id="cartCheckoutSuccess"><div class="cart-checkout-success-mark">✓</div><div class="eyebrow">Payment successful</div><h2>Thank you.</h2><div class="cart-checkout-receipt"><div>Transaction ID: <strong id="cartCheckoutReceiptId"></strong></div><div>Method: <strong id="cartCheckoutReceiptMethod"></strong></div><div>Voucher: <strong id="cartCheckoutReceiptVoucher"></strong></div><div class="cart-checkout-receipt-total"><span>Total paid</span><strong id="cartCheckoutReceiptTotal"></strong></div></div><div class="cart-checkout-actions"><button type="button" id="cartCheckoutPrintReceipt">View / Download Receipt</button><a class="cart-checkout-warranty" id="cartCheckoutWarrantyLink" href="#" target="_blank" rel="noopener">Open warranty card</a></div></div>
  </div>
</section>

<script type="module">
  const checkoutOverlay = document.getElementById('cartCheckoutOverlay');
  const checkoutFormView = document.getElementById('cartCheckoutFormView');
  const checkoutSuccess = document.getElementById('cartCheckoutSuccess');
  const checkoutTotal = document.getElementById('cartCheckoutTotal');
  const checkoutVoucher = document.getElementById('cartCheckoutVoucher');
  const checkoutVoucherSelect = document.getElementById('cartCheckoutVoucherSelect');
  const checkoutMessage = document.getElementById('cartCheckoutMessage');
  const checkoutGateway = document.getElementById('cartCheckoutGateway');
  const checkoutSubmit = document.getElementById('cartCheckoutSubmit');
  const checkoutPrintReceipt = document.getElementById('cartCheckoutPrintReceipt');
  const checkoutWarrantyLink = document.getElementById('cartCheckoutWarrantyLink');
  const shippingFee = 25000;

  const renderCartCheckoutVoucherOptions = () => {
    const choices = window.getAvailableVouchers ? window.getAvailableVouchers() : [];
    if (!checkoutVoucherSelect) return;
    checkoutVoucherSelect.innerHTML = `<option value="">Choose a voucher</option>${choices.map((voucher) => `<option value="${voucher.code}">${voucher.code} · ${voucher.label}</option>`).join('')}`;
  };

  const applyCartVoucherSelection = () => {
    if (!checkoutVoucherSelect || !checkoutVoucherSelect.value) return;
    checkoutVoucher.value = checkoutVoucherSelect.value;
    document.getElementById('cartCheckoutApplyVoucher')?.click();
  };
  let checkoutItems = [];
  let selectedPayment = 'QRIS';
  let paymentStarted = false;
  let promotion = { valid: false };
  let completedTransaction = {};
  const formatIDR = (value) => new Intl.NumberFormat('id-ID').format(value);

  const printCheckoutReceipt = () => {
    const receiptWindow = window.open('', '_blank', 'width=520,height=700');
    if (!receiptWindow) return;
    receiptWindow.document.write(`<!doctype html><html lang="en"><head><title>Receipt ${completedTransaction.id}</title><style>body{font:14px Arial,sans-serif;max-width:420px;margin:40px auto;color:#17130f}h1{font-size:24px;border-bottom:2px solid #17130f;padding-bottom:16px}p{line-height:1.7}.total{border-top:1px solid #999;margin-top:20px;padding-top:14px;font-weight:bold;display:flex;justify-content:space-between}</style></head><body><h1>THE VINTAGE SNEAKERS</h1><p><strong>PAYMENT SUCCESSFUL</strong></p><p>Transaction ID: ${completedTransaction.id}<br>Time: ${completedTransaction.time}<br>Method: ${completedTransaction.method}<br>Voucher: ${completedTransaction.voucher}</p><p class="total"><span>Total paid</span><span>${completedTransaction.total}</span></p><script>window.onload=()=>window.print();<\/script></body></html>`);
    receiptWindow.document.close();
  };

  checkoutPrintReceipt?.addEventListener('click', printCheckoutReceipt);

  const refreshCheckoutTotal = () => {
    const subtotal = checkoutItems.reduce((sum, item) => sum + item.price * item.qty, 0);
    promotion = window.calculatePromotion(checkoutVoucher.value, subtotal, shippingFee);
    checkoutTotal.textContent = `Rp ${formatIDR(promotion.valid ? promotion.total : subtotal + shippingFee)}`;
  };

  const openCheckout = async (event) => {
    event.preventDefault();
    checkoutItems = await window.VintageCart.getItems();
    if (!checkoutItems.length) return;
    checkoutFormView.style.display = 'block';
    checkoutSuccess.classList.remove('active');
    checkoutVoucher.value = '';
    checkoutVoucherSelect.value = '';
    checkoutMessage.textContent = '';
    paymentStarted = false;
    checkoutGateway.classList.remove('active');
    checkoutSubmit.textContent = 'Continue to Payment';
    renderCartCheckoutVoucherOptions();
    refreshCheckoutTotal();
    checkoutOverlay.classList.add('active');
    checkoutOverlay.setAttribute('aria-hidden', 'false');
  };

  checkoutVoucherSelect?.addEventListener('change', applyCartVoucherSelection);

  document.addEventListener('click', (event) => {
    if (event.target.closest('#cartCheckout')) openCheckout(event);
  });
  document.getElementById('cartCheckoutClose')?.addEventListener('click', () => { checkoutOverlay.classList.remove('active'); checkoutOverlay.setAttribute('aria-hidden', 'true'); });
  checkoutOverlay?.addEventListener('click', (event) => { if (event.target === checkoutOverlay) checkoutOverlay.classList.remove('active'); });
  document.getElementById('cartCheckoutApplyVoucher')?.addEventListener('click', async () => { await window.promotionReady; promotion = window.calculatePromotion(checkoutVoucher.value, checkoutItems.reduce((sum, item) => sum + item.price * item.qty, 0), shippingFee); checkoutMessage.textContent = promotion.valid ? `${promotion.label} applied.` : (promotion.message || 'Voucher code not found.'); checkoutMessage.classList.toggle('invalid', !promotion.valid); refreshCheckoutTotal(); });
  document.querySelectorAll('#cartCheckoutPayment button').forEach((button) => button.addEventListener('click', () => { selectedPayment = button.dataset.method; paymentStarted = false; checkoutSubmit.textContent = 'Continue to Payment'; checkoutGateway.classList.remove('active'); document.querySelectorAll('#cartCheckoutPayment button').forEach((item) => item.classList.toggle('selected', item === button)); }));

  checkoutSubmit?.addEventListener('click', async () => {
    const fields = ['cartCheckoutName', 'cartCheckoutPhone', 'cartCheckoutAddress', 'cartCheckoutCity', 'cartCheckoutPostalCode', 'cartCheckoutCourier'].map((id) => document.getElementById(id));
    if (!fields.every((field) => field.value.trim())) { fields.find((field) => !field.value.trim())?.reportValidity(); return; }
    if (!paymentStarted) { checkoutGateway.innerHTML = `<strong>${selectedPayment} Demo</strong><br>Use the total above to complete your payment.`; checkoutGateway.classList.add('active'); paymentStarted = true; checkoutSubmit.textContent = 'I Have Paid'; return; }
    await window.refreshPromotions();
    refreshCheckoutTotal();
    const total = promotion.valid ? promotion.total : checkoutItems.reduce((sum, item) => sum + item.price * item.qty, 0) + shippingFee;
    const transactionId = `TVS-${Date.now().toString().slice(-8)}`;
    const transactionTime = new Intl.DateTimeFormat('en-GB', { dateStyle: 'medium', timeStyle: 'short' }).format(new Date());
    const orderSaved = await window.VintageCart.saveOrder({ transaction_id: transactionId, customer: fields[0].value.trim(), phone: fields[1].value.trim(), shipping: { address: fields[2].value.trim(), city: fields[3].value.trim(), postal_code: fields[4].value.trim(), courier: fields[5].value }, items: checkoutItems, total, voucher: promotion.valid ? { code: promotion.code, label: promotion.label, discount: promotion.discount, cashback: promotion.cashback, shipping_discount: promotion.shippingDiscount } : null, payment_method: selectedPayment, status: 'paid' });
    if (!orderSaved) { alert('The transaction could not be saved to Firebase.'); return; }
    await Promise.all(checkoutItems.map((item) => window.VintageCart.removeItem(item.id)));
    document.getElementById('cartCheckoutReceiptId').textContent = transactionId;
    document.getElementById('cartCheckoutReceiptMethod').textContent = selectedPayment;
    document.getElementById('cartCheckoutReceiptVoucher').textContent = promotion.valid ? promotion.code : 'None';
    document.getElementById('cartCheckoutReceiptTotal').textContent = `Rp ${formatIDR(total)}`;
    completedTransaction = { id: transactionId, time: transactionTime, method: selectedPayment, voucher: promotion.valid ? promotion.code : 'None', total: `Rp ${formatIDR(total)}` };
    const warrantyProduct = checkoutItems[0];
    const warrantyUrl = new URL('{{ route("warranty.card") }}', window.location.origin);
    warrantyUrl.search = new URLSearchParams({ purchase_id: transactionId, name: warrantyProduct.name, size: warrantyProduct.size || '-', customer: fields[0].value.trim(), email: window.shopUser?.email || '' });
    checkoutWarrantyLink.href = warrantyUrl.toString();
    checkoutFormView.style.display = 'none'; checkoutSuccess.classList.add('active'); window.refreshCartBadge?.();
  });
</script>
