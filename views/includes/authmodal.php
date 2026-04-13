<?php
// Cek apakah modal harus ditampilkan berdasarkan parameter URL
$show_modal = isset($_GET['auth']) && $_GET['auth'] === 'show' && !isset($_SESSION['user']);

if (isset($_SESSION['user'])) return;


$is_open = (isset($_GET['auth']) && $_GET['auth'] === 'show');
$display_class = $is_open ? '' : 'hidden'; 
?>

<div id="authmodal" class="<?= $display_class ?> fixed inset-0 z-[9999] flex items-center justify-center">
    
    <div onclick="closeModal()" class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity duration-300"></div>
    
    <div class="relative w-full max-w-md overflow-hidden rounded-[40px] bg-white p-12 shadow-2xl transform transition-all duration-300 scale-100 opacity-100 mx-4">
        
        <button onclick="closeModal()" class="absolute right-8 top-8 p-2 text-zinc-400 hover:text-[#2d4a22] transition-colors">
            <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>

        <div class="text-center">
            <div class="mx-auto mb-8 flex h-20 w-20 items-center justify-center rounded-full bg-[#2d4a22]/10 text-[#2d4a22]">
                <svg style="width: 40px; height: 40px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            
            <h2 class="mb-4 text-3xl font-serif font-bold text-[#2d4a22]">Join NaturaWed</h2>
            <p class="mb-10 text-zinc-500 leading-relaxed text-sm">
                Sign in to access your bookings, chat with vendors, and save your favorite inspirations.
            </p>

            <div class="space-y-4">
                <a href="index.php?action=show_login" 
                   class="flex w-full items-center justify-center gap-3 rounded-2xl bg-[#2d4a22] py-5 text-lg font-bold text-white shadow-xl transition-all hover:bg-[#1e3317] active:scale-95">
                    <span>Sign In</span>
                </a>
                
                <a href="index.php?action=show_register" 
                   class="flex w-full items-center justify-center gap-3 rounded-2xl border-2 border-[#2d4a22] py-5 text-lg font-bold text-[#2d4a22] transition-all hover:bg-[#2d4a22]/5 active:scale-95">
                    <span>Create Account</span>
                </a>
            </div>

            <p class="mt-8 text-[10px] text-zinc-400 uppercase tracking-widest font-bold">
                Eco-friendly weddings start here
            </p>
        </div>
    </div>
</div>
