<?php
// Cek apakah user mensimulasikan konfirmasi pembayaran
$status = isset($_GET['status']) ? $_GET['status'] : 'pending';

// TAMPILAN 1: SETELAH PEMBAYARAN BERHASIL (Success State)
if ($status === 'success'): ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>.serif { font-family: 'Playfair Display', serif; }</style>
</head>
<body class="min-h-screen bg-[#f9f8f3] font-sans text-zinc-900 flex flex-col items-center justify-center p-6">
    <div class="bg-white rounded-[48px] p-16 max-w-2xl w-full text-center shadow-2xl shadow-[#2d4a22]/10 border border-zinc-100">
        <div class="w-24 h-24 bg-[#2d4a22]/10 rounded-full flex items-center justify-center mx-auto mb-10">
            <svg class="text-[#2d4a22]" width="48" height="48" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
        </div>
        
        <h1 class="text-5xl serif text-[#2d4a22] mb-6">Payment Confirmed</h1>
        <p class="text-zinc-500 text-lg leading-relaxed mb-12">
            Your booking for <span class="text-zinc-900 font-bold">Seashell Bomb</span> has been successfully processed. 
            Our concierge will contact you shortly to finalize the details.
        </p>

        <a href="index.php?page=history" class="w-full py-6 bg-[#2d4a22] text-white rounded-2xl font-bold text-xl shadow-xl hover:bg-[#1e3317] transition-all flex items-center justify-center gap-3">
            <span>Go to Booking History</span>
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
    </div>
</body>
</html>

<?php else: ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>.serif { font-family: 'Playfair Display', serif; }</style>
</head>
<body class="min-h-screen bg-[#f9f8f3] font-sans text-zinc-900">

    <?php include 'includes/header.php'; ?>

    <main class="max-w-4xl mx-auto px-6 py-16">
        <div class="flex items-center gap-4 mb-12">
            <button onclick="window.history.back()" class="p-2 hover:bg-white rounded-full transition-colors">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
            </button>
            <h1 class="text-4xl serif text-[#2d4a22]">Payment Instructions</h1>
        </div>

        <div class="space-y-8">
            <section class="bg-[#2d4a22] rounded-[32px] p-8 text-white flex items-center justify-between shadow-xl shadow-[#2d4a22]/20">
                <div class="flex items-center gap-4">
                    <svg class="opacity-70" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    <div>
                        <p class="text-xs uppercase tracking-widest opacity-70 mb-1">Complete payment within</p>
                        <p class="text-3xl font-bold font-mono">23:59:59</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-xs uppercase tracking-widest opacity-70 mb-1">Total Amount</p>
                    <p class="text-3xl font-bold">IDR 120.500.000</p>
                </div>
            </section>

            <section class="bg-white rounded-[32px] p-10 border border-zinc-100 shadow-sm">
                <h2 class="text-xl font-bold mb-8 flex items-center gap-2">
                    <svg class="text-[#2d4a22]" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    Bank Transfer Details
                </h2>

                <div class="space-y-8">
                    <div class="flex items-center justify-between p-6 bg-zinc-50 rounded-2xl border border-zinc-100">
                        <div>
                            <p class="text-[10px] text-zinc-400 font-bold uppercase tracking-widest mb-2">BANK NAME</p>
                            <p class="text-xl font-bold">Bank Central Asia (BCA)</p>
                        </div>
                        <div class="px-4 py-2 bg-white rounded font-bold text-blue-800 text-xs shadow-sm border border-zinc-100">BCA</div>
                    </div>

                    <div class="flex items-center justify-between p-6 bg-zinc-50 rounded-2xl border border-zinc-100">
                        <div>
                            <p class="text-[10px] text-zinc-400 font-bold uppercase tracking-widest mb-2">ACCOUNT NUMBER</p>
                            <p id="acc-num" class="text-2xl font-mono font-bold">8141 2163 4197</p>
                        </div>
                        <button onclick="copyToClipboard('814121634197')" class="p-3 bg-white text-[#2d4a22] rounded-xl border border-zinc-100 hover:shadow-md transition-all">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                        </button>
                    </div>
                </div>
            </section>

            <section class="bg-white rounded-[32px] p-10 border border-zinc-100 shadow-sm text-center">
                <h3 class="text-xl font-bold mb-4">Already transferred?</h3>
                <p class="text-zinc-500 mb-10 max-w-md mx-auto leading-relaxed">
                    Please click the button below after you have completed the bank transfer. 
                    Our team will verify your payment manually.
                </p>

                <form action="index.php?page=payment&status=success" method="POST">
                    <button type="submit" id="confirm-btn" class="w-full py-6 bg-[#2d4a22] text-white rounded-2xl font-bold text-xl shadow-xl hover:bg-[#1e3317] transition-all flex items-center justify-center gap-3">
                        <span>I Have Completed Payment</span>
                    </button>
                </form>
            </section>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text);
        alert('Account number copied!');
    }

    // Simulasi loading saat tombol diklik
    document.querySelector('form').onsubmit = function() {
        const btn = document.getElementById('confirm-btn');
        btn.disabled = true;
        btn.innerHTML = '<div class="w-6 h-6 border-4 border-white/30 border-t-white rounded-full animate-spin"></div><span>Verifying Payment...</span>';
    };
    </script>
</body>
</html>
<?php endif; ?>