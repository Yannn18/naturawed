<?php
$pageTitle = "Vendors - NaturaWed";
require_once __DIR__ . '/includes/header.php';

// Dummy Data untuk Vendor
$all_vendors = [
    [
        "name" => "Emerald Luxe Floristry",
        "category" => "Master Florist",
        "location" => "Cotswolds, UK",
        "price" => "£2,400",
        "image" => "https://images.unsplash.com/photo-1526047932273-341f2a7631f9?q=80&w=1780&auto=format&fit=crop"
       
    ],
    [
        "name" => "The Grain & Grace",
        "category" => "Film Photography",
        "location" => "London, UK",
        "price" => "£3,800",
        "image" => "https://images.unsplash.com/photo-1542038784456-1ea8e935640e?q=80&w=2070&auto=format&fit=crop"
    ],
    [
        "name" => "Stonehaven Manor",
        "category" => "Exclusive Venue",
        "location" => "Somerset, UK",
        "price" => "£12,000",
        "image" => "https://images.unsplash.com/photo-1519167758481-83f550bb49b3?q=80&w=2074&auto=format&fit=crop"
    ],
    [
        "name" => "Wild & Rooted",
        "category" => "Artisanal Catering",
        "location" => "Brighton, UK",
        "price" => "£95/pp",
        "image" => "https://images.unsplash.com/photo-1555244162-803834f70033?q=80&w=2070&auto=format&fit=crop"
    ]
];
?>

<div class="bg-white min-h-screen">
    <section class="px-6 pt-12 pb-8 max-w-7xl mx-auto">
        <h1 class="text-4xl md:text-5xl font-serif font-bold text-[#2d4a22] mb-4">Our Curated Vendors</h1>
        <p class="text-gray-600 max-w-2xl text-lg">Temukan mitra terbaik untuk hari spesial Anda, mulai dari fotografer hingga dekorator bunga yang berkelanjutan.</p>
    </section>

    <div class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-gray-100 mb-8">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="relative w-full md:w-96">
                    <input type="text" placeholder="Search vendor name..." 
                        class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-[#2d4a22] focus:outline-none transition-all">
                    <span class="absolute left-3 top-3.5 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </span>
                </div>

                <div class="flex gap-3 overflow-x-auto w-full md:w-auto pb-2 md:pb-0">
                    <select class="px-4 py-2 bg-gray-50 border border-gray-200 rounded-full text-sm font-medium text-gray-700 focus:outline-none">
                        <option>All Categories</option>
                        <option>Florist</option>
                        <option>Venue</option>
                        <option>Photography</option>
                    </select>
                    <select class="px-4 py-2 bg-gray-50 border border-gray-200 rounded-full text-sm font-medium text-gray-700 focus:outline-none">
                        <option>Price Range</option>
                        <option>Low - High</option>
                        <option>High - Low</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-6 pb-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php foreach($all_vendors as $v): ?>
    <a href="index.php?action=package_detail" class="group cursor-pointer block">
        <div class="relative aspect-[4/5] rounded-3xl overflow-hidden mb-5">
            <img src="<?= $v['image'] ?>" alt="<?= $v['name'] ?>"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
            
            <div class="absolute top-4 left-4">
                <span class="px-3 py-1 bg-white/90 backdrop-blur text-[10px] font-bold uppercase tracking-widest text-[#2d4a22] rounded-full">
                    <?= $v['category'] ?>
                </span>
            </div>
        </div>

        <div class="flex justify-between items-start px-1">
            <div>
                <h3 class="text-xl font-serif font-bold text-[#2d4a22] mb-1 group-hover:text-amber-700 transition-colors">
                    <?= $v['name'] ?>
                </h3>
                <div class="flex items-center text-gray-500 text-sm">
                    <span>📍 <?= $v['location'] ?></span>
                </div>
            </div>
            <div class="text-right">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">Start from</p>
                <p class="text-lg font-bold text-[#2d4a22]"><?= $v['price'] ?></p>
            </div>
        </div>
    </a>
    <?php endforeach; ?>
</div>

        <div class="mt-16 flex justify-center">
            <nav class="flex items-center space-x-2">
                <a href="#" class="p-2 text-gray-400 hover:text-[#2d4a22]"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="2"></path></svg></a>
                <a href="#" class="px-4 py-2 rounded-xl bg-[#2d4a22] text-white font-bold">1</a>
                <a href="#" class="px-4 py-2 rounded-xl hover:bg-gray-100 text-gray-600 font-bold">2</a>
                <a href="#" class="px-4 py-2 rounded-xl hover:bg-gray-100 text-gray-600 font-bold">3</a>
                <a href="#" class="p-2 text-gray-400 hover:text-[#2d4a22]"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2"></path></svg></a>
            </nav>
        </div>
    </main>
</div>
<?php
// Memanggil komponen Footer
require_once __DIR__ . '/includes/footer.php';
?>