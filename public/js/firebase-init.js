// ============================================================
// FIREBASE CONFIG — project: vintagesneakers-database
// ============================================================
const firebaseConfig = {
  apiKey: "AIzaSyC4PZYLZd_4h-jAUxetQ7wZz1Z0cz5eYKM",
  authDomain: "vintagesneakers-database.firebaseapp.com",
  projectId: "vintagesneakers-database",
  storageBucket: "vintagesneakers-database.firebasestorage.app",
  messagingSenderId: "440612533892",
  appId: "1:440612533892:web:accb6605c8fcb80595b4d1"
};

import { initializeApp } from "https://www.gstatic.com/firebasejs/10.13.0/firebase-app.js";
import {
  getAuth,
  createUserWithEmailAndPassword,
  signInWithEmailAndPassword,
  GoogleAuthProvider,
  signInWithPopup,
  signOut,
  onAuthStateChanged,
  updateProfile
} from "https://www.gstatic.com/firebasejs/10.13.0/firebase-auth.js";
import {
  getFirestore,
  doc,
  setDoc,
  getDoc,
  updateDoc,
  collection,
  getDocs,
  deleteDoc
} from "https://www.gstatic.com/firebasejs/10.13.0/firebase-firestore.js";

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const db = getFirestore(app);

window.VintageFirebase = { auth, db };
window.shopUser = null;

// list of callbacks other pages/scripts register via VintageAuth.onChange()
const listeners = [];

function notify(user) {
  listeners.forEach((cb) => {
    try { cb(user); } catch (e) { console.error(e); }
  });
}

onAuthStateChanged(auth, async (fbUser) => {
  if (!fbUser) {
    window.shopUser = null;
    notify(null);
    return;
  }
  try {
    const snap = await getDoc(doc(db, "users", fbUser.uid));
    const profile = snap.exists()
      ? snap.data()
      : { name: fbUser.displayName || fbUser.email, email: fbUser.email };
    const user = { uid: fbUser.uid, email: fbUser.email, name: profile.name };
    window.shopUser = user;
    notify(user);
  } catch (e) {
    console.error("Failed to load user profile:", e);
    const user = { uid: fbUser.uid, email: fbUser.email, name: fbUser.displayName || fbUser.email };
    window.shopUser = user;
    notify(user);
  }
});

window.VintageAuth = {
  // cb(user) is called immediately on every auth state change.
  // user is either { uid, email, name } or null when signed out.
  onChange(cb) {
    listeners.push(cb);
  },

  async signUp(name, email, password) {
    const cred = await createUserWithEmailAndPassword(auth, email, password);
    await updateProfile(cred.user, { displayName: name });
    await setDoc(doc(db, "users", cred.user.uid), {
      name,
      email,
      createdAt: new Date().toISOString()
    });
    return cred.user;
  },

  async signIn(email, password) {
    const cred = await signInWithEmailAndPassword(auth, email, password);
    return cred.user;
  },

    async signInWithGoogle() {
      const provider = new GoogleAuthProvider();
      provider.setCustomParameters({ prompt: 'select_account' });
      const cred = await signInWithPopup(auth, provider);
      await setDoc(doc(db, "users", cred.user.uid), {
        name: cred.user.displayName || cred.user.email,
        email: cred.user.email,
        updatedAt: new Date().toISOString()
      }, { merge: true });
      return cred.user;
    },

  async signOutUser() {
    await signOut(auth);
  },

  async updateName(newName) {
    const user = auth.currentUser;
    if (!user) throw new Error("Not signed in");
    await updateDoc(doc(db, "users", user.uid), { name: newName });
    await updateProfile(user, { displayName: newName });
  }
};

// ============================================================
// CART — use the same db and auth instances initialized above for sign-in.
// ============================================================
window.VintageCart = {
  // product = { id, name, price, image }, size = "42" misalnya
  // Return true on success, false on failure (for example, when signed out).
  async addItem(product, size) {
    const user = auth.currentUser;
    if (!user) {
      alert("Please sign in first to add items to your cart.");
      return false;
    }

    const itemId = `${product.id ?? product.name}-${size}`;
    const itemRef = doc(db, "carts", user.uid, "items", itemId);
    const availableStock = Number(product.stock);

    try {
      const itemSnap = await getDoc(itemRef);

      if (itemSnap.exists()) {
        if (Number.isFinite(availableStock) && itemSnap.data().qty >= availableStock) return false;
        await updateDoc(itemRef, { qty: itemSnap.data().qty + 1 });
      } else {
        await setDoc(itemRef, {
          name: product.name,
          price: product.price,
          image: product.image,
          size: size,
          stock: Number.isFinite(availableStock) ? availableStock : null,
          qty: 1
        });
      }
      return true;
    } catch (e) {
      console.error("Failed to add item to cart:", e);
      return false;
    }
  },

  // Load all items for the signed-in user's cart.
  // Return an empty array when signed out or when the cart is empty.
  async getItems() {
    const user = auth.currentUser;
    if (!user) return [];

    try {
      const itemsRef = collection(db, "carts", user.uid, "items");
      const snap = await getDocs(itemsRef);
      return snap.docs.map((d) => ({ id: d.id, ...d.data() }));
    } catch (e) {
      console.error("Failed to load cart data:", e);
      return [];
    }
  },

  // Ubah jumlah (qty) satu item. Kalau qty jadi 0 atau kurang, item dihapus.
  async updateQty(itemId, qty) {
    const user = auth.currentUser;
    if (!user) return false;

    if (qty < 1) {
      return this.removeItem(itemId);
    }

    try {
      await updateDoc(doc(db, "carts", user.uid, "items", itemId), { qty });
      return true;
    } catch (e) {
      console.error("Failed to update item quantity:", e);
      return false;
    }
  },

  // Remove one item from the cart.
  async removeItem(itemId) {
    const user = auth.currentUser;
    if (!user) return false;

    try {
      await deleteDoc(doc(db, "carts", user.uid, "items", itemId));
      return true;
    } catch (e) {
      console.error("Failed to remove item:", e);
      return false;
    }
  },

  async saveOrder(order) {
    const user = auth.currentUser;
    if (!user) return false;

    try {
      await setDoc(doc(db, "orders", user.uid, "purchases", order.transaction_id), {
        ...order,
        user_id: user.uid,
        created_at: new Date().toISOString()
      });
      return true;
    } catch (e) {
      console.error("Failed to save order:", e);
      return false;
    }
  },

  async getOrders() {
    const user = auth.currentUser;
    if (!user) return [];

    try {
      const ordersRef = collection(db, "orders", user.uid, "purchases");
      const snap = await getDocs(ordersRef);
      return snap.docs
        .map((order) => ({ id: order.id, ...order.data() }))
        .sort((first, second) => String(second.created_at || '').localeCompare(String(first.created_at || '')));
    } catch (e) {
      console.error("Failed to load order history:", e);
      return [];
    }
  }
};
