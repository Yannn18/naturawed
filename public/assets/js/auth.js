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
          alert("Login Berhasil! Selamat datang " + hasilJson.username);
          // PERHATIKAN: Redirect menggunakan router
          window.location.href = "index.php?action=home";
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
  // 2. LOGIKA SIGN UP
  // ==========================================
  const signUpForm = document.getElementById("SignUp");
  if (signUpForm) {
    // Fungsi validasi diletakkan di dalam scope ini agar rapi
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

      const username = document.getElementById("username").value.trim();
      const email = document.getElementById("email").value.trim();
      const password = document.getElementById("password").value.trim();

      try {
        // PERHATIKAN: URL Tembakan diubah ke router index.php
        const response = await fetch("index.php?action=register", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: new URLSearchParams({
            username: username,
            email: email,
            password: password,
          }),
        });

        const hasil = await response.json();

        if (hasil.status === "success") {
          alert("Pendaftaran Berhasil! Selamat datang, " + hasil.username);
          // PERBAIKAN LOGIKA: Karena AuthController->register() sudah mengeset $_SESSION['login'] = true,
          // pengguna tidak perlu disuruh login ulang. Langsung tembak ke dashboard!
          window.location.href = "index.php?action=show_login";
        } else {
          alert("Gagal: " + hasil.message);
          btn.disabled = false;
          btn.innerText = "Sign Up";
        }
      } catch (error) {
        console.error("Error detail:", error);
        btn.disabled = false;
        btn.innerText = "Sign Up";
      }
    });
  }
});
