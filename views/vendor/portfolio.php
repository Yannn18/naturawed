<?php 
$pageTitle = "Portfolio - NaturaWed";
require_once __DIR__ . '/../includes/components.php'; 

// DUMMY DATA GALERI (Nantinya tarik dari database)
$galleries = [
    "https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=600&q=80",
    "https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=600&q=80",
    "https://images.unsplash.com/photo-1510076857177-7470076d4098?auto=format&fit=crop&w=600&q=80"
];
?>

<main class="flex-1 flex flex-col overflow-y-auto bg-[#f8f9fa]">
    <header class="h-20 px-12 flex items-center justify-between sticky top-0 bg-white/80 backdrop-blur-md z-10 border-b border-gray-100">
        <h2 class="text-xl font-serif italic text-[#2d3e2d]">Portfolio Studio</h2>
    </header>

    <div class="px-12 py-10 w-full">
        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-50 mb-10 flex items-center justify-between">
            <div>
                <h3 class="text-2xl font-serif text-[#2d3e2d] mb-1">Visual Gallery</h3>
                <p class="text-gray-500 text-sm">Upload high-quality images to inspire your future clients.</p>
            </div>
            <form action="/index.php?action=upload_portfolio" method="POST" enctype="multipart/form-data" class="flex gap-4 items-center">
                <input type="file" name="portfolio_image" required class="text-sm file:mr-4 file:py-2.5 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#e1f5e1] file:text-[#2d3e2d] hover:file:bg-[#c8e6c9] cursor-pointer">
                <?= ButtonPrimary('Upload Image', 'submit') ?>
            </form>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php foreach ($galleries as $img): ?>
                <div class="group relative aspect-[4/5] rounded-3xl overflow-hidden shadow-sm bg-gray-200">
                    <img src="<?= $img ?>" alt="Portfolio Item" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <button onclick="confirm('Hapus foto ini?')" class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white hover:bg-red-500 transition-colors">
                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>