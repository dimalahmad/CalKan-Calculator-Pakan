<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CalKan - Kalkulator Formula Pakan Mudah</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (via CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-55 text-slate-900 min-h-screen flex flex-col antialiased">

    <!-- Top Navigation Bar -->
    <header class="bg-emerald-700 text-white shadow-md">
        <div class="max-w-6xl mx-auto px-4 py-4 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3 text-center md:text-left">
                <div class="bg-white/10 p-2 rounded-lg font-bold text-lg hidden md:block">
                    CALKAN
                </div>
                <div>
                    <h1 id="header-title" class="text-xl md:text-2xl font-bold tracking-tight font-sans">Calculator Pakan CalKan</h1>
                    <p id="header-subtitle" class="text-xs text-emerald-100 font-medium">Formulasi Pakan Ternak Mandiri - Mudah dan Praktis</p>
                </div>
            </div>

            <!-- Tab Buttons & Change Mode Action -->
            <div class="flex items-center gap-3 flex-wrap justify-center">
                <button id="btn-change-mode" onclick="showModeSelection()" class="hidden bg-emerald-800 hover:bg-emerald-900 text-white font-bold px-3 py-2 rounded-xl text-sm border border-emerald-600 transition-colors">
                    Ganti Kategori
                </button>
                <nav id="header-tabs-nav" class="hidden flex bg-emerald-800/50 p-1 rounded-xl border border-emerald-650 overflow-x-auto max-w-full whitespace-nowrap scrollbar-none">
                    <button onclick="switchTab('calculator')" id="btn-tab-calculator" class="tab-btn px-2.5 sm:px-4 py-1.5 sm:py-2 text-[11px] sm:text-xs md:text-sm font-bold rounded-lg transition-all duration-150 bg-white text-emerald-800 shadow">
                        Hitung Pakan
                    </button>
                    <button onclick="switchTab('ingredients')" id="btn-tab-ingredients" class="tab-btn px-2.5 sm:px-4 py-1.5 sm:py-2 text-[11px] sm:text-xs md:text-sm font-bold rounded-lg transition-all duration-150 text-white hover:bg-emerald-600/50">
                        Data Bahan Pakan
                    </button>
                    <button onclick="switchTab('livestock')" id="btn-tab-livestock" class="tab-btn px-2.5 sm:px-4 py-1.5 sm:py-2 text-[11px] sm:text-xs md:text-sm font-bold rounded-lg transition-all duration-150 text-white hover:bg-emerald-600/50">
                        Standar Ternak
                    </button>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 max-w-6xl w-full mx-auto px-4 py-6">

        <!-- ==================== TAB: MODE SELECTION (LANDING) ==================== -->
        <div id="mode-selection-screen" class="max-w-4xl mx-auto my-8 md:my-16 space-y-8">
            <div class="text-center space-y-2">
                <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900">Selamat Datang di CalKan</h2>
                <p class="text-slate-600 text-base md:text-lg">Silakan pilih kategori hewan untuk mulai menyusun formulasi pakan:</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Option 1: Pets -->
                <button onclick="selectAppMode('peliharaan')" class="bg-white border-2 border-slate-200/80 hover:border-emerald-600 rounded-3xl p-6 md:p-8 shadow-sm hover:shadow-xl hover:shadow-emerald-100/40 transform hover:scale-[1.015] active:scale-[0.985] transition-all duration-300 text-left flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="bg-emerald-50 text-emerald-800 px-3 py-1.5 text-xs font-bold rounded-xl w-max border border-emerald-250">
                            Kategori Rumah Tangga
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-emerald-800 transition-colors">Hewan Peliharaan</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Kalkulasi pakan anjing dan kucing (Puppy, Kitten, Dewasa, Senior, Hamil, Menyusui) sesuai standar AAFCO, FEDIAF, dan NRC. Menggunakan parameter gizi Kadar Air, Protein, Lemak, Serat Kasar, Kadar Abu, Kalsium (Ca), Fosfor (P), dan Energi Metabolis (ME).</p>
                    </div>
                    <div class="mt-8 text-emerald-700 font-extrabold text-sm flex items-center gap-1.5 group-hover:translate-x-1.5 transition-transform">
                        Pilih Hewan Peliharaan <span class="text-lg leading-none">&rarr;</span>
                    </div>
                </button>

                <!-- Option 2: Livestock -->
                <button onclick="selectAppMode('ternak')" class="bg-white border-2 border-slate-200/80 hover:border-emerald-600 rounded-3xl p-6 md:p-8 shadow-sm hover:shadow-xl hover:shadow-emerald-100/40 transform hover:scale-[1.015] active:scale-[0.985] transition-all duration-300 text-left flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="bg-emerald-50 text-emerald-800 px-3 py-1.5 text-xs font-bold rounded-xl w-max border border-emerald-250">
                            Kategori Peternakan
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-emerald-800 transition-colors">Hewan Ternak</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Kalkulasi formulasi pakan untuk Sapi Perah, Sapi Potong, Kambing, dan Domba. Menggunakan parameter gizi Bahan Kering (BK), Protein Kasar (PK), Lemak Kasar (LK), Kadar Abu, Kalsium (Ca), Fosfor (P), dan Energi TDN.</p>
                    </div>
                    <div class="mt-8 text-emerald-700 font-extrabold text-sm flex items-center gap-1.5 group-hover:translate-x-1.5 transition-transform">
                        Pilih Hewan Ternak <span class="text-lg leading-none">&rarr;</span>
                    </div>
                </button>
            </div>
        </div>

        <!-- ==================== MAIN CALCULATOR APP CONTAINER ==================== -->
        <div id="main-calculator-app" class="hidden space-y-6">

            <!-- ==================== TAB: CALCULATOR ==================== -->
            <div id="tab-calculator" class="tab-content space-y-6">
                
                <!-- Panduan Singkat Banner -->
                <div class="bg-gradient-to-br from-emerald-50 to-teal-50/30 border-l-4 border-emerald-600 rounded-r-2xl p-5 shadow-xs border border-slate-200/60 flex flex-col md:flex-row gap-4 items-start">
                    <div class="bg-emerald-600/10 p-2.5 rounded-xl text-emerald-800 hidden sm:block">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="space-y-3 flex-1">
                        <h3 class="text-base font-bold text-emerald-950">Petunjuk Penggunaan Kalkulator:</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs md:text-sm text-slate-750 leading-relaxed">
                            <div class="space-y-2.5">
                                <div class="flex gap-2">
                                    <span class="font-black text-emerald-800 bg-emerald-100/80 px-2 py-0.5 rounded text-xs h-max">1</span>
                                    <p><span class="font-bold text-slate-900">Pilih Jenis Hewan & Jumlah Ekor:</span> Tentukan jenis hewan serta jumlah hewan di Langkah 1. <span class="text-slate-500 text-xs block mt-0.5">(Khusus Pets: masukkan juga Berat Badan, Aktivitas, & Target Gizi).</span></p>
                                </div>
                                <div class="flex gap-2">
                                    <span class="font-black text-emerald-800 bg-emerald-100/80 px-2 py-0.5 rounded text-xs h-max">2</span>
                                    <p><span class="font-bold text-slate-900">Rekomendasi Pakan Instan:</span> Klik tombol <span class="text-emerald-700 font-bold">"Gunakan Resep Rekomendasi"</span> untuk memformulasikan pakan secara otomatis dengan gizi penuh (Hijau) & biaya paling hemat.</p>
                                </div>
                            </div>
                            <div class="space-y-2.5">
                                <div class="flex gap-2">
                                    <span class="font-black text-emerald-800 bg-emerald-100/80 px-2 py-0.5 rounded text-xs h-max">3</span>
                                    <p><span class="font-bold text-slate-900">Formulasi Mandiri (Langkah 2):</span> Atau pilih bahan secara manual. Atur takaran pakan dalam satuan <span class="font-bold text-slate-800">KG</span> (untuk Ternak) atau <span class="font-bold text-slate-800">Gram</span> (untuk Pets).</p>
                                </div>
                                <div class="flex gap-2">
                                    <span class="font-black text-emerald-800 bg-emerald-100/80 px-2 py-0.5 rounded text-xs h-max">4</span>
                                    <p><span class="font-bold text-slate-900">Analisis & Rincian (Langkah 3):</span> Lihat total berat campuran pakan, porsi per ekor, rincian timbangan, perbandingan gizi lengkap, serta estimasi biaya pakan keseluruhan maupun per ekor.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grid Layout for Inputs & Outputs -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    
                    <!-- Left Column: Step 1 & Step 2 (7 cols) -->
                    <div class="lg:col-span-7 space-y-6">
                        
                        <!-- LANGKAH 1: Ternak & Berat -->
                        <div class="bg-white border border-slate-200/80 rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-md/50 transition-shadow space-y-4">
                            <div class="flex items-center gap-3 border-b border-slate-100 pb-3 flex-wrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-black bg-emerald-100 text-emerald-800 border border-emerald-250">
                                    Langkah 1
                                </span>
                                <h2 id="step-1-title" class="text-base md:text-lg font-bold text-slate-900">Pilih Jenis Ternak dan Berat Pakan</h2>
                            </div>
                            
                            <div class="grid grid-cols-1 gap-4">
                                <!-- Select Ternak & Jumlah Ternak -->
                                <div id="ternak-select-wrapper" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div class="sm:col-span-2">
                                        <label id="step-1-label" for="select-ternak" class="block text-sm font-bold text-slate-700 mb-2">Jenis Ternak:</label>
                                        <select id="select-ternak" onchange="onTernakChange()" class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3 text-base text-slate-800 font-medium focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-700 focus:outline-none">
                                            <option value="">-- Pilih Hewan --</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="ternak-animal-count" class="block text-sm font-bold text-slate-700 mb-2">Jumlah Hewan (Ekor):</label>
                                        <input type="number" id="ternak-animal-count" value="1" min="1" oninput="calculateFeed()" class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3 text-base text-slate-800 font-bold focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-700 focus:outline-none">
                                    </div>
                                </div>
                                
                                <div class="flex justify-center pt-1 hidden" id="ternak-rec-recipe-wrapper">
                                    <button type="button" onclick="applyTernakRecommendedRecipe()" id="btn-ternak-rec-recipe" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-4 py-2.5 rounded-xl shadow-sm hover:shadow transition-all flex items-center gap-1.5">
                                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                        Gunakan Resep Rekomendasi
                                    </button>
                                </div>

                                <input type="hidden" id="input-weight" value="0">
                            </div>

                            <!-- Pet Energy & Feeding Calculator (Hanya muncul di mode peliharaan) -->
                            <div id="pet-energy-calculator-container" class="hidden border-t border-slate-100 pt-4 space-y-4">
                                <h3 class="text-sm font-bold text-slate-700">Estimasi Kebutuhan Energi & Pakan Harian:</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <!-- Input Berat Badan Hewan -->
                                    <div>
                                        <label for="pet-body-weight" class="block text-xs font-bold text-slate-600 mb-1">Berat Badan Hewan (KG):</label>
                                        <input type="number" id="pet-body-weight" value="0" min="0" step="any" oninput="calculatePetEnergy()" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-sm text-slate-800 font-bold focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-700 focus:outline-none">
                                    </div>
                                    <!-- Select Faktor Kondisi / Aktivitas & Target -->
                                    <div>
                                        <label for="pet-activity-factor" class="block text-xs font-bold text-slate-600 mb-1">Status / Aktivitas & Target Gizi:</label>
                                        <select id="pet-activity-factor" onchange="calculatePetEnergy()" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-sm text-slate-800 font-semibold focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-700 focus:outline-none">
                                            <option value="" data-req-id="">-- Pilih Status & Target --</option>
                                            <option value="1.6" data-req-id="2">Anjing: Dewasa Normal (1.6x RER)</option>
                                            <option value="2.0" data-req-id="2">Anjing: Dewasa Aktif (2.0x RER)</option>
                                            <option value="1.2" data-req-id="3">Anjing: Senior / Kurang Aktif (1.2x RER)</option>
                                            <option value="3.0" data-req-id="1">Anjing: Puppy (3.0x RER)</option>
                                            <option value="3.0" data-req-id="4">Anjing: Hamil (3.0x RER)</option>
                                            <option value="3.0" data-req-id="5">Anjing: Menyusui (3.0x RER)</option>
                                            <option value="1.2" data-req-id="7">Kucing: Dewasa Steril (1.2x RER)</option>
                                            <option value="1.4" data-req-id="7">Kucing: Dewasa Tidak Steril (1.4x RER)</option>
                                            <option value="1.0" data-req-id="8">Kucing: Senior / Kurang Aktif (1.0x RER)</option>
                                            <option value="2.5" data-req-id="6">Kucing: Kitten (2.5x RER)</option>
                                            <option value="2.5" data-req-id="9">Kucing: Hamil (2.5x RER)</option>
                                            <option value="2.5" data-req-id="10">Kucing: Menyusui (2.5x RER)</option>
                                        </select>
                                    </div>
                                    <!-- Input Jumlah Hewan -->
                                    <div>
                                        <label for="pet-animal-count" class="block text-xs font-bold text-slate-600 mb-1">Jumlah Hewan (Ekor):</label>
                                        <input type="number" id="pet-animal-count" value="1" min="1" oninput="calculatePetEnergy()" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-sm text-slate-800 font-bold focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-700 focus:outline-none">
                                    </div>
                                </div>
                                
                                <!-- Output Box RER, MER, and Recommended Grams -->
                                <div class="grid grid-cols-3 gap-2 bg-emerald-50/60 rounded-xl p-3 border border-emerald-100/80 text-center">
                                    <div>
                                        <p class="text-[10px] font-bold text-emerald-800 uppercase tracking-wider">RER</p>
                                        <p id="pet-rer-val" class="text-sm font-black text-slate-900 mt-0.5">0 kcal/hari</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-emerald-800 uppercase tracking-wider">MER (Kebutuhan Energi)</p>
                                        <p id="pet-mer-val" class="text-sm font-black text-slate-900 mt-0.5">0 kcal/hari</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-emerald-800 uppercase tracking-wider">Rekomendasi Porsi</p>
                                        <p id="pet-rec-feed-val" class="text-sm font-black text-emerald-750 mt-0.5 font-mono">0 Gram/hari</p>
                                    </div>
                                </div>

                                <div class="flex justify-center pt-1" id="rec-recipe-wrapper">
                                    <button type="button" onclick="applyRecommendedRecipe()" id="btn-rec-recipe" class="hidden bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-4 py-2.5 rounded-xl shadow-sm hover:shadow transition-all flex items-center gap-1.5">
                                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                        Gunakan Resep Rekomendasi
                                    </button>
                                </div>
                            </div>

                            <!-- Mini Livestock/Pet Requirement Card -->
                            <div id="ternak-req-card" class="hidden bg-emerald-50/50 rounded-xl p-4 border border-emerald-100 space-y-3">
                                <h3 id="req-card-title" class="text-sm font-bold text-emerald-800">Target Nutrisi Minimal Ternak:</h3>
                                <div id="ternak-req-grid" class="grid gap-2 text-center text-xs">
                                    <!-- Injected dynamically by JS -->
                                </div>
                            </div>
                        </div>

                        <!-- LANGKAH 2: Pemilihan Bahan -->
                        <div class="bg-white border border-slate-200/80 rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-md/50 transition-shadow space-y-4">
                            <div class="flex items-center justify-between border-b border-slate-100 pb-3 flex-wrap gap-3">
                                <div class="flex items-center gap-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-black bg-emerald-100 text-emerald-800 border border-emerald-250">
                                        Langkah 2
                                    </span>
                                    <h2 class="text-base md:text-lg font-bold text-slate-900">Atur Campuran Bahan Pakan</h2>
                                </div>
                                
                                <!-- Hidden input to track row count -->
                                <input type="hidden" id="input-rows" value="3">

                                <!-- Row Adder/Remover Buttons -->
                                <div class="flex items-center gap-2">
                                    <button onclick="decrementRows()" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-3 py-2 rounded-xl text-sm border border-slate-300 transition-colors shadow-xs">
                                        Kurang Bahan
                                    </button>
                                    <span class="text-sm font-bold px-1 text-slate-700" id="label-row-count">3 Bahan</span>
                                    <button onclick="incrementRows()" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-3 py-2 rounded-xl text-sm transition-colors shadow-xs">
                                        Tambah Bahan
                                    </button>
                                </div>
                            </div>

                            <!-- Feed Table -->
                            <div class="border border-slate-200 rounded-xl overflow-hidden">
                                <table class="w-full block sm:table text-left border-collapse">
                                    <thead class="hidden sm:table-header-group">
                                        <tr class="bg-slate-55 border-b border-slate-200 text-xs font-bold text-slate-600 uppercase">
                                            <th class="py-3 px-3 w-1/2">Nama Bahan Pakan</th>
                                            <th id="th-weight-column" class="py-3 px-2 w-28 text-center">Porsi (%)</th>
                                            <th class="py-3 px-3 w-36 price-column">Harga (Rp/Kg)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="feed-rows-container" class="block sm:table-row-group divide-y divide-slate-150 sm:divide-y sm:divide-slate-100">
                                        <!-- Dynamic rows injected here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Step 3 Results (5 cols) -->
                    <div class="lg:col-span-5 space-y-6">
                        
                        <!-- LANGKAH 3: Hasil & Biaya -->
                        <div class="bg-white border border-slate-200/80 rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-md/50 transition-shadow space-y-5">
                            <div class="flex items-center gap-3 border-b border-slate-100 pb-3 flex-wrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-black bg-emerald-100 text-emerald-800 border border-emerald-250">
                                    Langkah 3
                                </span>
                                <h2 id="step-3-title" class="text-base md:text-lg font-bold text-slate-900">Hasil Formulasi dan Biaya</h2>
                            </div>

                            <!-- Progress Bar for total weight -->
                            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 space-y-2">
                                <div class="flex justify-between items-center text-sm font-bold">
                                    <span id="total-percent-label" class="text-slate-600">Total berat Campuran:</span>
                                    <span id="total-percent-badge" class="px-2.5 py-0.5 rounded-lg bg-red-100 text-red-800 font-extrabold border border-red-200 text-base">0 Gram</span>
                                </div>
                                <div id="per-animal-weight-container" class="flex justify-between items-center text-xs font-semibold text-slate-550 border-t border-slate-150 pt-2 mt-1 hidden">
                                    <span>Porsi per Ekor:</span>
                                    <span id="per-animal-weight-val" class="font-bold text-slate-700">0 Gram</span>
                                </div>
                                <div class="w-full bg-slate-200 h-3 rounded-full overflow-hidden border border-slate-350 hidden">
                                    <div id="total-percent-bar" class="h-full bg-red-500 transition-all duration-200" style="width: 0%"></div>
                                </div>
                                <p id="total-percent-warning" class="text-xs text-red-850 font-bold bg-red-50 p-2.5 rounded-lg border border-red-200">
                                    PENTING: Porsi campuran harus pas 100%! Silakan sesuaikan kembali persentase bahan di Langkah 2.
                                </p>
                            </div>

                            <!-- Cost Summary -->
                            <div id="cost-summary-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-3">
                                <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 text-center shadow-xs">
                                    <p class="text-xs font-bold text-emerald-800 uppercase tracking-wider">Harga Pakan per KG</p>
                                    <p id="cost-per-kg" class="text-2xl font-black text-slate-900 mt-1">Rp 0</p>
                                </div>
                                <div class="bg-slate-55 border border-slate-200 rounded-xl p-4 text-center shadow-xs space-y-1">
                                    <p class="text-xs font-bold text-slate-600 uppercase tracking-wider">Total Biaya Campuran</p>
                                    <p id="total-cost" class="text-2xl font-black text-emerald-700 mt-1">Rp 0</p>
                                    <div id="per-animal-cost-wrapper" class="text-xs text-slate-500 font-bold border-t border-slate-200 pt-1.5 mt-1.5 hidden">
                                        Biaya per Ekor: <span id="per-animal-cost-val" class="text-slate-800 font-extrabold font-mono">Rp 0</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Ingredient mix breakdown list -->
                            <div class="space-y-3">
                                <h3 class="text-sm font-bold text-slate-700">Rincian Timbangan Campuran:</h3>
                                <div id="breakdown-container" class="space-y-2 max-h-52 overflow-y-auto pr-1">
                                    <p class="text-sm text-slate-500 italic text-center py-4 bg-slate-50 rounded-xl border border-slate-200">Belum ada bahan pakan yang dipilih.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Comparison Table: Nutrient Profile vs Targets -->
                        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-4">
                            <h2 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Cek Kecukupan Gizi Pakan</h2>

                             <div class="border border-slate-200 rounded-xl overflow-hidden">
                                <table class="w-full text-center text-xs sm:text-sm border-collapse">
                                    <thead>
                                        <tr class="bg-slate-55 border-b border-slate-200 text-slate-600 font-bold">
                                            <th class="py-2.5 px-2 text-left">Nutrisi</th>
                                            <th class="py-2.5 px-1.5 sm:px-2">Hasil</th>
                                            <th class="py-2.5 px-1.5 sm:px-2">Target</th>
                                            <th class="py-2.5 px-1.5 sm:px-2">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="nutrient-comparison-tbody" class="divide-y divide-slate-100">
                                        <!-- Injected dynamically by JS -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section: Panduan Istilah & Nutrisi -->
                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-4">
                    <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
                        <h2 class="text-base font-bold text-slate-900">Panduan Istilah Parameter Nutrisi</h2>
                    </div>
                    <div class="border border-slate-200 rounded-xl overflow-hidden">
                        <table class="w-full block sm:table text-left border-collapse">
                            <thead class="hidden sm:table-header-group">
                                <tr class="bg-slate-55 border-b border-slate-200 text-slate-650 font-bold text-xs uppercase">
                                    <th class="py-2.5 px-4 w-1/4">Singkatan</th>
                                    <th class="py-2.5 px-4 w-1/3">Nama Lengkap</th>
                                    <th class="py-2.5 px-4">Keterangan Singkat</th>
                                </tr>
                            </thead>
                            <tbody class="block sm:table-row-group divide-y divide-slate-150 text-slate-700">
                                <tr class="block sm:table-row hover:bg-slate-50 py-3 sm:py-0">
                                    <td class="block sm:table-cell py-1.5 sm:py-3 px-4 font-bold text-slate-900 bg-slate-50/50 sm:bg-transparent">BK (%) / Air (%)</td>
                                    <td class="block sm:table-cell py-0.5 sm:py-3 px-4 font-semibold text-slate-800 text-xs sm:text-sm">Bahan Kering / Kadar Air</td>
                                    <td class="block sm:table-cell py-1 sm:py-3 px-4 text-slate-500 text-xs leading-relaxed">Pencerminan porsi zat nutrisi solid atau kadar basah kelembaban pakan secara total.</td>
                                </tr>
                                <tr class="block sm:table-row hover:bg-slate-50 py-3 sm:py-0">
                                    <td class="block sm:table-cell py-1.5 sm:py-3 px-4 font-bold text-slate-900 bg-slate-50/50 sm:bg-transparent">PK (%) / Protein (%)</td>
                                    <td class="block sm:table-cell py-0.5 sm:py-3 px-4 font-semibold text-slate-800 text-xs sm:text-sm">Protein Kasar (Crude Protein)</td>
                                    <td class="block sm:table-cell py-1 sm:py-3 px-4 text-slate-500 text-xs leading-relaxed">Zat utama pakan pembangun sel-sel tubuh, jaringan otot, dan regenerasi organ tubuh.</td>
                                </tr>
                                <tr class="block sm:table-row hover:bg-slate-50 py-3 sm:py-0">
                                    <td class="block sm:table-cell py-1.5 sm:py-3 px-4 font-bold text-slate-900 bg-slate-50/50 sm:bg-transparent">LK (%) / Lemak (%)</td>
                                    <td class="block sm:table-cell py-0.5 sm:py-3 px-4 font-semibold text-slate-800 text-xs sm:text-sm">Lemak Kasar (Crude Fat)</td>
                                    <td class="block sm:table-cell py-1 sm:py-3 px-4 text-slate-500 text-xs leading-relaxed">Sumber kalori yang padat energi dan mempermudah penyerapan vitamin larut lemak.</td>
                                </tr>
                                <tr class="block sm:table-row hover:bg-slate-50 py-3 sm:py-0">
                                    <td class="block sm:table-cell py-1.5 sm:py-3 px-4 font-bold text-slate-900 bg-slate-50/50 sm:bg-transparent">Serat (%)</td>
                                    <td class="block sm:table-cell py-0.5 sm:py-3 px-4 font-semibold text-slate-800 text-xs sm:text-sm">Serat Kasar (Crude Fiber)</td>
                                    <td class="block sm:table-cell py-1 sm:py-3 px-4 text-slate-500 text-xs leading-relaxed">Komponen karbohidrat kompleks yang melancarkan kinerja sistem organ pencernaan.</td>
                                </tr>
                                <tr class="block sm:table-row hover:bg-slate-50 py-3 sm:py-0">
                                    <td class="block sm:table-cell py-1.5 sm:py-3 px-4 font-bold text-slate-900 bg-slate-50/50 sm:bg-transparent">Abu (%)</td>
                                    <td class="block sm:table-cell py-0.5 sm:py-3 px-4 font-semibold text-slate-800 text-xs sm:text-sm">Kadar Abu (Total Mineral)</td>
                                    <td class="block sm:table-cell py-1 sm:py-3 px-4 text-slate-500 text-xs leading-relaxed">Zat anorganik sisa pemanasan pakan yang mencakup semua mineral penyusun pakan.</td>
                                </tr>
                                <tr class="block sm:table-row hover:bg-slate-50 py-3 sm:py-0">
                                    <td class="block sm:table-cell py-1.5 sm:py-3 px-4 font-bold text-slate-900 bg-slate-50/50 sm:bg-transparent">Ca (%)</td>
                                    <td class="block sm:table-cell py-0.5 sm:py-3 px-4 font-semibold text-slate-800 text-xs sm:text-sm">Kalsium (Calcium)</td>
                                    <td class="block sm:table-cell py-1 sm:py-3 px-4 text-slate-500 text-xs leading-relaxed">Mineral makro krusial untuk struktur pembentukan tulang, gigi, dan sistem syaraf.</td>
                                </tr>
                                <tr class="block sm:table-row hover:bg-slate-50 py-3 sm:py-0">
                                    <td class="block sm:table-cell py-1.5 sm:py-3 px-4 font-bold text-slate-900 bg-slate-50/50 sm:bg-transparent">P (%)</td>
                                    <td class="block sm:table-cell py-0.5 sm:py-3 px-4 font-semibold text-slate-800 text-xs sm:text-sm">Fosfor (Phosphorus)</td>
                                    <td class="block sm:table-cell py-1 sm:py-3 px-4 text-slate-500 text-xs leading-relaxed">Mineral pembentuk energi seluler ATP serta membantu integrasi mineral kalsium.</td>
                                </tr>
                                <tr class="block sm:table-row hover:bg-slate-50 py-3 sm:py-0">
                                    <td class="block sm:table-cell py-1.5 sm:py-3 px-4 font-bold text-slate-900 bg-slate-50/50 sm:bg-transparent">TDN (%) / ME (kcal/kg)</td>
                                    <td class="block sm:table-cell py-0.5 sm:py-3 px-4 font-semibold text-slate-800 text-xs sm:text-sm">Total Nutrien Tercerna / Energi Metabolis</td>
                                    <td class="block sm:table-cell py-1 sm:py-3 px-4 text-slate-500 text-xs leading-relaxed">Nilai total kalori pakan yang siap dimetabolisme dan dimanfaatkan oleh tubuh hewan.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ==================== TAB: INGREDIENTS ==================== -->
            <div id="tab-ingredients" class="tab-content hidden space-y-6">
                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-200 pb-4 flex-wrap gap-3">
                        <h2 id="ingredients-title-heading" class="text-xl font-bold text-slate-900">Kandungan Gizi Bahan Pakan Lengkap</h2>
                        <!-- Live Loading Badge -->
                        <span id="badge-api-ingredients" class="px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-250 animate-pulse">Menghubungkan Database API...</span>
                    </div>

                    <p class="text-sm text-slate-650 bg-slate-50 p-3.5 rounded-lg border border-slate-200">
                        Tips Peternak: Tabel ini berisi standar nilai gizi bahan pakan. Anda dapat menggunakannya sebagai acuan memilih bahan pakan di kalkulator utama.
                    </p>

                    <div class="overflow-x-auto border border-slate-200 rounded-xl">
                        <table class="w-full text-center text-sm border-collapse min-w-[650px]">
                            <thead id="ingredients-table-header" class="sticky top-0 bg-slate-100 border-b border-slate-200 text-slate-700 font-bold text-xs uppercase z-10">
                                <!-- Dynamic Headers -->
                            </thead>
                            <tbody id="ingredients-table-body" class="divide-y divide-slate-150 text-slate-700">
                                <!-- Injected by JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ==================== TAB: LIVESTOCK ==================== -->
            <div id="tab-livestock" class="tab-content hidden space-y-6">
                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-200 pb-4 flex-wrap gap-3">
                        <h2 id="livestock-title-heading" class="text-xl font-bold text-slate-900">Standar Minimum Kebutuhan Gizi Ternak</h2>
                        <!-- Live Loading Badge -->
                        <span id="badge-api-livestock" class="px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-250 animate-pulse">Menghubungkan Database API...</span>
                    </div>

                    <p class="text-sm text-slate-650 bg-slate-50 p-3.5 rounded-lg border border-slate-200">
                        Tips Peternak: Setiap jenis hewan memiliki standar minimal zat gizi yang berbeda-beda agar mereka tumbuh sehat dan cepat gemuk.
                    </p>

                    <div class="overflow-x-auto border border-slate-200 rounded-xl">
                        <table class="w-full text-center text-sm border-collapse min-w-[650px]">
                            <thead id="livestock-table-header" class="sticky top-0 bg-slate-100 border-b border-slate-200 text-slate-700 font-bold text-xs uppercase z-10">
                                <!-- Dynamic Headers -->
                            </thead>
                            <tbody id="livestock-table-body" class="divide-y divide-slate-150 text-slate-700">
                                <!-- Injected by JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-200 bg-white py-6 mt-12 text-center text-slate-600">
        <div class="max-w-6xl mx-auto px-4 space-y-1">
            <p class="text-sm font-bold">Kalkulator Pakan CalKan</p>
            <p class="text-xs text-slate-400">Dapat dijalankan tanpa koneksi internet jika sudah dimuat.</p>
        </div>
    </footer>

    <!-- INGREDIENT DETAIL MODAL -->
    <div id="detail-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs hidden">
        <div class="bg-white border border-slate-300 w-full max-w-md rounded-2xl overflow-hidden shadow-xl">
            <div class="flex items-center justify-between p-6 border-b border-slate-200">
                <h3 id="modal-title" class="text-base font-bold text-slate-900">Detail Kandungan</h3>
                <button onclick="closeModal()" class="text-slate-500 hover:text-slate-800 transition-colors font-bold text-lg">
                    Tutup
                </button>
            </div>
            <div class="p-6 space-y-4">
                <div id="modal-nutrients-grid" class="grid grid-cols-2 gap-4">
                    <!-- Dynamic modal grids -->
                </div>
            </div>
            <div class="bg-slate-100 p-6 border-t border-slate-200 flex justify-end">
                <button onclick="closeModal()" class="px-5 py-2.5 rounded-xl bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-semibold text-xs transition-colors">Tutup Jendela</button>
            </div>
        </div>
    </div>


    <!-- ==================== LOGIC / JS DATABASE ==================== -->
    <script>
        // Kategori Mode Aktif
        let currentMode = null; // 'ternak' atau 'peliharaan'

        // Pre-loaded Local Database Fallbacks (Hewan Ternak)
        let dataTernak = [
            {"id":"1","nama":"Sapi Perah Pemula 1","BK":"86","PK":"21","LK":"11","Abu":"7","Ca":"0.8","P":"0.5","NDF":"0","TDN":"94"},
            {"id":"2","nama":"Sapi Perah Pemula 2","BK":"86","PK":"16","LK":"6","Abu":"9","Ca":"0.5","P":"0.7","NDF":"10","TDN":"78"},
            {"id":"3","nama":"Sapi Perah Dara","BK":"86","PK":"15","LK":"6","Abu":"9","Ca":"0.7","P":"0.6","NDF":"30","TDN":"75"},
            {"id":"4","nama":"Sapi Perah Laktasi","BK":"86","PK":"16","LK":"6","Abu":"9","Ca":"0.9","P":"0.7","NDF":"35","TDN":"70"},
            {"id":"5","nama":"Sapi Perah Laktasi Produksi Tinggi","BK":"86","PK":"18","LK":"6","Abu":"9","Ca":"1.1","P":"0.7","NDF":"35","TDN":"75"},
            {"id":"6","nama":"Sapi Perah Kering Bunting","BK":"86","PK":"14","LK":"6","Abu":"9","Ca":"0.7","P":"0.7","NDF":"30","TDN":"65"},
            {"id":"7","nama":"Sapi Perah Pejantan","BK":"86","PK":"12","LK":"5","Abu":"11","Ca":"0.6","P":"0.4","NDF":"30","TDN":"65"},
            {"id":"8","nama":"Sapi Potong Penggemukan","BK":"86","PK":"13","LK":"6","Abu":"11","Ca":"0.9","P":"0.7","NDF":"35","TDN":"70"},
            {"id":"9","nama":"Sapi Potong Induk","BK":"86","PK":"14","LK":"5","Abu":"11","Ca":"0.9","P":"0.7","NDF":"35","TDN":"65"},
            {"id":"10","nama":"Sapi Potong Pejantan","BK":"86","PK":"12","LK":"5","Abu":"11","Ca":"0.6","P":"0.4","NDF":"30","TDN":"65"},
            {"id":"11","nama":"Kambing Potong Penggemukan","BK":"86","PK":"13","LK":"6","Abu":"11","Ca":"0.9","P":"0.7","NDF":"35","TDN":"70"},
            {"id":"12","nama":"Kambing Potong Induk","BK":"86","PK":"14","LK":"5","Abu":"11","Ca":"0.9","P":"0.7","NDF":"35","TDN":"65"},
            {"id":"13","nama":"Kambing Potong Pejantan","BK":"86","PK":"12","LK":"5","Abu":"11","Ca":"0.6","P":"0.4","NDF":"30","TDN":"65"},
            {"id":"14","nama":"Kambing Perah Pemula","BK":"86","PK":"16","LK":"6","Abu":"9","Ca":"0.5","P":"0.7","NDF":"10","TDN":"78"},
            {"id":"15","nama":"Kambing Perah Dara","BK":"86","PK":"15","LK":"6","Abu":"9","Ca":"0.7","P":"0.6","NDF":"30","TDN":"75"},
            {"id":"16","nama":"Kambing Perah Laktasi","BK":"86","PK":"16","LK":"6","Abu":"9","Ca":"0.9","P":"0.7","NDF":"35","TDN":"70"},
            {"id":"17","nama":"Kambing Perah Laktasi Produksi Tinggi","BK":"86","PK":"18","LK":"6","Abu":"9","Ca":"1.1","P":"0.7","NDF":"35","TDN":"75"},
            {"id":"18","nama":"Kambing Perah Kering Bunting","BK":"86","PK":"14","LK":"6","Abu":"9","Ca":"0.7","P":"0.7","NDF":"30","TDN":"65"},
            {"id":"19","nama":"Kambing Perah Pejantan","BK":"86","PK":"12","LK":"5","Abu":"11","Ca":"0.6","P":"0.4","NDF":"30","TDN":"65"},
            {"id":"20","nama":"Domba Penggemukan","BK":"86","PK":"13","LK":"6","Abu":"11","Ca":"0.9","P":"0.7","NDF":"35","TDN":"70"},
            {"id":"21","nama":"Domba Induk","BK":"86","PK":"14","LK":"5","Abu":"11","Ca":"0.9","P":"0.7","NDF":"35","TDN":"65"},
            {"id":"22","nama":"Domba Pejantan","BK":"86","PK":"12","LK":"5","Abu":"11","Ca":"0.6","P":"0.4","NDF":"30","TDN":"65"}
        ];

        let dataBahan = [
            {"id":"1","nama":"ALANG-ALANG","BK":"40","PK":"6.5","LK":"1.3","Abu":"0","Ca":"0.13","P":"0.09","NDF":"0","TDN":"54"},
            {"id":"2","nama":"AMPAS KELAPA","BK":"86","PK":"21.6","LK":"10.2","Abu":"12.11","Ca":"0.21","P":"0.65","NDF":"0","TDN":"70"},
            {"id":"3","nama":"BEKATUL","BK":"88","PK":"8","LK":"10","Abu":"15","Ca":"0.02","P":"0.29","NDF":"0","TDN":"65"},
            {"id":"4","nama":"BENGGALA","BK":"24","PK":"8.8","LK":"2.1","Abu":"0","Ca":"0.67","P":"0.25","NDF":"0","TDN":"53"},
            {"id":"5","nama":"BUFFEL","BK":"22","PK":"8.6","LK":"4.1","Abu":"0","Ca":"0.37","P":"0.2","NDF":"0","TDN":"48"},
            {"id":"6","nama":"BUNGKIL KEDELE","BK":"86","PK":"51.9","LK":"5.7","Abu":"6.2","Ca":"0.34","P":"0.7","NDF":"0","TDN":"81"},
            {"id":"7","nama":"BUNGKIL KELAPA","BK":"91","PK":"19","LK":"7","Abu":"14.1","Ca":"0.2","P":"1.16","NDF":"0","TDN":"77.18"},
            {"id":"8","nama":"DAUN KETELA POHON","BK":"23","PK":"14.9","LK":"7.4","Abu":"0","Ca":"2.16","P":"0.43","NDF":"0","TDN":"71"},
            {"id":"9","nama":"GAJAH","BK":"18","PK":"9.1","LK":"2.3","Abu":"0","Ca":"0.7","P":"0.38","NDF":"0","TDN":"46"},
            {"id":"10","nama":"GAMAL","BK":"27","PK":"19.1","LK":"3","Abu":"0","Ca":"0.67","P":"0.19","NDF":"0","TDN":"69"},
            {"id":"11","nama":"GAPLEK","BK":"88","PK":"3","LK":"1","Abu":"10","Ca":"0.04","P":"0.36","NDF":"0","TDN":"75"},
            {"id":"12","nama":"GARAM DAPUR","BK":"97","PK":"0","LK":"0","Abu":"0","Ca":"0","P":"0","NDF":"0","TDN":"0"},
            {"id":"13","nama":"GRINTING","BK":"31","PK":"11.9","LK":"2.9","Abu":"0","Ca":"0.32","P":"0.26","NDF":"0","TDN":"57"},
            {"id":"14","nama":"JARAGUA","BK":"46","PK":"4.8","LK":"2.2","Abu":"0","Ca":"0.54","P":"0","NDF":"0","TDN":"59"},
            {"id":"15","nama":"JERAMI KACANG","BK":"86","PK":"6.6","LK":"6.2","Abu":"0","Ca":"1.4","P":"0.3","NDF":"0","TDN":"50"},
            {"id":"16","nama":"JERAMI KEDELE","BK":"90","PK":"6","LK":"2.4","Abu":"0","Ca":"0.38","P":"0.2","NDF":"0","TDN":"51"},
            {"id":"17","nama":"JERAMI PADI","BK":"86","PK":"3.7","LK":"1.7","Abu":"0","Ca":"0","P":"0","NDF":"0","TDN":"41"},
            {"id":"18","nama":"KANGKUNG KERING","BK":"75","PK":"4.47","LK":"0","Abu":"0","Ca":"0","P":"0","NDF":"0","TDN":"0"},
            {"id":"19","nama":"KEDELAI","BK":"86","PK":"30","LK":"0","Abu":"0","Ca":"0","P":"0","NDF":"0","TDN":"0"},
            {"id":"20","nama":"KEMBANG BAYAM","BK":"80","PK":"16.93","LK":"0","Abu":"0","Ca":"0","P":"0","NDF":"0","TDN":"0"},
            {"id":"21","nama":"KLENTHENG","BK":"92","PK":"25","LK":"23.1","Abu":"20.8","Ca":"0.16","P":"0.75","NDF":"0","TDN":"70"},
            {"id":"22","nama":"KOLONJONO","BK":"24","PK":"7.1","LK":"1.3","Abu":"0","Ca":"0.33","P":"0.21","NDF":"0","TDN":"55"},
            {"id":"23","nama":"KONSENTRAT BROILER","BK":"91","PK":"39","LK":"7","Abu":"3","Ca":"0.2","P":"1.16","NDF":"0","TDN":"77.18"},
            {"id":"24","nama":"KOTORAN ULAT HONGKONG","BK":"92","PK":"23.9","LK":"23.1","Abu":"20.8","Ca":"0.16","P":"0.75","NDF":"0","TDN":"96"},
            {"id":"25","nama":"KULIT KETELA POHON","BK":"23","PK":"6.3","LK":"4.3","Abu":"0","Ca":"2.16","P":"0.43","NDF":"0","TDN":"33"},
            {"id":"26","nama":"KULIT KOPI","BK":"86","PK":"6","LK":"0","Abu":"0","Ca":"0","P":"0","NDF":"0","TDN":"0"},
            {"id":"27","nama":"LAMTORO","BK":"30","PK":"20.2","LK":"4.1","Abu":"0","Ca":"1.4","P":"0.21","NDF":"0","TDN":"71"},
            {"id":"28","nama":"LIMBAH BIJI KANGKUNG","BK":"80","PK":"10","LK":"0","Abu":"0","Ca":"0","P":"0","NDF":"0","TDN":"0"},
            {"id":"29","nama":"MOLASSES (TETES)","BK":"75","PK":"3","LK":"0.1","Abu":"0.5","Ca":"1","P":"0.11","NDF":"0","TDN":"72"},
            {"id":"30","nama":"NILAM","BK":"85","PK":"16.12","LK":"2.2","Abu":"21.3","Ca":"0","P":"0","NDF":"0","TDN":"0"},
            {"id":"31","nama":"POLLARD","BK":"91","PK":"15","LK":"15.1","Abu":"12.8","Ca":"0.08","P":"1.7","NDF":"0","TDN":"70"},
            {"id":"32","nama":"PROMIX","BK":"80","PK":"23","LK":"3","Abu":"23","Ca":"1.56","P":"0.3","NDF":"0","TDN":"63"},
            {"id":"33","nama":"RHODES","BK":"21","PK":"8.1","LK":"1.9","Abu":"0","Ca":"0.54","P":"0.2","NDF":"0","TDN":"52"},
            {"id":"34","nama":"SIGNAL","BK":"32","PK":"6.6","LK":"1.3","Abu":"0","Ca":"0","P":"0","NDF":"0","TDN":"56"},
            {"id":"35","nama":"SORGUM","BK":"28","PK":"7.7","LK":"1.9","Abu":"28.8","Ca":"1.09","P":"0.12","NDF":"0","TDN":"59"},
            {"id":"36","nama":"STAR GRASS","BK":"28","PK":"10","LK":"1.8","Abu":"0","Ca":"0.23","P":"0.31","NDF":"0","TDN":"56"},
            {"id":"37","nama":"TEBON JAGUNG","BK":"22","PK":"8.8","LK":"1.9","Abu":"0","Ca":"0.28","P":"0.14","NDF":"0","TDN":"59"},
            {"id":"38","nama":"TEPUNG IKAN","BK":"91","PK":"44","LK":"7","Abu":"3","Ca":"0.2","P":"1.16","NDF":"0","TDN":"77.18"},
            {"id":"39","nama":"TONGKOL JAGUNG","BK":"85","PK":"3","LK":"0","Abu":"0","Ca":"0","P":"0","NDF":"0","TDN":"0"},
            {"id":"40","nama":"UREA","BK":"99","PK":"288","LK":"0","Abu":"0","Ca":"0","P":"0","NDF":"0","TDN":"0"}
        ];

        // Datasets Kebutuhan Hewan Peliharaan (Pets)
        let petRequirements = [
            {"id":"1","nama":"Anjing - Puppy","Air":"10","Protein":"22","Lemak":"8","Serat":"5","Abu":"8","Ca":"1.2","P":"1.0","ME":"3500"},
            {"id":"2","nama":"Anjing - Dewasa","Air":"10","Protein":"18","Lemak":"5.5","Serat":"5","Abu":"8","Ca":"0.6","P":"0.5","ME":"3200"},
            {"id":"3","nama":"Anjing - Senior","Air":"10","Protein":"20","Lemak":"7","Serat":"6","Abu":"8","Ca":"0.7","P":"0.6","ME":"3000"},
            {"id":"4","nama":"Anjing - Hamil","Air":"10","Protein":"22","Lemak":"8","Serat":"5","Abu":"8","Ca":"1.0","P":"0.8","ME":"3600"},
            {"id":"5","nama":"Anjing - Menyusui","Air":"10","Protein":"25","Lemak":"10","Serat":"5","Abu":"8","Ca":"1.2","P":"1.0","ME":"4000"},
            {"id":"6","nama":"Kucing - Kitten","Air":"10","Protein":"30","Lemak":"9","Serat":"3","Abu":"8","Ca":"1.0","P":"0.8","ME":"4000"},
            {"id":"7","nama":"Kucing - Dewasa","Air":"10","Protein":"26","Lemak":"9","Serat":"3","Abu":"8","Ca":"0.6","P":"0.5","ME":"3800"},
            {"id":"8","nama":"Kucing - Senior","Air":"10","Protein":"28","Lemak":"9","Serat":"4","Abu":"8","Ca":"0.7","P":"0.6","ME":"3600"},
            {"id":"9","nama":"Kucing - Hamil","Air":"10","Protein":"30","Lemak":"10","Serat":"3","Abu":"8","Ca":"1.0","P":"0.8","ME":"4000"},
            {"id":"10","nama":"Kucing - Menyusui","Air":"10","Protein":"32","Lemak":"12","Serat":"3","Abu":"8","Ca":"1.2","P":"1.0","ME":"4300"}
        ];

        // Datasets Bahan Pakan Hewan Peliharaan (Pets)
        let petIngredients = [
            {"id":"1","nama":"DADA AYAM","kategori":"Protein Hewani","Air":"70","Protein":"23.1","Lemak":"2.6","Serat":"0","Abu":"1.2","Ca":"0.01","P":"0.20","ME":"1650"},
            {"id":"2","nama":"PAHA AYAM","kategori":"Protein Hewani","Air":"69","Protein":"20.5","Lemak":"8.7","Serat":"0","Abu":"1.1","Ca":"0.02","P":"0.18","ME":"2150"},
            {"id":"3","nama":"HATI AYAM","kategori":"Protein Hewani","Air":"71","Protein":"24.5","Lemak":"5.0","Serat":"0","Abu":"1.5","Ca":"0.01","P":"0.35","ME":"1700"},
            {"id":"4","nama":"JANTUNG AYAM","kategori":"Protein Hewani","Air":"76","Protein":"15.5","Lemak":"4.8","Serat":"0","Abu":"1.1","Ca":"0.01","P":"0.18","ME":"1400"},
            {"id":"5","nama":"AMPELA AYAM","kategori":"Protein Hewani","Air":"79","Protein":"18.0","Lemak":"2.1","Serat":"0","Abu":"1.0","Ca":"0.02","P":"0.20","ME":"940"},
            {"id":"6","nama":"DAGING SAPI","kategori":"Protein Hewani","Air":"68","Protein":"21.5","Lemak":"8.5","Serat":"0","Abu":"1.0","Ca":"0.02","P":"0.19","ME":"2100"},
            {"id":"7","nama":"HATI SAPI","kategori":"Protein Hewani","Air":"71","Protein":"20.4","Lemak":"3.6","Serat":"0","Abu":"1.4","Ca":"0.01","P":"0.39","ME":"1350"},
            {"id":"8","nama":"DAGING KAMBING","kategori":"Protein Hewani","Air":"68","Protein":"20.6","Lemak":"3.2","Serat":"0","Abu":"1.1","Ca":"0.01","P":"0.18","ME":"1600"},
            {"id":"9","nama":"TUNA","kategori":"Protein Hewani","Air":"72","Protein":"25.5","Lemak":"1.0","Serat":"0","Abu":"1.2","Ca":"0.03","P":"0.25","ME":"1450"},
            {"id":"10","nama":"SALMON","kategori":"Protein Hewani","Air":"68","Protein":"22.0","Lemak":"12.0","Serat":"0","Abu":"1.2","Ca":"0.02","P":"0.25","ME":"2300"},
            {"id":"11","nama":"SARDEN","kategori":"Protein Hewani","Air":"70","Protein":"24.0","Lemak":"10.5","Serat":"0","Abu":"2.2","Ca":"0.38","P":"0.49","ME":"2080"},
            {"id":"12","nama":"TEPUNG IKAN","kategori":"Protein Hewani","Air":"8","Protein":"60.0","Lemak":"8.0","Serat":"0","Abu":"18","Ca":"5.00","P":"3.00","ME":"3200"},
            {"id":"13","nama":"TELUR AYAM","kategori":"Protein Hewani","Air":"76","Protein":"12.6","Lemak":"10.6","Serat":"0","Abu":"1.0","Ca":"0.05","P":"0.20","ME":"1550"},
            {"id":"14","nama":"PUTIH TELUR","kategori":"Protein Hewani","Air":"88","Protein":"10.9","Lemak":"0.2","Serat":"0","Abu":"0.7","Ca":"0.01","P":"0.02","ME":"520"},
            {"id":"15","nama":"BERAS PUTIH","kategori":"Karbohidrat","Air":"11","Protein":"7.1","Lemak":"0.7","Serat":"0.4","Abu":"0.7","Ca":"0.01","P":"0.10","ME":"3600"},
            {"id":"16","nama":"BERAS MERAH","kategori":"Karbohidrat","Air":"11","Protein":"7.9","Lemak":"2.7","Serat":"3.5","Abu":"1.2","Ca":"0.02","P":"0.15","ME":"3600"},
            {"id":"17","nama":"OAT","kategori":"Karbohidrat","Air":"10","Protein":"13.2","Lemak":"6.5","Serat":"10.1","Abu":"2.5","Ca":"0.05","P":"0.40","ME":"3700"},
            {"id":"18","nama":"JAGUNG","kategori":"Karbohidrat","Air":"11","Protein":"9.4","Lemak":"4.7","Serat":"2.8","Abu":"1.5","Ca":"0.02","P":"0.28","ME":"3400"},
            {"id":"19","nama":"KENTANG","kategori":"Karbohidrat","Air":"79","Protein":"2.0","Lemak":"0.1","Serat":"2.2","Abu":"1.0","Ca":"0.01","P":"0.05","ME":"800"},
            {"id":"20","nama":"UBI JALAR","kategori":"Karbohidrat","Air":"72","Protein":"1.6","Lemak":"0.2","Serat":"3.0","Abu":"1.0","Ca":"0.03","P":"0.05","ME":"900"},
            {"id":"21","nama":"LABU KUNING","kategori":"Sayuran","Air":"90","Protein":"1.0","Lemak":"0.1","Serat":"1.1","Abu":"0.8","Ca":"0.02","P":"0.04","ME":"350"},
            {"id":"22","nama":"WORTEL","kategori":"Sayuran","Air":"88","Protein":"0.9","Lemak":"0.2","Serat":"2.8","Abu":"1.1","Ca":"0.03","P":"0.04","ME":"400"},
            {"id":"23","nama":"BROKOLI","kategori":"Sayuran","Air":"89","Protein":"2.8","Lemak":"0.4","Serat":"2.6","Abu":"0.9","Ca":"0.05","P":"0.07","ME":"340"},
            {"id":"24","nama":"BAYAM","kategori":"Sayuran","Air":"91","Protein":"2.9","Lemak":"0.4","Serat":"2.2","Abu":"1.7","Ca":"0.10","P":"0.05","ME":"230"},
            {"id":"25","nama":"KACANG POLONG","kategori":"Sayuran","Air":"78","Protein":"5.4","Lemak":"0.4","Serat":"5.1","Abu":"1.2","Ca":"0.03","P":"0.10","ME":"810"},
            {"id":"26","nama":"MINYAK IKAN","kategori":"Lemak","Air":"0","Protein":"0","Lemak":"100","Serat":"0","Abu":"0","Ca":"0","P":"0","ME":"9000"},
            {"id":"27","nama":"MINYAK AYAM","kategori":"Lemak","Air":"0","Protein":"0","Lemak":"100","Serat":"0","Abu":"0","Ca":"0","P":"0","ME":"9000"},
            {"id":"28","nama":"LEMAK SAPI","kategori":"Lemak","Air":"0","Protein":"0","Lemak":"100","Serat":"0","Abu":"0","Ca":"0","P":"0","ME":"9000"},
            {"id":"29","nama":"TEPUNG TULANG","kategori":"Mineral","Air":"2","Protein":"0","Lemak":"0","Serat":"0","Abu":"95","Ca":"30","P":"15","ME":"0"},
            {"id":"30","nama":"TEPUNG CANGKANG TELUR","kategori":"Mineral","Air":"2","Protein":"0","Lemak":"0","Serat":"0","Abu":"95","Ca":"38","P":"0","ME":"0"},
            {"id":"31","nama":"TAURIN","kategori":"Suplemen","Air":"0","Protein":"100","Lemak":"0","Serat":"0","Abu":"0","Ca":"0","P":"0","ME":"0"},
            {"id":"32","nama":"L-LYSINE","kategori":"Suplemen","Air":"0","Protein":"100","Lemak":"0","Serat":"0","Abu":"0","Ca":"0","P":"0","ME":"0"},
            {"id":"33","nama":"DL-METHIONINE","kategori":"Suplemen","Air":"0","Protein":"100","Lemak":"0","Serat":"0","Abu":"0","Ca":"0","P":"0","ME":"0"},
            {"id":"34","nama":"PREMIX VITAMIN MINERAL","kategori":"Vitamin & Mineral","Air":"5","Protein":"0","Lemak":"0","Serat":"0","Abu":"90","Ca":"15","P":"8","ME":"0"}
        ];

        // Definisi Kunci Parameter Zat Nutrisi & Keterangan
        const nutrientKeys = {
            ternak: [
                { key: 'BK', label: 'Bahan Kering (BK)', desc: 'Menentukan kekenyangan ternak' },
                { key: 'PK', label: 'Protein Kasar (PK)', desc: 'Untuk pertumbuhan daging & susu' },
                { key: 'LK', label: 'Lemak Kasar (LK)', desc: 'Sumber energi sekunder' },
                { key: 'Abu', label: 'Kadar Abu', desc: 'Kadar abu pembentuk pakan' },
                { key: 'Ca', label: 'Kalsium (Ca)', desc: 'Penting untuk tulang kuat' },
                { key: 'P', label: 'Fosfor (P)', desc: 'Membantu pembentukan sel tubuh' },
                { key: 'TDN', label: 'Energi (TDN)', desc: 'Energi utama kekuatan ternak' }
            ],
            peliharaan: [
                { key: 'Air', label: 'Kadar Air (Moisture)', desc: 'Kelembaban kandungan pakan' },
                { key: 'Protein', label: 'Protein Kasar', desc: 'Membangun sel otot dan organ' },
                { key: 'Lemak', label: 'Lemak Kasar', desc: 'Sumber energi utama pet' },
                { key: 'Serat', label: 'Serat Kasar', desc: 'Membantu organ pencernaan' },
                { key: 'Abu', label: 'Kadar Abu', desc: 'Total mineral mikro dan makro' },
                { key: 'Ca', label: 'Kalsium (Ca)', desc: 'Penting untuk tulang dan gigi' },
                { key: 'P', label: 'Fosfor (P)', desc: 'Penting untuk transfer energi sel' },
                { key: 'ME', label: 'Energi ME', desc: 'Energi metabolis pakan', isKcal: true }
            ]
        };

        const petDefaults = {
            "1": { weight: 5, factorVal: "3.0" }, // Puppy
            "2": { weight: 10, factorVal: "1.6" }, // Dewasa Anjing
            "3": { weight: 10, factorVal: "1.2" }, // Senior Anjing
            "4": { weight: 12, factorVal: "3.0" }, // Hamil Anjing
            "5": { weight: 12, factorVal: "3.0" }, // Menyusui Anjing
            "6": { weight: 1.5, factorVal: "2.5" }, // Kitten
            "7": { weight: 4, factorVal: "1.2" }, // Dewasa Kucing
            "8": { weight: 4, factorVal: "1.0" }, // Senior Kucing
            "9": { weight: 4.5, factorVal: "2.5" }, // Hamil Kucing
            "10": { weight: 4.5, factorVal: "2.5" } // Menyusui Kucing
        };

        // Active State Selection
        let selectedTernak = null;

        // Mode Switching
        function selectAppMode(mode) {
            currentMode = mode;
            
            // Toggle container visibilities
            document.getElementById('mode-selection-screen').classList.add('hidden');
            document.getElementById('main-calculator-app').classList.remove('hidden');
            document.getElementById('header-tabs-nav').classList.remove('hidden');
            document.getElementById('btn-change-mode').classList.remove('hidden');

            const ternakSelectWrapper = document.getElementById('ternak-select-wrapper');
            if (mode === 'ternak') {
                ternakSelectWrapper.classList.remove('hidden');
            } else {
                ternakSelectWrapper.classList.add('hidden');
            }
            
            // Elements to update
            const headerTitle = document.getElementById('header-title');
            const headerSubtitle = document.getElementById('header-subtitle');
            const tabIngredientsBtn = document.getElementById('btn-tab-ingredients');
            const tabLivestockBtn = document.getElementById('btn-tab-livestock');
            const step1Title = document.getElementById('step-1-title');
            const step1Label = document.getElementById('step-1-label');
            const reqCardTitle = document.getElementById('req-card-title');
            const ingHeading = document.getElementById('ingredients-title-heading');
            const liveHeading = document.getElementById('livestock-title-heading');
            
            if (mode === 'ternak') {
                headerTitle.innerText = "Calculator Pakan Ternak CalKan";
                headerSubtitle.innerText = "Formulasi Pakan Ternak Mandiri - Mudah dan Praktis";
                tabIngredientsBtn.innerText = "Data Bahan Pakan";
                tabLivestockBtn.innerText = "Standar Ternak";
                step1Title.innerText = "Pilih Jenis Ternak dan Berat Pakan";
                step1Label.innerText = "Jenis Ternak:";
                reqCardTitle.innerText = "Target Gizi Minimal Ternak:";
                ingHeading.innerText = "Kandungan Gizi Bahan Pakan Lengkap";
                liveHeading.innerText = "Standar Minimum Kebutuhan Gizi Ternak";
            } else {
                headerTitle.innerText = "Calculator Pakan Pets CalKan";
                headerSubtitle.innerText = "Formulasi Pakan Anjing dan Kucing - Mudah dan Praktis";
                tabIngredientsBtn.innerText = "Data Bahan Peliharaan";
                tabLivestockBtn.innerText = "Standar Hewan Peliharaan";
                step1Title.innerText = "Pilih Jenis Hewan Peliharaan dan Berat Pakan";
                step1Label.innerText = "Jenis Hewan Peliharaan:";
                reqCardTitle.innerText = "Target Gizi Minimal Hewan Peliharaan:";
                ingHeading.innerText = "Kandungan Gizi Bahan Peliharaan Lengkap";
                liveHeading.innerText = "Standar Minimum Kebutuhan Gizi Hewan Peliharaan";
            }
            
            // Reset active requirements
            selectedTernak = null;
            document.getElementById('select-ternak').value = "";
            document.getElementById('ternak-req-card').classList.add('hidden');
            const ternakRecWrapper = document.getElementById('ternak-rec-recipe-wrapper');
            if (ternakRecWrapper) ternakRecWrapper.classList.add('hidden');
            
            // Re-render layout structures
            renderTargetNutrientsCard();
            renderNutrientComparisonTable();
            populateTernakDropdown();
            updateAllSelects();
            renderTabTables();
            
            // Clear calculation rows and start with 3 rows
            document.getElementById('feed-rows-container').innerHTML = '';
            document.getElementById('input-rows').value = "3";
            document.getElementById('label-row-count').innerText = "3 Bahan";
            renderRows(3);
            
            // Reset input values
            document.getElementById('input-weight').value = "0";
            
            // Update unit label
            const weightUnitLabel = document.getElementById('weight-unit-label');
            if (weightUnitLabel) {
                weightUnitLabel.innerText = mode === 'ternak' ? 'KG' : 'Gram';
            }

            // Update th column header
            const thWeight = document.getElementById('th-weight-column');
            if (thWeight) {
                thWeight.innerText = mode === 'ternak' ? 'Berat (KG)' : 'Berat (Gram)';
            }

            // Update mobile weight label text
            const currentRowsCount = parseInt(document.getElementById('input-rows').value) || 0;
            for (let idx = 0; idx < currentRowsCount; idx++) {
                const mobLabel = document.getElementById(`mobile-label-weight-${idx}`);
                if (mobLabel) {
                    mobLabel.innerText = mode === 'ternak' ? 'Porsi (KG):' : 'Porsi (Gram):';
                }
            }

            // Update total weight text
            const totalWeightText = document.getElementById('total-weight-text');
            if (totalWeightText) {
                totalWeightText.innerText = mode === 'ternak' ? 'Total Berat Campuran (KG):' : 'Total Berat Campuran (Gram):';
            }

            // Hide percent progress bar wrapper
            const totalPercentBarWrapper = document.getElementById('total-percent-bar-wrapper');
            if (totalPercentBarWrapper) {
                totalPercentBarWrapper.classList.add('hidden');
            }
            
            // Toggle Pet Energy Calculator
            const petCalcContainer = document.getElementById('pet-energy-calculator-container');
            if (mode === 'ternak') {
                petCalcContainer.classList.add('hidden');
                document.getElementById('ternak-animal-count').value = "1";
            } else {
                petCalcContainer.classList.remove('hidden');
                document.getElementById('pet-body-weight').value = "0";
                document.getElementById('pet-activity-factor').value = "";
                document.getElementById('pet-animal-count').value = "1";
                calculatePetEnergy();
            }
            
            // Update Langkah 3 Header & Cost visibility
            const step3Title = document.getElementById('step-3-title');
            const costSummaryContainer = document.getElementById('cost-summary-container');
            if (mode === 'ternak') {
                step3Title.innerText = "Hasil Formulasi dan Biaya";
                costSummaryContainer.classList.remove('hidden');
            } else {
                step3Title.innerText = "Hasil Formulasi dan Timbangan";
                costSummaryContainer.classList.add('hidden');
            }
            
            togglePriceColumns();
            
            switchTab('calculator');
            calculateFeed();
        }

        function togglePriceColumns() {
            document.querySelectorAll('.price-column').forEach(el => {
                if (currentMode === 'ternak') {
                    el.classList.remove('hidden');
                } else {
                    el.classList.add('hidden');
                }
            });
        }

        function calculatePetEnergy(currentFeedMe = null) {
            if (currentMode !== 'peliharaan') return;

            const weight = parseFloat(document.getElementById('pet-body-weight').value) || 0;
            const factorSelect = document.getElementById('pet-activity-factor');
            const factor = parseFloat(factorSelect.value) || 0;
            const petCount = parseInt(document.getElementById('pet-animal-count').value) || 1;

            const selectedOpt = factorSelect.options[factorSelect.selectedIndex];
            const reqId = selectedOpt ? selectedOpt.getAttribute('data-req-id') : null;
            
            const card = document.getElementById('ternak-req-card');
            const recBtn = document.getElementById('btn-rec-recipe');

            if (reqId) {
                selectedTernak = petRequirements.find(t => t.id === reqId);
                if (selectedTernak) {
                    card.classList.remove('hidden');
                    if (recBtn && weight > 0) recBtn.classList.remove('hidden');
                    const keys = nutrientKeys[currentMode];
                    keys.forEach(n => {
                        const suffix = n.isKcal ? ' kcal/kg' : '%';
                        const valStr = `${selectedTernak[n.key]}${suffix}`;
                        const reqEl = document.getElementById(`req-${n.key}`);
                        const tarEl = document.getElementById(`tar-${n.key}`);
                        if (reqEl) reqEl.innerText = valStr;
                        if (tarEl) tarEl.innerText = valStr;
                    });
                }
            } else {
                selectedTernak = null;
                card.classList.add('hidden');
                if (recBtn) recBtn.classList.add('hidden');
                resetTargets();
            }

            if (weight <= 0) {
                document.getElementById('pet-rer-val').innerText = '0 kcal/hari';
                document.getElementById('pet-mer-val').innerText = '0 kcal/hari';
                document.getElementById('pet-rec-feed-val').innerText = '0 Gram/hari';
                window.lastPetRecIntake = 0;
                if (recBtn) recBtn.classList.add('hidden');
                updateDailyPortionFeedback(0);
                return;
            }

            // RER = 70 * (weight ^ 0.75) * petCount
            const rer = 70 * Math.pow(weight, 0.75) * petCount;
            const mer = (70 * Math.pow(weight, 0.75) * factor) * petCount;

            document.getElementById('pet-rer-val').innerText = `${Math.round(rer)} kcal/hari`;
            document.getElementById('pet-mer-val').innerText = `${Math.round(mer)} kcal/hari`;

            let meVal = currentFeedMe;
            if (meVal === null || meVal === 0) {
                const resMeEl = document.getElementById('res-ME');
                meVal = resMeEl ? parseFloat(resMeEl.innerText) : 0;
            }

            // Fallback to standard target ME of selected pet profile if formulation is empty/0
            if (meVal === 0 && selectedTernak && selectedTernak.ME) {
                meVal = parseFloat(selectedTernak.ME) || 0;
            }

            if (meVal > 0) {
                const recIntake = (mer / meVal) * 1000;
                document.getElementById('pet-rec-feed-val').innerText = `${Math.round(recIntake)} Gram/hari`;
                window.lastPetRecIntake = Math.round(recIntake);
                updateDailyPortionFeedback(recIntake);
            } else {
                document.getElementById('pet-rec-feed-val').innerText = '0 Gram/hari';
                window.lastPetRecIntake = 0;
                updateDailyPortionFeedback(0);
            }
        }

        function updateDailyPortionFeedback(recIntake) {
            const warningText = document.getElementById('total-percent-warning');
            const percentBadge = document.getElementById('total-percent-badge');
            
            if (currentMode !== 'peliharaan') {
                if (warningText) warningText.classList.add('hidden');
                return;
            }

            const weightInput = parseFloat(document.getElementById('input-weight').value) || 0;
            
            // Set badge text
            percentBadge.innerText = `${weightInput.toLocaleString('id-ID', { maximumFractionDigits: 1 })} Gram`;
            
            if (weightInput === 0) {
                percentBadge.className = "px-3 py-1 rounded-lg bg-red-100 text-red-800 font-extrabold border border-red-300 text-base shadow-xs";
                warningText.innerText = "Silakan isi berat bahan pakan di Langkah 2.";
                warningText.className = "text-xs text-slate-700 font-bold bg-slate-50 p-2.5 rounded-lg border border-slate-200";
                warningText.classList.remove('hidden');
                return;
            }

            if (recIntake <= 0) {
                percentBadge.className = "px-3 py-1 rounded-lg bg-red-100 text-red-800 font-extrabold border border-red-300 text-base shadow-xs";
                warningText.innerText = "Kandungan Energi Metabolis (ME) campuran pakan Anda masih 0. Pastikan bahan pakan mengandung energi.";
                warningText.className = "text-xs text-amber-800 font-bold bg-amber-50 p-2.5 rounded-lg border border-amber-250";
                warningText.classList.remove('hidden');
                return;
            }

            const roundedWeight = Math.round(weightInput);
            const roundedRec = Math.round(recIntake);
            const difference = roundedWeight - roundedRec;
            const pctDiff = roundedRec > 0 ? Math.abs(difference) / roundedRec : 0;

            warningText.classList.remove('hidden');
            
            if (roundedWeight >= roundedRec || Math.abs(difference) <= 1) {
                // Sesuai atau berlebih (mencukupi pakannya) -> Hijau
                percentBadge.className = "px-3 py-1 rounded-lg bg-emerald-100 text-emerald-800 font-extrabold border border-emerald-300 text-base shadow-xs";
                
                if (pctDiff <= 0.05 || Math.abs(difference) <= 1) {
                    warningText.innerText = `Porsi Sesuai! Campuran Anda (${roundedWeight} Gram) pas untuk kebutuhan harian kucing/anjing Anda (${roundedRec} Gram/hari).`;
                    warningText.className = "text-xs text-emerald-850 font-bold bg-emerald-50 p-2.5 rounded-lg border border-emerald-250";
                } else {
                    warningText.innerText = `Porsi Berlebih! Campuran Anda (${roundedWeight} Gram) melebihi kebutuhan harian (${roundedRec} Gram/hari). Lebih sekitar ${difference} Gram.`;
                    warningText.className = "text-xs text-blue-850 font-bold bg-blue-50 p-2.5 rounded-lg border border-blue-250";
                }
            } else {
                // Belum mencukupi -> Merah
                percentBadge.className = "px-3 py-1 rounded-lg bg-red-100 text-red-800 font-extrabold border border-red-300 text-base shadow-xs";
                
                warningText.innerText = `Porsi Kurang! Campuran Anda (${roundedWeight} Gram) kurang dari kebutuhan harian (${roundedRec} Gram/hari). Kurang sekitar ${Math.abs(difference)} Gram.`;
                warningText.className = "text-xs text-red-850 font-bold bg-red-50 p-2.5 rounded-lg border border-red-200";
            }
        }

        function showModeSelection() {
            currentMode = null;
            document.getElementById('mode-selection-screen').classList.remove('hidden');
            document.getElementById('main-calculator-app').classList.add('hidden');
            document.getElementById('header-tabs-nav').classList.add('hidden');
            document.getElementById('btn-change-mode').classList.add('hidden');
            
            const headerTitle = document.getElementById('header-title');
            if (headerTitle) {
                headerTitle.innerText = "Calculator Pakan CalKan";
            }
        }

        // Tab Switching
        function switchTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.getElementById(`tab-${tabId}`).classList.remove('hidden');

            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('bg-white', 'text-emerald-800', 'shadow');
                btn.classList.add('text-white', 'hover:bg-emerald-600/50');
            });

            const activeBtn = document.getElementById(`btn-tab-${tabId}`);
            activeBtn.classList.remove('text-white', 'hover:bg-emerald-600/50');
            activeBtn.classList.add('bg-white', 'text-emerald-800', 'shadow');
        }

        // Initialize App
        window.addEventListener('DOMContentLoaded', () => {
            fetchData();
        });

        function fetchData() {
            // Fetch Ternak
            fetch("https://script.google.com/macros/s/AKfycbwgcwSOROmoKE26pyN3YkBAS2_MpaM2zC_ySZc8z0lo9_0HZXx_bJMZTFULsKVAydNiCg/exec?nama=Ternak")
                .then(res => res.json())
                .then(json => {
                    if (json && json.data) {
                        dataTernak = json.data;
                        if (currentMode === 'ternak') {
                            populateTernakDropdown();
                            renderTabTables();
                        }
                        const badge = document.getElementById('badge-api-livestock');
                        badge.innerText = "Terhubung (API)";
                        badge.className = "px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-300";
                    }
                })
                .catch(err => {
                    console.warn("Failed to fetch live Ternak data, using local fallback.", err);
                    const badge = document.getElementById('badge-api-livestock');
                    badge.innerText = "Menggunakan Database Cadangan";
                    badge.className = "px-3 py-1 rounded-full text-xs font-bold bg-slate-200 text-slate-700 border border-slate-350";
                });

            // Fetch Bahan
            fetch("https://script.google.com/macros/s/AKfycbwgcwSOROmoKE26pyN3YkBAS2_MpaM2zC_ySZc8z0lo9_0HZXx_bJMZTFULsKVAydNiCg/exec?nama=Bahan")
                .then(res => res.json())
                .then(json => {
                    if (json && json.data) {
                        dataBahan = json.data;
                        if (currentMode === 'ternak') {
                            updateAllSelects();
                            renderTabTables();
                        }
                        const badge = document.getElementById('badge-api-ingredients');
                        badge.innerText = "Terhubung (API)";
                        badge.className = "px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-300";
                    }
                })
                .catch(err => {
                    console.warn("Failed to fetch live Bahan data, using local fallback.", err);
                    const badge = document.getElementById('badge-api-ingredients');
                    badge.innerText = "Menggunakan Database Cadangan";
                    badge.className = "px-3 py-1 rounded-full text-xs font-bold bg-slate-200 text-slate-700 border border-slate-350";
                });
        }

        // Dropdown Ternak
        function populateTernakDropdown() {
            const dropdown = document.getElementById('select-ternak');
            const currentValue = dropdown.value;
            dropdown.innerHTML = '';
            
            const defaultOpt = document.createElement('option');
            defaultOpt.value = "";
            defaultOpt.innerText = currentMode === 'ternak' ? "-- Pilih Ternak --" : "-- Pilih Jenis Hewan --";
            dropdown.appendChild(defaultOpt);
            
            const activeList = currentMode === 'ternak' ? dataTernak : petRequirements;
            
            activeList.forEach(item => {
                const opt = document.createElement('option');
                opt.value = item.id;
                opt.innerText = item.nama;
                dropdown.appendChild(opt);
            });
            if (currentValue) dropdown.value = currentValue;
        }

        // Render Tables for Tab 2 and Tab 3
        function renderTabTables() {
            const ingHeader = document.getElementById('ingredients-table-header');
            const ingBody = document.getElementById('ingredients-table-body');
            ingHeader.innerHTML = '';
            ingBody.innerHTML = '';
            
            if (currentMode === 'ternak') {
                ingHeader.innerHTML = `
                    <tr>
                        <th class="py-3 px-4 text-left">Nama Bahan</th>
                        <th class="py-3 px-2">Bahan Kering (%)</th>
                        <th class="py-3 px-2">Protein Kasar (%)</th>
                        <th class="py-3 px-2">Lemak Kasar (%)</th>
                        <th class="py-3 px-2">Kadar Abu (%)</th>
                        <th class="py-3 px-2">Kalsium (%)</th>
                        <th class="py-3 px-2">Fosfor (%)</th>
                        <th class="py-3 px-2">Energi TDN (%)</th>
                    </tr>
                `;
                dataBahan.forEach(item => {
                    const row = document.createElement('tr');
                    row.className = "hover:bg-slate-100 transition-colors border-b border-slate-200";
                    row.innerHTML = `
                        <td class="py-3 px-4 text-left font-bold text-slate-900">${item.nama}</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.BK}%</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.PK}%</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.LK}%</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.Abu}%</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.Ca}%</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.P}%</td>
                        <td class="py-3 px-2 font-bold text-emerald-800 bg-emerald-50/50">${item.TDN}%</td>
                    `;
                    ingBody.appendChild(row);
                });
            } else {
                ingHeader.innerHTML = `
                    <tr>
                        <th class="py-3 px-4 text-left">Nama Bahan</th>
                        <th class="py-3 px-2">Kategori</th>
                        <th class="py-3 px-2">Air (%)</th>
                        <th class="py-3 px-2">Protein (%)</th>
                        <th class="py-3 px-2">Lemak (%)</th>
                        <th class="py-3 px-2">Serat (%)</th>
                        <th class="py-3 px-2">Abu (%)</th>
                        <th class="py-3 px-2">Kalsium (%)</th>
                        <th class="py-3 px-2">Fosfor (%)</th>
                        <th class="py-3 px-2">Energi ME (kcal)</th>
                    </tr>
                `;
                petIngredients.forEach(item => {
                    const row = document.createElement('tr');
                    row.className = "hover:bg-slate-100 transition-colors border-b border-slate-200";
                    row.innerHTML = `
                        <td class="py-3 px-4 text-left font-bold text-slate-900">${item.nama}</td>
                        <td class="py-3 px-2 text-xs font-semibold text-slate-500">${item.kategori}</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.Air}%</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.Protein}%</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.Lemak}%</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.Serat}%</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.Abu}%</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.Ca}%</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.P}%</td>
                        <td class="py-3 px-2 font-bold text-emerald-800 bg-emerald-50/50">${item.ME}</td>
                    `;
                    ingBody.appendChild(row);
                });
            }

            const liveHeader = document.getElementById('livestock-table-header');
            const liveBody = document.getElementById('livestock-table-body');
            liveHeader.innerHTML = '';
            liveBody.innerHTML = '';

            if (currentMode === 'ternak') {
                liveHeader.innerHTML = `
                    <tr>
                        <th class="py-3 px-4 text-left">Nama Ternak</th>
                        <th class="py-3 px-2">Bahan Kering (%)</th>
                        <th class="py-3 px-2">Protein Kasar (%)</th>
                        <th class="py-3 px-2">Lemak Kasar (%)</th>
                        <th class="py-3 px-2">Kadar Abu (%)</th>
                        <th class="py-3 px-2">Kalsium (%)</th>
                        <th class="py-3 px-2">Fosfor (%)</th>
                        <th class="py-3 px-2">Energi TDN (%)</th>
                    </tr>
                `;
                dataTernak.forEach(item => {
                    const row = document.createElement('tr');
                    row.className = "hover:bg-slate-100 transition-colors border-b border-slate-200";
                    row.innerHTML = `
                        <td class="py-3 px-4 text-left font-bold text-slate-900">${item.nama}</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.BK}%</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.PK}%</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.LK}%</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.Abu}%</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.Ca}%</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.P}%</td>
                        <td class="py-3 px-2 font-bold text-emerald-800 bg-emerald-50/50">${item.TDN}%</td>
                    `;
                    liveBody.appendChild(row);
                });
            } else {
                liveHeader.innerHTML = `
                    <tr>
                        <th class="py-3 px-4 text-left">Nama Hewan Peliharaan</th>
                        <th class="py-3 px-2">Air (%)</th>
                        <th class="py-3 px-2">Protein (%)</th>
                        <th class="py-3 px-2">Lemak (%)</th>
                        <th class="py-3 px-2">Serat (%)</th>
                        <th class="py-3 px-2">Abu (%)</th>
                        <th class="py-3 px-2">Kalsium (%)</th>
                        <th class="py-3 px-2">Fosfor (%)</th>
                        <th class="py-3 px-2">Energi ME (kcal)</th>
                    </tr>
                `;
                petRequirements.forEach(item => {
                    const row = document.createElement('tr');
                    row.className = "hover:bg-slate-100 transition-colors border-b border-slate-200";
                    row.innerHTML = `
                        <td class="py-3 px-4 text-left font-bold text-slate-900">${item.nama}</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.Air}%</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.Protein}%</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.Lemak}%</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.Serat}%</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.Abu}%</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.Ca}%</td>
                        <td class="py-3 px-2 font-semibold text-slate-800">${item.P}%</td>
                        <td class="py-3 px-2 font-bold text-emerald-800 bg-emerald-50/50">${item.ME}</td>
                    `;
                    liveBody.appendChild(row);
                });
            }
        }

        // On Livestock Selection
        function onTernakChange() {
            if (currentMode !== 'ternak') return;

            const val = document.getElementById('select-ternak').value;
            const card = document.getElementById('ternak-req-card');
            const ternakRecWrapper = document.getElementById('ternak-rec-recipe-wrapper');
            
            if (!val) {
                selectedTernak = null;
                card.classList.add('hidden');
                if (ternakRecWrapper) ternakRecWrapper.classList.add('hidden');
                resetTargets();
                calculateFeed();
                return;
            }

            selectedTernak = dataTernak.find(t => t.id === val);
            card.classList.remove('hidden');
            if (ternakRecWrapper) ternakRecWrapper.classList.remove('hidden');

            // Set targets
            const keys = nutrientKeys[currentMode];
            keys.forEach(n => {
                const suffix = n.isKcal ? ' kcal/kg' : '%';
                const valStr = `${selectedTernak[n.key]}${suffix}`;
                document.getElementById(`req-${n.key}`).innerText = valStr;
                document.getElementById(`tar-${n.key}`).innerText = valStr;
            });

            calculateFeed();
        }

        function resetTargets() {
            const keys = nutrientKeys[currentMode];
            keys.forEach(n => {
                const targetEl = document.getElementById(`tar-${n.key}`);
                if (targetEl) targetEl.innerText = n.isKcal ? '0 kcal/kg' : '0.00%';
            });
        }

        // Render Requirement Grid
        function renderTargetNutrientsCard() {
            const reqGrid = document.getElementById('ternak-req-grid');
            reqGrid.innerHTML = '';
            
            const keys = nutrientKeys[currentMode];
            
            reqGrid.className = "grid gap-2 text-center text-xs";
            if (currentMode === 'ternak') {
                reqGrid.classList.add('grid-cols-2', 'sm:grid-cols-4', 'md:grid-cols-7');
            } else {
                reqGrid.classList.add('grid-cols-2', 'sm:grid-cols-4', 'md:grid-cols-8');
            }
            
            keys.forEach(n => {
                const div = document.createElement('div');
                div.className = "bg-white rounded-lg p-2 border border-slate-200 shadow-xs";
                const displayLabel = n.label.split(' (')[0];
                div.innerHTML = `
                    <p class="text-slate-500 font-bold">${displayLabel}</p>
                    <p id="req-${n.key}" class="text-sm font-bold text-slate-800">-</p>
                `;
                reqGrid.appendChild(div);
            });
        }

        // Render Left Bottom Comparison Table
        function renderNutrientComparisonTable() {
            const tbody = document.getElementById('nutrient-comparison-tbody');
            tbody.innerHTML = '';
            
            const keys = nutrientKeys[currentMode];
            keys.forEach(n => {
                const tr = document.createElement('tr');
                tr.className = "hover:bg-slate-50 border-b border-slate-100";
                tr.innerHTML = `
                    <td class="py-2.5 px-1.5 sm:px-2 text-left">
                        <span class="font-bold text-slate-900 block text-xs sm:text-sm">${n.label}</span>
                        <span class="text-[10px] text-slate-500 block leading-tight mt-0.5">${n.desc}</span>
                    </td>
                    <td id="res-${n.key}" class="py-2.5 px-1 sm:px-2 font-bold text-slate-850 text-xs sm:text-sm">0.00%</td>
                    <td id="tar-${n.key}" class="py-2.5 px-1 sm:px-2 text-slate-500 font-medium text-xs sm:text-sm">0.00%</td>
                    <td class="py-2.5 px-1 sm:px-2"><span id="diff-${n.key}" class="px-1.5 py-0.5 rounded bg-slate-100 text-slate-600 font-bold border border-slate-200 text-[10px] sm:text-xs block text-center whitespace-nowrap">Belum Ada</span></td>
                `;
                tbody.appendChild(tr);
            });
        }

        // Rows Management
        function incrementRows() {
            const el = document.getElementById('input-rows');
            let val = parseInt(el.value);
            if (val < 15) {
                el.value = val + 1;
                onRowsChange();
            }
        }

        // Rows Management decrement
        function decrementRows() {
            const el = document.getElementById('input-rows');
            let val = parseInt(el.value);
            if (val > 1) {
                el.value = val - 1;
                onRowsChange();
            }
        }

        function onRowsChange() {
            const val = parseInt(document.getElementById('input-rows').value);
            document.getElementById('label-row-count').innerText = `${val} Bahan`;
            renderRows(val);
            calculateFeed();
        }

        // Custom Searchable Dropdown Helpers
        function toggleDropdown(index) {
            document.querySelectorAll('.custom-select-container').forEach(container => {
                const idx = container.id.split('-').pop();
                if (parseInt(idx) !== index) {
                    const otherDropdown = document.getElementById(`custom-select-dropdown-${idx}`);
                    const otherArrow = document.getElementById(`custom-select-arrow-${idx}`);
                    if (otherDropdown) otherDropdown.classList.add('hidden');
                    if (otherArrow) otherArrow.classList.remove('rotate-180');
                }
            });
            
            const dropdown = document.getElementById(`custom-select-dropdown-${index}`);
            const arrow = document.getElementById(`custom-select-arrow-${index}`);
            if (!dropdown) return;
            
            const isOpen = !dropdown.classList.contains('hidden');
            if (isOpen) {
                dropdown.classList.add('hidden');
                if (arrow) arrow.classList.remove('rotate-180');
            } else {
                dropdown.classList.remove('hidden');
                if (arrow) arrow.classList.add('rotate-180');
                const searchInput = dropdown.querySelector('input[type="text"]');
                if (searchInput) {
                    searchInput.value = '';
                    filterDropdown(index, '');
                    searchInput.focus();
                }
            }
        }

        function filterDropdown(index, query) {
            const q = query.toLowerCase();
            const optionsList = document.getElementById(`custom-select-options-${index}`);
            if (!optionsList) return;
            const items = optionsList.querySelectorAll('.option-item');
            items.forEach(item => {
                const text = item.innerText.toLowerCase();
                if (text.includes(q)) {
                    item.style.display = "flex";
                } else {
                    item.style.display = "none";
                }
            });
        }

        function selectOption(index, val, label) {
            const valInput = document.getElementById(`custom-select-val-${index}`);
            const labelSpan = document.getElementById(`custom-select-label-${index}`);
            const dropdown = document.getElementById(`custom-select-dropdown-${index}`);
            const arrow = document.getElementById(`custom-select-arrow-${index}`);
            
            if (valInput) valInput.value = val;
            if (labelSpan) labelSpan.innerText = label;
            
            if (dropdown) dropdown.classList.add('hidden');
            if (arrow) arrow.classList.remove('rotate-180');
            
            calculateFeed();
        }

        // Close dropdowns on clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.custom-select-container')) {
                document.querySelectorAll('.custom-select-container').forEach(container => {
                    const idx = container.id.split('-').pop();
                    const dropdown = document.getElementById(`custom-select-dropdown-${idx}`);
                    const arrow = document.getElementById(`custom-select-arrow-${idx}`);
                    if (dropdown) dropdown.classList.add('hidden');
                    if (arrow) arrow.classList.remove('rotate-180');
                });
            }
        });

        function renderRows(count) {
            const container = document.getElementById('feed-rows-container');
            const currentRows = container.children.length;

            if (count > currentRows) {
                for (let i = currentRows; i < count; i++) {
                    const row = document.createElement('tr');
                    row.id = `feed-row-${i}`;
                    row.className = "block sm:table-row hover:bg-slate-50 border-b border-slate-200 py-3 sm:py-0 space-y-2 sm:space-y-0";
                    row.innerHTML = `
                        <td class="block sm:table-cell py-1 sm:py-3 px-3 w-full sm:w-1/2">
                            <span class="block sm:hidden text-xs font-bold text-slate-550 mb-1.5">Nama Bahan Pakan:</span>
                            <div class="flex items-center gap-2">
                                <button type="button" onclick="showIngredientDetails(${i})" class="bg-slate-100 hover:bg-emerald-100 text-slate-700 hover:text-emerald-800 px-2.5 py-2.5 rounded-xl border border-slate-300 font-bold text-xs flex items-center gap-1 transition-colors shrink-0" title="Lihat detail gizi">
                                    Info
                                </button>
                                <div class="relative custom-select-container w-full" id="custom-select-container-${i}">
                                    <button type="button" onclick="toggleDropdown(${i})" id="custom-select-btn-${i}" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2.5 text-sm text-slate-800 font-semibold focus:border-emerald-700 focus:outline-none flex justify-between items-center">
                                        <span id="custom-select-label-${i}">-- Pilih Bahan --</span>
                                        <svg class="w-4 h-4 text-slate-500 transition-transform duration-200" id="custom-select-arrow-${i}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </button>
                                    <input type="hidden" name="ingredient" id="custom-select-val-${i}">
                                    <div id="custom-select-dropdown-${i}" class="absolute z-[999] left-0 right-0 mt-1 hidden bg-white border border-slate-200 rounded-xl shadow-xl max-h-64 overflow-hidden flex flex-col">
                                        <div class="p-2 border-b border-slate-100 bg-slate-50">
                                            <input type="text" oninput="filterDropdown(${i}, this.value)" placeholder="Cari bahan..." class="w-full bg-white border border-slate-200 rounded-lg px-2.5 py-1.5 text-xs focus:outline-none focus:border-emerald-600">
                                        </div>
                                        <div id="custom-select-options-${i}" class="overflow-y-auto max-h-48 text-sm text-slate-700 py-1">
                                            <!-- options items populated dynamically -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="block sm:table-cell py-1 sm:py-3 px-3 sm:px-2 w-full sm:w-28">
                            <span class="block sm:hidden text-xs font-bold text-slate-550 mb-1.5" id="mobile-label-weight-${i}">Porsi:</span>
                            <input type="number" name="percentage" min="0" step="any" oninput="calculateFeed()" placeholder="0" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2.5 text-sm text-slate-900 font-bold focus:border-emerald-700 focus:outline-none text-center">
                        </td>
                        <td class="block sm:table-cell py-1 sm:py-3 px-3 w-full sm:w-36 price-column">
                            <span class="block sm:hidden text-xs font-bold text-slate-550 mb-1.5">Harga (Rp/Kg):</span>
                            <input type="number" name="price" min="0" step="any" oninput="calculateFeed()" placeholder="0" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2.5 text-sm text-slate-900 font-bold focus:border-emerald-700 focus:outline-none">
                        </td>
                    `;
                    container.appendChild(row);
                }
            } else if (count < currentRows) {
                for (let i = currentRows - 1; i >= count; i--) {
                    container.removeChild(container.children[i]);
                }
            }

            updateAllSelects();
            togglePriceColumns();
        }

        function updateAllSelects() {
            const containers = document.querySelectorAll('.custom-select-container');
            containers.forEach(container => {
                const idx = container.id.split('-').pop();
                const optionsDiv = document.getElementById(`custom-select-options-${idx}`);
                const valInput = document.getElementById(`custom-select-val-${idx}`);
                const labelSpan = document.getElementById(`custom-select-label-${idx}`);
                
                if (!optionsDiv) return;
                
                const curVal = valInput.value;
                optionsDiv.innerHTML = '';
                
                // Add an option for unselecting
                const emptyOption = document.createElement('div');
                emptyOption.className = "option-item px-3 py-2 hover:bg-slate-100 cursor-pointer text-slate-500 font-medium text-xs";
                emptyOption.innerText = "-- Pilih Bahan --";
                emptyOption.onclick = () => selectOption(idx, "", "-- Pilih Bahan --");
                optionsDiv.appendChild(emptyOption);

                if (currentMode === 'ternak') {
                    dataBahan.forEach(item => {
                        const opt = document.createElement('div');
                        opt.className = "option-item px-3 py-2 hover:bg-emerald-50 hover:text-emerald-900 cursor-pointer font-semibold flex justify-between items-center transition-colors";
                        opt.innerHTML = `<span>${item.nama}</span>`;
                        opt.onclick = () => selectOption(idx, item.id, item.nama);
                        optionsDiv.appendChild(opt);
                    });
                } else {
                    // Group by Kategori for Pet Mode
                    const categories = {};
                    petIngredients.forEach(item => {
                        if (!categories[item.kategori]) {
                            categories[item.kategori] = [];
                        }
                        categories[item.kategori].push(item);
                    });
                    
                    for (let cat in categories) {
                        const catHeader = document.createElement('div');
                        catHeader.className = "px-3 py-1 bg-slate-100 text-slate-600 font-bold text-[10px] uppercase tracking-wider";
                        catHeader.innerText = cat;
                        optionsDiv.appendChild(catHeader);

                        categories[cat].forEach(item => {
                            const opt = document.createElement('div');
                            opt.className = "option-item pl-6 pr-3 py-2 hover:bg-emerald-50 hover:text-emerald-900 cursor-pointer font-semibold flex justify-between items-center transition-colors";
                            opt.innerHTML = `<span>${item.nama}</span>`;
                            opt.onclick = () => selectOption(idx, item.id, item.nama);
                            optionsDiv.appendChild(opt);
                        });
                    }
                }
                
                // Restore current selection label if present
                if (curVal) {
                    let found;
                    if (currentMode === 'ternak') {
                        found = dataBahan.find(b => b.id === curVal);
                    } else {
                        found = petIngredients.find(b => b.id === curVal);
                    }
                    if (found) {
                        labelSpan.innerText = found.nama;
                    } else {
                        valInput.value = "";
                        labelSpan.innerText = "-- Pilih Bahan --";
                    }
                } else {
                    labelSpan.innerText = "-- Pilih Bahan --";
                }
            });
        }

        // Show Details Modal
        function showIngredientDetails(rowIndex) {
            const valInput = document.getElementById(`custom-select-val-${rowIndex}`);
            if (!valInput || !valInput.value) {
                alert("Pilih bahan pakan terlebih dahulu.");
                return;
            }
            
            let item;
            if (currentMode === 'ternak') {
                item = dataBahan.find(b => b.id === valInput.value);
            } else {
                item = petIngredients.find(b => b.id === valInput.value);
            }
            
            document.getElementById('modal-title').innerText = `Kandungan Gizi: ${item.nama}`;
            
            const container = document.getElementById('modal-nutrients-grid');
            container.innerHTML = '';
            
            const keys = nutrientKeys[currentMode];
            keys.forEach(n => {
                const div = document.createElement('div');
                div.className = "bg-slate-55 rounded-xl p-3 border border-slate-200 text-center";
                
                const suffix = n.isKcal ? ' kcal/kg' : '%';
                const valStr = `${parseFloat(item[n.key] || 0).toFixed(2)}${suffix}`;
                
                div.innerHTML = `
                    <p class="text-xs font-bold text-slate-500 uppercase">${n.label.split(' (')[0]}</p>
                    <p class="text-base font-bold text-slate-900 mt-1">${valStr}</p>
                `;
                container.appendChild(div);
            });

            document.getElementById('detail-modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('detail-modal').classList.add('hidden');
        }

        // Core Calculation Engine
        function calculateFeed() {
            if (!currentMode) return;

            const rows = document.querySelectorAll('#feed-rows-container tr');
            
            // Calculate total weight from ingredient inputs
            let totalInputWeight = 0;
            rows.forEach(row => {
                const select = row.querySelector('input[name="ingredient"]');
                const val = parseFloat(row.querySelector('input[name="percentage"]').value) || 0;
                if (select && select.value) {
                    totalInputWeight += val;
                }
            });
            document.getElementById('input-weight').value = totalInputWeight;
            const totalKg = currentMode === 'ternak' ? totalInputWeight : totalInputWeight / 1000;
            
            let sumPercent = 0;
            let totalCost = 0;
            let selectedIngredients = [];

            // Reset mix nutrients dynamically
            let mixNutrients = {};
            const keys = nutrientKeys[currentMode];
            keys.forEach(n => {
                mixNutrients[n.key] = 0;
            });

            rows.forEach(row => {
                const select = row.querySelector('input[name="ingredient"]');
                const inputWeightVal = parseFloat(row.querySelector('input[name="percentage"]').value) || 0;
                const priceVal = parseFloat(row.querySelector('input[name="price"]').value) || 0;

                if (select && select.value) {
                    let item;
                    if (currentMode === 'ternak') {
                        item = dataBahan.find(b => b.id === select.value);
                    } else {
                        item = petIngredients.find(b => b.id === select.value);
                    }

                    if (item) {
                        const weight = currentMode === 'ternak' ? inputWeightVal : inputWeightVal / 1000;
                        const percentVal = totalKg > 0 ? (weight / totalKg) * 100 : 0;
                        sumPercent += percentVal;

                        const cost = weight * priceVal;
                        totalCost += cost;

                        // Calculate mix nutrients
                        keys.forEach(n => {
                            mixNutrients[n.key] += (parseFloat(item[n.key] || 0) * percentVal) / 100;
                        });

                        selectedIngredients.push({
                            nama: item.nama,
                            percentage: percentVal,
                            weight: weight,
                            cost: cost
                        });
                    }
                }
            });

            // Update Total Weight Badge Display
            const percentBadge = document.getElementById('total-percent-badge');
            const warningText = document.getElementById('total-percent-warning');
            const unit = currentMode === 'ternak' ? 'KG' : 'Gram';

            percentBadge.innerText = `${totalInputWeight.toLocaleString('id-ID', { maximumFractionDigits: 1 })} ${unit}`;
            
            if (currentMode === 'ternak') {
                percentBadge.className = "px-3 py-1 rounded-lg bg-emerald-100 text-emerald-800 font-extrabold border border-emerald-300 text-base shadow-xs";
                if (warningText) warningText.classList.add('hidden');
            }

            // Update per animal weight display
            const ternakCount = parseInt(document.getElementById('ternak-animal-count').value) || 1;
            const petCount = parseInt(document.getElementById('pet-animal-count').value) || 1;
            const animalCount = currentMode === 'ternak' ? ternakCount : petCount;
            const perAnimalWeightContainer = document.getElementById('per-animal-weight-container');
            const perAnimalWeightVal = document.getElementById('per-animal-weight-val');
            
            if (animalCount > 1 && totalInputWeight > 0) {
                const perAnimalWeight = totalInputWeight / animalCount;
                if (perAnimalWeightVal) perAnimalWeightVal.innerText = `${perAnimalWeight.toLocaleString('id-ID', { maximumFractionDigits: 1 })} ${unit}`;
                if (perAnimalWeightContainer) perAnimalWeightContainer.classList.remove('hidden');
            } else {
                if (perAnimalWeightContainer) perAnimalWeightContainer.classList.add('hidden');
            }

            // Update Cost Display
            document.getElementById('total-cost').innerText = `Rp ${totalCost.toLocaleString('id-ID', { maximumFractionDigits: 0 })}`;
            const costPerKg = totalKg > 0 ? (totalCost / totalKg) : 0;
            document.getElementById('cost-per-kg').innerText = `Rp ${costPerKg.toLocaleString('id-ID', { maximumFractionDigits: 0 })}`;

            // Update per animal cost display
            const perAnimalCostWrapper = document.getElementById('per-animal-cost-wrapper');
            const perAnimalCostVal = document.getElementById('per-animal-cost-val');
            
            if (currentMode === 'ternak' && animalCount > 1 && totalCost > 0) {
                const perAnimalCost = totalCost / animalCount;
                if (perAnimalCostVal) perAnimalCostVal.innerText = `Rp ${perAnimalCost.toLocaleString('id-ID', { maximumFractionDigits: 0 })}`;
                if (perAnimalCostWrapper) perAnimalCostWrapper.classList.remove('hidden');
            } else {
                if (perAnimalCostWrapper) perAnimalCostWrapper.classList.add('hidden');
            }

            // Update Composition Breakdown List
            const breakdownContainer = document.getElementById('breakdown-container');
            if (selectedIngredients.length === 0) {
                breakdownContainer.innerHTML = '<p class="text-sm text-slate-500 italic text-center py-4 bg-slate-50 rounded-xl border border-slate-200">Belum ada bahan pakan yang dipilih.</p>';
            } else {
                breakdownContainer.innerHTML = '';
                selectedIngredients.forEach(item => {
                    const el = document.createElement('div');
                    el.className = "flex justify-between items-center bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm";
                    el.innerHTML = `
                        <div class="space-y-0.5">
                            <p class="font-bold text-slate-900">${item.nama}</p>
                            <p class="text-xs text-slate-500">${item.percentage.toFixed(1)}% dari total pakan</p>
                        </div>
                        <div class="text-right space-y-0.5">
                            <p class="font-extrabold text-slate-800">${currentMode === 'ternak' ? `${item.weight.toFixed(2)} KG` : `${(item.weight * 1000).toFixed(0)} Gram`}</p>
                            ${currentMode === 'ternak' ? `<p class="text-xs text-emerald-700 font-bold">Biaya: Rp ${item.cost.toLocaleString('id-ID', { maximumFractionDigits: 0 })}</p>` : ''}
                        </div>
                    `;
                    breakdownContainer.appendChild(el);
                });
            }

            // Update Nutrient Comparisons table
            keys.forEach(n => {
                const resEl = document.getElementById(`res-${n.key}`);
                const diffEl = document.getElementById(`diff-${n.key}`);

                const suffix = n.isKcal ? ' kcal/kg' : '%';
                resEl.innerText = `${mixNutrients[n.key].toFixed(n.isKcal ? 0 : 2)}${suffix}`;

                const targetVal = selectedTernak ? parseFloat(selectedTernak[n.key] || 0) : 0;
                const difference = mixNutrients[n.key] - targetVal;

                if (selectedTernak) {
                    const diffStr = n.isKcal ? `${difference.toFixed(0)} kcal/kg` : `${difference.toFixed(2)}%`;
                    
                    let isSufficient = difference >= 0;
                    if (currentMode === 'peliharaan' && n.key === 'Air') {
                        isSufficient = true;
                    }
                    if (currentMode === 'ternak') {
                        let tolerance = 0;
                        if (n.key === 'BK') tolerance = 0.25 * targetVal;
                        else if (n.key === 'Abu') tolerance = 0.30 * targetVal;
                        else tolerance = 0.10 * targetVal;
                        
                        if (difference >= -tolerance) {
                            isSufficient = true;
                        }
                    }

                    if (isSufficient) {
                        const showDiff = difference >= 0 ? `+${diffStr}` : diffStr;
                        diffEl.innerText = `Cukup (${showDiff})`;
                        diffEl.className = "px-1.5 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold border border-emerald-300 text-[10px] sm:text-xs block text-center shadow-xs whitespace-nowrap";
                    } else {
                        diffEl.innerText = `Kurang (${diffStr})`;
                        diffEl.className = "px-1.5 py-0.5 rounded bg-red-100 text-red-800 font-bold border border-red-300 text-[10px] sm:text-xs block text-center shadow-xs whitespace-nowrap";
                    }
                } else {
                    diffEl.innerText = "Belum Ada";
                    diffEl.className = "px-1.5 py-0.5 rounded bg-slate-100 text-slate-600 font-bold border border-slate-200 text-[10px] sm:text-xs block text-center shadow-xs whitespace-nowrap";
                }
            });

            if (currentMode === 'peliharaan') {
                calculatePetEnergy(mixNutrients['ME']);
            }
        }

        function applyRecommendedRecipe() {
            if (currentMode !== 'peliharaan') return;
            if (!selectedTernak) {
                alert("Pilih Status & Target Gizi terlebih dahulu.");
                return;
            }

            const weight = parseFloat(document.getElementById('pet-body-weight').value) || 0;
            const factorSelect = document.getElementById('pet-activity-factor');
            const factor = parseFloat(factorSelect.value) || 0;

            if (weight <= 0 || factor <= 0) {
                alert("Masukkan berat badan hewan dan pilih status gizi terlebih dahulu.");
                return;
            }

            const reqId = selectedTernak.id;
            let recipe = [];
            
            if (reqId === "1" || reqId === "4" || reqId === "2") {
                // Anjing - Puppy, Anjing - Hamil, Anjing - Dewasa
                recipe = [
                    { name: 'OAT', pct: 50 },
                    { name: 'TEPUNG IKAN', pct: 35 },
                    { name: 'MINYAK IKAN', pct: 11 },
                    { name: 'TEPUNG TULANG', pct: 3 },
                    { name: 'PREMIX VITAMIN MINERAL', pct: 1 }
                ];
            } else if (reqId === "3") {
                // Anjing - Senior
                recipe = [
                    { name: 'OAT', pct: 60 },
                    { name: 'TEPUNG IKAN', pct: 30 },
                    { name: 'MINYAK IKAN', pct: 6 },
                    { name: 'TEPUNG TULANG', pct: 3 },
                    { name: 'PREMIX VITAMIN MINERAL', pct: 1 }
                ];
            } else if (reqId === "5") {
                // Anjing - Menyusui
                recipe = [
                    { name: 'OAT', pct: 50 },
                    { name: 'TEPUNG IKAN', pct: 35 },
                    { name: 'MINYAK IKAN', pct: 12 },
                    { name: 'TEPUNG TULANG', pct: 2 },
                    { name: 'PREMIX VITAMIN MINERAL', pct: 1 }
                ];
            } else if (reqId === "6" || reqId === "7" || reqId === "9") {
                // Kucing - Kitten, Kucing - Dewasa, Kucing - Hamil
                recipe = [
                    { name: 'OAT', pct: 30 },
                    { name: 'TEPUNG IKAN', pct: 50 },
                    { name: 'MINYAK IKAN', pct: 16 },
                    { name: 'TEPUNG TULANG', pct: 3 },
                    { name: 'PREMIX VITAMIN MINERAL', pct: 1 }
                ];
            } else if (reqId === "8") {
                // Kucing - Senior
                recipe = [
                    { name: 'OAT', pct: 40 },
                    { name: 'TEPUNG IKAN', pct: 45 },
                    { name: 'MINYAK IKAN', pct: 11 },
                    { name: 'TEPUNG TULANG', pct: 3 },
                    { name: 'PREMIX VITAMIN MINERAL', pct: 1 }
                ];
            } else if (reqId === "10") {
                // Kucing - Menyusui
                recipe = [
                    { name: 'OAT', pct: 30 },
                    { name: 'TEPUNG IKAN', pct: 50 },
                    { name: 'MINYAK IKAN', pct: 18 },
                    { name: 'TEPUNG TULANG', pct: 1 },
                    { name: 'PREMIX VITAMIN MINERAL', pct: 1 }
                ];
            }

            // Pre-calculate exact recipe ME dynamically
            let recipeME = 0;
            recipe.forEach(recItem => {
                const foundIng = petIngredients.find(ing => ing.nama.toUpperCase() === recItem.name.toUpperCase());
                if (foundIng) {
                    recipeME += (parseFloat(foundIng.ME) || 0) * (recItem.pct / 100);
                }
            });

            // Calculate precise required daily portion based on the exact recipe ME
            const petCount = parseInt(document.getElementById('pet-animal-count').value) || 1;
            const rer = 70 * Math.pow(weight, 0.75);
            const mer = rer * factor;
            let exactRecIntake = 0;
            if (recipeME > 0) {
                exactRecIntake = (mer / recipeME) * 1000 * petCount;
            }

            if (exactRecIntake <= 0) {
                alert("Gagal menghitung rekomendasi porsi.");
                return;
            }

            const elRows = document.getElementById('input-rows');
            elRows.value = recipe.length.toString();
            document.getElementById('label-row-count').innerText = `${recipe.length} Bahan`;
            renderRows(recipe.length);

            const rows = document.querySelectorAll('#feed-rows-container tr');
            let sumRounded = 0;
            recipe.forEach((recItem, idx) => {
                if (idx >= rows.length) return;
                
                const row = rows[idx];
                
                const foundIng = petIngredients.find(ing => ing.nama.toUpperCase() === recItem.name.toUpperCase());
                if (foundIng) {
                    const valInput = document.getElementById(`custom-select-val-${idx}`);
                    const labelSpan = document.getElementById(`custom-select-label-${idx}`);
                    if (valInput) valInput.value = foundIng.id;
                    if (labelSpan) labelSpan.innerText = foundIng.nama;
                }
                
                let weightGram = 0;
                if (idx === recipe.length - 1) {
                    weightGram = Math.round(exactRecIntake) - sumRounded;
                } else {
                    weightGram = Math.round((recItem.pct / 100) * exactRecIntake);
                    sumRounded += weightGram;
                }

                const weightInput = row.querySelector('input[name="percentage"]');
                if (weightInput) {
                    weightInput.value = weightGram;
                }
            });

            calculateFeed();
        }

        function applyTernakRecommendedRecipe() {
            if (currentMode !== 'ternak') return;
            if (!selectedTernak) {
                alert("Pilih Jenis Ternak terlebih dahulu.");
                return;
            }

            const reqId = selectedTernak.id;
            let recipe = [];

            // Scientifically formulated cost-efficient recipes that exceed all nutrient targets
            if (reqId === "1") { // Sapi Perah Pemula 1 (PK 21%, Ca 0.8%, TDN 94%)
                recipe = [
                    { name: 'KOTORAN ULAT HONGKONG', pct: 60 },
                    { name: 'PROMIX', pct: 25 },
                    { name: 'DAUN KETELA POHON', pct: 15 }
                ];
            } else if (reqId === "5" || reqId === "17") { // Sapi/Kambing Perah Laktasi Prod Tinggi (PK 18%, Ca 1.1%, TDN 75%)
                recipe = [
                    { name: 'DAUN KETELA POHON', pct: 40 },
                    { name: 'BUNGKIL KEDELE', pct: 20 },
                    { name: 'PROMIX', pct: 15 },
                    { name: 'KOTORAN ULAT HONGKONG', pct: 15 },
                    { name: 'BUNGKIL KELAPA', pct: 10 }
                ];
            } else if (reqId === "2" || reqId === "14") { // Sapi/Kambing Perah Pemula 2 (PK 16%, Ca 0.5%, TDN 78%)
                recipe = [
                    { name: 'BUNGKIL KELAPA', pct: 25 },
                    { name: 'BUNGKIL KEDELE', pct: 25 },
                    { name: 'DAUN KETELA POHON', pct: 20 },
                    { name: 'KOTORAN ULAT HONGKONG', pct: 20 },
                    { name: 'AMPAS KELAPA', pct: 10 }
                ];
            } else if (reqId === "3" || reqId === "15") { // Sapi/Kambing Perah Dara (PK 15%, Ca 0.7%, TDN 75%)
                recipe = [
                    { name: 'DAUN KETELA POHON', pct: 30 },
                    { name: 'BUNGKIL KEDELE', pct: 25 },
                    { name: 'BUNGKIL KELAPA', pct: 20 },
                    { name: 'KOTORAN ULAT HONGKONG', pct: 15 },
                    { name: 'AMPAS KELAPA', pct: 10 }
                ];
            } else if (reqId === "4" || reqId === "16") { // Sapi/Kambing Perah Laktasi (PK 16%, Ca 0.9%, TDN 70%)
                recipe = [
                    { name: 'DAUN KETELA POHON', pct: 35 },
                    { name: 'BUNGKIL KEDELE', pct: 25 },
                    { name: 'BUNGKIL KELAPA', pct: 20 },
                    { name: 'AMPAS KELAPA', pct: 10 },
                    { name: 'BEKATUL', pct: 10 }
                ];
            } else if (reqId === "8" || reqId === "11" || reqId === "20") { // Sapi/Kambing/Domba Potong Penggemukan (PK 13%, Ca 0.9%, TDN 70%)
                recipe = [
                    { name: 'DAUN KETELA POHON', pct: 40 },
                    { name: 'BUNGKIL KELAPA', pct: 20 },
                    { name: 'BUNGKIL KEDELE', pct: 15 },
                    { name: 'AMPAS KELAPA', pct: 15 },
                    { name: 'BEKATUL', pct: 10 }
                ];
            } else if (reqId === "6" || reqId === "18") { // Sapi/Kambing Perah Kering Bunting (PK 14%, Ca 0.7%, TDN 65%)
                recipe = [
                    { name: 'DAUN KETELA POHON', pct: 30 },
                    { name: 'BUNGKIL KELAPA', pct: 25 },
                    { name: 'AMPAS KELAPA', pct: 20 },
                    { name: 'BEKATUL', pct: 15 },
                    { name: 'BUNGKIL KEDELE', pct: 10 }
                ];
            } else if (reqId === "7" || reqId === "10" || reqId === "13" || reqId === "19" || reqId === "22") { // Sapi/Kambing/Domba Pejantan (PK 12%, Ca 0.6%, TDN 65%)
                recipe = [
                    { name: 'DAUN KETELA POHON', pct: 30 },
                    { name: 'BUNGKIL KELAPA', pct: 25 },
                    { name: 'BEKATUL', pct: 25 },
                    { name: 'AMPAS KELAPA', pct: 10 },
                    { name: 'BUNGKIL KEDELE', pct: 10 }
                ];
            } else { // Default / Induk Potong (PK 14%, Ca 0.9%, TDN 65%)
                recipe = [
                    { name: 'DAUN KETELA POHON', pct: 35 },
                    { name: 'BUNGKIL KELAPA', pct: 20 },
                    { name: 'BUNGKIL KEDELE', pct: 15 },
                    { name: 'AMPAS KELAPA', pct: 15 },
                    { name: 'BEKATUL', pct: 15 }
                ];
            }

            const elRows = document.getElementById('input-rows');
            elRows.value = recipe.length.toString();
            document.getElementById('label-row-count').innerText = `${recipe.length} Bahan`;
            renderRows(recipe.length);

            const rows = document.querySelectorAll('#feed-rows-container tr');
            recipe.forEach((recItem, idx) => {
                if (idx >= rows.length) return;
                
                const row = rows[idx];
                
                const foundIng = dataBahan.find(ing => ing.nama.toUpperCase() === recItem.name.toUpperCase());
                if (foundIng) {
                    const valInput = document.getElementById(`custom-select-val-${idx}`);
                    const labelSpan = document.getElementById(`custom-select-label-${idx}`);
                    if (valInput) valInput.value = foundIng.id;
                    if (labelSpan) labelSpan.innerText = foundIng.nama;
                }
                
                const weightInput = row.querySelector('input[name="percentage"]');
                if (weightInput) {
                    weightInput.value = recItem.pct;
                }

                const priceInput = row.querySelector('input[name="price"]');
                if (priceInput && (!priceInput.value || parseFloat(priceInput.value) === 0)) {
                    let priceVal = 0;
                    if (recItem.name === 'AMPAS KELAPA') priceVal = 1500;
                    else if (recItem.name === 'BEKATUL') priceVal = 3000;
                    else if (recItem.name === 'BUNGKIL KEDELE') priceVal = 8500;
                    else if (recItem.name === 'BUNGKIL KELAPA') priceVal = 4000;
                    else if (recItem.name === 'DAUN KETELA POHON') priceVal = 1000;
                    else if (recItem.name === 'LAMTORO') priceVal = 1200;
                    else if (recItem.name === 'KOTORAN ULAT HONGKONG') priceVal = 12000;
                    else if (recItem.name === 'PROMIX') priceVal = 5000;
                    priceInput.value = priceVal;
                }
            });

            calculateFeed();
        }
    </script>
</body>
</html>
