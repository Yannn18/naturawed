<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - NaturaWed</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <style>
        .serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="min-h-screen bg-[#f9f8f3] font-sans text-zinc-900 pb-20">

    <header class="w-full px-12 py-8 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <button onclick="window.history.back()" class="p-2 hover:bg-white rounded-full transition-colors flex items-center gap-2 group">
                <svg width="24" height="24" fill="none" stroke="#2d4a22" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
                <span class="text-2xl font-serif text-[#2d4a22]">NaturaWed</span>
            </button>
        </div>
        <div class="w-10 h-10 bg-[#2d4a22] rounded-full flex items-center justify-center">
            <div class="w-5 h-5 border-2 border-white rounded-full relative">
                <div class="absolute -top-1 left-1/2 -translate-x-1/2 w-1 h-2 bg-white rounded-full"></div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-12 py-8">
        <div class="mb-16">
            <h1 class="text-6xl serif text-[#2d4a22] mb-4">Finalize Your Celebration</h1>
            <p class="text-zinc-500 max-w-2xl leading-relaxed">
                Secure your date with Verdant Atelier. Our artisans are ready to bring your botanical vision to life with the Emerald Luxe experience.
            </p>
        </div>

        <form action="index.php?action=payment" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-16">
            <div class="lg:col-span-2 space-y-16">
                
                <section>
                    <div class="flex items-center gap-4 mb-8">
                        <span class="text-zinc-300 font-mono text-sm">01</span>
                        <h2 class="text-2xl serif text-[#2d4a22]">Contact Details</h2>
                    </div>
                    <div class="bg-zinc-100/50 rounded-[32px] p-10 space-y-8 border border-zinc-100">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold tracking-widest text-zinc-400 uppercase">Full Name</label>
                            <input type="text" name="full_name" placeholder="e.g. Julianne Sterling" class="w-full bg-zinc-100 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-[#2d4a22]/20 placeholder:text-zinc-400">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold tracking-widest text-zinc-400 uppercase">Phone Number</label>
                                <input type="text" name="phone" placeholder="+62 812..." class="w-full bg-zinc-100 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-[#2d4a22]/20">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold tracking-widest text-zinc-400 uppercase">Email Address</label>
                                <input type="email" name="email" placeholder="julianne@example.com" class="w-full bg-zinc-100 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-[#2d4a22]/20">
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="flex items-center gap-4 mb-8">
                        <span class="text-zinc-300 font-mono text-sm">02</span>
                        <h2 class="text-2xl serif text-[#2d4a22]">Wedding Details</h2>
                    </div>
                    <div class="bg-zinc-100/50 rounded-[32px] p-10 space-y-8 border border-zinc-100">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold tracking-widest text-zinc-400 uppercase">Event Date</label>
                                <input type="date" name="event_date" class="w-full bg-zinc-100 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-[#2d4a22]/20 text-zinc-600">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold tracking-widest text-zinc-400 uppercase">Location / Venue</label>
                                <div class="relative">
                                    <div class="absolute left-6 top-1/2 -translate-y-1/2 text-zinc-400">
                                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                    </div>
                                    <input type="text" name="location" placeholder="City or Venue Name" class="w-full bg-zinc-100 border-none rounded-2xl py-4 pl-14 pr-6 focus:ring-2 focus:ring-[#2d4a22]/20">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="bg-[#2d4a22] rounded-[40px] p-12 text-white">
                    <h3 class="text-3xl serif mb-10">Emerald Luxe Inclusion</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12">
                        <?php 
                        $inclusions = ["Full Floral Scape Design", "On-site Creative Direction", "Custom Welcome Signage", "Bespoke Bridal Bouquet", "Premium Silk Runners", "Pre-Wedding Consultation"];
                        foreach ($inclusions as $item): ?>
                        <div class="flex items-start gap-4">
                            <div class="w-5 h-5 rounded-full border border-white/30 flex items-center justify-center flex-shrink-0 mt-1">
                                <svg width="12" height="12" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                            </div>
                            <span class="text-sm opacity-90"><?= $item ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            </div>

            <div class="space-y-8">
                <section class="bg-white rounded-[40px] overflow-hidden shadow-xl shadow-zinc-200/50 sticky top-12">
                    <div class="aspect-[4/3] relative">
                        <img src="https://images.unsplash.com/photo-1614850523296-d8c1af93d400?w=800" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex flex-col justify-end p-8">
                            <h3 class="text-3xl serif text-white">Emerald Luxe</h3>
                        </div>
                    </div>
                    
                    <div class="p-10 space-y-6">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-zinc-400">Total Amount</span>
                            <span class="font-bold text-2xl text-[#2d4a22]">IDR 15.000.000</span>
                        </div>
                        <button type="submit" class="w-full py-6 bg-[#3a4d39] text-white rounded-2xl font-bold text-lg hover:bg-[#2d4a22] transition-all">
                            COMPLETE PURCHASE
                        </button>
                    </div>
                </section>
            </div>
        </form>
    </main>
</body>
</html>