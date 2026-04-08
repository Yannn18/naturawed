<?php
// Kalau pakai MVC dan dipanggil lewat index.php, session_start() biarkan dihapus aja dari sini seperti sebelumnya
// Cek apakah user sudah login (sesuaikan dengan logika MVC kamu)
if (!isset($_SESSION['login'])) {
    header("Location: signin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Package - NaturaWed</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Inter', sans-serif; }
        
        /* CSS khusus untuk Toggle Switch Custom Quote */
        .toggle-checkbox:checked {
            right: 0;
            border-color: #4caf50;
        }
        .toggle-checkbox:checked + .toggle-label {
            background-color: #4caf50;
        }
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
            <a href="index.php?action=dashboard-vendor" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl transition-colors text-sm font-medium">
                <i data-lucide="layout-dashboard" class="w-[18px] h-[18px]"></i> Dashboard
            </a>
            <a href="index.php?action=portfolio" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl transition-colors text-sm font-medium">
                <i data-lucide="briefcase" class="w-[18px] h-[18px]"></i> Portfolio
            </a>
            <a href="index.php?action=package_add" class="flex items-center gap-3 px-4 py-3 bg-[#f0f2f0] text-[#2d3e2d] rounded-xl font-semibold text-sm relative">
                <i data-lucide="package" class="w-[18px] h-[18px]"></i> Packages
                <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-[#2d3e2d] rounded-l-full"></div>
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl transition-colors text-sm font-medium">
                <i data-lucide="message-square" class="w-[18px] h-[18px]"></i> Messages
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl transition-colors text-sm font-medium">
                <i data-lucide="star" class="w-[18px] h-[18px]"></i> Reviews
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl transition-colors text-sm font-medium">
                <i data-lucide="shopping-bag" class="w-[18px] h-[18px]"></i> Orders
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
                <h2 class="text-4xl font-serif text-[#2d3e2d] mb-2">Create New Wedding Package</h2>
                <p class="text-gray-500 text-sm max-w-xl">Craft an exquisite experience for our clients. Define the botanical essence, structural elements, and pricing of your new signature offering.</p>
            </div>
            <div class="flex items-center gap-6">
                <button class="text-sm font-bold tracking-widest uppercase text-gray-500 hover:text-[#2d3e2d] transition-colors">
                    SAVE AS DRAFT
                </button>
                <button class="px-8 py-4 bg-[#2a3f24] text-white rounded-xl text-xs font-bold tracking-widest uppercase hover:opacity-90 transition-opacity shadow-lg">
                    PUBLISH PACKAGE
                </button>
            </div>
        </header>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <div class="xl:col-span-2 space-y-8">
                <div class="bg-white p-10 rounded-[2.5rem] border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center text-gray-400">
                            <i data-lucide="info" class="w-4 h-4"></i>
                        </div>
                        <h3 class="text-2xl font-serif text-gray-900">Basic Information</h3>
                    </div>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-3">Package Name</label>
                            <input type="text" placeholder="e.g., The Ethereal Conservatory Collection" class="w-full px-6 py-4 bg-[#f8f9fa] border-none rounded-xl text-gray-900 focus:ring-2 focus:ring-[#2d3e2d]/20 transition-all outline-none text-sm placeholder-gray-400" />
                        </div>
                        
                        <div>
                            <label class="block text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-3">Category</label>
                            <div class="relative">
                                <select name="category_id" class="w-full px-6 py-4 bg-[#f8f9fa] border-none rounded-xl text-gray-900 focus:ring-2 focus:ring-[#2d3e2d]/20 transition-all outline-none text-sm appearance-none cursor-pointer">
                                    <option value="" disabled selected>Pilih Kategori...</option>
                                    <option value="1">Venue</option>
                                    <option value="2">Catering</option>
                                    <option value="3">Photography</option>
                                    <option value="4">Decoration</option>
                                    <option value="5">Makeup Artist</option>
                                    <option value="6">Wedding Organizer</option>
                                    <option value="7">Music & Entertainment</option>
                                    <option value="8">Attire & Jewelry</option>
                                </select>
                                <i data-lucide="chevron-down" class="absolute right-6 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"></i>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-3">Detailed Description</label>
                            <textarea rows="5" placeholder="Describe the sensory experience, the materials used, and the artistic inspiration..." class="w-full px-6 py-4 bg-[#f8f9fa] border-none rounded-xl text-gray-900 focus:ring-2 focus:ring-[#2d3e2d]/20 transition-all outline-none resize-none text-sm placeholder-gray-400"></textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-10 rounded-[2.5rem] border border-gray-100 shadow-sm">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center text-gray-400">
                                <i data-lucide="plus-square" class="w-4 h-4"></i>
                            </div>
                            <h3 class="text-2xl font-serif text-gray-900">Package Features</h3>
                        </div>
                        <button class="text-[10px] font-bold tracking-widest text-gray-500 hover:text-[#2d3e2d] transition-colors flex items-center gap-1 uppercase">
                            <i data-lucide="plus" class="w-3 h-3"></i> Add New Item
                        </button>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex items-center gap-4 px-6 py-4 bg-[#f8f9fa] rounded-xl border border-gray-50 group">
                            <i data-lucide="grip-vertical" class="w-4 h-4 text-gray-300 cursor-grab active:cursor-grabbing"></i>
                            <span class="text-sm font-medium text-gray-700 flex-1">Bespoke Floral Archway (Fresh Import)</span>
                        </div>
                        <div class="flex items-center gap-4 px-6 py-4 bg-[#f8f9fa] rounded-xl border border-gray-50 group">
                            <i data-lucide="grip-vertical" class="w-4 h-4 text-gray-300 cursor-grab active:cursor-grabbing"></i>
                            <span class="text-sm font-medium text-gray-700 flex-1">Ambient Warm LED Uplighting (12 Units)</span>
                        </div>
                        
                        <div class="mt-4 p-4 bg-[#f0f2f0] rounded-xl border-2 border-dashed border-gray-200">
                            <input type="text" placeholder="Type a feature and press enter..." class="w-full bg-transparent border-none focus:ring-0 transition-all outline-none text-sm placeholder-gray-400" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <div class="bg-[#2a3f24] p-10 rounded-[2.5rem] shadow-xl">
                    <div class="flex items-center gap-4 mb-8 text-white">
                        <div class="w-8 h-8 rounded-full border border-white/20 flex items-center justify-center">
                            <i data-lucide="dollar-sign" class="w-4 h-4"></i>
                        </div>
                        <h3 class="text-2xl font-serif">Pricing</h3>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-bold tracking-widest text-white/50 uppercase mb-3">Base Price (IDR)</label>
                            <div class="relative">
                                <div class="absolute left-6 top-1/2 -translate-y-1/2 flex items-center gap-2 pointer-events-none">
                                    <span class="text-sm font-bold text-white/40">Rp</span>
                                </div>
                                <input type="number" placeholder="25000000" class="w-full pl-14 pr-6 py-4 bg-white/10 border-none rounded-xl text-xl font-serif text-[#a5d6a7] focus:ring-1 focus:ring-white/20 transition-all outline-none placeholder-white/30" />
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-5 bg-white/5 rounded-xl border border-white/10">
                            <div>
                                <h4 class="text-sm font-bold text-white">Custom Quote Only</h4>
                                <p class="text-[10px] text-white/50 uppercase tracking-widest mt-0.5">Hide price from public view</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="custom_quote" class="sr-only peer">
                                <div class="w-11 h-6 bg-white/30 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#4caf50]"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-10 rounded-[2.5rem] border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center text-gray-400">
                            <i data-lucide="image" class="w-4 h-4"></i>
                        </div>
                        <h3 class="text-2xl font-serif text-gray-900">Media Gallery</h3>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="aspect-square rounded-2xl overflow-hidden relative group">
                            <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=400&auto=format&fit=crop" class="w-full h-full object-cover" referrerpolicy="no-referrer" />
                        </div>
                        <div class="aspect-square rounded-2xl overflow-hidden relative group">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=400&auto=format&fit=crop" class="w-full h-full object-cover" referrerpolicy="no-referrer" />
                        </div>
                    </div>

                    <div class="border-2 border-dashed border-gray-200 rounded-3xl p-8 flex flex-col items-center justify-center text-center cursor-pointer hover:border-[#2d3e2d]/20 hover:bg-gray-50 transition-all group">
                        <div class="w-12 h-12 rounded-xl bg-white border border-gray-100 flex items-center justify-center text-[#2d3e2d] mb-4 shadow-sm group-hover:scale-110 transition-transform">
                            <i data-lucide="upload" class="w-5 h-5"></i>
                        </div>
                        <p class="text-sm font-bold text-gray-900 mb-1">Upload Image</p>
                        <p class="text-[10px] text-gray-400 uppercase tracking-widest leading-relaxed">High-res JPEG or PNG<br/>(Max 10MB)</p>
                    </div>
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