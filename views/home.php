<?php

// Set judul halaman
$pageTitle = "Home - NaturaWed";


// Memanggil komponen Header
require_once __DIR__ . '/includes/header.php';

// =====================================================================
// DATA MOCKUP (Idealnya data ini nantinya ditarik dari Database via Controller)
// =====================================================================

$ecoPackages = [
    [
        "id" => 1,
        "title" => "Seashell Bomb",
        "author" => "Ocean Wed n Co.",
        "price" => "IDR 120.000.000,00",
        "img" => "https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=2070&auto=format&fit=crop",
        "desc" => "A romantic beachside session capturing the tenderness of your perfect day, framed with calm waves and natural elegance."
    ],
    [
        "id" => 2,
        "title" => "Highland Whisper",
        "author" => "Ocean Wed...",
        "price" => "IDR 97.500.000,00",
        "img" => "https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?q=80&w=2070&auto=format&fit=crop",
        "desc" => "A modern mountain wedding, highlighting effortlessly new wedding chemistry and stability."
    ],
    [
        "id" => 3,
        "title" => "Forest Grove",
        "author" => "Ocean Wed n C...",
        "price" => "IDR 97.500.000,00",
        "img" => "https://images.unsplash.com/photo-1465495910483-0d6745756038?q=80&w=2070&auto=format&fit=crop",
        "desc" => "A romantic beachside section capturing the tenderness of your perfect day, framed with calm waves and natural elegance."
    ]
];

$recommendedVendors = [
    [
        "id" => 1,
        "name" => "Shoreline Studio",
        "author" => "Anne",
        "img" => "https://images.unsplash.com/photo-1520854221256-17451cc331bf?q=80&w=2070&auto=format&fit=crop",
        "review" => "Great service, professional, and easy to work with."
    ],
    [
        "id" => 2,
        "name" => "Ocean Breeze",
        "author" => "Johon",
        "img" => "https://images.unsplash.com/photo-1510076857177-7470076d4098?q=80&w=2072&auto=format&fit=crop",
        "review" => "Beautiful work! Truly made, Beautiful work feel, feel special."
    ],
    [
        "id" => 3,
        "name" => "Green Leaf Catering",
        "author" => "Coterer",
        "img" => "https://images.unsplash.com/photo-1555244162-803834f70033?q=80&w=2070&auto=format&fit=crop",
        "review" => "Caterer, limit points, really, really caterers."
    ]
];

$weddingDeals = [
    [
        "id" => 1,
        "title" => "Rodeo Bliss",
        "author" => "Ocean Wed n Co.",
        "price" => "IDR 275.000.000,00",
        "oldPrice" => "IDR 300.000.000,00",
        "img" => "https://images.unsplash.com/photo-1537633552985-df8429e8048b?q=80&w=2070&auto=format&fit=crop",
        "desc" => "An intimate countryside celebration capturing with your love story in a cozy atmosphere."
    ],
    [
        "id" => 2,
        "title" => "Luxe Signature",
        "author" => "Ocean Wed n Co.",
        "price" => "IDR 320.000.000,00",
        "oldPrice" => null,
        "img" => "https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=2070&auto=format&fit=crop",
        "desc" => "An elegant evening with refined details and enjoy your love story in your wedding journey."
    ]
];

$videos = [
    ["user" => "@evergreenatelier", "views" => "752", "img" => "https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=1974&auto=format&fit=crop"],
    ["user" => "@naturevibes", "views" => "752", "img" => "https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=1974&auto=format&fit=crop"],
    ["user" => "@evergreenatelier", "views" => "1.2k", "img" => "https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=1974&auto=format&fit=crop"],
    ["user" => "@siennaart", "views" => "456", "img" => "https://images.unsplash.com/photo-1522673607200-1648832cee98?q=80&w=1974&auto=format&fit=crop"],
    ["user" => "@honeywood", "views" => "971", "img" => "https://images.unsplash.com/photo-1469334031218-e382a71b716b?q=80&w=1974&auto=format&fit=crop"]
];
?>

<main class="min-h-screen bg-white font-sans text-gray-900">
    
    <section class="relative h-[600px] w-full overflow-hidden">
        <img 
            src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=2069&auto=format&fit=crop" 
            alt="Wedding couple in forest"
            class="h-full w-full object-cover brightness-95"
            referrerpolicy="no-referrer"
        />
        <div class="absolute inset-0 flex items-center justify-center">
            <form action="/index.php" method="GET" class="relative flex w-full max-w-3xl items-center px-6">
                <input type="hidden" name="action" value="search">
                <input
                    type="text"
                    name="q"
                    placeholder="Find your eco-friendly wedding vendors"
                    class="h-16 w-full rounded-full bg-white pl-10 pr-40 text-lg shadow-2xl focus:outline-none"
                />
                <button
                    type="submit"
                    class="absolute right-8 rounded-full bg-[#2d4a22] px-10 py-3 text-lg font-bold text-white shadow-lg transition-all hover:scale-105 active:scale-95"
                >
                    Search
                </button>
            </form>
        </div>
    </section>

    <section class="bg-[#d9e4c3] px-12 py-16">
        <h2 class="mb-12 text-4xl font-bold text-[#2d4a22]">Eco Elegance for Your Perfect Day</h2>
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            <?php foreach ($ecoPackages as $item): ?>
                 <a href="index.php?action=package_detail" class="group cursor-pointer block">
                    <div
                        class="overflow-hidden rounded-3xl bg-white shadow-xl cursor-pointer transition-transform duration-300 hover:-translate-y-2"
                    >
                        <img src="<?= $item['img'] ?>" alt="<?= htmlspecialchars($item['title']) ?>" class="h-56 w-full object-cover" referrerpolicy="no-referrer" />
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-900"><?= htmlspecialchars($item['title']) ?></h3>
                            <span
                                onclick="event.stopPropagation(); window.location.href='/index.php?action=vendor&id=1'"
                                class="text-xs font-bold text-gray-500 uppercase tracking-wider hover:text-[#2d4a22]"
                            >
                                by <?= htmlspecialchars($item['author']) ?>
                            </span>
                        </div>
                        <p class="mt-3 text-sm leading-relaxed text-gray-600 line-clamp-3">
                            <?= htmlspecialchars($item['desc']) ?>
                        </p>
                        <div class="mt-6 text-lg font-bold text-gray-900"><?= htmlspecialchars($item['price']) ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="bg-white px-12 py-16">
        <h2 class="mb-12 text-4xl font-bold text-gray-900">Most Recommended Vendors</h2>
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            <?php foreach ($recommendedVendors as $item): ?>
                 <a href="index.php?action=package_detail" class="group cursor-pointer block">
                    <div
                        class="overflow-hidden rounded-3xl shadow-2xl cursor-pointer transition-transform duration-300 hover:scale-105"
                    >
                        <img src="<?= $item['img'] ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="h-64 w-full object-cover" referrerpolicy="no-referrer" />
                    <div class="bg-[#800000] p-8 text-white">
                        <h3 class="text-2xl font-bold"><?= htmlspecialchars($item['name']) ?></h3>
                        <div class="mt-2 flex items-center space-x-1">
                            <?php for ($i = 0; $i < 4; $i++): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-400">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                </svg>
                            <?php endfor; ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-300">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                            <span class="text-xs opacity-80 pl-1">(4.0)</span>
                        </div>
                        <p class="mt-4 text-sm leading-relaxed opacity-90 line-clamp-2">
                            <?= htmlspecialchars($item['review']) ?>
                        </p>
                        <div class="mt-4 text-xs font-bold uppercase tracking-widest opacity-70">by <?= htmlspecialchars($item['author']) ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="bg-[#f4e1e1] px-12 py-16">
        <h2 class="mb-12 text-4xl font-bold text-gray-900">Unforgettable Wedding Deals</h2>
        <div class="grid grid-cols-1 gap-10 md:grid-cols-2">
            <?php foreach ($weddingDeals as $item): ?>
                <a href="index.php?action=package_detail" class="group cursor-pointer block"></a>
                <div 
                    onclick="window.location.href='/index.php?action=package&id=<?= $item['id'] ?>'"
                    class="overflow-hidden rounded-[2.5rem] bg-white shadow-2xl cursor-pointer transition-transform duration-300 hover:-translate-y-2"
                >
                    <div class="relative h-80">
                        <img src="<?= $item['img'] ?>" alt="<?= htmlspecialchars($item['title']) ?>" class="h-full w-full object-cover" referrerpolicy="no-referrer" />
                        <div class="absolute top-6 right-6 rounded-lg bg-[#ff3b3b] px-5 py-2 text-sm font-bold text-white shadow-md">Recommend</div>
                    </div>
                    <div class="p-10">
                        <div class="flex items-center justify-between">
                            <h3 class="text-3xl font-bold text-gray-900"><?= htmlspecialchars($item['title']) ?></h3>
                            <span
                                onclick="event.stopPropagation(); window.location.href='/index.php?action=vendor&id=1'"
                                class="text-sm font-bold text-gray-500 uppercase tracking-widest hover:text-[#2d4a22]"
                            >
                                by <?= htmlspecialchars($item['author']) ?>
                            </span>
                        </div>
                        <p class="mt-4 text-lg leading-relaxed text-gray-600">
                            <?= htmlspecialchars($item['desc']) ?>
                        </p>
                        <div class="mt-8 flex items-baseline space-x-4">
                            <span class="text-2xl font-bold text-gray-900"><?= htmlspecialchars($item['price']) ?></span>
                            <?php if ($item['oldPrice']): ?>
                                <span class="text-lg text-gray-400 line-through"><?= htmlspecialchars($item['oldPrice']) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="bg-white px-12 py-16">
        <h2 class="mb-12 text-4xl font-bold text-gray-900">Natura Video</h2>
        <div class="grid grid-cols-2 gap-6 sm:grid-cols-3 md:grid-cols-5">
            <?php foreach ($videos as $video): ?>
                <div class="group relative aspect-[3/4.5] cursor-pointer overflow-hidden rounded-2xl shadow-lg transition-transform duration-300 hover:scale-105">
                    <img src="<?= $video['img'] ?>" alt="Video thumbnail" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" referrerpolicy="no-referrer" />
                    <div class="absolute inset-0 bg-black/20 transition-colors group-hover:bg-black/40"></div>
                    <div class="absolute top-4 left-4 flex items-center space-x-2 text-xs font-bold text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="6 3 20 12 6 21 6 3"/>
                        </svg>
                        <span><?= htmlspecialchars($video['views']) ?></span>
                    </div>
                    <div class="absolute bottom-4 left-4 text-xs font-bold text-white opacity-90">
                        <?= htmlspecialchars($video['user']) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

</main>

<?php
// Memanggil komponen Footer
require_once __DIR__ . '/includes/footer.php';
?>