<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= isset($pageTitle) ? $pageTitle : 'NaturaWed' ?></title>
    <link rel="stylesheet" href="/assets/css/output.css" />
  </head>
  <body class="bg-[#d1e2da] overflow-x-hidden">

    <header class="sticky top-0 z-50 flex items-center justify-between bg-[#e8e8d8] px-12 py-4 shadow-sm">
      
      <div class="text-3xl font-bold text-[#2d4a22] tracking-tight">
        NaturaWed
      </div>
      
      <nav class="hidden items-center space-x-10 md:flex">
        <a href="/index.php?action=home" class="relative font-semibold text-[#2d4a22] after:absolute after:-bottom-1 after:left-0 after:h-0.5 after:w-full after:bg-[#2d4a22]">Home</a>
        <a href="#" class="font-semibold text-gray-600 hover:text-[#2d4a22] transition-colors">Vendors</a>
        <a href="#" class="font-semibold text-gray-600 hover:text-[#2d4a22] transition-colors">Inspiration</a>
        <a href="#" class="font-semibold text-gray-600 hover:text-[#2d4a22] transition-colors">Deals</a>
      </nav>
      
      <div class="flex items-center space-x-6 text-gray-600">
        
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 cursor-pointer hover:text-[#2d4a22] transition-colors">
            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
        </svg>

        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 cursor-pointer hover:text-[#2d4a22] transition-colors">
            <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"/>
        </svg>

        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 cursor-pointer hover:text-[#2d4a22] transition-colors">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
        </svg>

        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 cursor-pointer hover:text-[#2d4a22] transition-colors">
            <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M12 7v5l4 2"/>
        </svg>

      </div>
    </header>
  </body>
</html>