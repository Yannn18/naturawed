<?php
// Tab tetap statis
$tabs = ['All', 'Ongoing', 'Completed', 'Canceled'];
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
                Review your curated wedding experiences and upcoming arrangements.
            </p>
        </div>

        <div class="flex items-center space-x-10 border-b border-zinc-200 mb-16">
            <?php foreach ($tabs as $tab): ?>
                <a href="index.php?action=history&tab=<?= $tab; ?>" 
                   class="pb-4 text-sm font-semibold tracking-wider transition-all relative <?= $activeTab === $tab ? 'text-zinc-900 border-b-2 border-[#2d4a22]' : 'text-zinc-400 hover:text-zinc-600'; ?>">
                    <?= $tab; ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="space-y-12">
            <?php if (empty($historyItems)): ?>
                <div class="text-center py-20 bg-white rounded-[32px] border border-dashed border-zinc-200">
                    <p class="text-zinc-400 italic">No arrangements found in this category.</p>
                </div>
            <?php else: ?>
                <?php foreach ($historyItems as $item): ?>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 bg-white rounded-[32px] overflow-hidden p-2 shadow-sm border border-zinc-100">
                        <div class="lg:col-span-1 aspect-[4/3] rounded-[28px] overflow-hidden relative">
                            <img src="<?= htmlspecialchars($item['main_image']); ?>" class="w-full h-full object-cover">
                            
                            <?php 
                                $statusClass = "bg-zinc-500";
                                $statusLabel = $item['payment_status'] ?? 'Unpaid';
                                
                                if($statusLabel == 'success') { $statusClass = "bg-[#2d4a22]"; $statusLabel = "Confirmed"; }
                                elseif($statusLabel == 'pending_verification') { $statusClass = "bg-amber-500"; $statusLabel = "Pending"; }
                                elseif($statusLabel == 'unpaid' || !$statusLabel) { $statusClass = "bg-red-500"; $statusLabel = "Unpaid"; }
                            ?>
                            <div class="absolute top-6 left-6 px-3 py-1 <?= $statusClass ?> text-white text-[10px] font-bold tracking-widest uppercase rounded-full">
                                <?= $statusLabel ?>
                            </div>
                        </div>

                        <div class="lg:col-span-2 p-8 flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start">
                                    <h2 class="text-3xl serif mb-2"><?= htmlspecialchars($item['package_name']); ?></h2>
                                    <span class="text-[10px] font-mono text-zinc-400 uppercase"><?= date('d M Y', strtotime($item['created_at'])); ?></span>
                                </div>
                                <p class="text-zinc-500 mb-4 italic">Event Date: <?= date('d F Y', strtotime($item['event_date'])); ?></p>
                                <p class="text-sm text-zinc-400 line-clamp-2">Location: <?= htmlspecialchars($item['event_location']); ?></p>
                            </div>

                            <div class="flex items-center justify-between mt-8 pt-8 border-t border-zinc-50">
                                <div>
                                    <p class="text-[10px] uppercase text-zinc-400 mb-1">Total Investment</p>
                                    <p class="text-2xl font-semibold">
                                        IDR <?= number_format($item['total_price'] ?? 0, 0, ',', '.'); ?>
                                    </p>
                                </div>

                                <?php if($item['payment_status'] != 'success' && $item['payment_status'] != 'pending_verification'): ?>
                                    <a href="index.php?action=payment-instruction&booking_id=<?= $item['id'] ?>" class="bg-[#2d4a22] text-white px-8 py-4 rounded-xl font-semibold hover:bg-[#1e3317] transition-colors">Pay Now →</a>
                                <?php else: ?>
                                    <button class="border border-zinc-200 text-zinc-900 px-8 py-4 rounded-xl font-semibold hover:bg-zinc-50 transition-colors">View Details</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>