import { collection, getDocs, onSnapshot } from "https://www.gstatic.com/firebasejs/10.13.0/firebase-firestore.js";

const DEFAULT_VOUCHERS = {
  ONGKIRGRATIS: {
    label: 'Gratis ongkir',
    type: 'shipping',
  },
  CASHBACK10: {
    label: 'Cashback 10%',
    type: 'cashback',
    rate: 0.1,
  },
  HEMAT50: {
    label: 'Potongan Rp 50.000',
    type: 'discount',
    amount: 50000,
  },
};

let vouchers = { ...DEFAULT_VOUCHERS };
let resolvePromotionReady;
const promotionReady = new Promise((resolve) => {
  resolvePromotionReady = resolve;
});

const applyVoucherSnapshot = (snapshot) => {
  vouchers = snapshot.empty ? { ...DEFAULT_VOUCHERS } : {};
  snapshot.forEach((voucherDocument) => {
    const voucher = voucherDocument.data();
    if (voucher.active !== false) vouchers[voucherDocument.id.toUpperCase()] = voucher;
  });
  resolvePromotionReady();
};

const startPromotionListener = () => {
  const db = window.VintageFirebase?.db;
  if (!db) {
    vouchers = { ...DEFAULT_VOUCHERS };
    resolvePromotionReady();
    return;
  }

  onSnapshot(collection(db, 'promotions'), applyVoucherSnapshot, (error) => {
    console.error('Failed to load real-time vouchers:', error);
    vouchers = { ...DEFAULT_VOUCHERS };
    resolvePromotionReady();
  });
};

const refreshPromotions = async () => {
  await Promise.race([
    promotionReady,
    new Promise((resolve) => setTimeout(resolve, 3000)),
  ]);
  const db = window.VintageFirebase?.db;
  if (!db) return;
  try {
    const snapshot = await Promise.race([
      getDocs(collection(db, 'promotions')),
      new Promise((resolve) => setTimeout(() => resolve(null), 3000)),
    ]);
    if (snapshot) applyVoucherSnapshot(snapshot);
  } catch (error) {
    console.error('Failed to refresh vouchers:', error);
  }
};

export const calculatePromotion = (code, subtotal, shippingFee = 0) => {
  const normalizedCode = String(code || '').trim().toUpperCase();
  const voucher = vouchers[normalizedCode];
  if (!voucher) return { valid: false, code: normalizedCode };

  const discount = voucher.type === 'discount'
    ? Math.min(voucher.amount, subtotal)
    : voucher.type === 'cashback'
      ? Math.round(subtotal * voucher.rate)
      : 0;
  const shippingDiscount = voucher.type === 'shipping' ? shippingFee : 0;

  return {
    valid: true,
    code: normalizedCode,
    label: voucher.label,
    discount,
    cashback: voucher.type === 'cashback' ? discount : 0,
    shippingDiscount,
    total: Math.max(0, subtotal + shippingFee - discount - shippingDiscount),
  };
};

window.calculatePromotion = calculatePromotion;
window.promotionReady = promotionReady;
window.refreshPromotions = refreshPromotions;

startPromotionListener();
