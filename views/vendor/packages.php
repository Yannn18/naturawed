<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: signin.php");
    exit;
}

// Data List Package
$packages = [
    [
        "id" => 1,
        "name" => "The Ethereal Conservatory Collection",
        "category" => "Full Floral Scape",
        "price" => "Rp 25,000,000",
        "status" => "Active",
        "image" => "https://picsum.photos/seed/pkg1/400/300",
        "bookings" => 12
    ],
    [
        "id" => 2,
        "name" => "Minimalist Grandeur",
        "category" => "Modern Minimalist",
        "price" => "Rp 18,500,000",
        "status" => "Active",
        "image" => "https://picsum.photos/seed/pkg2/400/300",
        "bookings" => 8
    ],
    [
        "id" => 3,
        "name" => "Golden Hour Curation",
        "category" => "Sunset Rustic",
        "price" => "Rp 22,000,000",
        "status" => "Draft",
        "image" => "https://picsum.photos/seed/pkg3/400/300",
        "bookings" => 0
    ],
    [
        "id" => 4,
        "name" => "Midnight Bloom Symphony",
        "category" => "Luxury Evening",
        "price" => "Rp 35,000,000",
        "status" => "Active",
        "image" => "https://picsum.photos/seed/pkg4/400/300",
        "bookings" => 5
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package List - NaturaWed</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body>
    <div class="min-h-screen flex bg-[#f8f9fa] font-sans text-[#1a1a1a]">
        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col sticky top-0 h-screen">
            <div class="p-8">
                <h1 class="text-xl font-serif font-semibold text-[#2d3e2d]">NaturaWed</h1>
                <p class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mt-1">Vendor Portal</p>
            </div>

            <nav class="flex-1 px-4 space-y-1 mt-4">
                <a href="dashboard.php" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl transition-colors text-sm font-medium">
                    <i data-lucide="layout-dashboard" class="w-[18px] h-[18px]"></i> Dashboard
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl transition-colors text-sm font-medium">
                    <i data-lucide="briefcase" class="w-[18px] h-[18px]"></i> Portfolio
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 bg-[#f0f2f0] text-[#2d3e2d] rounded-xl font-semibold text-sm relative">
                    <i data-lucide="package" class="w-[18px] h-[18px]"></i> Packages
                    <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-[#2d3e2d] rounded-l-full"></div>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl transition-colors text-sm font-medium">
                    <i data-lucide="calendar" class="w-[18px] h-[18px]"></i> Bookings
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl transition-colors text-sm font-medium">
                    <i data-lucide="message-square" class="w-[18px] h-[18px]"></i> Inquiries
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl transition-colors text-sm font-medium">
                    <i data-lucide="settings" class="w-[18px] h-[18px]"></i> Settings
                </a>
                
                <div class="pt-4 mt-4 border-t border-gray-100">
                    <a href="logout.php" class="flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl transition-colors text-sm font-medium">
                        <i data-lucide="log-out" class="w-[18px] h-[18px]"></i> Logout
                    </a>
                </div>
            </nav>

            <div class="p-4">
                <div class="bg-[#f0f2f0] p-3 rounded-2xl flex items-center gap-3">
                    <img src="https://picsum.photos/seed/vendor/100/100" alt="Profile" class="w-10 h-10 rounded-full object-cover" referrerpolicy="no-referrer" />
                    <div class="min-w-0">
                        <h4 class="text-xs font-bold truncate"><?= htmlspecialchars($_SESSION['user'] ?? 'Vendor'); ?></h4>
                        <p class="text-[10px] text-gray-400 uppercase tracking-widest">Active User</p>
                    </div>
                </div>
            </div>
        </aside>

        <main class="flex-1 p-12 overflow-y-auto">
            <header class="flex justify-between items-center mb-12">
                <div>
                    <h2 class="text-4xl font-serif text-[#2d3e2d] mb-2">Wedding Packages</h2>
                    <p class="text-gray-500">Manage your signature collections and service offerings.</p>
                </div>
                <button class="px-8 py-3 bg-[#2d3e2d] text-white rounded-xl text-xs font-bold tracking-widest uppercase hover:opacity-90 transition-opacity flex items-center gap-2">
                    <i data-lucide="plus" class="w-4 h-4"></i> Add New Package
                </button>
            </header>

            <div class="flex gap-4 mb-8">
                <div class="flex-1 relative">
                    <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 w-[18px] h-[18px]"></i>
                    <input type="text" placeholder="Search packages by name or category..." class="w-full pl-12 pr-6 py-3 bg-white border border-gray-100 rounded-xl text-sm focus:ring-1 focus:ring-[#2d3e2d]/20 transition-all shadow-sm outline-none" />
                </div>
                <button class="px-6 py-3 bg-white border border-gray-100 rounded-xl text-sm font-medium text-gray-500 flex items-center gap-2 hover:bg-gray-50 transition-colors shadow-sm">
                    <i data-lucide="filter" class="w-[18px] h-[18px]"></i> Filters
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-8">
                <?php foreach ($packages as $pkg): ?>
                <div class="bg-white rounded-[2.5rem] overflow-hidden border border-gray-100 shadow-sm group hover:-translate-y-1 transition-transform">
                    <div class="relative aspect-[16/9] overflow-hidden">
                        <img src="<?= htmlspecialchars($pkg['image']) ?>" alt="<?= htmlspecialchars($pkg['name']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" referrerpolicy="no-referrer" />
                        <div class="absolute top-4 right-4">
                            <?php if ($pkg['status'] === 'Active'): ?>
                                <span class="px-3 py-1 rounded-full text-[9px] font-bold tracking-wider uppercase bg-[#e1f5e1] text-[#2d3e2d]"><?= htmlspecialchars($pkg['status']) ?></span>
                            <?php else: ?>
                                <span class="px-3 py-1 rounded-full text-[9px] font-bold tracking-wider uppercase bg-gray-100 text-gray-400"><?= htmlspecialchars($pkg['status']) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 group/title">
                                    <h3 class="text-xl font-serif text-[#2d3e2d] leading-tight"><?= htmlspecialchars($pkg['name']) ?></h3>
                                    <button class="text-gray-300 hover:text-[#2d3e2d] transition-colors opacity-0 group-hover/title:opacity-100">
                                        <i data-lucide="edit-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                                <p class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mt-1"><?= htmlspecialchars($pkg['category']) ?></p>
                            </div>
                            <button class="text-gray-400 hover:text-[#2d3e2d] transition-colors">
                                <i data-lucide="more-vertical" class="w-5 h-5"></i>
                            </button>
                        </div>

                        <div class="flex justify-between items-end pt-6 border-t border-gray-50">
                            <div>
                                <p class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-1">Base Price</p>
                                <p class="text-lg font-serif text-[#2d3e2d]"><?= htmlspecialchars($pkg['price']) ?></p>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="text-right mr-2">
                                    <p class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-1">Bookings</p>
                                    <p class="text-sm font-bold text-[#2d3e2d]"><?= htmlspecialchars($pkg['bookings']) ?></p>
                                </div>
                                <button class="w-10 h-10 rounded-full bg-[#f0f2f0] flex items-center justify-center text-[#2d3e2d] hover:bg-[#2d3e2d] hover:text-white transition-all">
                                    <i data-lucide="eye" class="w-[18px] h-[18px]"></i>
                                </button>
                                <button class="w-10 h-10 rounded-full bg-[#f0f2f0] flex items-center justify-center text-[#2d3e2d] hover:bg-red-50 hover:text-red-600 transition-all">
                                    <i data-lucide="trash-2" class="w-[18px] h-[18px]"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

                <button class="border-2 border-dashed border-gray-200 rounded-[2.5rem] flex flex-col items-center justify-center p-12 text-center group hover:border-[#2d3e2d]/20 transition-all bg-white/50">
                    <div class="w-16 h-16 rounded-2xl bg-[#f0f2f0] flex items-center justify-center text-[#2d3e2d] mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="plus" class="w-8 h-8"></i>
                    </div>
                    <h4 class="text-xl font-serif text-[#2d3e2d] mb-2">Create New Package</h4>
                    <p class="text-sm text-gray-400 max-w-[200px]">Expand your portfolio with a new signature wedding collection.</p>
                </button>
            </div>
        </main>
    </div>

    <script>
      lucide.createIcons();
    </script>
</body>
</html>