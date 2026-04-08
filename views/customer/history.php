<?php
// Ambil tab aktif dari URL, default ke 'All'
$activeTab = $_GET['tab'] ?? 'All';
$tabs = ['All', 'Ongoing', 'Completed', 'Reviewed', 'Canceled'];

// Mock Data (Nantinya ini diambil dari Database)
$historyItems = [
    ['title' => "The Heritage Garden", 'date' => "20 MAY 2024", 'cat' => "BESPOKE FLORAL CURATION", 'price' => "$1,250.00", 'desc' => "The botanical arrangements transformed the garden into a sanctuary of natural elegance."],
    ['title' => "Atelier Workshop", 'date' => "12 APR 2024", 'cat' => "SUSTAINABILITY IN DESIGN", 'price' => "$450.00", 'desc' => "An intimate study of artisanal dried florals and organic architectural forms."],
    // ... data lainnya
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History - Naturawed</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style>
        .serif { font-family: 'Times New Roman', serif; }
        .bg-brand-cream { background-color: #fdfcf7; }
    </style>
</head>
<body class="min-h-screen bg-brand-cream font-sans text-zinc-900">

    <?php include __DIR__ . '/../includes/header.php'; ?>


    <main class="max-w-7xl mx-auto px-6 py-16">
        <div class="mb-12">
            <h1 class="text-6xl serif mb-6">Booking History</h1>
            <p class="text-zinc-500 max-w-2xl leading-relaxed">
                Review your curated wedding experiences and upcoming arrangements within the Atelier's seasonal calendar.
            </p>
        </div>

        <div class="flex items-center space-x-10 border-b border-zinc-200 mb-16">
            <?php foreach ($tabs as $tab): ?>
                <a href="index.php?action=history&tab=<?php echo $tab; ?>" 
                   class="pb-4 text-sm font-semibold tracking-wider transition-all relative <?php echo $activeTab === $tab ? 'text-zinc-900 border-b-2 border-[#2d4a22]' : 'text-zinc-400 hover:text-zinc-600'; ?>">
                    <?php echo $tab; ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="space-y-12">
            <?php if ($activeTab === 'All'): ?>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 bg-white rounded-[32px] overflow-hidden p-2 shadow-sm border border-zinc-100">
                    <div class="lg:col-span-1 aspect-[4/3] rounded-[28px] overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1519741497674-611481863552" class="w-full h-full object-cover">
                        <div class="absolute top-6 left-6 px-3 py-1 bg-red-500 text-white text-[10px] font-bold tracking-widest uppercase rounded-full">Unpaid</div>
                    </div>
                    <div class="lg:col-span-2 p-8 flex flex-col justify-between">
                        <div>
                            <h2 class="text-3xl serif mb-4">Seashell Bomb Package</h2>
                            <p class="text-zinc-500 mb-8">A romantic beachside session...</p>
                        </div>
                        <div class="flex items-center justify-between mt-12 pt-8 border-t border-zinc-50">
                            <div>
                                <p class="text-[10px] uppercase text-zinc-400 mb-1">Total Investment</p>
                                <p class="text-2xl font-semibold">IDR 120.500.000</p>
                            </div>
                            <a href="index.php?action=payment-instruction&booking_id=<?= $item['id'] ?>" class="bg-[#2d4a22] text-white px-8 py-4 rounded-xl font-semibold hover:bg-[#1e3317] transition-colors">Pay Now →</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($activeTab !== 'All'): ?>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <?php foreach ($historyItems as $item): ?>
                        <div class="bg-white rounded-[32px] overflow-hidden border border-zinc-100 shadow-sm group">
                            <div class="p-8">
                                <span class="text-[10px] font-bold tracking-[0.2em] uppercase text-zinc-400 mb-3 block"><?php echo $item['cat']; ?></span>
                                <h3 class="text-2xl serif mb-4"><?php echo $item['title']; ?></h3>
                                <p class="text-sm text-zinc-500 mb-8"><?php echo $item['desc']; ?></p>
                                <div class="flex items-center justify-between pt-6 border-t border-zinc-50">
                                    <p class="text-sm text-zinc-400">Total: <span class="text-zinc-900 font-semibold"><?php echo $item['price']; ?></span></p>
                                    <button class="text-[10px] font-bold uppercase text-zinc-400 hover:text-zinc-900">Details</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-32 w-full bg-[#2d4a22] rounded-[48px] overflow-hidden flex flex-col lg:flex-row">
            <div class="flex-1 p-16 lg:p-24 text-white">
                <h2 class="text-5xl serif mb-8 leading-tight">Need guidance?</h2>
                <button class="bg-white text-[#2d4a22] px-8 py-4 rounded-xl font-semibold">Speak with a Concierge</button>
            </div>
            <div class="flex-1">
                <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622" class="w-full h-full object-cover">
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>