<?php
// Set judul halaman
$pageTitle = "Inspiration - NaturaWed";

// Memanggil komponen Header
require_once __DIR__ . '/includes/header.php';

// =====================================================================
// DATA MOCKUP INSPIRATION
// =====================================================================

$featuredArticle = [
    "id" => "jonas-and-emelie",
    "title" => "Jonas and Emelie: A Spectacular Night at a Royal Outdoor Wedding",
    "author" => "Isabella Thorne",
    "time" => "2 hours ago • 8 min read",
    "image" => "https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&q=80&w=1920",
    "tag" => "FEATURED ARTICLE",
    "authorImg" => "https://i.pravatar.cc/150?u=isabella"
];

$articles = [
    [
        "id" => "art-of-subtlety",
        "title" => "The Art of Subtlety: Designing a Minimalist Forest Ceremony",
        "author" => "Marcus Sterling",
        "time" => "4 HOURS AGO",
        "image" => "https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?auto=format&fit=crop&q=80&w=1000",
    ],
    [
        "id" => "botanical-tablescapes",
        "title" => "Botanical Tablescapes: Bringing the Garden Indoors",
        "author" => "Elena Rossi",
        "time" => "YESTERDAY",
        "image" => "https://images.unsplash.com/photo-1510076857177-7470076d4098?auto=format&fit=crop&q=80&w=1000",
    ],
    [
        "id" => "eternal-horizon",
        "title" => "Eternal Horizon: The Most Romantic Destination Elopements",
        "author" => "Julian Vance",
        "time" => "2 DAYS AGO",
        "image" => "https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&q=80&w=1000",
    ],
    [
        "id" => "great-escape",
        "title" => "The Great Escape: Grand Exits and Vintage Luxury",
        "author" => "Sophie Laurent",
        "time" => "3 DAYS AGO",
        "image" => "https://images.unsplash.com/photo-1513151233558-d860c5398176?auto=format&fit=crop&q=80&w=1000",
    ],
    [
        "id" => "modern-romanticism",
        "title" => "Modern Romanticism: Balancing Heritage and Trend",
        "author" => "Amara Okafor",
        "time" => "5 DAYS AGO",
        "image" => "https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&fit=crop&q=80&w=1000",
    ],
    [
        "id" => "artisanal-spirits",
        "title" => "Artisanal Spirits: Crafting a Bespoke Celebration Menu",
        "author" => "David Chen",
        "time" => "1 WEEK AGO",
        "image" => "https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&q=80&w=1000",
    ]
];
?>

<main class="min-h-screen bg-white font-sans text-gray-900">
    <div class="max-w-7xl mx-auto px-6 py-12">
        
        <a 
            href="/index.php?action=article_detail&id=<?= $featuredArticle['id'] ?>"
            class="relative block h-[600px] w-full rounded-3xl overflow-hidden cursor-pointer group mb-24"
        >
            <img 
                src="<?= $featuredArticle['image'] ?>" 
                alt="<?= htmlspecialchars($featuredArticle['title']) ?>"
                class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                referrerpolicy="no-referrer"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
            
            <div class="absolute bottom-12 left-12 right-12 text-white">
                <span class="inline-block px-3 py-1 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full text-[10px] font-semibold tracking-[0.2em] uppercase mb-6">
                    <?= htmlspecialchars($featuredArticle['tag']) ?>
                </span>
                <h1 class="text-5xl md:text-6xl font-serif max-w-3xl leading-tight mb-8">
                    <?= htmlspecialchars($featuredArticle['title']) ?>
                </h1>
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 rounded-full bg-zinc-400 overflow-hidden border border-white/20">
                        <img src="<?= $featuredArticle['authorImg'] ?>" alt="<?= htmlspecialchars($featuredArticle['author']) ?>" class="w-full h-full object-cover" />
                    </div>
                    <div class="text-[11px] tracking-wide">
                        <p class="font-semibold"><?= htmlspecialchars($featuredArticle['author']) ?></p>
                        <p class="opacity-60"><?= htmlspecialchars($featuredArticle['time']) ?></p>
                    </div>
                </div>
            </div>
        </a>

        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-8">
            <div>
                <h2 class="text-4xl font-serif mb-4">Curated Inspiration</h2>
                <p class="text-zinc-500 max-w-md leading-relaxed">
                    Explore our weekly selection of artisanal celebrations, timeless decor concepts, and editorial bridal journals.
                </p>
            </div>
            <div class="flex items-center space-x-4">
                <button class="px-6 py-2.5 rounded-full border border-zinc-200 text-xs font-semibold tracking-wider hover:bg-zinc-50 transition-colors flex items-center space-x-2">
                    <span>Refine</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="-rotate-90"><path d="m15 18-6-6 6-6"/></svg>
                </button>
                <button class="px-6 py-2.5 rounded-full border border-zinc-200 text-xs font-semibold tracking-wider hover:bg-zinc-50 transition-colors flex items-center space-x-2">
                    <span>Latest</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="-rotate-90"><path d="m15 18-6-6 6-6"/></svg>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-20 mb-24">
            <?php foreach ($articles as $article): ?>
                <a 
                    href="/index.php?action=article_detail&id=<?= $article['id'] ?>" 
                    class="group block cursor-pointer"
                >
                    <div class="relative aspect-[4/5] rounded-2xl overflow-hidden mb-6">
                        <img 
                            src="<?= $article['image'] ?>" 
                            alt="<?= htmlspecialchars($article['title']) ?>"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            referrerpolicy="no-referrer"
                        />
                        <button onclick="event.preventDefault(); /* Logika Bookmark PHP nanti di sini */" class="absolute top-4 right-4 w-10 h-10 rounded-full bg-white/90 backdrop-blur-sm flex items-center justify-center text-zinc-900 shadow-sm hover:bg-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"/></svg>
                        </button>
                    </div>
                    <h3 class="text-xl font-serif leading-snug mb-4 group-hover:text-zinc-600 transition-colors">
                        <?= htmlspecialchars($article['title']) ?>
                    </h3>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full bg-zinc-200 overflow-hidden">
                            <img src="https://i.pravatar.cc/150?u=<?= urlencode($article['author']) ?>" alt="<?= htmlspecialchars($article['author']) ?>" class="w-full h-full object-cover" />
                        </div>
                        <div class="text-[10px] tracking-wider uppercase font-semibold">
                            <p class="text-zinc-900"><?= htmlspecialchars($article['author']) ?></p>
                            <p class="text-zinc-400"><?= htmlspecialchars($article['time']) ?></p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="flex items-center justify-center space-x-2 mb-24">
            <button class="w-10 h-10 rounded-full flex items-center justify-center text-zinc-400 hover:text-zinc-900 hover:bg-zinc-100 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            </button>
            <button class="w-10 h-10 rounded-full bg-[#2d4a22] text-white text-sm font-semibold">1</button>
            <button class="w-10 h-10 rounded-full text-zinc-400 hover:text-zinc-900 hover:bg-zinc-100 transition-all text-sm font-semibold">2</button>
            <button class="w-10 h-10 rounded-full text-zinc-400 hover:text-zinc-900 hover:bg-zinc-100 transition-all text-sm font-semibold">3</button>
            <span class="px-2 text-zinc-300">...</span>
            <button class="w-10 h-10 rounded-full text-zinc-400 hover:text-zinc-900 hover:bg-zinc-100 transition-all text-sm font-semibold">12</button>
            <button class="w-10 h-10 rounded-full flex items-center justify-center text-zinc-400 hover:text-zinc-900 hover:bg-zinc-100 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </button>
        </div>
        
    </div>
</main>

<?php
// Memanggil komponen Footer
require_once __DIR__ . '/includes/footer.php';
?>