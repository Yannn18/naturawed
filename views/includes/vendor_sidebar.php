<?php
// Ambil action saat ini dari URL untuk menentukan menu mana yang sedang aktif (menyala)
$currentAction = $_GET['action'] ?? 'vendor_dashboard';

// Fungsi bantuan untuk menentukan kelas CSS menu yang aktif
function getMenuClass($actionName, $currentAction) {
    $baseClass = "flex items-center gap-3 px-4 py-3 rounded-xl transition-colors text-sm font-medium relative ";
    if ($currentAction === $actionName) {
        // Menu Aktif: Background hijau muda, teks hijau tua pekat
        return $baseClass . "bg-[#f0f2f0] text-[#2d3e2d] font-semibold";
    } else {
        // Menu Tidak Aktif: Teks abu-abu, hover abu-abu terang
        return $baseClass . "text-gray-500 hover:bg-gray-50";
    }
}
?>

<aside class="w-64 bg-white border-r border-gray-100 flex flex-col sticky top-0 h-screen shrink-0">
    
    <div class="p-8 pb-4">
        <h1 class="text-xl font-serif font-semibold text-[#2d3e2d]">NaturaWed</h1>
        <p class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mt-1">Vendor Portal</p>
    </div>

    <nav class="flex-1 px-4 space-y-1 mt-4 overflow-y-auto hide-scrollbar">
        
        <a href="index.php?action=dashboard-vendor" class="<?= getMenuClass('dashboard-vendor', $currentAction) ?>">
            <i data-lucide="layout-dashboard" class="w-[18px] h-[18px]"></i>
            Dashboard
            <?php if($currentAction === 'vendor_dashboard'): ?>
                <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-[#2d3e2d] rounded-l-full"></div>
            <?php endif; ?>
        </a>

        <a href="index.php?action=portfolio" class="<?= getMenuClass('portfolio', $currentAction) ?>">
            <i data-lucide="briefcase" class="w-[18px] h-[18px]"></i>
            Studio Profile
            <?php if($currentAction === 'portfolio'): ?>
                <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-[#2d3e2d] rounded-l-full"></div>
            <?php endif; ?>
        </a>

        <a href="index.php?action=vendor_packages" class="<?= getMenuClass('vendor_packages', $currentAction) ?> <?= getMenuClass('vendor_add_package', $currentAction) ?>">
            <i data-lucide="package" class="w-[18px] h-[18px]"></i>
            Packages
            <?php if($currentAction === 'vendor_packages' || $currentAction === 'vendor_packages'): ?>
                <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-[#2d3e2d] rounded-l-full"></div>
            <?php endif; ?>
        </a>
        
        <div class="pt-6 mt-6 border-t border-gray-100">
            <a href="index.php?action=logout" onclick="return confirm('Apakah Anda yakin ingin keluar?')" class="flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl transition-colors text-sm font-medium">
                <i data-lucide="log-out" class="w-[18px] h-[18px]"></i>
                Logout
            </a>
        </div>
    </nav>

   <div class="p-4 mt-auto">
        <div class="bg-[#f0f2f0] p-3 rounded-2xl flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-[#2d3e2d] text-white flex items-center justify-center font-bold font-serif shadow-inner">
                <?= strtoupper(substr($_SESSION['business_name'] ?? 'V', 0, 1)) ?>
            </div>
            <div class="min-w-0">
                <h4 class="text-xs font-bold truncate text-[#2d3e2d]">
                    <?= htmlspecialchars($_SESSION['business_name'] ?? 'Vendor Studio') ?>
                </h4>
                <p class="text-[10px] text-gray-400 uppercase tracking-widest mt-0.5">Active</p>
            </div>
        </div>
    </div>
</aside>