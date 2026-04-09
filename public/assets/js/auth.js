document.addEventListener("DOMContentLoaded", function () {
  // ==========================================
  // 1. LOGIKA SIGN IN
  // ==========================================
  const signinForm = document.getElementById("SignIn");
  if (signinForm) {
    signinForm.addEventListener("submit", async function (event) {
      event.preventDefault();
      const email = document.getElementById("email").value.trim();
      const password = document.getElementById("password").value.trim();
      const remember = document.getElementById("remember").checked
        ? "true"
        : "false";

      const btn = signinForm.querySelector('button[type="submit"]');
      if (btn) {
        btn.disabled = true;
        btn.innerText = "Processing...";
      }

      try {
        // PERHATIKAN: URL Tembakan diubah ke router index.php
        const response = await fetch("index.php?action=login", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: new URLSearchParams({
            email: email,
            password: password,
            remember: remember,
          }),
        });

        const hasilMentah = await response.text();
        let hasilJson = JSON.parse(hasilMentah);

        if (hasilJson.status === "success") {
          alert("Login Berhasil! Selamat datang " + hasilJson.email);
          // PERHATIKAN: Redirect menggunakan router
          // LOGIKA PEMILAHAN ROLE
          if (hasilJson.role === "vendor") {
            // Arahkan ke dashboard vendor melalui router
            window.location.href = "index.php?action=dashboard-vendor";
          } else {
            // Arahkan ke home customer seperti biasa
            window.location.href = "index.php?action=home";
          }
        } else {
          alert("Gagal: " + hasilJson.message);
          btn.disabled = false;
          btn.innerText = "Sign In";
        }
      } catch (error) {
        console.error("Detail Error:", error);
        btn.disabled = false;
        btn.innerText = "Sign In";
      }
    });
  }

  // ==========================================
  // 2. LOGIKA SIGN UP (MODIFIED FOR MULTI-ROLE)
  // ==========================================
  // Menggunakan querySelector agar bisa menangkap salah satu form yang ada
  const signUpForm =
    document.getElementById("SignUp") ||
    document.getElementById("SignUpVendor");
  if (signUpForm) {
    function validasiNama() {
      let inputNama = document.getElementById("username").value;
      if (!/^[a-zA-Z' ]+$/.test(inputNama)) {
        alert("Nama hanya boleh mengandung huruf dan tanda petik satu (')");
        return false;
      }
      return true;
    }

    function validasiPassword() {
      const pass = document.getElementById("password").value;
      const confPass = document.getElementById("confirmpassword").value;
      if (pass !== confPass) {
        alert("Password dan Confirm Password tidak cocok");
        return false;
      }
      return true;
    }

    signUpForm.addEventListener("submit", async function (event) {
      event.preventDefault();
      if (!validasiNama() || !validasiPassword()) return;

      const btn = signUpForm.querySelector('button[type="submit"]');
      if (btn) {
        btn.disabled = true;
        btn.innerText = "Registering...";
      }

      // Ambil data dasar
      const username = document.getElementById("username").value.trim();
      const email = document.getElementById("email").value.trim();
      const password = document.getElementById("password").value.trim();

      // Deteksi Role dari Input Hidden
      const roleInput = document.getElementById("role");
      const role = roleInput ? roleInput.value : "customer";

      // TENTUKAN TARGET ACTION (Sesuai fungsi terpisah di PHP)
      let actionTarget; // Gunakan 'let' karena nilainya akan diisi di dalam blok if

      if (role === "vendor") {
        actionTarget = "register_vendor";
      } else {
        actionTarget = "register";
      }

      // Susun Params secara dinamis
      const params = new URLSearchParams();
      params.append("username", username);
      params.append("email", email);
      params.append("password", password);

      // Hanya tambahkan address jika dia Vendor
      if (role === "vendor") {
        const addressField = document.getElementById("address");
        if (addressField) {
          params.append("address", addressField.value.trim());
        }
      }

      try {
        // PERBAIKAN 1: Menggunakan Backtick ( ` ) agar variabel terbaca
        // PERBAIKAN 2: Menghapus properti duplikat (username, email, dll) di luar body
        const response = await fetch(`index.php?action=${actionTarget}`, {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: params,
        });

        // Tambahkan pengecekan apakah responnya benar-benar JSON
        const textRespon = await response.text();
        console.log("Respon Mentah Server:", textRespon); // Untuk debug jika gagal lagi

        const hasil = JSON.parse(textRespon);

        if (hasil.status === "success") {
          alert("Pendaftaran Berhasil sebagai " + role + "!");
          window.location.href = "index.php?action=show_login";
        } else {
          alert("Gagal: " + hasil.message);
          if (btn) {
            btn.disabled = false;
            btn.innerText = "Sign Up";
          }
        }
      } catch (error) {
        console.error("Error detail:", error);
        alert("Terjadi kesalahan sistem. Cek konsol browser.");
        if (btn) {
          btn.disabled = false;
          btn.innerText = "Sign Up";
        }
      }
    });
  }
});
