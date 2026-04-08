    <?php 
$pageTitle = "Add New Package - NaturaWed";
// require_once __DIR__ . '/../includes/header_vendor.php'; // Contoh jika sidebar dipisah
require_once __DIR__ . '/../includes/components.php'; // Wajib panggil file komponen tombol
?>

<main class="flex-1 flex flex-col overflow-y-auto bg-[#f8f9fa]">
    <header class="h-20 px-12 flex items-center justify-between sticky top-0 bg-white/80 backdrop-blur-md z-10 border-b border-gray-100">
        <h2 class="text-xl font-serif italic text-[#2d3e2d]">Add New Package</h2>
    </header>

    <div class="px-12 py-10 max-w-4xl mx-auto w-full">
        <div class="mb-8">
            <h3 class="text-3xl font-serif text-[#2d3e2d] mb-2">Create Package</h3>
            <p class="text-gray-500 text-sm">Fill in the details to showcase your best offering to couples.</p>
        </div>

        <form action="/index.php?action=store_package" method="POST" enctype="multipart/form-data" class="bg-white rounded-[2rem] p-10 shadow-sm border border-gray-50 space-y-6">
            
            <div class="grid grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label class="block text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-2">Package Name</label>
                    <input type="text" name="package_name" placeholder="e.g., The Botanical Suite" required
                           class="w-full bg-[#f0f2f0] border-transparent rounded-xl px-4 py-3 text-sm focus:border-[#2d3e2d] focus:ring-0 transition-colors">
                </div>

                <div>
                    <label class="block text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-2">Category</label>
                    <select name="category_id" required class="w-full bg-[#f0f2f0] border-transparent rounded-xl px-4 py-3 text-sm focus:border-[#2d3e2d] focus:ring-0 transition-colors">
                        <option value="">Select Category...</option>
                        <option value="1">Venue</option>
                        <option value="2">Catering</option>
                        <option value="3">Photography</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-2">Price (IDR)</label>
                    <input type="number" name="price" placeholder="e.g., 15000000" required
                           class="w-full bg-[#f0f2f0] border-transparent rounded-xl px-4 py-3 text-sm focus:border-[#2d3e2d] focus:ring-0 transition-colors">
                </div>

                <div class="col-span-2">
                    <label class="block text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-2">Description</label>
                    <textarea name="description" rows="4" placeholder="Describe the magical experience..." required
                              class="w-full bg-[#f0f2f0] border-transparent rounded-xl px-4 py-3 text-sm focus:border-[#2d3e2d] focus:ring-0 transition-colors"></textarea>
                </div>

                <div class="col-span-2">
                    <label class="block text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-2">Cover Image</label>
                    <div class="border-2 border-dashed border-gray-200 rounded-2xl p-8 text-center hover:bg-gray-50 transition-colors cursor-pointer">
                        <input type="file" name="main_image" accept="image/*" class="hidden" id="coverUpload">
                        <label for="coverUpload" class="cursor-pointer flex flex-col items-center">
                            <i data-lucide="image-plus" class="w-8 h-8 text-gray-400 mb-3"></i>
                            <span class="text-sm font-semibold text-[#2d3e2d]">Click to upload</span>
                            <span class="text-xs text-gray-500 mt-1">PNG, JPG up to 5MB</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-6 mt-6 border-t border-gray-100">
                <?= ButtonSecondary('Cancel', 'button', "window.history.back()") ?>
                <?= ButtonPrimary('Publish Package', 'submit') ?>
            </div>
        </form>
    </div>
</main>