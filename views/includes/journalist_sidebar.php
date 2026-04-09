<?php
$currentAction = $_GET['action'] ?? 'journalist_write';

function getJournalistMenuClass($actionName, $currentAction) {
    $baseClass = "flex items-center gap-3 px-4 py-3 rounded-xl transition-colors text-sm font-medium relative ";
    if ($currentAction === $actionName) {
        return $baseClass . "bg-[#f0f2f0] text-[#2d3e2d] font-semibold";
    } else {
        return $baseClass . "text-gray-500 hover:bg-gray-50";
    }
}
?>

<aside class="w-64 bg-[#fafafa] border-r border-gray-100 flex flex-col sticky top-0 h-screen shrink-0">
    
    <div class="p-8 pb-4">
        <h1 class="text-xl font-serif font-semibold text-[#2d3e2d]">
            <?= htmlspecialchars($_SESSION['user'] ?? 'Verdant Atelier') ?>
        </h1>
        <p class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mt-1">Journalist Portal</p>
    </div>

    <nav class="flex-1 px-4 space-y-1 mt-4 overflow-y-auto hide-scrollbar">
        
        <a href="index.php?action=home" class="<?= getJournalistMenuClass('home', $currentAction) ?>">
            <i data-lucide="arrow-left" class="w-[18px] h-[18px]"></i>
            Back to Home
        </a>

        <a href="index.php?action=write_article" class="<?= getJournalistMenuClass('write_article', $currentAction) ?>">
            <i data-lucide="pen-tool" class="w-[18px] h-[18px]"></i>
            Write Article
            <?php if($currentAction === 'write_article'): ?>
                <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-[#2d3e2d] rounded-l-full"></div>
            <?php endif; ?>
        </a>

        <a href="index.php?action=journalist_dashboard" class="<?= getJournalistMenuClass('journalist_dashboard', $currentAction) ?>">
            <i data-lucide="layout-grid" class="w-[18px] h-[18px]"></i>
            View Inspiration
            <?php if($currentAction === 'journalist_dashboard'): ?>
                <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-[#2d3e2d] rounded-l-full"></div>
            <?php endif; ?>
        </a>
        
        <div class="pt-6 mt-6 border-t border-gray-100">
            <a href="index.php?action=logout" onclick="return confirm('Keluar dari portal?')" class="flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl transition-colors text-sm font-medium">
                <i data-lucide="log-out" class="w-[18px] h-[18px]"></i>
                Logout
            </a>
        </div>
    </nav>
</aside>