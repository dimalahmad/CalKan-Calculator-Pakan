<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CalKan - Kalkulator Formula Pakan Ternak</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;850&display=swap" rel="stylesheet">

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
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col antialiased">

    <!-- Top Navigation Bar -->
    <header class="bg-gradient-to-r from-emerald-800 to-teal-800 text-white shadow-md sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-4 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="bg-white/10 p-2.5 rounded-xl text-2xl backdrop-blur-md shadow-inner">
                    🌾
                </div>
                <div class="text-center md:text-left">
                    <h1 class="text-2xl font-extrabold tracking-tight">CalKan</h1>
                    <p class="text-xs text-emerald-100/90 font-medium">Kalkulator Pakan Ternak Mandiri • Premium & Praktis</p>
                </div>
            </div>

            <!-- Tab Buttons - Big, Premium & Clear -->
            <nav class="flex bg-emerald-950/40 p-1.5 rounded-xl border border-emerald-600/30">
                <button onclick="switchTab('calculator')" id="btn-tab-calculator" class="tab-btn px-5 py-2.5 text-sm font-bold rounded-lg transition-all duration-150 bg-white text-emerald-900 shadow-md">
                    📊 Mulai Hitung
                </button>
                <button onclick="switchTab('ingredients')" id="btn-tab-ingredients" class="tab-btn px-5 py-2.5 text-sm font-bold rounded-lg transition-all duration-150 text-emerald-100 hover:text-white hover:bg-emerald-700/50">
                    🌾 Data Bahan Pakan
                </button>
                <button onclick="switchTab('livestock')" id="btn-tab-livestock" class="tab-btn px-5 py-2.5 text-sm font-bold rounded-lg transition-all duration-150 text-emerald-100 hover:text-white hover:bg-emerald-700/50">
                    🐄 Standar Ternak
                </button>
            </nav>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 max-w-6xl w-full mx-auto px-4 py-8">

        <!-- ==================== TAB: CALCULATOR ==================== -->
        <div id="tab-calculator" class="tab-content space-y-6">
            
            <!-- Panduan Banner -->
            <div class="bg-emerald-50/60 border border-emerald-250 rounded-2xl p-5 shadow-sm flex items-start gap-4">
                <div class="text-3xl text-emerald-800 hidden sm:block">💡</div>
                <div class="space-y-1">
                    <h3 class="text-base font-extrabold text-emerald-900">Petunjuk Cepat Penggunaan Kalkulator:</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Silakan ikuti <strong>Langkah 1</strong> (pilih ternak), lalu isi persentase bahan pakan di <strong>Langkah 2</strong> sampai total persentase di kanan menjadi <strong>100%</strong>. Hasil analisa gizi dan estimasi biaya pakan akan keluar otomatis di <strong>Langkah 3</strong>.
                    </p>
                </div>
            </div>

            <!-- Grid Layout for Inputs & Outputs -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Left Column: Step 1 & Step 2 (7 cols) -->
                <div class="lg:col-span-7 space-y-6">
                    
                    <!-- LANGKAH 1: Ternak & Berat -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-5">
                        <div class="flex items-center gap-3 border-b border-slate-100 pb-3">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 font-extrabold text-sm shadow-sm">1</span>
                            <h2 class="text-lg font-bold text-slate-900">Pilih Jenis Ternak & Berat Pakan</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <!-- Select Ternak -->
                            <div>
                                <label for="select-ternak" class="block text-sm font-bold text-slate-650 mb-2">Jenis Ternak Anda:</label>
                                <select id="select-ternak" onchange="onTernakChange()" class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3 text-base text-slate-800 font-semibold focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-700 focus:outline-none transition-all shadow-xs">
                                    <option value="">-- Silakan Pilih Ternak --</option>
                                </select>
                            </div>
                            
                            <!-- Input Weight -->
                            <div>
                                <label for="input-weight" class="block text-sm font-bold text-slate-650 mb-2">Total Berat Campuran Pakan:</label>
                                <div class="relative">
                                    <input type="number" id="input-weight" value="100" min="1" step="any" oninput="calculateFeed()" class="w-full bg-white border border-slate-300 rounded-xl pl-4 pr-16 py-3 text-base text-slate-900 font-black focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-700 focus:outline-none transition-all shadow-xs">
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-sm font-bold text-slate-400">KG</span>
                                </div>
                            </div>
                        </div>

                        <!-- Mini Requirement Card -->
                        <div id="ternak-req-card" class="hidden bg-slate-50 rounded-xl p-4 border border-slate-200 space-y-3">
                            <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Target Minimal Nutrisi Ternak:</h3>
                            <div class="grid grid-cols-4 sm:grid-cols-7 gap-2 text-center text-xs">
                                <div class="bg-white rounded-lg p-2 border border-slate-200/60 shadow-xs">
                                    <p class="text-slate-400 font-semibold">BK (%)</p>
                                    <p id="req-BK" class="text-sm font-bold text-slate-800">-</p>
                                </div>
                                <div class="bg-white rounded-lg p-2 border border-slate-200/60 shadow-xs">
                                    <p class="text-slate-400 font-semibold">PK (%)</p>
                                    <p id="req-PK" class="text-sm font-bold text-slate-800">-</p>
                                </div>
                                <div class="bg-white rounded-lg p-2 border border-slate-200/60 shadow-xs">
                                    <p class="text-slate-400 font-semibold">LK (%)</p>
                                    <p id="req-LK" class="text-sm font-bold text-slate-800">-</p>
                                </div>
                                <div class="bg-white rounded-lg p-2 border border-slate-200/60 shadow-xs">
                                    <p class="text-slate-400 font-semibold">Abu (%)</p>
                                    <p id="req-Abu" class="text-sm font-bold text-slate-800">-</p>
                                </div>
                                <div class="bg-white rounded-lg p-2 border border-slate-200/60 shadow-xs">
                                    <p class="text-slate-400 font-semibold">Ca (%)</p>
                                    <p id="req-Ca" class="text-sm font-bold text-slate-800">-</p>
                                </div>
                                <div class="bg-white rounded-lg p-2 border border-slate-200/60 shadow-xs">
                                    <p class="text-slate-400 font-semibold">P (%)</p>
                                    <p id="req-P" class="text-sm font-bold text-slate-800">-</p>
                                </div>
                                <div class="bg-emerald-50 rounded-lg p-2 border border-emerald-100 shadow-xs">
                                    <p class="text-emerald-700 font-bold">TDN (%)</p>
                                    <p id="req-TDN" class="text-sm font-extrabold text-emerald-800">-</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- LANGKAH 2: Pemilihan Bahan -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3 flex-wrap gap-4">
                            <div class="flex items-center gap-3">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 font-extrabold text-sm shadow-sm">2</span>
                                <h2 class="text-lg font-bold text-slate-900">Atur Campuran Bahan Pakan</h2>
                            </div>
                            
                            <!-- Row Controls -->
                            <div class="flex items-center bg-slate-100 border border-slate-200 rounded-xl p-1.5">
                                <button onclick="decrementRows()" class="w-8 h-8 rounded-lg flex items-center justify-center bg-white border border-slate-250 hover:bg-slate-50 text-slate-600 transition-colors shadow-xs">
                                    ➖
                                </button>
                                <span class="text-sm font-extrabold px-3 text-slate-800" id="label-row-count">3 Bahan</span>
                                <button onclick="incrementRows()" class="w-8 h-8 rounded-lg flex items-center justify-center bg-emerald-600 hover:bg-emerald-750 text-white transition-colors shadow-xs">
                                    ➕
                                </button>
                            </div>
                        </div>

                        <!-- Feed Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-slate-200 text-xs font-bold text-slate-400 uppercase tracking-wider">
                                        <th class="pb-3 pr-2">Bahan Pakan</th>
                                        <th class="pb-3 px-2 w-32 text-center">Porsi (%)</th>
                                        <th class="pb-3 pl-2 w-36">Harga (Rp/Kg)</th>
                                    </tr>
                                </thead>
                                <tbody id="feed-rows-container" class="divide-y divide-slate-100">
                                    <!-- Injected dynamically -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Step 3 Results (5 cols) -->
                <div class="lg:col-span-5 space-y-6">
                    
                    <!-- LANGKAH 3: Hasil & Biaya -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-6">
                        <div class="flex items-center gap-3 border-b border-slate-100 pb-3">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 font-extrabold text-sm shadow-sm">3</span>
                            <h2 class="text-lg font-bold text-slate-900">Hasil & Estimasi Biaya</h2>
                        </div>

                        <!-- Progress Bar -->
                        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-4.5 space-y-2.5">
                            <div class="flex justify-between items-center text-sm font-bold">
                                <span class="text-slate-650">Total Formulasi:</span>
                                <span id="total-percent-badge" class="px-2.5 py-1 rounded-lg bg-red-50 text-red-700 font-black border border-red-200 text-base">0%</span>
                            </div>
                            <div class="w-full bg-slate-200 h-3 rounded-full overflow-hidden border border-slate-300">
                                <div id="total-percent-bar" class="h-full bg-red-500 transition-all duration-200" style="width: 0%"></div>
                            </div>
                            <p id="total-percent-warning" class="text-xs text-red-750 font-bold bg-red-50/50 p-2.5 rounded-lg border border-red-200/60 leading-relaxed">
                                ⚠️ Campuran belum genap 100%! Silakan sesuaikan lagi porsi (%) bahan pakan Anda.
                            </p>
                        </div>

                        <!-- Pricing Cards -->
                        <div class="grid grid-cols-1 gap-3">
                            <div class="bg-emerald-50/50 border border-emerald-200 rounded-2xl p-4 text-center">
                                <p class="text-[10px] font-bold text-emerald-850 uppercase tracking-wider">Harga Pakan per KG</p>
                                <p id="cost-per-kg" class="text-2xl font-black text-slate-900 mt-1">Rp 0</p>
                            </div>
                            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-4 text-center">
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Total Biaya Pembuatan</p>
                                <p id="total-cost" class="text-2xl font-black text-emerald-700 mt-1">Rp 0</p>
                            </div>
                        </div>

                        <!-- Breakdown list -->
                        <div class="space-y-3">
                            <h3 class="text-xs font-bold text-slate-550 uppercase tracking-wider">Timbangan Campuran:</h3>
                            <div id="breakdown-container" class="space-y-2 max-h-56 overflow-y-auto pr-1">
                                <p class="text-sm text-slate-450 italic text-center py-4 bg-slate-50 border border-slate-200 rounded-xl">Belum ada bahan pakan.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Comparison Table: Nutrient Profile vs Targets -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-4">
                        <h2 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">🎯 Hasil Analisa Nutrisi</h2>

                        <div class="overflow-x-auto">
                            <table class="w-full text-center text-sm">
                                <thead>
                                    <tr class="border-b border-slate-200 text-slate-400 font-bold">
                                        <th class="pb-2 text-left">Nutrisi</th>
                                        <th class="pb-2">Hasil</th>
                                        <th class="pb-2">Target</th>
                                        <th class="pb-2">Status</th>
                                    </tr>
                                </thead>
                                <tbody id="nutrient-comparison-tbody" class="divide-y divide-slate-100">
                                    <tr class="hover:bg-slate-50">
                                        <td class="py-3 text-left">
                                            <span class="font-bold text-slate-800 block">Bahan Kering (BK)</span>
                                            <span class="text-[10px] text-slate-400 block">Total bahan padat bebas air</span>
                                        </td>
                                        <td id="res-BK" class="font-bold text-slate-700">0.00%</td>
                                        <td id="tar-BK" class="text-slate-400">0.00%</td>
                                        <td><span id="diff-BK" class="inline-block px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500 border border-slate-200">Belum Ada Target</span></td>
                                    </tr>
                                    <tr class="hover:bg-slate-50">
                                        <td class="py-3 text-left">
                                            <span class="font-bold text-slate-800 block">Protein Kasar (PK)</span>
                                            <span class="text-[10px] text-slate-400 block">Pertumbuhan & produksi susu</span>
                                        </td>
                                        <td id="res-PK" class="font-bold text-slate-700">0.00%</td>
                                        <td id="tar-PK" class="text-slate-400">0.00%</td>
                                        <td><span id="diff-PK" class="inline-block px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500 border border-slate-200">Belum Ada Target</span></td>
                                    </tr>
                                    <tr class="hover:bg-slate-50">
                                        <td class="py-3 text-left">
                                            <span class="font-bold text-slate-800 block">Lemak Kasar (LK)</span>
                                            <span class="text-[10px] text-slate-400 block">Energi & kesehatan sel</span>
                                        </td>
                                        <td id="res-LK" class="font-bold text-slate-700">0.00%</td>
                                        <td id="tar-LK" class="text-slate-400">0.00%</td>
                                        <td><span id="diff-LK" class="inline-block px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500 border border-slate-200">Belum Ada Target</span></td>
                                    </tr>
                                    <tr class="hover:bg-slate-50">
                                        <td class="py-3 text-left">
                                            <span class="font-bold text-slate-800 block">Mineral / Abu</span>
                                            <span class="text-[10px] text-slate-400 block">Kandungan zat anorganik</span>
                                        </td>
                                        <td id="res-Abu" class="font-bold text-slate-700">0.00%</td>
                                        <td id="tar-Abu" class="text-slate-400">0.00%</td>
                                        <td><span id="diff-Abu" class="inline-block px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500 border border-slate-200">Belum Ada Target</span></td>
                                    </tr>
                                    <tr class="hover:bg-slate-50">
                                        <td class="py-3 text-left">
                                            <span class="font-bold text-slate-800 block">Kalsium (Ca)</span>
                                            <span class="text-[10px] text-slate-400 block">Kekuatan struktur tulang</span>
                                        </td>
                                        <td id="res-Ca" class="font-bold text-slate-700">0.00%</td>
                                        <td id="tar-Ca" class="text-slate-400">0.00%</td>
                                        <td><span id="diff-Ca" class="inline-block px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500 border border-slate-200">Belum Ada Target</span></td>
                                    </tr>
                                    <tr class="hover:bg-slate-50">
                                        <td class="py-3 text-left">
                                            <span class="font-bold text-slate-800 block">Fosfor (P)</span>
                                            <span class="text-[10px] text-slate-400 block">Metabolisme zat gizi</span>
                                        </td>
                                        <td id="res-P" class="font-bold text-slate-700">0.00%</td>
                                        <td id="tar-P" class="text-slate-400">0.00%</td>
                                        <td><span id="diff-P" class="inline-block px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500 border border-slate-200">Belum Ada Target</span></td>
                                    </tr>
                                    <tr class="hover:bg-slate-50">
                                        <td class="py-3 text-left">
                                            <span class="font-bold text-slate-850 block">Energi (TDN)</span>
                                            <span class="text-[10px] text-slate-400 block">Total kecernaan nutrien</span>
                                        </td>
                                        <td id="res-TDN" class="font-bold text-slate-850">0.00%</td>
                                        <td id="tar-TDN" class="text-slate-400">0.00%</td>
                                        <td><span id="diff-TDN" class="inline-block px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500 border border-slate-200">Belum Ada Target</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== TAB: INGREDIENTS ==================== -->
        <div id="tab-ingredients" class="tab-content hidden space-y-6">
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-slate-200 pb-4 flex-wrap gap-2">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-slate-900">📋 Data Gizi Bahan Pakan Ternak</h2>
                    </div>
                    <!-- Live Loading Badge -->
                    <span id="badge-api-ingredients" class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200 animate-pulse">Menghubungkan Database API...</span>
                </div>

                <div class="overflow-x-auto max-h-[60vh] overflow-y-auto">
                    <table class="w-full text-center text-sm border-collapse">
                        <thead class="sticky top-0 bg-slate-100 border-b-2 border-slate-200 text-slate-650 font-bold text-xs z-10">
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
                <div class="flex items-center justify-between border-b border-slate-200 pb-4 flex-wrap gap-2">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-slate-900">📋 Standar Target Kebutuhan Gizi Ternak</h2>
                    </div>
                    <!-- Live Loading Badge -->
                    <span id="badge-api-livestock" class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200 animate-pulse">Menghubungkan Database API...</span>
                </div>

                <div class="overflow-x-auto max-h-[60vh] overflow-y-auto">
                    <table class="w-full text-center text-sm border-collapse">
                        <thead class="sticky top-0 bg-slate-100 border-b-2 border-slate-200 text-slate-650 font-bold text-xs z-10">
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
                        </thead>
                        <tbody id="livestock-table-body" class="divide-y divide-slate-150 text-slate-700">
                            <!-- Injected by JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-200 bg-white py-6 mt-12 text-center text-xs text-slate-500">
        <div class="max-w-6xl mx-auto px-4 space-y-1">
            <p class="font-bold text-slate-700">CalKan • Aplikasi Pintar Peternak Mandiri</p>
            <p>Database terhubung langsung dengan spreadsheet pertanian live.</p>
        </div>
    </footer>

    <!-- INGREDIENT DETAIL MODAL -->
    <div id="detail-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs hidden">
        <div class="bg-white border border-slate-200 w-full max-w-md rounded-2xl overflow-hidden shadow-xl">
            <div class="flex items-center justify-between p-6 border-b border-slate-155 bg-slate-50">
                <h3 id="modal-title" class="text-base font-bold text-slate-900">Detail Gizi</h3>
                <button onclick="closeModal()" class="text-slate-400 hover:text-slate-800 text-xl font-bold">
                    ✖
                </button>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-200">
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Bahan Kering (BK)</p>
                        <p id="modal-BK" class="text-base font-bold text-slate-800">-</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-200">
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Protein Kasar (PK)</p>
                        <p id="modal-PK" class="text-base font-bold text-slate-800">-</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-200">
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Lemak Kasar (LK)</p>
                        <p id="modal-LK" class="text-base font-bold text-slate-800">-</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-200">
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Mineral / Abu</p>
                        <p id="modal-Abu" class="text-base font-bold text-slate-800">-</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-200">
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Kalsium (Ca)</p>
                        <p id="modal-Ca" class="text-base font-bold text-slate-800">-</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-200">
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Fosfor (P)</p>
                        <p id="modal-P" class="text-base font-bold text-slate-800">-</p>
                    </div>
                    <div class="col-span-2 bg-slate-50 rounded-xl p-3 border border-slate-200 text-center">
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Energi (TDN)</p>
                        <p id="modal-TDN" class="text-base font-extrabold text-emerald-700">-</p>
                    </div>
                </div>
            </div>
            <div class="bg-slate-50 p-6 border-t border-slate-155 flex justify-end">
                <button onclick="closeModal()" class="px-5 py-2.5 rounded-xl bg-white border border-slate-300 hover:bg-slate-100 text-slate-700 font-bold text-xs shadow-xs transition-colors">Tutup Jendela</button>
            </div>
        </div>
    </div>


    <!-- ==================== LOGIC / JS DATABASE ==================== -->
    <script>
        // Pre-loaded Local Database Fallbacks
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

        // Active State
        let selectedTernak = null;

        // Tab Switching
        function switchTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.getElementById(`tab-${tabId}`).classList.remove('hidden');

            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('bg-white', 'text-emerald-900', 'shadow-md');
                btn.classList.add('text-emerald-100', 'hover:text-white', 'hover:bg-emerald-700/50');
            });

            const activeBtn = document.getElementById(`btn-tab-${tabId}`);
            activeBtn.classList.remove('text-emerald-100', 'hover:text-white', 'hover:bg-emerald-700/50');
            activeBtn.classList.add('bg-white', 'text-emerald-900', 'shadow-md');
        }

        // Initialize App
        window.addEventListener('DOMContentLoaded', () => {
            populateTernakDropdown();
            renderTernakTable();
            renderIngredientsTable();
            renderRows(3); // Start with 3 rows

            fetchData();
        });

        function fetchData() {
            // Fetch Ternak
            fetch("https://script.google.com/macros/s/AKfycbwgcwSOROmoKE26pyN3YkBAS2_MpaM2zC_ySZc8z0lo9_0HZXx_bJMZTFULsKVAydNiCg/exec?nama=Ternak")
                .then(res => res.json())
                .then(json => {
                    if (json && json.data) {
                        dataTernak = json.data;
                        populateTernakDropdown();
                        renderTernakTable();
                        const badge = document.getElementById('badge-api-livestock');
                        badge.innerText = "Terhubung (API)";
                        badge.className = "px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-350";
                    }
                })
                .catch(err => {
                    console.warn("Failed to fetch live Ternak data, using local fallback.", err);
                    const badge = document.getElementById('badge-api-livestock');
                    badge.innerText = "Offline (Database Cadangan)";
                    badge.className = "px-3 py-1 rounded-full text-xs font-bold bg-slate-200 text-slate-700 border border-slate-300";
                });

            // Fetch Bahan
            fetch("https://script.google.com/macros/s/AKfycbwgcwSOROmoKE26pyN3YkBAS2_MpaM2zC_ySZc8z0lo9_0HZXx_bJMZTFULsKVAydNiCg/exec?nama=Bahan")
                .then(res => res.json())
                .then(json => {
                    if (json && json.data) {
                        dataBahan = json.data;
                        renderIngredientsTable();
                        updateAllSelects();
                        const badge = document.getElementById('badge-api-ingredients');
                        badge.innerText = "Terhubung (API)";
                        badge.className = "px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-350";
                    }
                })
                .catch(err => {
                    console.warn("Failed to fetch live Bahan data, using local fallback.", err);
                    const badge = document.getElementById('badge-api-ingredients');
                    badge.innerText = "Offline (Database Cadangan)";
                    badge.className = "px-3 py-1 rounded-full text-xs font-bold bg-slate-200 text-slate-700 border border-slate-300";
                });
        }

        // Dropdown Ternak
        function populateTernakDropdown() {
            const dropdown = document.getElementById('select-ternak');
            const currentValue = dropdown.value;
            dropdown.innerHTML = '<option value="">-- Silakan Pilih Ternak --</option>';
            dataTernak.forEach(item => {
                const opt = document.createElement('option');
                opt.value = item.id;
                opt.innerText = item.nama;
                dropdown.appendChild(opt);
            });
            if (currentValue) dropdown.value = currentValue;
        }

        // Render Tables for other tabs
        function renderTernakTable() {
            const container = document.getElementById('livestock-table-body');
            container.innerHTML = '';
            dataTernak.forEach(item => {
                const row = document.createElement('tr');
                row.className = "hover:bg-slate-50 transition-colors border-b border-slate-200";
                row.innerHTML = `
                    <td class="py-3 px-4 text-left font-bold text-slate-900">${item.nama}</td>
                    <td class="py-3 px-2 font-semibold text-slate-800">${item.BK}%</td>
                    <td class="py-3 px-2 font-semibold text-slate-800">${item.PK}%</td>
                    <td class="py-3 px-2 font-semibold text-slate-800">${item.LK}%</td>
                    <td class="py-3 px-2 font-semibold text-slate-800">${item.Abu}%</td>
                    <td class="py-3 px-2 font-semibold text-slate-800">${item.Ca}%</td>
                    <td class="py-3 px-2 font-semibold text-slate-800">${item.P}%</td>
                    <td class="py-3 px-2 font-extrabold text-emerald-800 bg-emerald-50">${item.TDN}%</td>
                `;
                container.appendChild(row);
            });
        }

        function renderIngredientsTable() {
            const container = document.getElementById('ingredients-table-body');
            container.innerHTML = '';
            dataBahan.forEach(item => {
                const row = document.createElement('tr');
                row.className = "hover:bg-slate-50 transition-colors border-b border-slate-200";
                row.innerHTML = `
                    <td class="py-3 px-4 text-left font-bold text-slate-900">${item.nama}</td>
                    <td class="py-3 px-2 font-semibold text-slate-800">${item.BK}%</td>
                    <td class="py-3 px-2 font-semibold text-slate-800">${item.PK}%</td>
                    <td class="py-3 px-2 font-semibold text-slate-800">${item.LK}%</td>
                    <td class="py-3 px-2 font-semibold text-slate-800">${item.Abu}%</td>
                    <td class="py-3 px-2 font-semibold text-slate-800">${item.Ca}%</td>
                    <td class="py-3 px-2 font-semibold text-slate-800">${item.P}%</td>
                    <td class="py-3 px-2 font-extrabold text-emerald-800 bg-emerald-50">${item.TDN}%</td>
                `;
                container.appendChild(row);
            });
        }

        // On Livestock Selection
        function onTernakChange() {
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
            document.getElementById('req-BK').innerText = `${selectedTernak.BK}%`;
            document.getElementById('req-PK').innerText = `${selectedTernak.PK}%`;
            document.getElementById('req-LK').innerText = `${selectedTernak.LK}%`;
            document.getElementById('req-Abu').innerText = `${selectedTernak.Abu}%`;
            document.getElementById('req-Ca').innerText = `${selectedTernak.Ca}%`;
            document.getElementById('req-P').innerText = `${selectedTernak.P}%`;
            document.getElementById('req-TDN').innerText = `${selectedTernak.TDN}%`;

            document.getElementById('tar-BK').innerText = `${selectedTernak.BK}%`;
            document.getElementById('tar-PK').innerText = `${selectedTernak.PK}%`;
            document.getElementById('tar-LK').innerText = `${selectedTernak.LK}%`;
            document.getElementById('tar-Abu').innerText = `${selectedTernak.Abu}%`;
            document.getElementById('tar-Ca').innerText = `${selectedTernak.Ca}%`;
            document.getElementById('tar-P').innerText = `${selectedTernak.P}%`;
            document.getElementById('tar-TDN').innerText = `${selectedTernak.TDN}%`;

            calculateFeed();
        }

        function resetTargets() {
            ['BK', 'PK', 'LK', 'Abu', 'Ca', 'P', 'TDN'].forEach(nut => {
                document.getElementById(`tar-${nut}`).innerText = '0.00%';
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
                    row.className = "hover:bg-slate-50 border-b border-slate-100";
                    row.innerHTML = `
                        <td class="py-4 pr-2 flex items-center gap-2">
                            <!-- Info Icon button -->
                            <button type="button" onclick="showIngredientDetails(${i})" class="bg-slate-100 hover:bg-emerald-100 text-slate-600 hover:text-emerald-800 p-2.5 rounded-xl border border-slate-200 font-extrabold text-sm flex items-center justify-center transition-colors shadow-xs" title="Lihat detail gizi bahan ini">
                                ℹ️
                            </button>
                            <select onchange="calculateFeed()" name="ingredient" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2.5 text-base text-slate-800 font-bold focus:border-emerald-600 focus:outline-none transition-all shadow-xs">
                                <option value="">-- Pilih Bahan --</option>
                            </select>
                        </td>
                        <td class="py-4 px-2">
                            <input type="number" name="percentage" min="0" max="100" step="any" oninput="calculateFeed()" placeholder="0" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2.5 text-base text-slate-900 font-bold focus:border-emerald-600 focus:outline-none text-center shadow-xs">
                        </td>
                        <td class="py-4 pl-2">
                            <input type="number" name="price" min="0" step="any" oninput="calculateFeed()" placeholder="0" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2.5 text-base text-slate-900 font-bold focus:border-emerald-600 focus:outline-none shadow-xs">
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
        }

        function updateAllSelects() {
            const selects = document.querySelectorAll('select[name="ingredient"]');
            selects.forEach(select => {
                const curVal = select.value;
                select.innerHTML = '<option value="">-- Pilih Bahan --</option>';
                dataBahan.forEach(item => {
                    const opt = document.createElement('option');
                    opt.value = item.id;
                    opt.innerText = item.nama;
                    select.appendChild(opt);
                });
                if (curVal) select.value = curVal;
            });
        }

        // Show Details Modal
        function showIngredientDetails(rowIndex) {
            const row = document.getElementById(`feed-row-${rowIndex}`);
            const select = row.querySelector('select[name="ingredient"]');
            if (!select.value) {
                alert("Pilih bahan pakan di dropdown terlebih dahulu!");
                return;
            }
            const item = dataBahan.find(b => b.id === select.value);
            
            document.getElementById('modal-title').innerText = `Kandungan Gizi: ${item.nama}`;
            document.getElementById('modal-BK').innerText = `${item.BK}%`;
            document.getElementById('modal-PK').innerText = `${item.PK}%`;
            document.getElementById('modal-LK').innerText = `${item.LK}%`;
            document.getElementById('modal-Abu').innerText = `${item.Abu}%`;
            document.getElementById('modal-Ca').innerText = `${item.Ca}%`;
            document.getElementById('modal-P').innerText = `${item.P}%`;
            document.getElementById('modal-TDN').innerText = `${item.TDN}%`;

            document.getElementById('detail-modal').classList.remove('hidden');
        }

        // Close Modal
        function closeModal() {
            document.getElementById('detail-modal').classList.add('hidden');
        }

        // Core Calculation Engine
        function calculateFeed() {
            const rows = document.querySelectorAll('#feed-rows-container tr');
            const totalKg = parseFloat(document.getElementById('input-weight').value) || 0;
            
            let sumPercent = 0;
            let totalCost = 0;
            let selectedIngredients = [];

            // Reset mix nutrients
            let mixNutrients = { BK: 0, PK: 0, LK: 0, Abu: 0, Ca: 0, P: 0, TDN: 0 };

            rows.forEach(row => {
                const select = row.querySelector('select[name="ingredient"]');
                const percentVal = parseFloat(row.querySelector('input[name="percentage"]').value) || 0;
                const priceVal = parseFloat(row.querySelector('input[name="price"]').value) || 0;

                sumPercent += percentVal;

                if (select.value) {
                    const item = dataBahan.find(b => b.id === select.value);
                    const weight = (percentVal / 100) * totalKg;
                    const cost = weight * priceVal;
                    totalCost += cost;

                    // Calculate mix nutrients
                    for (let key in mixNutrients) {
                        mixNutrients[key] += (parseFloat(item[key]) * percentVal) / 100;
                    }

                    selectedIngredients.push({
                        nama: item.nama,
                        percentage: percentVal,
                        weight: weight,
                        cost: cost
                    });
                }
            });

            // Update Total Percent Display
            const percentBadge = document.getElementById('total-percent-badge');
            const percentBar = document.getElementById('total-percent-bar');
            const warningText = document.getElementById('total-percent-warning');

            percentBadge.innerText = `${sumPercent.toFixed(1)}%`;
            percentBar.style.width = `${Math.min(sumPercent, 100)}%`;

            if (sumPercent === 100) {
                percentBadge.className = "px-3 py-1 rounded-lg bg-emerald-100 text-emerald-800 font-extrabold border border-emerald-350 text-base shadow-xs";
                percentBar.className = "h-full bg-emerald-600 transition-all duration-200";
                warningText.classList.add('hidden');
            } else {
                percentBadge.className = "px-3 py-1 rounded-lg bg-red-150 text-red-800 font-extrabold border border-red-300 text-base shadow-xs";
                percentBar.className = "h-full bg-red-500 transition-all duration-200";
                warningText.classList.remove('hidden');
            }

            // Update Cost Display
            document.getElementById('total-cost').innerText = `Rp ${totalCost.toLocaleString('id-ID', { maximumFractionDigits: 0 })}`;
            const costPerKg = totalKg > 0 ? (totalCost / totalKg) : 0;
            document.getElementById('cost-per-kg').innerText = `Rp ${costPerKg.toLocaleString('id-ID', { maximumFractionDigits: 0 })}`;

            // Update Composition Breakdown List
            const breakdownContainer = document.getElementById('breakdown-container');
            if (selectedIngredients.length === 0) {
                breakdownContainer.innerHTML = '<p class="text-sm text-slate-450 italic text-center py-4 bg-slate-50 border border-slate-200 rounded-xl">Belum ada bahan pakan.</p>';
            } else {
                breakdownContainer.innerHTML = '';
                selectedIngredients.forEach(item => {
                    const el = document.createElement('div');
                    el.className = "flex justify-between items-center bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm";
                    el.innerHTML = `
                        <div class="space-y-0.5">
                            <p class="font-bold text-slate-900">${item.nama}</p>
                            <p class="text-xs text-slate-500">${item.percentage}% dari total pakan</p>
                        </div>
                        <div class="text-right space-y-0.5">
                            <p class="font-extrabold text-slate-800">${item.weight.toFixed(2)} KG</p>
                            <p class="text-xs text-emerald-700 font-bold">Biaya: Rp ${item.cost.toLocaleString('id-ID', { maximumFractionDigits: 0 })}</p>
                        </div>
                    `;
                    breakdownContainer.appendChild(el);
                });
            }

            // Update Nutrient Comparisons table
            for (let key in mixNutrients) {
                const resEl = document.getElementById(`res-${key}`);
                const diffEl = document.getElementById(`diff-${key}`);

                resEl.innerText = `${mixNutrients[key].toFixed(2)}%`;

                const targetVal = selectedTernak ? parseFloat(selectedTernak[key]) : 0;
                const difference = mixNutrients[key] - targetVal;

                if (selectedTernak) {
                    if (difference >= 0) {
                        diffEl.innerText = `Cukup ✅ (+${difference.toFixed(2)}%)`;
                        diffEl.className = "inline-block px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-350 shadow-xs";
                    } else {
                        diffEl.innerText = `Kurang ❌ (${difference.toFixed(2)}%)`;
                        diffEl.className = "inline-block px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 border border-red-300 shadow-xs";
                    }
                } else {
                    diffEl.innerText = "Belum Ada Target";
                    diffEl.className = "inline-block px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500 border border-slate-200 shadow-xs";
                }
            }
        }
    </script>
</body>
</html>
