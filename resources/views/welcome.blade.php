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
                    <h1 id="header-title" class="text-xl md:text-2xl font-bold tracking-tight font-sans">Kalkulator Pakan CalKan</h1>
                    <p id="header-subtitle" class="text-xs text-emerald-100 font-medium">Formulasi Pakan Ternak Mandiri - Mudah dan Praktis</p>
                </div>
            </div>

            <!-- Tab Buttons & Change Mode Action -->
            <div class="flex items-center gap-3 flex-wrap justify-center">
                <button id="btn-change-mode" onclick="showModeSelection()" class="hidden bg-emerald-800 hover:bg-emerald-900 text-white font-bold px-3 py-2 rounded-xl text-sm border border-emerald-600 transition-colors">
                    Ganti Kategori
                </button>
                <nav id="header-tabs-nav" class="hidden flex bg-emerald-800/50 p-1 rounded-xl border border-emerald-600 overflow-x-auto max-w-full whitespace-nowrap scrollbar-none">
                    <button onclick="switchTab('calculator')" id="btn-tab-calculator" class="tab-btn px-4 py-2 text-xs md:text-sm font-bold rounded-lg transition-all duration-150 bg-white text-emerald-800 shadow">
                        Hitung Pakan
                    </button>
                    <button onclick="switchTab('ingredients')" id="btn-tab-ingredients" class="tab-btn px-4 py-2 text-xs md:text-sm font-bold rounded-lg transition-all duration-150 text-white hover:bg-emerald-600/50">
                        Data Bahan Pakan
                    </button>
                    <button onclick="switchTab('livestock')" id="btn-tab-livestock" class="tab-btn px-4 py-2 text-xs md:text-sm font-bold rounded-lg transition-all duration-150 text-white hover:bg-emerald-600/50">
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
                <!-- Option 1: Livestock -->
                <button onclick="selectAppMode('ternak')" class="bg-white border-2 border-slate-200 hover:border-emerald-600 rounded-2xl p-6 md:p-8 shadow-sm hover:shadow-md transition-all text-left flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="bg-emerald-50 text-emerald-800 px-3 py-1 text-xs font-bold rounded-full w-max border border-emerald-200">
                            Kategori Peternakan
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">Hewan Ternak</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Kalkulasi formulasi pakan untuk Sapi Perah, Sapi Potong, Kambing, dan Domba. Menggunakan parameter gizi Bahan Kering (BK), Protein Kasar (PK), Lemak Kasar (LK), Kadar Abu, Kalsium (Ca), Fosfor (P), dan Energi TDN.</p>
                    </div>
                    <div class="mt-8 text-emerald-700 font-bold text-sm">
                        Pilih Hewan Ternak &rarr;
                    </div>
                </button>
                
                <!-- Option 2: Pets -->
                <button onclick="selectAppMode('peliharaan')" class="bg-white border-2 border-slate-200 hover:border-emerald-600 rounded-2xl p-6 md:p-8 shadow-sm hover:shadow-md transition-all text-left flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="bg-emerald-50 text-emerald-800 px-3 py-1 text-xs font-bold rounded-full w-max border border-emerald-200">
                            Kategori Rumah Tangga
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">Hewan Peliharaan</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Kalkulasi pakan anjing dan kucing (Puppy, Kitten, Dewasa, Senior, Hamil, Menyusui) sesuai standar AAFCO, FEDIAF, dan NRC. Menggunakan parameter gizi Kadar Air, Protein, Lemak, Serat Kasar, Kadar Abu, Kalsium (Ca), Fosfor (P), dan Energi Metabolis (ME).</p>
                    </div>
                    <div class="mt-8 text-emerald-700 font-bold text-sm">
                        Pilih Hewan Peliharaan &rarr;
                    </div>
                </button>
            </div>
        </div>

        <!-- ==================== MAIN CALCULATOR APP CONTAINER ==================== -->
        <div id="main-calculator-app" class="hidden space-y-6">

            <!-- ==================== TAB: CALCULATOR ==================== -->
            <div id="tab-calculator" class="tab-content space-y-6">
                
                <!-- Panduan Singkat Banner -->
                <div class="bg-white border-l-4 border-emerald-600 rounded-r-xl p-5 shadow-sm space-y-1.5 border border-slate-200">
                    <h3 class="text-base font-bold text-emerald-800">Petunjuk Penggunaan Kalkulator:</h3>
                    <ol class="list-decimal list-inside text-sm text-slate-700 space-y-1">
                        <li>Pilih jenis hewan dan masukkan total berat pakan pada Langkah 1.</li>
                        <li>Pilih bahan pakan dan isi persentase campuran pada Langkah 2.</li>
                        <li>Pastikan total persentase campuran pakan genap bernilai 100%.</li>
                        <li>Hasil analisis kecukupan gizi dan estimasi biaya dapat dilihat pada Langkah 3.</li>
                    </ol>
                </div>

                <!-- Grid Layout for Inputs & Outputs -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    
                    <!-- Left Column: Step 1 & Step 2 (7 cols) -->
                    <div class="lg:col-span-7 space-y-6">
                        
                        <!-- LANGKAH 1: Ternak & Berat -->
                        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-4">
                            <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
                                <span class="text-emerald-700 text-lg font-bold">Langkah 1:</span>
                                <h2 id="step-1-title" class="text-lg font-bold text-slate-900">Pilih Jenis Ternak dan Berat Pakan</h2>
                            </div>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Select Ternak -->
                                <div id="ternak-select-wrapper">
                                    <label id="step-1-label" for="select-ternak" class="block text-sm font-bold text-slate-700 mb-2">Jenis Ternak:</label>
                                    <select id="select-ternak" onchange="onTernakChange()" class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3 text-base text-slate-800 font-medium focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-700 focus:outline-none">
                                        <option value="">-- Pilih Hewan --</option>
                                    </select>
                                </div>
                                
                                <!-- Input Weight -->
                                <div>
                                    <label for="input-weight" class="block text-sm font-bold text-slate-700 mb-2">Total Berat Campuran:</label>
                                    <div class="relative">
                                        <input type="number" id="input-weight" value="0" readonly class="w-full bg-slate-50 border border-slate-300 rounded-xl pl-4 pr-16 py-3 text-base text-slate-800 font-bold focus:outline-none cursor-not-allowed">
                                        <span id="weight-unit-label" class="absolute right-4 top-1/2 -translate-y-1/2 text-sm font-bold text-slate-500">KG</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Pet Energy & Feeding Calculator (Hanya muncul di mode peliharaan) -->
                            <div id="pet-energy-calculator-container" class="hidden border-t border-slate-100 pt-4 space-y-4">
                                <h3 class="text-sm font-bold text-slate-700">Estimasi Kebutuhan Energi & Pakan Harian:</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <!-- Input Berat Badan Hewan -->
                                    <div>
                                        <label for="pet-body-weight" class="block text-xs font-bold text-slate-600 mb-1">Berat Badan Hewan (KG):</label>
                                        <input type="number" id="pet-body-weight" value="5" min="0.1" step="any" oninput="calculatePetEnergy()" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-sm text-slate-800 font-bold focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-700 focus:outline-none">
                                    </div>
                                    <!-- Select Faktor Kondisi / Aktivitas & Target -->
                                    <div>
                                        <label for="pet-activity-factor" class="block text-xs font-bold text-slate-600 mb-1">Status / Aktivitas & Target Gizi:</label>
                                        <select id="pet-activity-factor" onchange="calculatePetEnergy()" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-sm text-slate-800 font-semibold focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-700 focus:outline-none">
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
                                        <p id="pet-rec-feed-val" class="text-sm font-black text-emerald-700 mt-0.5 font-mono">0 Gram/hari</p>
                                    </div>
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
                        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-4">
                            <div class="flex items-center justify-between border-b border-slate-100 pb-3 flex-wrap gap-3">
                                <div class="flex items-center gap-2">
                                    <span class="text-emerald-700 text-lg font-bold">Langkah 2:</span>
                                    <h2 class="text-lg font-bold text-slate-900">Atur Campuran Bahan Pakan</h2>
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
                            <div class="overflow-x-auto border border-slate-200 rounded-xl">
                                <table class="w-full text-left border-collapse min-w-[500px]">
                                    <thead>
                                        <tr class="bg-slate-55 border-b border-slate-200 text-xs font-bold text-slate-600 uppercase">
                                            <th class="py-3 px-3 w-1/2">Nama Bahan Pakan</th>
                                            <th id="th-weight-column" class="py-3 px-2 w-28 text-center">Porsi (%)</th>
                                            <th class="py-3 px-3 w-36 price-column">Harga (Rp/Kg)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="feed-rows-container" class="divide-y divide-slate-100">
                                        <!-- Dynamic rows injected here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Step 3 Results (5 cols) -->
                    <div class="lg:col-span-5 space-y-6">
                        
                        <!-- LANGKAH 3: Hasil & Biaya -->
                        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-6">
                            <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
                                <span class="text-emerald-700 text-lg font-bold">Langkah 3:</span>
                                <h2 id="step-3-title" class="text-lg font-bold text-slate-900">Hasil Formulasi dan Biaya</h2>
                            </div>

                            <!-- Progress Bar for total percentage -->
                            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 space-y-2">
                                <div class="flex justify-between items-center text-sm font-bold">
                                    <span class="text-slate-600">Total Persentase Campuran:</span>
                                    <span id="total-percent-badge" class="px-2.5 py-0.5 rounded-lg bg-red-100 text-red-800 font-extrabold border border-red-200 text-base">0%</span>
                                </div>
                                <div class="w-full bg-slate-200 h-3 rounded-full overflow-hidden border border-slate-350">
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
                                <div class="bg-slate-55 border border-slate-200 rounded-xl p-4 text-center shadow-xs">
                                    <p class="text-xs font-bold text-slate-600 uppercase tracking-wider">Total Biaya Campuran</p>
                                    <p id="total-cost" class="text-2xl font-black text-emerald-700 mt-1">Rp 0</p>
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

                            <div class="overflow-x-auto border border-slate-200 rounded-xl">
                                <table class="w-full text-center text-sm min-w-[340px]">
                                    <thead>
                                        <tr class="bg-slate-55 border-b border-slate-200 text-slate-660 font-bold">
                                            <th class="py-2.5 px-2 text-left">Nutrisi</th>
                                            <th class="py-2.5 px-2">Hasil</th>
                                            <th class="py-2.5 px-2">Target</th>
                                            <th class="py-2.5 px-2">Status</th>
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
                    <div class="overflow-x-auto border border-slate-200 rounded-xl">
                        <table class="w-full text-left text-sm border-collapse min-w-[500px]">
                            <thead>
                                <tr class="bg-slate-55 border-b border-slate-200 text-slate-650 font-bold text-xs uppercase">
                                    <th class="py-2.5 px-4 w-1/4">Singkatan</th>
                                    <th class="py-2.5 px-4 w-1/3">Nama Lengkap</th>
                                    <th class="py-2.5 px-4">Keterangan Singkat</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-150 text-slate-700">
                                <tr class="hover:bg-slate-50">
                                    <td class="py-3 px-4 font-bold text-slate-900">BK (%) / Air (%)</td>
                                    <td class="py-3 px-4 font-semibold text-slate-800">Bahan Kering / Kadar Air</td>
                                    <td class="py-3 px-4 text-slate-500 text-xs">Pencerminan porsi zat nutrisi solid atau kadar basah kelembaban pakan secara total.</td>
                                </tr>
                                <tr class="hover:bg-slate-50">
                                    <td class="py-3 px-4 font-bold text-slate-900">PK (%) / Protein (%)</td>
                                    <td class="py-3 px-4 font-semibold text-slate-800">Protein Kasar (Crude Protein)</td>
                                    <td class="py-3 px-4 text-slate-500 text-xs">Zat utama pakan pembangun sel-sel tubuh, jaringan otot, dan regenerasi organ tubuh.</td>
                                </tr>
                                <tr class="hover:bg-slate-50">
                                    <td class="py-3 px-4 font-bold text-slate-900">LK (%) / Lemak (%)</td>
                                    <td class="py-3 px-4 font-semibold text-slate-800">Lemak Kasar (Crude Fat)</td>
                                    <td class="py-3 px-4 text-slate-500 text-xs">Sumber kalori yang padat energi dan mempermudah penyerapan vitamin larut lemak.</td>
                                </tr>
                                <tr class="hover:bg-slate-50">
                                    <td class="py-3 px-4 font-bold text-slate-900">Serat (%)</td>
                                    <td class="py-3 px-4 font-semibold text-slate-800">Serat Kasar (Crude Fiber)</td>
                                    <td class="py-3 px-4 text-slate-500 text-xs">Komponen karbohidrat kompleks yang melancarkan kinerja sistem organ pencernaan.</td>
                                </tr>
                                <tr class="hover:bg-slate-50">
                                    <td class="py-3 px-4 font-bold text-slate-900">Abu (%)</td>
                                    <td class="py-3 px-4 font-semibold text-slate-800">Kadar Abu (Total Mineral)</td>
                                    <td class="py-3 px-4 text-slate-500 text-xs">Zat anorganik sisa pemanasan pakan yang mencakup semua mineral penyusun pakan.</td>
                                </tr>
                                <tr class="hover:bg-slate-50">
                                    <td class="py-3 px-4 font-bold text-slate-900">Ca (%)</td>
                                    <td class="py-3 px-4 font-semibold text-slate-800">Kalsium (Calcium)</td>
                                    <td class="py-3 px-4 text-slate-500 text-xs">Mineral makro krusial untuk struktur pembentukan tulang, gigi, dan sistem syaraf.</td>
                                </tr>
                                <tr class="hover:bg-slate-50">
                                    <td class="py-3 px-4 font-bold text-slate-900">P (%)</td>
                                    <td class="py-3 px-4 font-semibold text-slate-800">Fosfor (Phosphorus)</td>
                                    <td class="py-3 px-4 text-slate-500 text-xs">Mineral pembentuk energi seluler ATP serta membantu integrasi mineral kalsium.</td>
                                </tr>
                                <tr class="hover:bg-slate-50">
                                    <td class="py-3 px-4 font-bold text-slate-900">TDN (%) / ME (kcal/kg)</td>
                                    <td class="py-3 px-4 font-semibold text-slate-800">Total Nutrien Tercerna / Energi Metabolis</td>
                                    <td class="py-3 px-4 text-slate-500 text-xs">Nilai total kalori pakan yang siap dimetabolisme dan dimanfaatkan oleh tubuh hewan.</td>
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
                headerTitle.innerText = "Kalkulator Pakan CalKan";
                headerSubtitle.innerText = "Formulasi Pakan Ternak Mandiri - Mudah dan Praktis";
                tabIngredientsBtn.innerText = "Data Bahan Pakan";
                tabLivestockBtn.innerText = "Standar Ternak";
                step1Title.innerText = "Pilih Jenis Ternak dan Berat Pakan";
                step1Label.innerText = "Jenis Ternak:";
                reqCardTitle.innerText = "Target Gizi Minimal Ternak:";
                ingHeading.innerText = "Kandungan Gizi Bahan Pakan Lengkap";
                liveHeading.innerText = "Standar Minimum Kebutuhan Gizi Ternak";
            } else {
                headerTitle.innerText = "Kalkulator Pakan Pets CalKan";
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
            document.getElementById('weight-unit-label').innerText = mode === 'ternak' ? 'KG' : 'Gram';

            // Update th column header
            const thWeight = document.getElementById('th-weight-column');
            if (thWeight) {
                thWeight.innerText = mode === 'ternak' ? 'Berat (KG)' : 'Berat (Gram)';
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
            } else {
                petCalcContainer.classList.remove('hidden');
                document.getElementById('pet-body-weight').value = "5";
                updateActivityFactorDropdown("");
                calculatePetEnergy();
            }
            
            // Update Langkah 3 Header & Cost visibility
            const step3Title = document.getElementById('step-3-title');
            const costSummaryContainer = document.getElementById('cost-summary-container');
            if (mode === 'ternak') {
                step3Title.innerText = "Hasil Formulasi dan Biaya";
                costSummaryContainer.style.display = '';
            } else {
                step3Title.innerText = "Hasil Formulasi dan Timbangan";
                costSummaryContainer.style.display = 'none';
            }
            
            togglePriceColumns();
            
            switchTab('calculator');
            calculateFeed();
        }

        function togglePriceColumns() {
            document.querySelectorAll('.price-column').forEach(el => {
                if (currentMode === 'ternak') {
                    el.style.display = '';
                } else {
                    el.style.display = 'none';
                }
            });
        }

        function calculatePetEnergy(currentFeedMe = null) {
            if (currentMode !== 'peliharaan') return;

            const weight = parseFloat(document.getElementById('pet-body-weight').value) || 0;
            const factorSelect = document.getElementById('pet-activity-factor');
            const factor = parseFloat(factorSelect.value) || 0;

            const selectedOpt = factorSelect.options[factorSelect.selectedIndex];
            const reqId = selectedOpt ? selectedOpt.getAttribute('data-req-id') : null;
            
            const card = document.getElementById('ternak-req-card');
            if (reqId) {
                selectedTernak = petRequirements.find(t => t.id === reqId);
                if (selectedTernak) {
                    card.classList.remove('hidden');
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
                resetTargets();
            }

            if (weight <= 0) {
                document.getElementById('pet-rer-val').innerText = '0 kcal/hari';
                document.getElementById('pet-mer-val').innerText = '0 kcal/hari';
                document.getElementById('pet-rec-feed-val').innerText = '0 Gram/hari';
                updateDailyPortionFeedback(0);
                return;
            }

            // RER = 70 * (weight ^ 0.75)
            const rer = 70 * Math.pow(weight, 0.75);
            const mer = rer * factor;

            document.getElementById('pet-rer-val').innerText = `${Math.round(rer)} kcal/hari`;
            document.getElementById('pet-mer-val').innerText = `${Math.round(mer)} kcal/hari`;

            let meVal = currentFeedMe;
            if (meVal === null) {
                const resMeEl = document.getElementById('res-ME');
                meVal = resMeEl ? parseFloat(resMeEl.innerText) : 0;
            }

            if (meVal > 0) {
                const recIntake = (mer / meVal) * 1000;
                document.getElementById('pet-rec-feed-val').innerText = `${Math.round(recIntake)} Gram/hari`;
                updateDailyPortionFeedback(recIntake);
            } else {
                document.getElementById('pet-rec-feed-val').innerText = '0 Gram/hari';
                updateDailyPortionFeedback(0);
            }
        }

        function updateDailyPortionFeedback(recIntake) {
            const warningText = document.getElementById('total-percent-warning');
            if (currentMode !== 'peliharaan') {
                warningText.classList.add('hidden');
                return;
            }

            const weightInput = parseFloat(document.getElementById('input-weight').value) || 0;
            if (weightInput === 0) {
                warningText.innerText = "Silakan isi berat bahan pakan di Langkah 2.";
                warningText.className = "text-xs text-slate-700 font-bold bg-slate-50 p-2.5 rounded-lg border border-slate-200";
                warningText.classList.remove('hidden');
                return;
            }

            if (recIntake <= 0) {
                warningText.innerText = "Kandungan Energi Metabolis (ME) campuran pakan Anda masih 0. Pastikan bahan pakan mengandung energi.";
                warningText.className = "text-xs text-amber-800 font-bold bg-amber-50 p-2.5 rounded-lg border border-amber-250";
                warningText.classList.remove('hidden');
                return;
            }

            const difference = weightInput - recIntake;
            const pctDiff = Math.abs(difference) / recIntake;

            warningText.classList.remove('hidden');
            if (pctDiff <= 0.05) {
                warningText.innerText = `Porsi Sesuai! Campuran Anda (${Math.round(weightInput)} Gram) pas untuk kebutuhan harian kucing/anjing Anda (${Math.round(recIntake)} Gram/hari).`;
                warningText.className = "text-xs text-emerald-850 font-bold bg-emerald-50 p-2.5 rounded-lg border border-emerald-250";
            } else if (difference < 0) {
                warningText.innerText = `Porsi Kurang! Campuran Anda (${Math.round(weightInput)} Gram) kurang dari kebutuhan harian (${Math.round(recIntake)} Gram/hari). Kurang sekitar ${Math.round(Math.abs(difference))} Gram.`;
                warningText.className = "text-xs text-amber-855 font-bold bg-amber-50 p-2.5 rounded-lg border border-amber-250";
            } else {
                warningText.innerText = `Porsi Berlebih! Campuran Anda (${Math.round(weightInput)} Gram) melebihi kebutuhan harian (${Math.round(recIntake)} Gram/hari). Lebih sekitar ${Math.round(difference)} Gram.`;
                warningText.className = "text-xs text-blue-850 font-bold bg-blue-50 p-2.5 rounded-lg border border-blue-250";
            }
        }

        function showModeSelection() {
            currentMode = null;
            document.getElementById('mode-selection-screen').classList.remove('hidden');
            document.getElementById('main-calculator-app').classList.add('hidden');
            document.getElementById('header-tabs-nav').classList.add('hidden');
            document.getElementById('btn-change-mode').classList.add('hidden');
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
            
            if (!val) {
                selectedTernak = null;
                card.classList.add('hidden');
                resetTargets();
                calculateFeed();
                return;
            }

            selectedTernak = dataTernak.find(t => t.id === val);
            card.classList.remove('hidden');

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
                    <td class="py-3 px-2 text-left">
                        <span class="font-bold text-slate-900 block">${n.label}</span>
                        <span class="text-xs text-slate-500 block">${n.desc}</span>
                    </td>
                    <td id="res-${n.key}" class="font-bold text-slate-800">0.00%</td>
                    <td id="tar-${n.key}" class="text-slate-500 font-medium">0.00%</td>
                    <td class="px-2"><span id="diff-${n.key}" class="px-2 py-1 rounded bg-slate-100 text-slate-650 font-bold border border-slate-200 text-xs block text-center">Belum Ada Target</span></td>
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

        function renderRows(count) {
            const container = document.getElementById('feed-rows-container');
            const currentRows = container.children.length;

            if (count > currentRows) {
                for (let i = currentRows; i < count; i++) {
                    const row = document.createElement('tr');
                    row.id = `feed-row-${i}`;
                    row.className = "hover:bg-slate-50 border-b border-slate-200";
                    row.innerHTML = `
                        <td class="py-3 px-3 flex items-center gap-2">
                            <button type="button" onclick="showIngredientDetails(${i})" class="bg-slate-100 hover:bg-emerald-100 text-slate-700 hover:text-emerald-800 px-2.5 py-2 rounded-xl border border-slate-300 font-bold text-xs flex items-center gap-1 transition-colors" title="Lihat detail gizi">
                                Info
                            </button>
                            <select onchange="calculateFeed()" name="ingredient" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2.5 text-sm text-slate-800 font-semibold focus:border-emerald-700 focus:outline-none">
                                <option value="">-- Pilih Bahan --</option>
                            </select>
                        </td>
                         <td class="py-3 px-2">
                            <input type="number" name="percentage" min="0" step="any" oninput="calculateFeed()" placeholder="0" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2.5 text-sm text-slate-900 font-bold focus:border-emerald-700 focus:outline-none text-center">
                        </td>
                        <td class="py-3 px-3 price-column">
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
            const selects = document.querySelectorAll('select[name="ingredient"]');
            selects.forEach(select => {
                const curVal = select.value;
                select.innerHTML = '<option value="">-- Pilih Bahan --</option>';
                
                if (currentMode === 'ternak') {
                    dataBahan.forEach(item => {
                        const opt = document.createElement('option');
                        opt.value = item.id;
                        opt.innerText = item.nama;
                        select.appendChild(opt);
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
                        const group = document.createElement('optgroup');
                        group.label = cat;
                        categories[cat].forEach(item => {
                            const opt = document.createElement('option');
                            opt.value = item.id;
                            opt.innerText = item.nama;
                            group.appendChild(opt);
                        });
                        select.appendChild(group);
                    }
                }
                
                if (curVal) select.value = curVal;
            });
        }

        // Show Details Modal
        function showIngredientDetails(rowIndex) {
            const row = document.getElementById(`feed-row-${rowIndex}`);
            const select = row.querySelector('select[name="ingredient"]');
            if (!select.value) {
                alert("Pilih bahan pakan terlebih dahulu.");
                return;
            }
            
            let item;
            if (currentMode === 'ternak') {
                item = dataBahan.find(b => b.id === select.value);
            } else {
                item = petIngredients.find(b => b.id === select.value);
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
                const select = row.querySelector('select[name="ingredient"]');
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
                const select = row.querySelector('select[name="ingredient"]');
                const inputWeightVal = parseFloat(row.querySelector('input[name="percentage"]').value) || 0;
                const priceVal = parseFloat(row.querySelector('input[name="price"]').value) || 0;

                if (select.value) {
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

            percentBadge.innerText = `${totalInputWeight.toLocaleString('id-ID', { maximumFractionDigits: 2 })} ${unit}`;
            percentBadge.className = "px-3 py-1 rounded-lg bg-emerald-100 text-emerald-800 font-extrabold border border-emerald-300 text-base shadow-xs";
            
            if (currentMode === 'ternak') {
                warningText.classList.add('hidden');
            }

            // Update Cost Display
            document.getElementById('total-cost').innerText = `Rp ${totalCost.toLocaleString('id-ID', { maximumFractionDigits: 0 })}`;
            const costPerKg = totalKg > 0 ? (totalCost / totalKg) : 0;
            document.getElementById('cost-per-kg').innerText = `Rp ${costPerKg.toLocaleString('id-ID', { maximumFractionDigits: 0 })}`;

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
                    if (difference >= 0) {
                        diffEl.innerText = `Cukup (+${diffStr})`;
                        diffEl.className = "px-2 py-1 rounded bg-emerald-100 text-emerald-800 font-bold border border-emerald-300 text-xs block text-center shadow-xs";
                    } else {
                        diffEl.innerText = `Kurang (${diffStr})`;
                        diffEl.className = "px-2 py-1 rounded bg-red-100 text-red-800 font-bold border border-red-300 text-xs block text-center shadow-xs";
                    }
                } else {
                    diffEl.innerText = "Belum Ada Target";
                    diffEl.className = "px-2 py-1 rounded bg-slate-100 text-slate-650 font-bold border border-slate-200 text-xs block text-center shadow-xs";
                }
            });

            if (currentMode === 'peliharaan') {
                calculatePetEnergy(mixNutrients['ME']);
            }
        }
    </script>
</body>
</html>
