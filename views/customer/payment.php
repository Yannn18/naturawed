<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Instructions - Naturawed</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style>
        .serif { font-family: 'Times New Roman', serif; }
        @keyframes spin { to { transform: rotate(360deg); } }
        .animate-spin { animation: spin 1s linear infinite; }
    </style>
</head>
<body class="min-h-screen bg-[#f9f8f3] font-sans text-zinc-900">

    <?php include __DIR__ . '/../includes/header.php'; ?>


    <main id="main-content" class="max-w-4xl mx-auto px-6 py-16">
        <div id="payment-instructions">
            <div class="flex items-center gap-4 mb-12">
                <a href="javascript:history.back()" class="p-2 hover:bg-white rounded-full transition-colors">
                    ←
                </a>
                <h1 class="text-4xl serif text-[#2d4a22]">Payment Instructions</h1>
            </div>

            <div class="space-y-8">
                <section class="bg-[#2d4a22] rounded-[32px] p-8 text-white flex items-center justify-between shadow-xl shadow-[#2d4a22]/20">
                    <div class="flex items-center gap-4">
                        <span class="text-3xl opacity-70">🕒</span>
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
                        <span class="text-[#2d4a22]">🛡️</span>
                        Bank Transfer Details
                    </h2>

                    <div class="space-y-8">
                        <div class="flex items-center justify-between p-6 bg-zinc-50 rounded-2xl border border-zinc-100">
                            <div>
                                <p class="text-[10px] text-zinc-400 font-bold uppercase tracking-widest mb-2">BANK NAME</p>
                                <p class="text-xl font-bold">Bank Central Asia (BCA)</p>
                            </div>
                            <div class="w-16 h-10 bg-white rounded flex items-center justify-center font-bold text-blue-800 text-xs shadow-sm border border-zinc-100">BCA</div>
                        </div>

                        <div class="flex items-center justify-between p-6 bg-zinc-50 rounded-2xl border border-zinc-100">
                            <div>
                                <p class="text-[10px] text-zinc-400 font-bold uppercase tracking-widest mb-2">ACCOUNT NUMBER</p>
                                <p id="account-number" class="text-2xl font-mono font-bold">8141 2163 4197</p>
                            </div>
                            <button onclick="copyToClipboard()" class="p-3 bg-white text-[#2d4a22] rounded-xl shadow-sm hover:shadow-md transition-all border border-zinc-100">
                                📋
                            </button>
                        </div>
                    </div>
                </section>

                <section class="bg-white rounded-[32px] p-10 border border-zinc-100 shadow-sm text-center">
                    <h3 class="text-xl font-bold mb-4">Already transferred?</h3>
                    <p class="text-zinc-500 mb-10 max-w-md mx-auto leading-relaxed">
                        Please click the button below after you have completed the bank transfer. 
                    </p>

                    <button 
                        id="confirm-btn"
                        onclick="handleConfirmPayment()"
                        class="w-full py-6 bg-[#2d4a22] text-white rounded-2xl font-bold text-xl shadow-xl hover:bg-[#1e3317] transition-all flex items-center justify-center gap-3"
                    >
                        <span id="btn-text">I Have Completed Payment</span>
                        <div id="loader" class="hidden w-6 h-6 border-4 border-white/30 border-t-white rounded-full animate-spin"></div>
                    </button>
                </section>
            </div>
        </div>

        <div id="success-message" class="hidden flex flex-col items-center justify-center text-center py-20">
            <div class="bg-white rounded-[48px] p-16 max-w-2xl w-full shadow-2xl border border-zinc-100">
                <div class="w-24 h-24 bg-[#2d4a22]/10 rounded-full flex items-center justify-center mx-auto mb-10">
                    <span class="text-4xl text-[#2d4a22]">✅</span>
                </div>
                <h1 class="text-5xl serif text-[#2d4a22] mb-6">Payment Confirmed</h1>
                <p class="text-zinc-500 text-lg mb-12">
                    Your booking for <span class="text-zinc-900 font-bold">Seashell Bomb</span> has been processed.
                </p>
                <a href="index.php?action=history" class="w-full inline-block py-6 bg-[#2d4a22] text-white rounded-2xl font-bold text-xl hover:bg-[#1e3317] transition-all">
                    Go to Booking History →
                </a>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>

    <script>
        function copyToClipboard() {
            const accNum = document.getElementById('account-number').innerText;
            navigator.clipboard.writeText(accNum);
            alert("Account Number Copied!");
        }

        function handleConfirmPayment() {
            const btn = document.getElementById('confirm-btn');
            const btnText = document.getElementById('btn-text');
            const loader = document.getElementById('loader');
            const instructions = document.getElementById('payment-instructions');
            const success = document.getElementById('success-message');

            // Start "Confirming" state
            btn.disabled = true;
            btnText.innerText = "Verifying Payment...";
            loader.classList.remove('hidden');

            // Simulate Verification (2 seconds)
            setTimeout(() => {
                instructions.classList.add('hidden');
                success.classList.remove('hidden');
                window.scrollTo(0, 0);
            }, 2000);
        }
    </script>
</body>
</html>