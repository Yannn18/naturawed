<?php
 
        // require_once __DIR__ . '/../views/public/package_add.php';
      
        // require_once __DIR__ . '/../views/public/portfolio.php';
       
        // require_once __DIR__ . '/../views/public/profile_edit.php';
        
// Data Dummy Pesanan
$recentOrders = [
    [
        "client" => "Eleanor Vance",
        "package" => "The Botanical Suite",
        "status" => "CONFIRMED",
        "amount" => "$3,200",
        "statusColor" => "bg-[#e1f5e1] text-[#2d3e2d]"
    ],
    [
        "client" => "Julian Thorne",
        "package" => "Minimalist Grandeur",
        "status" => "PENDING",
        "amount" => "$1,850",
        "statusColor" => "bg-[#fff4e5] text-[#b7791f]"
    ],
    [
        "client" => "Maya Sterling",
        "package" => "Golden Hour Curation",
        "status" => "PROCESSING",
        "amount" => "$4,500",
        "statusColor" => "bg-[#e3f2fd] text-[#1976d2]"
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Dashboard - NaturaWed</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body>

    <div class="min-h-screen flex bg-white font-sans text-[#1a1a1a]">
        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col sticky top-0 h-screen">
            <div class="p-8">
                <h1 class="text-xl font-serif font-semibold text-[#2d3e2d]">NaturaWed</h1>
                <p class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mt-1">Vendor Portal</p>
            </div>

            <nav class="flex-1 px-4 space-y-1 mt-4">
                <a href="dashboard.php" class="flex items-center gap-3 px-4 py-3 bg-[#f0f2f0] text-[#2d3e2d] rounded-xl font-semibold text-sm relative">
                    <i data-lucide="layout-dashboard" class="w-[18px] h-[18px]"></i>
                    Dashboard
                    <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-[#2d3e2d] rounded-l-full"></div>
                </a>
                <a href="index.php?action=portfolio" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl transition-colors text-sm font-medium">
                    <i data-lucide="briefcase" class="w-[18px] h-[18px]"></i>
                    Portfolio
                </a>
                <a href="index.php?action=vendor_add_package" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl transition-colors text-sm font-medium">
                    <i data-lucide="package" class="w-[18px] h-[18px]"></i>
                    Packages
                </a>
                <a href="chat.php" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl transition-colors text-sm font-medium">
                    <i data-lucide="message-square" class="w-[18px] h-[18px]"></i>
                    Messages
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl transition-colors text-sm font-medium">
                    <i data-lucide="star" class="w-[18px] h-[18px]"></i>
                    Reviews
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl transition-colors text-sm font-medium">
                    <i data-lucide="shopping-bag" class="w-[18px] h-[18px]"></i>
                    Orders
                </a>
                
                <div class="pt-4 mt-4 border-t border-gray-100">
                    <a href="logout.php" class="flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl transition-colors text-sm font-medium">
                        <i data-lucide="log-out" class="w-[18px] h-[18px]"></i>
                        Logout
                    </a>
                </div>
            </nav>

            <div class="p-4">
                <div class="bg-[#f0f2f0] p-3 rounded-2xl flex items-center gap-3">
                    <img 
                        src="https://picsum.photos/seed/vendor/100/100" 
                        alt="Profile" 
                        class="w-10 h-10 rounded-full object-cover"
                        referrerpolicy="no-referrer"
                    />
                    <div class="min-w-0">
                        <h4 class="text-xs font-bold truncate"><?= htmlspecialchars($_SESSION['user'] ?? 'Vendor'); ?></h4>
                        <p class="text-[10px] text-gray-400 uppercase tracking-widest">Active User</p>
                    </div>
                </div>
            </div>
        </aside>

        <main class="flex-1 flex flex-col overflow-y-auto">
            <header class="h-20 px-12 flex items-center justify-between sticky top-0 bg-white/80 backdrop-blur-md z-10">
                <h2 class="text-xl font-serif italic text-[#2d3e2d]">NaturaWed</h2>
                
                <div class="flex items-center gap-8">
                    <div class="relative">
                        <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 w-[18px] h-[18px]"></i>
                        <input 
                            type="text" 
                            placeholder="Search orders..." 
                            class="pl-12 pr-6 py-2.5 bg-[#f0f2f0] border-none rounded-full text-sm w-64 focus:ring-1 focus:ring-[#2d3e2d]/20 transition-all outline-none"
                        />
                    </div>
                    <div class="flex items-center gap-5 text-gray-500">
                        <button class="hover:text-[#2d3e2d] transition-colors relative">
                            <i data-lucide="bell" class="w-5 h-5"></i>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 border-2 border-white rounded-full"></span>
                        </button>
                        <button class="hover:text-[#2d3e2d] transition-colors"><i data-lucide="mail" class="w-5 h-5"></i></button>
                        <button class="hover:text-[#2d3e2d] transition-colors"><i data-lucide="settings" class="w-5 h-5"></i></button>
                        <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden border border-gray-100 cursor-pointer">
                            <img 
                                src="https://picsum.photos/seed/vendor/100/100" 
                                alt="Profile" 
                                class="w-full h-full object-cover"
                                referrerpolicy="no-referrer"
                            />
                        </div>
                    </div>
                </div>
            </header>

            <div class="px-12 py-8 flex gap-12">
                <div class="flex-1 space-y-12">
                    <section>
                        <div class="flex justify-between items-end mb-4">
                            <div>
                                <h3 class="text-5xl font-serif text-[#2d3e2d] leading-tight">
                                    Welcome back,<br />
                                    <span class="italic"><?= htmlspecialchars($_SESSION['user'] ?? 'Vendor'); ?></span>
                                </h3>
                                <p class="text-gray-500 mt-4">Your studio has 4 new inquiries and 2 pending reviews this morning.</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-1">Current Status</p>
                                <div class="flex items-center gap-2 text-[#2d3e2d] font-bold">
                                    <div class="w-2 h-2 bg-[#4caf50] rounded-full"></div>
                                    Accepting Bookings
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-6 mt-10">
                            <div class="bg-[#f8f9fa] p-8 rounded-[2rem] border border-gray-50 hover:-translate-y-1 transition-transform cursor-default">
                                <p class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-6">Total Orders</p>
                                <div class="flex items-baseline gap-3">
                                    <span class="text-5xl font-serif text-[#2d3e2d]">128</span>
                                    <span class="text-[10px] font-bold text-[#4caf50]">+12% this month</span>
                                </div>
                            </div>
                            <div class="bg-[#e1e8e1] p-8 rounded-[2rem] border border-gray-50 hover:-translate-y-1 transition-transform cursor-default">
                                <p class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-6">New Reviews</p>
                                <div class="flex items-center gap-3">
                                    <span class="text-5xl font-serif text-[#2d3e2d]">24</span>
                                    <i data-lucide="star" class="text-[#2d3e2d] fill-[#2d3e2d] w-6 h-6"></i>
                                </div>
                            </div>
                            <div class="bg-[#f0f2f0] p-8 rounded-[2rem] border border-gray-50 hover:-translate-y-1 transition-transform cursor-default">
                                <p class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-6">Active Packages</p>
                                <div class="flex items-baseline gap-3">
                                    <span class="text-5xl font-serif text-[#2d3e2d]">06</span>
                                    <span class="text-[10px] font-bold text-gray-400">Live on store</span>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section>
                        <div class="flex justify-between items-center mb-6">
                            <h4 class="text-2xl font-serif text-[#2d3e2d]">Recent Orders</h4>
                            <button class="text-[10px] font-bold tracking-widest text-gray-400 uppercase hover:text-[#2d3e2d] transition-colors">View All</button>
                        </div>
                        <div class="bg-white rounded-[2rem] border border-gray-100 overflow-hidden shadow-sm">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="bg-[#f8f9fa] text-[10px] font-bold tracking-widest text-gray-400 uppercase">
                                        <th class="px-8 py-4">Client</th>
                                        <th class="px-8 py-4">Package</th>
                                        <th class="px-8 py-4">Status</th>
                                        <th class="px-8 py-4">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    <?php foreach ($recentOrders as $order): ?>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-8 py-5 font-semibold text-sm"><?= htmlspecialchars($order['client']) ?></td>
                                        <td class="px-8 py-5 text-sm text-gray-500"><?= htmlspecialchars($order['package']) ?></td>
                                        <td class="px-8 py-5">
                                            <span class="px-3 py-1 rounded-full text-[9px] font-bold tracking-wider <?= htmlspecialchars($order['statusColor']) ?>">
                                                <?= htmlspecialchars($order['status']) ?>
                                            </span>
                                        </td>
                                        <td class="px-8 py-5 font-semibold text-sm"><?= htmlspecialchars($order['amount']) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <section>
                        <div class="flex justify-between items-center mb-6">
                            <h4 class="text-2xl font-serif text-[#2d3e2d]">New Reviews</h4>
                            <button class="text-[10px] font-bold tracking-widest text-gray-400 uppercase hover:text-[#2d3e2d] transition-colors">Manage All</button>
                        </div>
                        <div class="bg-[#f8f9fa] p-8 rounded-[2rem] border border-gray-50">
                            <div class="flex justify-between items-start mb-6">
                                <div class="flex gap-4">
                                    <img 
                                        src="https://picsum.photos/seed/clara/100/100" 
                                        alt="Clara" 
                                        class="w-12 h-12 rounded-full object-cover"
                                        referrerpolicy="no-referrer"
                                    />
                                    <div>
                                        <h5 class="font-bold text-sm">Clara Beaumont</h5>
                                        <div class="flex gap-0.5 mt-1">
                                            <?php for($i=0; $i<5; $i++): ?>
                                                <i data-lucide="star" class="text-[#2d3e2d] fill-[#2d3e2d] w-3 h-3"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">2 Days Ago</span>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed italic">
                                "The attention to detail in the floral arrangements was simply breathtaking. NaturaWed captured our vision perfectly and went above and beyond."
                            </p>
                            <div class="flex gap-3 mt-8">
                                <button class="px-6 py-2.5 bg-[#2d3e2d] text-white rounded-full text-[10px] font-bold tracking-widest uppercase hover:opacity-90 transition-opacity">
                                    Quick Reply
                                </button>
                                <button class="px-6 py-2.5 bg-white border border-gray-200 text-gray-500 rounded-full text-[10px] font-bold tracking-widest uppercase hover:bg-gray-50 transition-colors">
                                    Dismiss
                                </button>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="w-80 space-y-8">
                    <div>
                        <p class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-6">Quick Actions</p>
                        <div class="space-y-4">
                            <button class="w-full bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-5 hover:border-[#2d3e2d]/20 transition-all group text-left">
                                <div class="w-12 h-12 rounded-xl bg-[#e1f5e1] flex items-center justify-center text-[#2d3e2d] group-hover:scale-110 transition-transform">
                                    <i data-lucide="edit-3" class="w-5 h-5"></i>
                                </div>
                                <div href="index.php?action=profile_edit">
                                    <h6 class="font-bold text-sm">Edit Profile</h6>
                                    <p class="text-[10px] text-gray-400 uppercase tracking-widest mt-0.5">Studio Details & Branding</p>
                                </div>
                            </button>
                            <button class="w-full bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-5 hover:border-[#2d3e2d]/20 transition-all group text-left">
                                <div class="w-12 h-12 rounded-xl bg-[#f8f9fa] flex items-center justify-center text-gray-400 group-hover:scale-110 transition-transform">
                                    <i data-lucide="image" class="w-5 h-5"></i>
                                </div>
                                <div href="index.php?action=portfolio">
                                    <h6 class="font-bold text-sm">Update Portfolio</h6>
                                    <p class="text-[10px] text-gray-400 uppercase tracking-widest mt-0.5">Manage your visual gallery</p>
                                </div>
                            </button>
                            <button class="w-full bg-[#2d3e2d] p-6 rounded-2xl shadow-lg flex items-center gap-5 hover:opacity-95 transition-all group text-left">
                                <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                                    <i data-lucide="plus-square" class="w-5 h-5"></i>
                                </div>
                                <div href="index.php?action=package_add">
                                    <h6 class="font-bold text-sm text-white">Add New Package</h6>
                                    <p class="text-[10px] text-white/50 uppercase tracking-widest mt-0.5">Expand your service list</p>
                                </div>
                            </button>
                        </div>
                    </div>

                    <div class="relative rounded-[2.5rem] overflow-hidden aspect-[3/4] group cursor-pointer">
                        <img 
                            src="https://picsum.photos/seed/portfolio/600/800" 
                            alt="Featured" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                            referrerpolicy="no-referrer"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-[#2d3e2d] via-[#2d3e2d]/40 to-transparent"></div>
                        <div class="absolute inset-0 flex flex-col justify-end p-8">
                            <p class="text-[10px] font-bold tracking-widest text-white/60 uppercase mb-2">Portfolio Featured</p>
                            <h5 class="text-3xl font-serif text-white leading-tight mb-6">Spring Solstice Gathering</h5>
                            <button class="flex items-center gap-2 text-[10px] font-bold tracking-widest text-white uppercase group/btn">
                                Manage Gallery
                                <i data-lucide="chevron-right" class="w-[14px] h-[14px] group-hover/btn:translate-x-1 transition-transform"></i>
                            </button>
                        </div>
                        <div class="absolute top-10 right-[-20%] w-[100%] h-[100%] opacity-20 pointer-events-none">
                            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                <path fill="#4caf50" d="M44.7,-76.4C58.1,-69.2,69.2,-58.1,76.4,-44.7C83.6,-31.3,86.9,-15.7,85.6,-0.7C84.3,14.2,78.4,28.5,70.2,41.1C62,53.7,51.5,64.7,38.9,72.4C26.3,80.1,11.6,84.5,-2.8,89.3C-17.2,94.1,-31.3,99.3,-44.7,95.6C-58.1,91.9,-70.8,79.3,-79.1,65.1C-87.4,50.9,-91.3,35.1,-92.4,19.3C-93.5,3.5,-91.8,-12.3,-86.1,-26.8C-80.4,-41.3,-70.7,-54.5,-58.2,-62.7C-45.7,-70.9,-30.4,-74.1,-15.7,-72.3C-1,70.5,13.7,73.7,28.4,76.9L44.7,-76.4Z" transform="translate(100 100)" />
                            </svg>
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