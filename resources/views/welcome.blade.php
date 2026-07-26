<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CalKan - Kalkulator Formula Pakan Ternak</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
            background: #0f172a;
        }
        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex flex-col selection:bg-emerald-500 selection:text-slate-900">

    <!-- Top Navigation Bar -->
    <header class="border-b border-slate-800 bg-slate-900/50 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="bg-gradient-to-tr from-emerald-500 to-teal-500 p-2 rounded-xl shadow-lg shadow-emerald-500/20">
                    <!-- Custom Animal / Calculator SVG Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-950" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold tracking-tight bg-gradient-to-r from-emerald-400 to-teal-400 bg-clip-text text-transparent">CalKan</h1>
                    <p class="text-[10px] text-slate-400 font-medium tracking-wider uppercase">Calculator Pakan Ternak</p>
                </div>
            </div>

            <!-- Tab Buttons -->
            <nav class="flex bg-slate-950/80 p-1 rounded-xl border border-slate-800">
                <button onclick="switchTab('calculator')" id="btn-tab-calculator" class="tab-btn px-4 py-2 text-xs font-semibold rounded-lg transition-all duration-200 bg-gradient-to-r from-emerald-500 to-teal-500 text-slate-950 shadow-md">
                    Kalkulator
                </button>
                <button onclick="switchTab('ingredients')" id="btn-tab-ingredients" class="tab-btn px-4 py-2 text-xs font-semibold rounded-lg transition-all duration-200 text-slate-400 hover:text-slate-200">
                    Bahan Pakan
                </button>
                <button onclick="switchTab('livestock')" id="btn-tab-livestock" class="tab-btn px-4 py-2 text-xs font-semibold rounded-lg transition-all duration-200 text-slate-400 hover:text-slate-200">
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
                    <div class="bg-slate-900/50 border border-slate-800 rounded-2xl p-6 backdrop-blur-sm space-y-4">
                        <div class="flex items-center gap-2 border-b border-slate-800 pb-3">
                            <span class="text-emerald-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </span>
                            <h2 class="text-lg font-bold text-slate-100">Kebutuhan & Skala Campuran</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Select Ternak -->
                            <div>
                                <label for="select-ternak" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Jenis Ternak</label>
                                <select id="select-ternak" onchange="onTernakChange()" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-200 focus:outline-none focus:border-emerald-500 transition-colors">
                                    <option value="">-- Pilih Jenis Ternak --</option>
                                </select>
                            </div>
                            
                            <!-- Input Weight -->
                            <div>
                                <label for="input-weight" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Skala Campuran (KG)</label>
                                <div class="relative">
                                    <input type="number" id="input-weight" value="1" min="0.1" step="any" oninput="calculateFeed()" class="w-full bg-slate-950 border border-slate-800 rounded-xl pl-4 pr-12 py-3 text-sm text-slate-200 focus:outline-none focus:border-emerald-500 transition-colors">
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-500">KG</span>
                                </div>
                            </div>
                        </div>

                        <!-- Mini Livestock Requirement Card -->
                        <div id="ternak-req-card" class="hidden bg-slate-950/60 rounded-xl p-4 border border-slate-800/80 space-y-3">
                            <h3 class="text-xs font-bold text-emerald-400 uppercase tracking-wider">Nutrisi Target Ternak :</h3>
                            <div class="grid grid-cols-4 sm:grid-cols-7 gap-2 text-center">
                                <div class="bg-slate-900/80 rounded-lg p-2 border border-slate-800">
                                    <p class="text-[10px] text-slate-500 font-bold uppercase">BK</p>
                                    <p id="req-BK" class="text-sm font-bold text-slate-200">-</p>
                                </div>
                                <div class="bg-slate-900/80 rounded-lg p-2 border border-slate-800">
                                    <p class="text-[10px] text-slate-500 font-bold uppercase">PK</p>
                                    <p id="req-PK" class="text-sm font-bold text-slate-200">-</p>
                                </div>
                                <div class="bg-slate-900/80 rounded-lg p-2 border border-slate-800">
                                    <p class="text-[10px] text-slate-500 font-bold uppercase">LK</p>
                                    <p id="req-LK" class="text-sm font-bold text-slate-200">-</p>
                                </div>
                                <div class="bg-slate-900/80 rounded-lg p-2 border border-slate-800">
                                    <p class="text-[10px] text-slate-500 font-bold uppercase">Abu</p>
                                    <p id="req-Abu" class="text-sm font-bold text-slate-200">-</p>
                                </div>
                                <div class="bg-slate-900/80 rounded-lg p-2 border border-slate-800">
                                    <p class="text-[10px] text-slate-500 font-bold uppercase">Ca</p>
                                    <p id="req-Ca" class="text-sm font-bold text-slate-200">-</p>
                                </div>
                                <div class="bg-slate-900/80 rounded-lg p-2 border border-slate-800">
                                    <p class="text-[10px] text-slate-500 font-bold uppercase">P</p>
                                    <p id="req-P" class="text-sm font-bold text-slate-200">-</p>
                                </div>
                                <div class="bg-slate-900/80 rounded-lg p-2 border border-slate-800">
                                    <p class="text-[10px] text-slate-500 font-bold uppercase">TDN</p>
                                    <p id="req-TDN" class="text-sm font-bold text-slate-200">-</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section: Pemilihan Bahan -->
                    <div class="bg-slate-900/50 border border-slate-800 rounded-2xl p-6 backdrop-blur-sm space-y-6">
                        <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                            <div class="flex items-center gap-2">
                                <span class="text-emerald-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </span>
                                <h2 class="text-lg font-bold text-slate-100">Pemilihan Bahan Pakan</h2>
                            </div>
                            <!-- Dynamic Row Counter -->
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-semibold text-slate-400">Jumlah Bahan:</span>
                                <div class="flex items-center bg-slate-950 border border-slate-800 rounded-xl p-1">
                                    <button onclick="decrementRows()" class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-slate-900 text-slate-400 hover:text-slate-100 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" /></svg>
                                    </button>
                                    <input type="number" id="input-rows" value="3" min="1" max="15" onchange="onRowsChange()" class="w-10 text-center bg-transparent border-0 text-sm font-bold text-slate-200 focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                    <button onclick="incrementRows()" class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-slate-900 text-slate-400 hover:text-slate-100 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Feed Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-slate-800 text-xs font-bold text-slate-400 uppercase tracking-wider">
                                        <th class="pb-3 pr-2">Bahan Pakan</th>
                                        <th class="pb-3 px-2 w-28">Persentase (%)</th>
                                        <th class="pb-3 pl-2 w-32">Harga (Rp/Kg)</th>
                                    </tr>
                                </thead>
                                <tbody id="feed-rows-container" class="divide-y divide-slate-800/50">
                                    <!-- Dynamic rows injected here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Results & Comparisons (5 cols) -->
                <div class="lg:col-span-5 space-y-6">
                    
                    <!-- Result Card: Price & Weights -->
                    <div class="bg-gradient-to-b from-slate-900 to-slate-950 border border-slate-800 rounded-2xl p-6 shadow-2xl space-y-6">
                        <div class="flex items-center gap-2 border-b border-slate-800 pb-3">
                            <span class="text-emerald-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8h6m-5 0a3 3 0 110 6H9l3 3m-3-6h6m6 1a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <h2 class="text-lg font-bold text-slate-100">Rincian Komposisi & Biaya</h2>
                        </div>

                        <!-- Progress Bar for total percentage -->
                        <div class="space-y-2">
                            <div class="flex justify-between items-center text-xs font-semibold">
                                <span class="text-slate-400">Total Persentase Formulasi:</span>
                                <span id="total-percent-badge" class="px-2 py-0.5 rounded-md bg-red-500/10 text-red-400 font-bold border border-red-500/20">0%</span>
                            </div>
                            <div class="w-full bg-slate-950 h-3 rounded-full border border-slate-800 overflow-hidden">
                                <div id="total-percent-bar" class="h-full bg-gradient-to-r from-red-500 to-red-400 transition-all duration-300" style="width: 0%"></div>
                            </div>
                            <p id="total-percent-warning" class="text-[11px] text-red-400 font-medium hidden">⚠️ Formulasi pakan harus genap bernilai 100%!</p>
                        </div>

                        <!-- Cost Summary -->
                        <div class="grid grid-cols-2 gap-4 bg-slate-950 border border-slate-800/80 rounded-xl p-4">
                            <div class="space-y-1">
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Harga per KG</p>
                                <p id="cost-per-kg" class="text-lg font-bold text-slate-100">Rp 0</p>
                            </div>
                            <div class="space-y-1 border-l border-slate-800 pl-4">
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Total Biaya Campuran</p>
                                <p id="total-cost" class="text-lg font-bold text-emerald-400">Rp 0</p>
                            </div>
                        </div>

                        <!-- Ingredient mix breakdown list -->
                        <div class="space-y-3">
                            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Komposisi Pakan:</h3>
                            <div id="breakdown-container" class="space-y-2 max-h-48 overflow-y-auto pr-1">
                                <p class="text-xs text-slate-500 italic text-center py-4">Pilih bahan dan persentase untuk melihat rincian.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Comparison Card: Nutrient Profile vs Targets -->
                    <div class="bg-slate-900/50 border border-slate-800 rounded-2xl p-6 backdrop-blur-sm space-y-4">
                        <div class="flex items-center gap-2 border-b border-slate-800 pb-3">
                            <span class="text-emerald-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </span>
                            <h2 class="text-lg font-bold text-slate-100">Kecukupan Nutrisi</h2>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-center text-xs">
                                <thead>
                                    <tr class="border-b border-slate-800 text-slate-400 font-bold uppercase tracking-wider">
                                        <th class="pb-2 text-left">Nutrisi</th>
                                        <th class="pb-2">Hasil</th>
                                        <th class="pb-2">Target</th>
                                        <th class="pb-2">Selisih</th>
                                    </tr>
                                </thead>
                                <tbody id="nutrient-comparison-tbody">
                                    <!-- BK, PK, LK, Abu, Ca, P, TDN comparison rows -->
                                    <tr class="border-b border-slate-800/30">
                                        <td class="py-3 text-left font-bold text-slate-300">BK <span class="text-[9px] font-normal text-slate-500">(Bahan Kering)</span></td>
                                        <td id="res-BK" class="font-semibold text-slate-300">0.00%</td>
                                        <td id="tar-BK" class="text-slate-500">0.00%</td>
                                        <td><span id="diff-BK" class="px-2 py-0.5 rounded bg-slate-950 text-slate-400 font-semibold border border-slate-800">0.00</span></td>
                                    </tr>
                                    <tr class="border-b border-slate-800/30">
                                        <td class="py-3 text-left font-bold text-slate-300">PK <span class="text-[9px] font-normal text-slate-500">(Protein Kasar)</span></td>
                                        <td id="res-PK" class="font-semibold text-slate-300">0.00%</td>
                                        <td id="tar-PK" class="text-slate-500">0.00%</td>
                                        <td><span id="diff-PK" class="px-2 py-0.5 rounded bg-slate-950 text-slate-400 font-semibold border border-slate-800">0.00</span></td>
                                    </tr>
                                    <tr class="border-b border-slate-800/30">
                                        <td class="py-3 text-left font-bold text-slate-300">LK <span class="text-[9px] font-normal text-slate-500">(Lemak Kasar)</span></td>
                                        <td id="res-LK" class="font-semibold text-slate-300">0.00%</td>
                                        <td id="tar-LK" class="text-slate-500">0.00%</td>
                                        <td><span id="diff-LK" class="px-2 py-0.5 rounded bg-slate-950 text-slate-400 font-semibold border border-slate-800">0.00</span></td>
                                    </tr>
                                    <tr class="border-b border-slate-800/30">
                                        <td class="py-3 text-left font-bold text-slate-300">Abu <span class="text-[9px] font-normal text-slate-500">(Mineral)</span></td>
                                        <td id="res-Abu" class="font-semibold text-slate-300">0.00%</td>
                                        <td id="tar-Abu" class="text-slate-500">0.00%</td>
                                        <td><span id="diff-Abu" class="px-2 py-0.5 rounded bg-slate-950 text-slate-400 font-semibold border border-slate-800">0.00</span></td>
                                    </tr>
                                    <tr class="border-b border-slate-800/30">
                                        <td class="py-3 text-left font-bold text-slate-300">Ca <span class="text-[9px] font-normal text-slate-500">(Kalsium)</span></td>
                                        <td id="res-Ca" class="font-semibold text-slate-300">0.00%</td>
                                        <td id="tar-Ca" class="text-slate-500">0.00%</td>
                                        <td><span id="diff-Ca" class="px-2 py-0.5 rounded bg-slate-950 text-slate-400 font-semibold border border-slate-800">0.00</span></td>
                                    </tr>
                                    <tr class="border-b border-slate-800/30">
                                        <td class="py-3 text-left font-bold text-slate-300">P <span class="text-[9px] font-normal text-slate-500">(Fosfor)</span></td>
                                        <td id="res-P" class="font-semibold text-slate-300">0.00%</td>
                                        <td id="tar-P" class="text-slate-500">0.00%</td>
                                        <td><span id="diff-P" class="px-2 py-0.5 rounded bg-slate-950 text-slate-400 font-semibold border border-slate-800">0.00</span></td>
                                    </tr>
                                    <tr class="border-b border-slate-800/30">
                                        <td class="py-3 text-left font-bold text-slate-300">TDN <span class="text-[9px] font-normal text-slate-500">(Energi)</span></td>
                                        <td id="res-TDN" class="font-semibold text-slate-300">0.00%</td>
                                        <td id="tar-TDN" class="text-slate-500">0.00%</td>
                                        <td><span id="diff-TDN" class="px-2 py-0.5 rounded bg-slate-950 text-slate-400 font-semibold border border-slate-800">0.00</span></td>
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
            <div class="bg-slate-900/50 border border-slate-800 rounded-2xl p-6 backdrop-blur-sm space-y-4">
                <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                    <div class="flex items-center gap-2">
                        <span class="text-emerald-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                        </span>
                        <h2 class="text-lg font-bold text-slate-100">Kandungan Nutrisi Bahan Pakan</h2>
                    </div>
                    <!-- Live Loading Badge -->
                    <span id="badge-api-ingredients" class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-amber-500/10 text-amber-400 border border-amber-500/20 animate-pulse">Loading API...</span>
                </div>

                <div class="overflow-x-auto max-h-[60vh] overflow-y-auto">
                    <table class="w-full text-center text-sm border-collapse">
                        <thead class="sticky top-0 bg-slate-900 border-b border-slate-800 text-slate-400 font-bold uppercase tracking-wider text-xs z-10">
                            <tr>
                                <th class="py-3 px-4 text-left">Nama Bahan</th>
                                <th class="py-3 px-2">BK (%)</th>
                                <th class="py-3 px-2">PK (%)</th>
                                <th class="py-3 px-2">LK (%)</th>
                                <th class="py-3 px-2">Abu (%)</th>
                                <th class="py-3 px-2">Ca (%)</th>
                                <th class="py-3 px-2">P (%)</th>
                                <th class="py-3 px-2">TDN (%)</th>
                            </tr>
                        </thead>
                        <tbody id="ingredients-table-body" class="divide-y divide-slate-800/45">
                            <!-- Injected by JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ==================== TAB: LIVESTOCK ==================== -->
        <div id="tab-livestock" class="tab-content hidden space-y-6">
            <div class="bg-slate-900/50 border border-slate-800 rounded-2xl p-6 backdrop-blur-sm space-y-4">
                <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                    <div class="flex items-center gap-2">
                        <span class="text-emerald-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </span>
                        <h2 class="text-lg font-bold text-slate-100">Tabel Kebutuhan Standar Nutrisi Ternak</h2>
                    </div>
                    <!-- Live Loading Badge -->
                    <span id="badge-api-livestock" class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-amber-500/10 text-amber-400 border border-amber-500/20 animate-pulse">Loading API...</span>
                </div>

                <div class="overflow-x-auto max-h-[60vh] overflow-y-auto">
                    <table class="w-full text-center text-sm border-collapse">
                        <thead class="sticky top-0 bg-slate-900 border-b border-slate-800 text-slate-400 font-bold uppercase tracking-wider text-xs z-10">
                            <tr>
                                <th class="py-3 px-4 text-left">Nama Ternak</th>
                                <th class="py-3 px-2">BK (%)</th>
                                <th class="py-3 px-2">PK (%)</th>
                                <th class="py-3 px-2">LK (%)</th>
                                <th class="py-3 px-2">Abu (%)</th>
                                <th class="py-3 px-2">Ca (%)</th>
                                <th class="py-3 px-2">P (%)</th>
                                <th class="py-3 px-2">TDN (%)</th>
                            </tr>
                        </thead>
                        <tbody id="livestock-table-body" class="divide-y divide-slate-800/45">
                            <!-- Injected by JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-900 bg-slate-950 py-6 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center space-y-2">
            <p class="text-xs text-slate-500">CalKan - Website Kalkulator Pakan Ternak All-in-One.</p>
            <p class="text-[10px] text-slate-600">Terintegrasi dengan Google Sheets API.</p>
        </div>
    </footer>

    <!-- INGREDIENT DETAIL MODAL -->
    <div id="detail-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm hidden">
        <div class="bg-slate-900 border border-slate-800 w-full max-w-md rounded-2xl overflow-hidden shadow-2xl">
            <div class="flex items-center justify-between p-6 border-b border-slate-800">
                <h3 id="modal-title" class="text-lg font-bold text-slate-100">Detail Kandungan</h3>
                <button onclick="closeModal()" class="text-slate-400 hover:text-slate-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-slate-950 rounded-xl p-3 border border-slate-800">
                        <p class="text-[10px] font-bold text-slate-500 uppercase">BK (Bahan Kering)</p>
                        <p id="modal-BK" class="text-lg font-bold text-slate-200">-</p>
                    </div>
                    <div class="bg-slate-950 rounded-xl p-3 border border-slate-800">
                        <p class="text-[10px] font-bold text-slate-500 uppercase">PK (Protein Kasar)</p>
                        <p id="modal-PK" class="text-lg font-bold text-slate-200">-</p>
                    </div>
                    <div class="bg-slate-950 rounded-xl p-3 border border-slate-800">
                        <p class="text-[10px] font-bold text-slate-500 uppercase">LK (Lemak Kasar)</p>
                        <p id="modal-LK" class="text-lg font-bold text-slate-200">-</p>
                    </div>
                    <div class="bg-slate-950 rounded-xl p-3 border border-slate-800">
                        <p class="text-[10px] font-bold text-slate-500 uppercase">Abu (Mineral)</p>
                        <p id="modal-Abu" class="text-lg font-bold text-slate-200">-</p>
                    </div>
                    <div class="bg-slate-950 rounded-xl p-3 border border-slate-800">
                        <p class="text-[10px] font-bold text-slate-500 uppercase">Ca (Kalsium)</p>
                        <p id="modal-Ca" class="text-lg font-bold text-slate-200">-</p>
                    </div>
                    <div class="bg-slate-950 rounded-xl p-3 border border-slate-800">
                        <p class="text-[10px] font-bold text-slate-500 uppercase">P (Fosfor)</p>
                        <p id="modal-P" class="text-lg font-bold text-slate-200">-</p>
                    </div>
                    <div class="col-span-2 bg-slate-950 rounded-xl p-3 border border-slate-800 text-center">
                        <p class="text-[10px] font-bold text-slate-500 uppercase">TDN (Total Energi)</p>
                        <p id="modal-TDN" class="text-lg font-bold text-emerald-400">-</p>
                    </div>
                </div>
            </div>
            <div class="bg-slate-950/40 p-6 border-t border-slate-800 flex justify-end">
                <button onclick="closeModal()" class="px-5 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 font-semibold text-xs transition-colors">Tutup</button>
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
                btn.classList.remove('bg-gradient-to-r', 'from-emerald-500', 'to-teal-500', 'text-slate-950', 'shadow-md');
                btn.classList.add('text-slate-400', 'hover:text-slate-200');
            });

            const activeBtn = document.getElementById(`btn-tab-${tabId}`);
            activeBtn.classList.remove('text-slate-400', 'hover:text-slate-200');
            activeBtn.classList.add('bg-gradient-to-r', 'from-emerald-500', 'to-teal-500', 'text-slate-950', 'shadow-md');
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
                        document.getElementById('badge-api-livestock').innerText = "Live (Google Sheets)";
                        document.getElementById('badge-api-livestock').classList.remove('bg-amber-500/10', 'text-amber-400', 'border-amber-500/20', 'animate-pulse');
                        document.getElementById('badge-api-livestock').classList.add('bg-emerald-500/10', 'text-emerald-400', 'border-emerald-500/20');
                    }
                })
                .catch(err => {
                    console.warn("Failed to fetch live Ternak data, using local fallback.", err);
                    document.getElementById('badge-api-livestock').innerText = "Offline Database";
                    document.getElementById('badge-api-livestock').classList.remove('animate-pulse');
                });

            // Fetch Bahan
            fetch("https://script.google.com/macros/s/AKfycbwgcwSOROmoKE26pyN3YkBAS2_MpaM2zC_ySZc8z0lo9_0HZXx_bJMZTFULsKVAydNiCg/exec?nama=Bahan")
                .then(res => res.json())
                .then(json => {
                    if (json && json.data) {
                        dataBahan = json.data;
                        renderIngredientsTable();
                        updateAllSelects();
                        document.getElementById('badge-api-ingredients').innerText = "Live (Google Sheets)";
                        document.getElementById('badge-api-ingredients').classList.remove('bg-amber-500/10', 'text-amber-400', 'border-amber-500/20', 'animate-pulse');
                        document.getElementById('badge-api-ingredients').classList.add('bg-emerald-500/10', 'text-emerald-400', 'border-emerald-500/20');
                    }
                })
                .catch(err => {
                    console.warn("Failed to fetch live Bahan data, using local fallback.", err);
                    document.getElementById('badge-api-ingredients').innerText = "Offline Database";
                    document.getElementById('badge-api-ingredients').classList.remove('animate-pulse');
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
                row.className = "hover:bg-slate-900/30 transition-colors";
                row.innerHTML = `
                    <td class="py-3 px-4 text-left font-semibold text-slate-200">${item.nama}</td>
                    <td class="py-3 px-2 text-slate-300">${item.BK}%</td>
                    <td class="py-3 px-2 text-slate-300">${item.PK}%</td>
                    <td class="py-3 px-2 text-slate-300">${item.LK}%</td>
                    <td class="py-3 px-2 text-slate-300">${item.Abu}%</td>
                    <td class="py-3 px-2 text-slate-300">${item.Ca}%</td>
                    <td class="py-3 px-2 text-slate-300">${item.P}%</td>
                    <td class="py-3 px-2 text-emerald-400 font-medium">${item.TDN}%</td>
                `;
                container.appendChild(row);
            });
        }

        function renderIngredientsTable() {
            const container = document.getElementById('ingredients-table-body');
            container.innerHTML = '';
            dataBahan.forEach(item => {
                const row = document.createElement('tr');
                row.className = "hover:bg-slate-900/30 transition-colors";
                row.innerHTML = `
                    <td class="py-3 px-4 text-left font-semibold text-slate-200">${item.nama}</td>
                    <td class="py-3 px-2 text-slate-300">${item.BK}%</td>
                    <td class="py-3 px-2 text-slate-300">${item.PK}%</td>
                    <td class="py-3 px-2 text-slate-300">${item.LK}%</td>
                    <td class="py-3 px-2 text-slate-300">${item.Abu}%</td>
                    <td class="py-3 px-2 text-slate-300">${item.Ca}%</td>
                    <td class="py-3 px-2 text-slate-300">${item.P}%</td>
                    <td class="py-3 px-2 text-emerald-400 font-medium">${item.TDN}%</td>
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
                    row.className = "hover:bg-slate-900/10 transition-colors";
                    row.innerHTML = `
                        <td class="py-3 pr-2 flex items-center gap-2">
                            <!-- Info Icon to view detailed composition -->
                            <button type="button" onclick="showIngredientDetails(${i})" class="text-slate-500 hover:text-emerald-400 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                            <select onchange="calculateFeed()" name="ingredient" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-sm text-slate-300 focus:outline-none focus:border-emerald-500 transition-colors">
                                <option value="">-- Pilih Bahan --</option>
                            </select>
                        </td>
                        <td class="py-3 px-2">
                            <input type="number" name="percentage" min="0" max="100" step="any" oninput="calculateFeed()" placeholder="0" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-sm text-slate-200 focus:outline-none focus:border-emerald-500 transition-colors text-center font-semibold">
                        </td>
                        <td class="py-3 pl-2">
                            <input type="number" name="price" min="0" step="any" oninput="calculateFeed()" placeholder="0" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-sm text-slate-200 focus:outline-none focus:border-emerald-500 transition-colors font-medium">
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
                percentBadge.className = "px-2 py-0.5 rounded-md bg-emerald-500/10 text-emerald-400 font-bold border border-emerald-500/20";
                percentBar.className = "h-full bg-gradient-to-r from-emerald-500 to-teal-400 transition-all duration-300";
                warningText.classList.add('hidden');
            } else {
                percentBadge.className = "px-2 py-0.5 rounded-md bg-red-500/10 text-red-400 font-bold border border-red-500/20";
                percentBar.className = "h-full bg-gradient-to-r from-red-500 to-red-400 transition-all duration-300";
                warningText.classList.remove('hidden');
            }

            // Update Cost Display
            document.getElementById('total-cost').innerText = `Rp ${totalCost.toLocaleString('id-ID', { maximumFractionDigits: 0 })}`;
            const costPerKg = totalKg > 0 ? (totalCost / totalKg) : 0;
            document.getElementById('cost-per-kg').innerText = `Rp ${costPerKg.toLocaleString('id-ID', { maximumFractionDigits: 0 })}`;

            // Update Composition Breakdown List
            const breakdownContainer = document.getElementById('breakdown-container');
            if (selectedIngredients.length === 0) {
                breakdownContainer.innerHTML = '<p class="text-xs text-slate-500 italic text-center py-4">Pilih bahan dan persentase untuk melihat rincian.</p>';
            } else {
                breakdownContainer.innerHTML = '';
                selectedIngredients.forEach(item => {
                    const el = document.createElement('div');
                    el.className = "flex justify-between items-center bg-slate-950/60 border border-slate-900 rounded-lg p-2.5 text-xs";
                    el.innerHTML = `
                        <div class="space-y-0.5">
                            <p class="font-bold text-slate-200">${item.nama}</p>
                            <p class="text-[10px] text-slate-500">${item.percentage}% dari total pakan</p>
                        </div>
                        <div class="text-right space-y-0.5">
                            <p class="font-semibold text-slate-300">${item.weight.toFixed(2)} KG</p>
                            <p class="text-[10px] text-emerald-400 font-medium">Rp ${item.cost.toLocaleString('id-ID', { maximumFractionDigits: 0 })}</p>
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
                        diffEl.className = "px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 font-bold border border-emerald-500/20";
                    } else {
                        diffEl.className = "px-2 py-0.5 rounded bg-red-500/10 text-red-400 font-bold border border-red-500/20";
                    }
                } else {
                    diffEl.innerText = difference.toFixed(2);
                    diffEl.className = "px-2 py-0.5 rounded bg-slate-950 text-slate-400 font-semibold border border-slate-800";
                }
            }
        }
    </script>
</body>
</html>
