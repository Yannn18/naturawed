<?php 
// session_start(); // Di-comment biar gak tabrakan sama index.php

// Cek apakah user sudah login (sesuaikan dengan logika MVC kamu)
if (!isset($_SESSION['login'])) {
    // header("Location: signin.php");
    // exit;
}

// 1. DATA DUMMY PROFIL VENDOR
$vendorProfile = [
    "name" => $_SESSION['business_name'] ?? "Glamorous Studio",
    "logo" => "https://picsum.photos/seed/vendorlogo/200/200",
    "crew_photo" => "https://images.unsplash.com/photo-1511895426328-dc8714191300?q=80&w=2000&auto=format&fit=crop", // Foto tim/crew
    "description" => "We are a passionate team of wedding decorators and organizers dedicated to turning your dream day into reality. With over 5 years of experience in crafting bespoke, eco-friendly, and luxurious wedding experiences, we ensure every petal, drapery, and light reflects your unique love story."
];

// 2. DATA DUMMY PAKET MILIK VENDOR INI
$vendorPackages = [
    [
        "name" => "The Ethereal Conservatory",
        "category" => "Full Floral Scape",
        "price" => "Rp 25,000,000",
        "image" => "https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=600&auto=format&fit=crop"
    ],
    [
        "name" => "Minimalist Grandeur",
        "category" => "Modern Minimalist",
        "price" => "Rp 18,500,000",
        "image" => "https://images.unsplash.com/photo-1469334031218-e382a71b716b?q=80&w=600&auto=format&fit=crop"
    ],
    [
        "name" => "Golden Hour Curation",
        "category" => "Sunset Rustic",
        "price" => "Rp 22,000,000",
        "image" => "https://images.unsplash.com/photo-1510076857177-7470076d4098?q=80&w=600&auto=format&fit=crop"
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Portfolio - NaturaWed</title>
    
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
        <?php require_once __DIR__ . '/../includes/vendor_sidebar.php'; ?>
       

        <main class="flex-1 overflow-y-auto">
            <div class="relative h-80 w-full bg-gray-200">
                <img src="<?= htmlspecialchars($vendorProfile['crew_photo']) ?>" alt="Crew Photo" class="w-full h-full object-cover" referrerpolicy="no-referrer" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>
                
                <button class="absolute top-6 right-12 px-4 py-2 bg-white/20 backdrop-blur-md text-white rounded-xl text-xs font-bold tracking-widest uppercase hover:bg-white hover:text-[#2d3e2d] transition-all flex items-center gap-2">
                    <i data-lucide="camera" class="w-4 h-4"></i> Change Cover
                </button>
            </div>

            <div class="max-w-6xl mx-auto px-12 -mt-16 relative z-10">
                <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-50 mb-12 flex flex-col md:flex-row gap-8 items-start">
                    
                    <div class="relative -mt-20 group cursor-pointer">
                        <div class="w-32 h-32 rounded-full border-4 border-white overflow-hidden bg-gray-100 shadow-lg">
                            <img src="<?= htmlspecialchars($vendorProfile['logo']) ?>" alt="Vendor Logo" class="w-full h-full object-cover" referrerpolicy="no-referrer" />
                        </div>
                        <div class="absolute inset-0 rounded-full bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <i data-lucide="edit-2" class="text-white w-6 h-6"></i>
                        </div>
                    </div>

                    <div class="flex-1">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h2 class="text-4xl font-serif text-[#2d3e2d] mb-2"><?= htmlspecialchars($vendorProfile['name']) ?></h2>
                                <div class="flex items-center gap-4 text-sm font-medium text-gray-500">
                                   <span class="flex items-center gap-1">
                                    <i data-lucide="map-pin" class="w-4 h-4"></i> 
                                    <?= htmlspecialchars($_SESSION['address'] ?? 'Surabaya, Indonesia') ?>
                                    </span>
                                    <span class="flex items-center gap-1 text-yellow-500"><i data-lucide="star" class="w-4 h-4 fill-current"></i> 4.9/5 (120 Reviews)</span>
                                </div>
                            </div>
                            <button class="px-6 py-2 border border-gray-200 text-gray-600 rounded-xl text-xs font-bold tracking-widest uppercase hover:bg-gray-50 transition-colors flex items-center gap-2">
                                <i data-lucide="edit-3" class="w-4 h-4"></i> Edit Profile
                            </button>
                        </div>
                        
                        <div class="mt-6">
                            <h4 class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-3">About Us</h4>
                            <p class="text-gray-600 leading-relaxed">
                                <?= htmlspecialchars($vendorProfile['description']) ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mb-12">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-3xl font-serif text-[#2d3e2d]">Our Packages</h3>
                        <a href="index.php?action=package_add" class="text-[10px] font-bold tracking-widest text-[#2d3e2d] uppercase hover:opacity-70 transition-opacity flex items-center gap-1">
                            <i data-lucide="plus" class="w-4 h-4"></i> Create New
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <?php foreach ($vendorPackages as $pkg): ?>
                            <div class="bg-white rounded-[2rem] overflow-hidden border border-gray-100 shadow-sm hover:-translate-y-1 transition-transform group cursor-pointer">
                                <div class="aspect-[4/3] overflow-hidden relative">
                                    <img src="<?= htmlspecialchars($pkg['image']) ?>" alt="Package Image" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" referrerpolicy="no-referrer">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
                                        <button class="w-full py-3 bg-white/20 backdrop-blur-md text-white rounded-xl text-xs font-bold tracking-widest uppercase hover:bg-white hover:text-[#2d3e2d] transition-colors">
                                            Edit Package
                                        </button>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <p class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-2"><?= htmlspecialchars($pkg['category']) ?></p>
                                    <h4 class="text-xl font-serif text-[#2d3e2d] mb-4 truncate"><?= htmlspecialchars($pkg['name']) ?></h4>
                                    <div class="flex justify-between items-center border-t border-gray-50 pt-4">
                                        <p class="text-sm font-bold text-[#2d3e2d]"><?= htmlspecialchars($pkg['price']) ?></p>
                                        <button class="text-gray-400 hover:text-red-500 transition-colors">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
      lucide.createIcons();
    </script>
</body>
</html>