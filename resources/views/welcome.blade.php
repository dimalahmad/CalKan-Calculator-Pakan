<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CalKan - Kalkulator Formula Pakan Ternak</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (via CDN to guarantee instant styling without Vercel-Vite mixed-content block) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-800 min-h-screen flex flex-col selection:bg-emerald-600 selection:text-white">

    <!-- Top Navigation Bar -->
    <header class="border-b border-slate-200 bg-white/90 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="bg-emerald-600 p-2 rounded-xl text-white shadow-sm">
                    <!-- Calculator SVG Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5.5 h-5.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg font-bold tracking-tight text-slate-900">CalKan</h1>
                    <p class="text-[9px] text-slate-500 font-semibold tracking-wider uppercase">Kalkulator Pakan Ternak</p>
                </div>
            </div>

            <!-- Tab Buttons -->
            <nav class="flex bg-slate-100 p-1 rounded-xl border border-slate-200">
                <button onclick="switchTab('calculator')" id="btn-tab-calculator" class="tab-btn px-4 py-2 text-xs font-semibold rounded-lg transition-all duration-200 bg-emerald-600 text-white shadow-sm">
                    Kalkulator
                </button>
                <button onclick="switchTab('ingredients')" id="btn-tab-ingredients" class="tab-btn px-4 py-2 text-xs font-semibold rounded-lg transition-all duration-200 text-slate-600 hover:text-slate-900">
                    Bahan Pakan
                </button>
                <button onclick="switchTab('livestock')" id="btn-tab-livestock" class="tab-btn px-4 py-2 text-xs font-semibold rounded-lg transition-all duration-200 text-slate-600 hover:text-slate-900">
                    Kebutuhan Ternak
                </button>
            </nav>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- ==================== TAB: CALCULATOR ==================== -->
        <div id="tab-calculator" class="tab-content space-y-8">
            
            <!-- Grid Layout for Inputs & Outputs -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Left Column: Settings & Ingredient Selection (7 cols) -->
                <div class="lg:col-span-7 space-y-6">
                    
                    <!-- Section: Ternak & Berat -->
                    <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-4">
                        <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
                            <span class="text-emerald-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </span>
                            <h2 class="text-base font-bold text-slate-900">Kebutuhan & Skala Campuran</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Select Ternak -->
                            <div>
                                <label for="select-ternak" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Jenis Ternak</label>
                                <select id="select-ternak" onchange="onTernakChange()" class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-emerald-600 focus:ring-2 focus:ring-emerald-500/20 transition-all">
                                    <option value="">-- Pilih Jenis Ternak --</option>
                                </select>
                            </div>
                            
                            <!-- Input Weight -->
                            <div>
                                <label for="input-weight" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Skala Campuran (KG)</label>
                                <div class="relative">
                                    <input type="number" id="input-weight" value="1" min="0.1" step="any" oninput="calculateFeed()" class="w-full bg-white border border-slate-300 rounded-xl pl-4 pr-12 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-emerald-600 focus:ring-2 focus:ring-emerald-500/20 transition-all">
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400">KG</span>
                                </div>
                            </div>
                        </div>

                        <!-- Mini Livestock Requirement Card -->
                        <div id="ternak-req-card" class="hidden bg-emerald-50/50 rounded-xl p-4 border border-emerald-100 space-y-3">
                            <h3 class="text-xs font-bold text-emerald-800 uppercase tracking-wider">Nutrisi Target Ternak :</h3>
                            <div class="grid grid-cols-4 sm:grid-cols-7 gap-2 text-center">
                                <div class="bg-white rounded-lg p-2 border border-slate-100 shadow-sm">
                                    <p class="text-[9px] text-slate-400 font-bold uppercase">BK</p>
                                    <p id="req-BK" class="text-xs font-bold text-slate-800">-</p>
                                </div>
                                <div class="bg-white rounded-lg p-2 border border-slate-100 shadow-sm">
                                    <p class="text-[9px] text-slate-400 font-bold uppercase">PK</p>
                                    <p id="req-PK" class="text-xs font-bold text-slate-800">-</p>
                                </div>
                                <div class="bg-white rounded-lg p-2 border border-slate-100 shadow-sm">
                                    <p class="text-[9px] text-slate-400 font-bold uppercase">LK</p>
                                    <p id="req-LK" class="text-xs font-bold text-slate-800">-</p>
                                </div>
                                <div class="bg-white rounded-lg p-2 border border-slate-100 shadow-sm">
                                    <p class="text-[9px] text-slate-400 font-bold uppercase">Abu</p>
                                    <p id="req-Abu" class="text-xs font-bold text-slate-800">-</p>
                                </div>
                                <div class="bg-white rounded-lg p-2 border border-slate-100 shadow-sm">
                                    <p class="text-[9px] text-slate-400 font-bold uppercase">Ca</p>
                                    <p id="req-Ca" class="text-xs font-bold text-slate-800">-</p>
                                </div>
                                <div class="bg-white rounded-lg p-2 border border-slate-100 shadow-sm">
                                    <p class="text-[9px] text-slate-400 font-bold uppercase">P</p>
                                    <p id="req-P" class="text-xs font-bold text-slate-800">-</p>
                                </div>
                                <div class="bg-white rounded-lg p-2 border border-slate-100 shadow-sm">
                                    <p class="text-[9px] text-slate-400 font-bold uppercase">TDN</p>
                                    <p id="req-TDN" class="text-xs font-bold text-emerald-700">-</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section: Pemilihan Bahan -->
                    <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-6">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <div class="flex items-center gap-2">
                                <span class="text-emerald-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </span>
                                <h2 class="text-base font-bold text-slate-900">Pemilihan Bahan Pakan</h2>
                            </div>
                            <!-- Dynamic Row Counter -->
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-semibold text-slate-500">Jumlah Bahan:</span>
                                <div class="flex items-center bg-slate-50 border border-slate-200 rounded-xl p-1">
                                    <button onclick="decrementRows()" class="w-7 h-7 rounded-lg flex items-center justify-center hover:bg-slate-200/80 text-slate-500 hover:text-slate-800 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" /></svg>
                                    </button>
                                    <input type="number" id="input-rows" value="3" min="1" max="15" onchange="onRowsChange()" class="w-9 text-center bg-transparent border-0 text-xs font-bold text-slate-800 focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                    <button onclick="incrementRows()" class="w-7 h-7 rounded-lg flex items-center justify-center hover:bg-slate-200/80 text-slate-500 hover:text-slate-800 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Feed Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-slate-200 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                                        <th class="pb-3 pr-2">Bahan Pakan</th>
                                        <th class="pb-3 px-2 w-28 text-center">Persentase (%)</th>
                                        <th class="pb-3 pl-2 w-32">Harga (Rp/Kg)</th>
                                    </tr>
                                </thead>
                                <tbody id="feed-rows-container" class="divide-y divide-slate-100">
                                    <!-- Dynamic rows injected here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Results & Comparisons (5 cols) -->
                <div class="lg:col-span-5 space-y-6">
                    
                    <!-- Result Card: Price & Weights -->
                    <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-6">
                        <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
                            <span class="text-emerald-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8h6m-5 0a3 3 0 110 6H9l3 3m-3-6h6m6 1a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <h2 class="text-base font-bold text-slate-900">Rincian Komposisi & Biaya</h2>
                        </div>

                        <!-- Progress Bar for total percentage -->
                        <div class="space-y-2">
                            <div class="flex justify-between items-center text-xs font-semibold">
                                <span class="text-slate-500">Total Persentase Formulasi:</span>
                                <span id="total-percent-badge" class="px-2 py-0.5 rounded-md bg-red-50 text-red-700 font-bold border border-red-200 text-xs">0%</span>
                            </div>
                            <div class="w-full bg-slate-100 h-2.5 rounded-full border border-slate-200 overflow-hidden">
                                <div id="total-percent-bar" class="h-full bg-red-500 transition-all duration-300" style="width: 0%"></div>
                            </div>
                            <p id="total-percent-warning" class="text-[11px] text-red-600 font-semibold hidden">⚠️ Formulasi pakan harus genap bernilai 100%!</p>
                        </div>

                        <!-- Cost Summary -->
                        <div class="grid grid-cols-2 gap-4 bg-slate-50 border border-slate-200/80 rounded-xl p-4">
                            <div class="space-y-1">
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Harga per KG</p>
                                <p id="cost-per-kg" class="text-base font-bold text-slate-800">Rp 0</p>
                            </div>
                            <div class="space-y-1 border-l border-slate-200 pl-4">
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Total Biaya Campuran</p>
                                <p id="total-cost" class="text-base font-bold text-emerald-600">Rp 0</p>
                            </div>
                        </div>

                        <!-- Ingredient mix breakdown list -->
                        <div class="space-y-3">
                            <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Komposisi Campuran:</h3>
                            <div id="breakdown-container" class="space-y-2 max-h-48 overflow-y-auto pr-1">
                                <p class="text-xs text-slate-400 italic text-center py-4">Pilih bahan dan masukkan persentase.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Comparison Card: Nutrient Profile vs Targets -->
                    <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-4">
                        <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
                            <span class="text-emerald-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </span>
                            <h2 class="text-base font-bold text-slate-900">Kecukupan Nutrisi</h2>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-center text-xs">
                                <thead>
                                    <tr class="border-b border-slate-200 text-slate-400 font-semibold uppercase tracking-wider">
                                        <th class="pb-2 text-left">Nutrisi</th>
                                        <th class="pb-2">Hasil</th>
                                        <th class="pb-2">Target</th>
                                        <th class="pb-2">Selisih</th>
                                    </tr>
                                </thead>
                                <tbody id="nutrient-comparison-tbody" class="divide-y divide-slate-100">
                                    <!-- BK, PK, LK, Abu, Ca, P, TDN comparison rows -->
                                    <tr class="hover:bg-slate-50/40">
                                        <td class="py-2.5 text-left font-semibold text-slate-800">
                                            BK (%) <span class="text-[9px] font-normal text-slate-400 block">Bahan Kering (Dry Matter/DM)</span>
                                        </td>
                                        <td id="res-BK" class="font-semibold text-slate-700">0.00%</td>
                                        <td id="tar-BK" class="text-slate-400">0.00%</td>
                                        <td><span id="diff-BK" class="px-1.5 py-0.5 rounded bg-slate-100 text-slate-500 font-semibold border border-slate-200">0.00</span></td>
                                    </tr>
                                    <tr class="hover:bg-slate-50/40">
                                        <td class="py-2.5 text-left font-semibold text-slate-800">
                                            PK (%) <span class="text-[9px] font-normal text-slate-400 block">Protein Kasar (Crude Protein/CP)</span>
                                        </td>
                                        <td id="res-PK" class="font-semibold text-slate-700">0.00%</td>
                                        <td id="tar-PK" class="text-slate-400">0.00%</td>
                                        <td><span id="diff-PK" class="px-1.5 py-0.5 rounded bg-slate-100 text-slate-500 font-semibold border border-slate-200">0.00</span></td>
                                    </tr>
                                    <tr class="hover:bg-slate-50/40">
                                        <td class="py-2.5 text-left font-semibold text-slate-800">
                                            LK (%) <span class="text-[9px] font-normal text-slate-400 block">Lemak Kasar (Ether Extract)</span>
                                        </td>
                                        <td id="res-LK" class="font-semibold text-slate-700">0.00%</td>
                                        <td id="tar-LK" class="text-slate-400">0.00%</td>
                                        <td><span id="diff-LK" class="px-1.5 py-0.5 rounded bg-slate-100 text-slate-500 font-semibold border border-slate-200">0.00</span></td>
                                    </tr>
                                    <tr class="hover:bg-slate-50/40">
                                        <td class="py-2.5 text-left font-semibold text-slate-800">
                                            Abu (%) <span class="text-[9px] font-normal text-slate-400 block">Kadar Abu (Ash Content)</span>
                                        </td>
                                        <td id="res-Abu" class="font-semibold text-slate-700">0.00%</td>
                                        <td id="tar-Abu" class="text-slate-400">0.00%</td>
                                        <td><span id="diff-Abu" class="px-1.5 py-0.5 rounded bg-slate-100 text-slate-500 font-semibold border border-slate-200">0.00</span></td>
                                    </tr>
                                    <tr class="hover:bg-slate-50/40">
                                        <td class="py-2.5 text-left font-semibold text-slate-800">
                                            Ca (%) <span class="text-[9px] font-normal text-slate-400 block">Kalsium (Calcium)</span>
                                        </td>
                                        <td id="res-Ca" class="font-semibold text-slate-700">0.00%</td>
                                        <td id="tar-Ca" class="text-slate-400">0.00%</td>
                                        <td><span id="diff-Ca" class="px-1.5 py-0.5 rounded bg-slate-100 text-slate-500 font-semibold border border-slate-200">0.00</span></td>
                                    </tr>
                                    <tr class="hover:bg-slate-50/40">
                                        <td class="py-2.5 text-left font-semibold text-slate-800">
                                            P (%) <span class="text-[9px] font-normal text-slate-400 block">Fosfor (Phosphorus)</span>
                                        </td>
                                        <td id="res-P" class="font-semibold text-slate-700">0.00%</td>
                                        <td id="tar-P" class="text-slate-400">0.00%</td>
                                        <td><span id="diff-P" class="px-1.5 py-0.5 rounded bg-slate-100 text-slate-500 font-semibold border border-slate-200">0.00</span></td>
                                    </tr>
                                    <tr class="hover:bg-slate-50/40">
                                        <td class="py-2.5 text-left font-semibold text-slate-800">
                                            TDN (%) <span class="text-[9px] font-normal text-slate-400 block">Total Digestible Nutrients (Energi)</span>
                                        </td>
                                        <td id="res-TDN" class="font-semibold text-slate-700">0.00%</td>
                                        <td id="tar-TDN" class="text-slate-400">0.00%</td>
                                        <td><span id="diff-TDN" class="px-1.5 py-0.5 rounded bg-slate-100 text-slate-500 font-semibold border border-slate-200">0.00</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Panduan Istilah & Nutrisi -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-4">
                <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
                    <span class="text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </span>
                    <h2 class="text-sm font-bold text-slate-900">Panduan Istilah & Parameter Nutrisi</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 text-slate-400 font-semibold uppercase tracking-wider">
                                <th class="py-2 px-3 w-1/4">Singkatan</th>
                                <th class="py-2 px-3 w-1/3">Kepanjangan</th>
                                <th class="py-2 px-3">Arti / Penjelasan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            <tr class="hover:bg-slate-50/50">
                                <td class="py-3 px-3 font-bold text-emerald-700">BK (%)</td>
                                <td class="py-3 px-3 font-semibold">Bahan Kering (Dry Matter/DM)</td>
                                <td class="py-3 px-3 text-slate-500">Persentase bahan pakan setelah kandungan air dihilangkan secara keseluruhan.</td>
                            </tr>
                            <tr class="hover:bg-slate-900/10">
                                <td class="py-3 px-3 font-bold text-emerald-700">PK (%)</td>
                                <td class="py-3 px-3 font-semibold">Protein Kasar (Crude Protein/CP)</td>
                                <td class="py-3 px-3 text-slate-500">Kandungan protein total dalam pakan yang dihitung berdasarkan kadar nitrogen total.</td>
                            </tr>
                            <tr class="hover:bg-slate-900/10">
                                <td class="py-3 px-3 font-bold text-emerald-700">LK (%)</td>
                                <td class="py-3 px-3 font-semibold">Lemak Kasar (Ether Extract)</td>
                                <td class="py-3 px-3 text-slate-500">Kandungan senyawa lipid, lemak, atau minyak total di dalam bahan pakan.</td>
                            </tr>
                            <tr class="hover:bg-slate-900/10">
                                <td class="py-3 px-3 font-bold text-emerald-700">Abu (%)</td>
                                <td class="py-3 px-3 font-semibold">Kadar Abu (Ash Content)</td>
                                <td class="py-3 px-3 text-slate-500">Total kandungan abu atau zat mineral anorganik yang tersisa setelah dibakar habis.</td>
                            </tr>
                            <tr class="hover:bg-slate-900/10">
                                <td class="py-3 px-3 font-bold text-emerald-700">Ca (%)</td>
                                <td class="py-3 px-3 font-semibold">Kalsium (Calcium)</td>
                                <td class="py-3 px-3 text-slate-500">Kandungan mineral makro kalsium yang berfungsi utama untuk struktur tulang & gigi ternak.</td>
                            </tr>
                            <tr class="hover:bg-slate-900/10">
                                <td class="py-3 px-3 font-bold text-emerald-700">P (%)</td>
                                <td class="py-3 px-3 font-semibold">Fosfor (Phosphorus)</td>
                                <td class="py-3 px-3 text-slate-500">Kandungan mineral makro fosfor yang sangat penting dalam pembentukan sel dan energi tubuh.</td>
                            </tr>
                            <tr class="hover:bg-slate-900/10">
                                <td class="py-3 px-3 font-bold text-emerald-700">TDN (%)</td>
                                <td class="py-3 px-3 font-semibold">Total Digestible Nutrients (Total Nutrien Tercerna)</td>
                                <td class="py-3 px-3 text-slate-500">Indikator nilai energi pakan berdasarkan jumlah keseluruhan nutrien yang dapat dicerna ternak.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ==================== TAB: INGREDIENTS ==================== -->
        <div id="tab-ingredients" class="tab-content hidden space-y-6">
            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div class="flex items-center gap-2">
                        <span class="text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                        </span>
                        <h2 class="text-base font-bold text-slate-900">Kandungan Nutrisi Bahan Pakan</h2>
                    </div>
                    <!-- Live Loading Badge -->
                    <span id="badge-api-ingredients" class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-amber-50 text-amber-700 border border-amber-200 animate-pulse">Loading API...</span>
                </div>

                <div class="overflow-x-auto max-h-[60vh] overflow-y-auto">
                    <table class="w-full text-center text-sm border-collapse">
                        <thead class="sticky top-0 bg-slate-50 border-b border-slate-200 text-slate-500 font-semibold uppercase tracking-wider text-xs z-10">
                            <tr>
                                <th class="py-3 px-4 text-left font-bold">Nama Bahan</th>
                                <th class="py-3 px-2 text-center" title="Bahan Kering (Dry Matter/DM)">
                                    <span class="block text-xs font-bold">BK (%)</span>
                                    <span class="block text-[9px] font-normal text-slate-400 leading-tight">Bahan Kering</span>
                                </th>
                                <th class="py-3 px-2 text-center" title="Protein Kasar (Crude Protein/CP)">
                                    <span class="block text-xs font-bold">PK (%)</span>
                                    <span class="block text-[9px] font-normal text-slate-400 leading-tight">Protein Kasar</span>
                                </th>
                                <th class="py-3 px-2 text-center" title="Lemak Kasar (Ether Extract/Crude Fat)">
                                    <span class="block text-xs font-bold">LK (%)</span>
                                    <span class="block text-[9px] font-normal text-slate-400 leading-tight">Lemak Kasar</span>
                                </th>
                                <th class="py-3 px-2 text-center" title="Kadar Abu (Ash Content)">
                                    <span class="block text-xs font-bold">Abu (%)</span>
                                    <span class="block text-[9px] font-normal text-slate-400 leading-tight">Kadar Abu</span>
                                </th>
                                <th class="py-3 px-2 text-center" title="Kalsium (Calcium)">
                                    <span class="block text-xs font-bold">Ca (%)</span>
                                    <span class="block text-[9px] font-normal text-slate-400 leading-tight">Kalsium</span>
                                </th>
                                <th class="py-3 px-2 text-center" title="Fosfor (Phosphorus)">
                                    <span class="block text-xs font-bold">P (%)</span>
                                    <span class="block text-[9px] font-normal text-slate-400 leading-tight">Fosfor</span>
                                </th>
                                <th class="py-3 px-2 text-center" title="Total Digestible Nutrients (Total Nutrien Tercerna)">
                                    <span class="block text-xs font-bold">TDN (%)</span>
                                    <span class="block text-[9px] font-normal text-slate-400 leading-tight">Total Nutrien</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="ingredients-table-body" class="divide-y divide-slate-100 text-slate-700">
                            <!-- Injected by JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ==================== TAB: LIVESTOCK ==================== -->
        <div id="tab-livestock" class="tab-content hidden space-y-6">
            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div class="flex items-center gap-2">
                        <span class="text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </span>
                        <h2 class="text-base font-bold text-slate-900">Tabel Kebutuhan Standar Nutrisi Ternak</h2>
                    </div>
                    <!-- Live Loading Badge -->
                    <span id="badge-api-livestock" class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-amber-50 text-amber-700 border border-amber-200 animate-pulse">Loading API...</span>
                </div>

                <div class="overflow-x-auto max-h-[60vh] overflow-y-auto">
                    <table class="w-full text-center text-sm border-collapse">
                        <thead class="sticky top-0 bg-slate-50 border-b border-slate-200 text-slate-500 font-semibold uppercase tracking-wider text-xs z-10">
                            <tr>
                                <th class="py-3 px-4 text-left font-bold">Nama Ternak</th>
                                <th class="py-3 px-2 text-center" title="Bahan Kering (Dry Matter/DM)">
                                    <span class="block text-xs font-bold">BK (%)</span>
                                    <span class="block text-[9px] font-normal text-slate-400 leading-tight">Bahan Kering</span>
                                </th>
                                <th class="py-3 px-2 text-center" title="Protein Kasar (Crude Protein/CP)">
                                    <span class="block text-xs font-bold">PK (%)</span>
                                    <span class="block text-[9px] font-normal text-slate-400 leading-tight">Protein Kasar</span>
                                </th>
                                <th class="py-3 px-2 text-center" title="Lemak Kasar (Ether Extract/Crude Fat)">
                                    <span class="block text-xs font-bold">LK (%)</span>
                                    <span class="block text-[9px] font-normal text-slate-400 leading-tight">Lemak Kasar</span>
                                </th>
                                <th class="py-3 px-2 text-center" title="Kadar Abu (Ash Content)">
                                    <span class="block text-xs font-bold">Abu (%)</span>
                                    <span class="block text-[9px] font-normal text-slate-400 leading-tight">Kadar Abu</span>
                                </th>
                                <th class="py-3 px-2 text-center" title="Kalsium (Calcium)">
                                    <span class="block text-xs font-bold">Ca (%)</span>
                                    <span class="block text-[9px] font-normal text-slate-400 leading-tight">Kalsium</span>
                                </th>
                                <th class="py-3 px-2 text-center" title="Fosfor (Phosphorus)">
                                    <span class="block text-xs font-bold">P (%)</span>
                                    <span class="block text-[9px] font-normal text-slate-400 leading-tight">Fosfor</span>
                                </th>
                                <th class="py-3 px-2 text-center" title="Total Digestible Nutrients (Total Nutrien Tercerna)">
                                    <span class="block text-xs font-bold">TDN (%)</span>
                                    <span class="block text-[9px] font-normal text-slate-400 leading-tight">Total Nutrien</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="livestock-table-body" class="divide-y divide-slate-100 text-slate-700">
                            <!-- Injected by JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-200 bg-white py-6 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center space-y-1">
            <p class="text-xs text-slate-500">CalKan - Kalkulator Pakan Ternak Mandiri</p>
            <p class="text-[10px] text-slate-400">Terintegrasi dengan Google Sheets API.</p>
        </div>
    </footer>

    <!-- INGREDIENT DETAIL MODAL -->
    <div id="detail-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden">
        <div class="bg-white border border-slate-200 w-full max-w-md rounded-2xl overflow-hidden shadow-2xl">
            <div class="flex items-center justify-between p-6 border-b border-slate-100">
                <h3 id="modal-title" class="text-base font-bold text-slate-900">Detail Kandungan</h3>
                <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5.5 h-5.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-200/60">
                        <p class="text-[9px] font-bold text-slate-400 uppercase">BK (Bahan Kering)</p>
                        <p id="modal-BK" class="text-base font-bold text-slate-800">-</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-200/60">
                        <p class="text-[9px] font-bold text-slate-400 uppercase">PK (Protein Kasar)</p>
                        <p id="modal-PK" class="text-base font-bold text-slate-800">-</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-200/60">
                        <p class="text-[9px] font-bold text-slate-400 uppercase">LK (Lemak Kasar)</p>
                        <p id="modal-LK" class="text-base font-bold text-slate-800">-</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-200/60">
                        <p class="text-[9px] font-bold text-slate-400 uppercase">Abu (Mineral)</p>
                        <p id="modal-Abu" class="text-base font-bold text-slate-800">-</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-200/60">
                        <p class="text-[9px] font-bold text-slate-400 uppercase">Ca (Kalsium)</p>
                        <p id="modal-Ca" class="text-base font-bold text-slate-800">-</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-200/60">
                        <p class="text-[9px] font-bold text-slate-400 uppercase">P (Fosfor)</p>
                        <p id="modal-P" class="text-base font-bold text-slate-800">-</p>
                    </div>
                    <div class="col-span-2 bg-slate-50 rounded-xl p-3 border border-slate-200/60 text-center">
                        <p class="text-[9px] font-bold text-slate-400 uppercase">TDN (Total Energi)</p>
                        <p id="modal-TDN" class="text-base font-bold text-emerald-700">-</p>
                    </div>
                </div>
            </div>
            <div class="bg-slate-50 p-6 border-t border-slate-100 flex justify-end">
                <button onclick="closeModal()" class="px-5 py-2 rounded-xl bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-semibold text-xs transition-colors">Tutup</button>
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
        let activeBahanRows = [];

        // Tab Switching
        function switchTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.getElementById(`tab-${tabId}`).classList.remove('hidden');

            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('bg-emerald-600', 'text-white', 'shadow-sm');
                btn.classList.add('text-slate-600', 'hover:text-slate-900');
            });

            const activeBtn = document.getElementById(`btn-tab-${tabId}`);
            activeBtn.classList.remove('text-slate-600', 'hover:text-slate-900');
            activeBtn.classList.add('bg-emerald-600', 'text-white', 'shadow-sm');
        }

        // Initialize App
        window.addEventListener('DOMContentLoaded', () => {
            // Load tables and selectors with fallback first
            populateTernakDropdown();
            renderTernakTable();
            renderIngredientsTable();
            renderRows(3); // Start with 3 ingredient rows

            // Then try to fetch from API for real-time updates
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
                        badge.innerText = "Online";
                        badge.classList.remove('bg-amber-50', 'text-amber-700', 'border-amber-200', 'animate-pulse');
                        badge.classList.add('bg-emerald-50', 'text-emerald-700', 'border-emerald-200');
                    }
                })
                .catch(err => {
                    console.warn("Failed to fetch live Ternak data, using local fallback.", err);
                    const badge = document.getElementById('badge-api-livestock');
                    badge.innerText = "Offline (Database Lokal)";
                    badge.classList.remove('animate-pulse');
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
                        badge.innerText = "Online";
                        badge.classList.remove('bg-amber-50', 'text-amber-700', 'border-amber-200', 'animate-pulse');
                        badge.classList.add('bg-emerald-50', 'text-emerald-700', 'border-emerald-200');
                    }
                })
                .catch(err => {
                    console.warn("Failed to fetch live Bahan data, using local fallback.", err);
                    const badge = document.getElementById('badge-api-ingredients');
                    badge.innerText = "Offline (Database Lokal)";
                    badge.classList.remove('animate-pulse');
                });
        }

        // Dropdown Ternak Inisialisasi
        function populateTernakDropdown() {
            const dropdown = document.getElementById('select-ternak');
            const currentValue = dropdown.value;
            dropdown.innerHTML = '<option value="">-- Pilih Jenis Ternak --</option>';
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
                row.className = "hover:bg-slate-50/60 transition-colors border-b border-slate-100";
                row.innerHTML = `
                    <td class="py-3 px-4 text-left font-semibold text-slate-800">${item.nama}</td>
                    <td class="py-3 px-2 text-slate-600">${item.BK}%</td>
                    <td class="py-3 px-2 text-slate-600">${item.PK}%</td>
                    <td class="py-3 px-2 text-slate-600">${item.LK}%</td>
                    <td class="py-3 px-2 text-slate-600">${item.Abu}%</td>
                    <td class="py-3 px-2 text-slate-600">${item.Ca}%</td>
                    <td class="py-3 px-2 text-slate-600">${item.P}%</td>
                    <td class="py-3 px-2 text-emerald-700 font-bold">${item.TDN}%</td>
                `;
                container.appendChild(row);
            });
        }

        function renderIngredientsTable() {
            const container = document.getElementById('ingredients-table-body');
            container.innerHTML = '';
            dataBahan.forEach(item => {
                const row = document.createElement('tr');
                row.className = "hover:bg-slate-50/60 transition-colors border-b border-slate-100";
                row.innerHTML = `
                    <td class="py-3 px-4 text-left font-semibold text-slate-800">${item.nama}</td>
                    <td class="py-3 px-2 text-slate-600">${item.BK}%</td>
                    <td class="py-3 px-2 text-slate-600">${item.PK}%</td>
                    <td class="py-3 px-2 text-slate-600">${item.LK}%</td>
                    <td class="py-3 px-2 text-slate-600">${item.Abu}%</td>
                    <td class="py-3 px-2 text-slate-600">${item.Ca}%</td>
                    <td class="py-3 px-2 text-slate-600">${item.P}%</td>
                    <td class="py-3 px-2 text-emerald-700 font-bold">${item.TDN}%</td>
                `;
                container.appendChild(row);
            });
        }

        // On Livestock Selection Change
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
                    row.className = "hover:bg-slate-50/50 border-b border-slate-100";
                    row.innerHTML = `
                        <td class="py-3 pr-2 flex items-center gap-2">
                            <!-- Info Icon to view detailed composition -->
                            <button type="button" onclick="showIngredientDetails(${i})" class="text-slate-400 hover:text-emerald-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                            <select onchange="calculateFeed()" name="ingredient" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-sm text-slate-800 focus:outline-none focus:border-emerald-600 transition-colors">
                                <option value="">-- Pilih Bahan --</option>
                            </select>
                        </td>
                        <td class="py-3 px-2">
                            <input type="number" name="percentage" min="0" max="100" step="any" oninput="calculateFeed()" placeholder="0" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-sm text-slate-800 focus:outline-none focus:border-emerald-600 transition-colors text-center font-semibold">
                        </td>
                        <td class="py-3 pl-2">
                            <input type="number" name="price" min="0" step="any" oninput="calculateFeed()" placeholder="0" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-sm text-slate-800 focus:outline-none focus:border-emerald-600 transition-colors font-medium">
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
                alert("Pilih bahan pakan terlebih dahulu!");
                return;
            }
            const item = dataBahan.find(b => b.id === select.value);
            
            document.getElementById('modal-title').innerText = `Detail Kandungan: ${item.nama}`;
            document.getElementById('modal-BK').innerText = `${item.BK}%`;
            document.getElementById('modal-PK').innerText = `${item.PK}%`;
            document.getElementById('modal-LK').innerText = `${item.LK}%`;
            document.getElementById('modal-Abu').innerText = `${item.Abu}%`;
            document.getElementById('modal-Ca').innerText = `${item.Ca}%`;
            document.getElementById('modal-P').innerText = `${item.P}%`;
            document.getElementById('modal-TDN').innerText = `${item.TDN}%`;

            document.getElementById('detail-modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('detail-modal').classList.add('hidden');
        }

        // Core Calculation Engine
        function calculateFeed() {
            const rows = document.querySelectorAll('#feed-rows-container tr');
            const totalKg = parseFloat(document.getElementById('input-weight').value) || 1;
            
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
                percentBadge.className = "px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 font-bold border border-emerald-200 text-xs";
                percentBar.className = "h-full bg-emerald-600 transition-all duration-300";
                warningText.classList.add('hidden');
            } else {
                percentBadge.className = "px-2 py-0.5 rounded-md bg-red-50 text-red-700 font-bold border border-red-200 text-xs";
                percentBar.className = "h-full bg-red-500 transition-all duration-300";
                warningText.classList.remove('hidden');
            }

            // Update Cost Display
            document.getElementById('total-cost').innerText = `Rp ${totalCost.toLocaleString('id-ID', { maximumFractionDigits: 0 })}`;
            const costPerKg = totalKg > 0 ? (totalCost / totalKg) : 0;
            document.getElementById('cost-per-kg').innerText = `Rp ${costPerKg.toLocaleString('id-ID', { maximumFractionDigits: 0 })}`;

            // Update Composition Breakdown List
            const breakdownContainer = document.getElementById('breakdown-container');
            if (selectedIngredients.length === 0) {
                breakdownContainer.innerHTML = '<p class="text-xs text-slate-400 italic text-center py-4">Pilih bahan dan masukkan persentase.</p>';
            } else {
                breakdownContainer.innerHTML = '';
                selectedIngredients.forEach(item => {
                    const el = document.createElement('div');
                    el.className = "flex justify-between items-center bg-slate-50 border border-slate-200 rounded-lg p-2.5 text-xs";
                    el.innerHTML = `
                        <div class="space-y-0.5">
                            <p class="font-bold text-slate-800">${item.nama}</p>
                            <p class="text-[10px] text-slate-400">${item.percentage}% dari total pakan</p>
                        </div>
                        <div class="text-right space-y-0.5">
                            <p class="font-semibold text-slate-750">${item.weight.toFixed(2)} KG</p>
                            <p class="text-[10px] text-emerald-600 font-bold">Rp ${item.cost.toLocaleString('id-ID', { maximumFractionDigits: 0 })}</p>
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
                    diffEl.innerText = (difference >= 0 ? '+' : '') + difference.toFixed(2);
                    if (difference >= 0) {
                        diffEl.className = "px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 font-bold border border-emerald-200";
                    } else {
                        diffEl.className = "px-2 py-0.5 rounded bg-red-50 text-red-700 font-bold border border-red-200";
                    }
                } else {
                    diffEl.innerText = difference.toFixed(2);
                    diffEl.className = "px-2 py-0.5 rounded bg-slate-100 text-slate-500 font-semibold border border-slate-200";
                }
            }
        }
    </script>
</body>
</html>
