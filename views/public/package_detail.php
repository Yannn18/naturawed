<?php

$pageTitle = "Package Detail - NaturaWed";
require_once __DIR__ . '/../includes/header.php';

// Cek apakah data paket berhasil dikirim dari Controller
if (!isset($packageData)) {
    echo "<h1>Error: Data paket tidak dimuat.</h1>";
    exit;
}

// Format harga jadi Rupiah (misal: 25000000 jadi 25.000.000)
$formattedPrice = number_format($packageData['price'], 0, ',', '.');
?>

<div class="min-h-screen bg-white font-sans text-[#333]">
    <style>
        .clip-path-triangle { clip-path: polygon(50% 0%, 0% 100%, 100% 100%); }
        .icon-size { width: 20px; height: 20px; }
    </style>


    <main class="mx-auto max-w-7xl px-6 py-10 lg:px-12">
        <section class="relative mb-16 overflow-hidden rounded-[40px] bg-[#3a4d32]">
            <div class="relative h-[600px] w-full">
                <img src="<?= htmlspecialchars($packageData['main_image'] ?? 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=2069') ?>" class="h-full w-full object-cover opacity-60">
                <div class="absolute inset-0 flex flex-col justify-end p-12 text-white">
                    <h1 class="text-7xl font-serif font-light tracking-tight"><?= htmlspecialchars($packageData['package_name']) ?></h1>
                    <p class="mt-4 text-sm font-semibold tracking-[0.3em] uppercase opacity-80"><?= htmlspecialchars($packageData['category_name']) ?> EXPERIENCE</p>
                </div>
            </div>
        </section>

        <div class="flex flex-col gap-12 lg:flex-row">
            <div class="flex-1">
                <div class="mb-12 flex items-center justify-between rounded-3xl bg-[#f8f9f5] p-6">
                    <div class="flex items-center space-x-4">
                        <div class="relative h-14 w-14 overflow-hidden rounded-full border-2 border-white shadow-sm bg-gray-200">
                            <img src="https://picsum.photos/seed/vendor<?= $packageData['vendor_id'] ?>/100/100" alt="Designer">
                            <div class="absolute bottom-0 right-0 h-3 w-3 rounded-full border-2 border-white bg-green-500"></div>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-400">Designed by</p>
                            <h3 class="text-xl font-bold text-[#2d4a22]"><?= htmlspecialchars($packageData['vendor_name']) ?></h3>
                        </div>
                    </div>
                </div>

                <section class="mb-16">
                    <h2 class="mb-6 text-3xl font-bold text-gray-900">Description</h2>
                    <div class="space-y-6 text-lg leading-relaxed text-gray-600">
                        <p><?= nl2br(htmlspecialchars($packageData['description'])) ?></p>
                    </div>
                </section>

                <section class="mb-16">
                    <h2 class="mb-8 text-3xl font-bold text-gray-900">Package Features</h2>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <?php 
                        // Karena features disimpan sebagai teks biasa, kita pecah berdasarkan koma (atau tampilkan langsung)
                        $featuresText = htmlspecialchars($packageData['features'] ?? '');
                        if (!empty($featuresText)): 
                            // Misal fitur dipisah koma saat input
                            $featuresList = explode(',', $featuresText);
                            foreach($featuresList as $f): 
                                $f = trim($f);
                                if(empty($f)) continue;
                        ?>
                        <div class="rounded-3xl bg-[#f3f4f0] p-8 transition-transform hover:-translate-y-1">
                            <h4 class="mb-2 text-xl font-bold text-gray-900">Included Feature</h4>
                            <p class="text-sm text-gray-500"><?= $f ?></p>
                        </div>
                        <?php 
                            endforeach; 
                        else: ?>
                             <p class="text-sm text-gray-500">Fitur belum ditambahkan oleh vendor.</p>
                        <?php endif; ?>
                    </div>
                </section>
            </div>

            <aside class="lg:w-[400px]">
                <div class="sticky top-32 rounded-[40px] bg-white p-8 shadow-2xl shadow-gray-200/50 border border-gray-50">
                    <div class="mb-8 flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-bold tracking-widest text-gray-400">STARTING FROM</p>
                            <div class="flex items-baseline space-x-1">
                                <span class="text-4xl font-bold text-gray-900">Rp <?= $formattedPrice ?></span>
                            </div>
                        </div>
                        <div class="rounded-full bg-[#e8f0e5] px-4 py-1.5 text-[10px] font-bold tracking-widest text-[#2d4a22]">TOP RATED</div>
                    </div>

                    <div class="space-y-6">
                        
                        <button
                        onclick="window.location.href='index.php?action=checkout&package_id=<?= $packageData['id'] ?>'"
                        class="w-full rounded-2xl bg-[#3a4d32] py-5 text-lg font-bold text-white shadow-lg transition-all hover:scale-[1.02] active:scale-95">
                            Book this Package
                        </button>
                        <p class="text-center text-[10px] font-medium text-gray-400">Response time: Usually under 24 hours</p>
                    </div>
                </div>
            </aside>
        </div>
    </main>

    <footer class="bg-[#1a2616] px-12 py-20 text-white mt-20">
        <div class="mx-auto max-w-7xl grid grid-cols-1 md:grid-cols-4 gap-16">
            <div>
                <h3 class="mb-6 text-xl font-bold text-[#f3f4f0]">NaturaWed</h3>
                <p class="text-sm opacity-60">Crafting timeless moments with sustainable luxury.</p>
            </div>
            </div>
        <div class="mt-20 border-t border-white/10 pt-8 text-center text-[10px] opacity-40">
            © 2026 NaturaWed. Crafted for Timeless Moments.
        </div>
    </footer>
</div>

<?php
// Memanggil komponen Footer
require_once __DIR__ . '/../includes/footer.php';
?>