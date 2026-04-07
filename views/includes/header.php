<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= isset($pageTitle) ? $pageTitle : 'NaturaWed' ?></title>
    <link rel="stylesheet" href="/assets/css/output.css" />
  </head>
  <body class="bg-white font-sans text-gray-900 overflow-x-hidden">
    
<?php

// Ambil status dari session dan URL
$isAuthenticated = isset($_SESSION['user']);
$currentAction = $_GET['action'] ?? 'home';

// CSS Classes
$activeClass = 'relative font-bold text-[#2d4a22] after:absolute after:-bottom-1 after:left-0 after:h-0.5 after:w-full after:bg-[#2d4a22] pb-1';
$inactiveClass = 'font-semibold text-zinc-400 hover:text-[#2d4a22] transition-colors';

// Helper untuk proteksi (handleProtectedAction)
function getProtectedRoute($path, $isAuth) {
    if (!$isAuth) {
       
       return "javascript:openAuthModal()";
    }
    return "index.php?action=$path";
}
include 'authmodal.php'; // Modal Login/Signup
?>



<header class="sticky top-0 z-50 w-full bg-white/80 backdrop-blur-md border-b border-zinc-100 h-20">
    <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-between">
        
        <div class="flex items-center space-x-12">
            <div class="flex items-center space-x-4">
                <?php if ($currentAction === 'package_detail'): ?>
                    <a href="javascript:history.back()" class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-50 text-gray-600 hover:bg-gray-100 transition-colors">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
                    </a>
                <?php endif; ?>
                
                <a href="index.php?action=home" class="text-2xl font-serif font-bold text-[#2d4a22] tracking-tight hover:opacity-70 transition-opacity">
                    NaturaWed
                </a>
            </div>
            
            <nav class="hidden md:flex items-center space-x-8">
                <a href="index.php?action=home" class="text-[11px] tracking-[0.15em] uppercase <?= ($currentAction == 'home') ? $activeClass : $inactiveClass ?>">Home</a>
                <a href="index.php?action=vendors" class="text-[11px] tracking-[0.15em] uppercase <?= ($currentAction == 'vendors' || $currentAction == 'package_detail') ? $activeClass : $inactiveClass ?>">Vendors</a>
                <a href="index.php?action=inspiration" class="text-[11px] tracking-[0.15em] uppercase <?= ($currentAction == 'inspiration') ? $activeClass : $inactiveClass ?>">Inspiration</a>
                <a href="#" class="text-[11px] tracking-[0.15em] uppercase <?= $inactiveClass ?>">About</a>
            </nav>
        </div>

        <div class="flex items-center space-x-6 text-zinc-400">
            
            <a href="<?= getProtectedRoute('notifications', $isAuthenticated) ?>" class="hover:text-[#2d4a22] transition-colors">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
                </svg>
            </a>

            <a href="<?= getProtectedRoute('bookmarks', $isAuthenticated) ?>" class="hover:text-[#2d4a22] transition-colors">
              
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"/>
                </svg>
            </a>
                 
            <a href="<?= getProtectedRoute('chat', $isAuthenticated) ?>" class="hover:text-[#2d4a22] transition-colors <?= ($currentAction == 'chat') ? 'text-[#2d4a22]' : '' ?>">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
            </a>

            <div class="h-8 w-px bg-zinc-100 mx-2"></div>

            <?php if ($isAuthenticated): ?>
                <a href="index.php?action=logout" class="flex items-center gap-2 text-zinc-400 hover:text-red-600 transition-colors">
                    <span class="text-[10px] font-bold tracking-widest uppercase">Logout</span>
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                </a>
            <?php else: ?>
                <a href="javascript:openAuthModal()" class="flex items-center gap-2 text-zinc-400 hover:text-[#2d4a22] transition-colors">
                    <span class="text-[10px] font-bold tracking-widest uppercase">Login</span>
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24">
                        <path d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </a>
            <?php endif; ?>

        </div>
    </div>
</header>

  
</body>