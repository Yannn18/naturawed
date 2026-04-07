// File: public/assets/js/global.js

function closeModal() {
  // 1. Tangkap elemen modal
  const modal = document.getElementById("authmodal");

  if (modal) {
    // 2. Sembunyikan modal secara visual (tanpa reload)
    // Kita tambahkan class 'hidden' bawaan Tailwind
    modal.classList.add("hidden");
  }

  // 3. Bersihkan URL dari ?auth=show TANPA me-reload halaman
  const url = new URL(window.location);
  url.searchParams.delete("auth");

  // history.replaceState adalah kunci agar halaman tidak melompat!
  window.history.replaceState({}, document.title, url.toString());
}

function openAuthModal() {
  const modal = document.getElementById("authmodal");
  if (modal) {
    modal.classList.remove("hidden"); // Tampilkan seketika
  }

  // Ubah URL di address bar jadi ?auth=show (Opsional, agar terlihat rapi)
  const url = new URL(window.location);
  url.searchParams.set("auth", "show");
  window.history.replaceState({}, document.title, url.toString());
}
