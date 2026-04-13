<?php
$pageTitle = "Vendors & Packages - NaturaWed";
require_once __DIR__ . '/../includes/header.php';

// 1. Panggil Koneksi & Model untuk menarik data dari Database
global $conn; 
require_once __DIR__ . '/../../models/PackageModel.php';

$packageModel = new PackageModel($conn);
// Tarik semua paket aktif (kita beri limit besar, misal 100 paket)
$allPackages = $packageModel->getActivePackages(100); 
?>

<div class="bg-white min-h-screen">
    <section class="px-6 pt-12 pb-8 max-w-7xl mx-auto">
        <h1 class="text-4xl md:text-5xl font-serif font-bold text-[#2d4a22] mb-4">Our Curated Packages</h1>
        <p class="text-gray-600 max-w-2xl text-lg">Temukan mitra terbaik untuk hari spesial Anda, mulai dari fotografer hingga dekorator yang berkelanjutan.</p>
    </section>

    <div class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-gray-100 mb-8">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="relative w-full md:w-96">
                    <input type="text" placeholder="Search package or vendor name..." 
                        class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-[#2d4a22] focus:outline-none transition-all">
                    <span class="absolute left-3 top-3.5 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </span>
                </div>

                <div class="flex gap-3 overflow-x-auto w-full md:w-auto pb-2 md:pb-0">
                    <select class="px-4 py-2 bg-gray-50 border border-gray-200 rounded-full text-sm font-medium text-gray-700 focus:outline-none cursor-pointer">
                        <option>All Categories</option>
                        <option>Venue</option>
                        <option>Catering</option>
                        <option>Photography</option>
                        <option>Decoration</option>
                    </select>
                    <select class="px-4 py-2 bg-gray-50 border border-gray-200 rounded-full text-sm font-medium text-gray-700 focus:outline-none cursor-pointer">
                        <option>Price Range</option>
                        <option>Low - High</option>
                        <option>High - Low</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-6 pb-20">
        
        <?php if (!empty($allPackages)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <?php foreach($allPackages as $pkg): ?>
                <a href="/index.php?action=package_detail&id=<?= $pkg['id'] ?>" class="group cursor-pointer block">
                    <div class="relative aspect-[4/5] rounded-3xl overflow-hidden mb-5 bg-gray-100 shadow-sm border border-gray-50">
                        
                        <img src="<?= htmlspecialchars($pkg['main_image'] ?: 'https://picsum.photos/600/800') ?>" 
                             alt="<?= htmlspecialchars($pkg['package_name']) ?>"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                             referrerpolicy="no-referrer">
                        
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-white/95 backdrop-blur-md text-[10px] font-bold uppercase tracking-widest text-[#2d4a22] rounded-full shadow-sm">
                                <?= htmlspecialchars($pkg['category_name'] ?? 'Uncategorized') ?>
                            </span>
                        </div>
                    </div>

                    <div class="flex justify-between items-start px-1">
                        <div class="pr-4">
                            <h3 class="text-xl font-serif font-bold text-[#2d4a22] mb-1 group-hover:text-amber-700 transition-colors line-clamp-1">
                                <?= htmlspecialchars($pkg['package_name']) ?>
                            </h3>
                            <div class="flex items-center text-gray-500 text-sm">
                                <span>🌿 By <?= htmlspecialchars($pkg['business_name'] ?? 'NaturaWed Vendor') ?></span>
                            </div>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">Start from</p>
                            <p class="text-lg font-bold text-[#2d4a22]">IDR <?= number_format((float)$pkg['price'], 0, ',', '.') ?></p>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>

            </div>
        <?php else: ?>
            <div class="text-center py-20 bg-gray-50 rounded-[2.5rem] border-2 border-dashed border-gray-200">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400 shadow-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 12H4M12 4v16" stroke-width="2" stroke-linecap="round"></path></svg>
                </div>
                <h3 class="text-xl font-serif font-bold text-gray-900 mb-2">Belum Ada Paket</h3>
                <p class="text-gray-500">Para vendor sedang mempersiapkan paket-paket terbaik mereka.</p>
            </div>
        <?php endif; ?>

        <?php if (!empty($allPackages)): ?>
        <div class="mt-16 flex justify-center">
            <nav class="flex items-center space-x-2">
                <a href="#" class="p-2 text-gray-400 hover:text-[#2d4a22]"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="2"></path></svg></a>
                <a href="#" class="px-4 py-2 rounded-xl bg-[#2d4a22] text-white font-bold shadow-md">1</a>
                <a href="#" class="p-2 text-gray-400 hover:text-[#2d4a22]"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2"></path></svg></a>
            </nav>
        </div>
        <?php endif; ?>

    </main>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>