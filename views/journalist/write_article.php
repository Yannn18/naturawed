<?php
// // Pastikan pengecekan session dan role (jika sudah ada role journalist)
//  if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'journalist') {   
//     header("Location: /index.php?action=show_login");
//     exit; }

$pageTitle = "Write Article - NaturaWed Journalist";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="flex min-h-screen bg-white font-sans text-[#1a1a1a]">

    <?php require_once __DIR__ . '/../includes/journalist_sidebar.php'; ?>

    <main class="flex-1 bg-white overflow-y-auto">
        
        <header class="px-12 py-10 border-b border-gray-50 flex items-center justify-between sticky top-0 bg-white/90 backdrop-blur-md z-10">
            <h2 class="text-2xl font-serif font-bold text-[#2d3e2d]">New Inspiration Article</h2>
            
            <button type="submit" form="articleForm" class="px-6 py-2.5 bg-[#2d3e2d] text-white rounded-full text-xs font-bold tracking-widest uppercase hover:bg-[#1e291e] transition-colors shadow-md">
                Publish Article
            </button>
        </header>

        <div class="px-12 py-10 max-w-4xl">
            <form id="articleForm" action="/index.php?action=store_article" method="POST" class="bg-white rounded-[2rem] p-10 shadow-[0_0_40px_rgba(0,0,0,0.03)] border border-gray-50">
                
                <div class="space-y-8">
                    <div>
                        <label class="block text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-3">Article Title</label>
                        <input type="text" name="title" placeholder="e.g. The Art of Subtlety: Designing a Minimalist Forest Ceremony" required
                               class="w-full px-6 py-4 bg-[#f8f9fa] border-none rounded-xl text-gray-900 focus:ring-1 focus:ring-[#2d3e2d]/20 transition-all outline-none text-base placeholder-gray-400 font-serif" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-3">Author Name</label>
                            <input type="text" name="author" placeholder="e.g. Isabella Thorne" required
                                   class="w-full px-6 py-4 bg-[#f8f9fa] border-none rounded-xl text-gray-900 focus:ring-1 focus:ring-[#2d3e2d]/20 transition-all outline-none text-sm placeholder-gray-400" />
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-3">Category / Tag</label>
                            <input type="text" name="category" placeholder="e.g. EDITORIAL" required
                                   class="w-full px-6 py-4 bg-[#f8f9fa] border-none rounded-xl text-gray-900 focus:ring-1 focus:ring-[#2d3e2d]/20 transition-all outline-none text-sm placeholder-gray-400 uppercase" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-3">Cover Image URL</label>
                        <div class="relative">
                            <i data-lucide="image" class="absolute left-6 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                            <input type="url" name="image_url" placeholder="https://images.unsplash.com/..." required
                                   class="w-full pl-14 pr-6 py-4 bg-[#f8f9fa] border-none rounded-xl text-gray-900 focus:ring-1 focus:ring-[#2d3e2d]/20 transition-all outline-none text-sm placeholder-gray-400" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-3">Article Content</label>
                        <textarea name="content" rows="12" placeholder="Write your inspiration article here..." required
                                  class="w-full px-6 py-6 bg-[#f8f9fa] border-none rounded-xl text-gray-900 focus:ring-1 focus:ring-[#2d3e2d]/20 transition-all outline-none resize-none text-sm placeholder-gray-400 leading-relaxed"></textarea>
                    </div>
                </div>

            </form>
        </div>

    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>