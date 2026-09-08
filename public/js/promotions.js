import { collection, getDocs, onSnapshot } from "https://www.gstatic.com/firebasejs/10.13.0/firebase-firestore.js";

const DEFAULT_VOUCHERS = {
  ONGKIRGRATIS: {
    label: 'Free shipping up to Rp 25,000',
    type: 'shipping',
    minSpend: 1500000,
    shippingCap: 25000,
  },
  HEMAT10: {
    label: '10% off, max Rp 150,000',
    type: 'discount_rate',
    rate: 0.1,
    minSpend: 2000000,
    maxDiscount: 150000,
  },
  HEMAT150: {
    label: 'Rp 150,000 off',
    type: 'discount',
    amount: 150000,
    minSpend: 3000000,
  },
  HEMAT300: {
    label: 'Rp 300,000 off',
    type: 'discount',
    amount: 300000,
    minSpend: 5000000,
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

  const minSpend = Number(voucher.minSpend || voucher.min_amount || 0);
  if (subtotal < minSpend) {
    return {
      valid: false,
      code: normalizedCode,
      label: voucher.label,
      minSpend,
      message: `Spend at least Rp ${new Intl.NumberFormat('id-ID').format(minSpend)} to use this voucher.`,
    };
  }

  const discount = voucher.type === 'discount'
    ? Math.min(Number(voucher.amount || 0), subtotal)
    : voucher.type === 'discount_rate' || voucher.type === 'cashback'
      ? Math.min(Math.round(subtotal * Number(voucher.rate || 0)), Number(voucher.maxDiscount || Number.MAX_SAFE_INTEGER))
      : 0;
  const shippingDiscount = voucher.type === 'shipping'
    ? Math.min(shippingFee, Number(voucher.shippingCap || shippingFee))
    : 0;

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
