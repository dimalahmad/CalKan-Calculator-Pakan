<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CalKan - Kalkulator Formula Pakan Ternak Mudah</title>

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
<body class="bg-slate-50 text-slate-900 min-h-screen flex flex-col antialiased">

    <!-- Top Navigation Bar -->
    <header class="bg-emerald-700 text-white shadow-md">
        <div class="max-w-6xl mx-auto px-4 py-4 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3 text-center md:text-left">
                <div class="bg-white/10 p-2 rounded-lg font-bold text-lg hidden md:block">
                    CALKAN
                </div>
                <div>
                    <h1 class="text-xl md:text-2xl font-bold tracking-tight">Kalkulator Pakan CalKan</h1>
                    <p class="text-xs text-emerald-100 font-medium">Formulasi Pakan Ternak Mandiri - Mudah dan Praktis</p>
                </div>
            </div>

            <!-- Tab Buttons - Responsive, scrollable on mobile -->
            <nav class="flex bg-emerald-800/50 p-1 rounded-xl border border-emerald-600 overflow-x-auto max-w-full whitespace-nowrap scrollbar-none">
                <button onclick="switchTab('calculator')" id="btn-tab-calculator" class="tab-btn px-4 py-2.5 text-sm font-bold rounded-lg transition-all duration-150 bg-white text-emerald-800 shadow">
                    Hitung Pakan
                </button>
                <button onclick="switchTab('ingredients')" id="btn-tab-ingredients" class="tab-btn px-4 py-2.5 text-sm font-bold rounded-lg transition-all duration-150 text-white hover:bg-emerald-600/50">
                    Data Bahan Pakan
                </button>
                <button onclick="switchTab('livestock')" id="btn-tab-livestock" class="tab-btn px-4 py-2.5 text-sm font-bold rounded-lg transition-all duration-150 text-white hover:bg-emerald-600/50">
                    Standar Ternak
                </button>
            </nav>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 max-w-6xl w-full mx-auto px-4 py-6">

        <!-- ==================== TAB: CALCULATOR ==================== -->
        <div id="tab-calculator" class="tab-content space-y-6">
            
            <!-- Panduan Singkat Banner -->
            <div class="bg-white border-l-4 border-emerald-600 rounded-r-xl p-5 shadow-sm space-y-1.5 border border-slate-200">
                <h3 class="text-base font-bold text-emerald-800">Petunjuk Penggunaan Kalkulator:</h3>
                <ol class="list-decimal list-inside text-sm text-slate-700 space-y-1">
                    <li>Pilih jenis hewan ternak dan masukkan total berat pakan pada Langkah 1.</li>
                    <li>Pilih bahan pakan dan isi persentase campuran pada Langkah 2.</li>
                    <li>Pastikan total persentase campuran pakan genap bernilai 100%.</li>
                    <li>Hasil analisis kecukupan nutrisi dan estimasi biaya dapat dilihat pada Langkah 3.</li>
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
                            <h2 class="text-lg font-bold text-slate-900">Pilih Jenis Ternak dan Berat Pakan</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Select Ternak -->
                            <div>
                                <label for="select-ternak" class="block text-sm font-bold text-slate-700 mb-2">Jenis Ternak:</label>
                                <select id="select-ternak" onchange="onTernakChange()" class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3 text-base text-slate-800 font-medium focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-700 focus:outline-none">
                                    <option value="">-- Pilih Ternak --</option>
                                </select>
                            </div>
                            
                            <!-- Input Weight -->
                            <div>
                                <label for="input-weight" class="block text-sm font-bold text-slate-700 mb-2">Total Berat Campuran:</label>
                                <div class="relative">
                                    <input type="number" id="input-weight" value="100" min="1" step="any" oninput="calculateFeed()" class="w-full bg-white border border-slate-300 rounded-xl pl-4 pr-16 py-3 text-base text-slate-800 font-bold focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-700 focus:outline-none">
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-sm font-bold text-slate-500">KG</span>
                                </div>
                            </div>
                        </div>

                        <!-- Mini Livestock Requirement Card -->
                        <div id="ternak-req-card" class="hidden bg-emerald-50/50 rounded-xl p-4 border border-emerald-100 space-y-3">
                            <h3 class="text-sm font-bold text-emerald-800">Target Nutrisi Minimal Ternak:</h3>
                            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-7 gap-2 text-center text-xs">
                                <div class="bg-white rounded-lg p-2 border border-slate-200 shadow-xs">
                                    <p class="text-slate-500 font-bold">Bahan Kering</p>
                                    <p id="req-BK" class="text-sm font-bold text-slate-800">-</p>
                                </div>
                                <div class="bg-white rounded-lg p-2 border border-slate-200 shadow-xs">
                                    <p class="text-slate-500 font-bold">Protein Kasar</p>
                                    <p id="req-PK" class="text-sm font-bold text-slate-800">-</p>
                                </div>
                                <div class="bg-white rounded-lg p-2 border border-slate-200 shadow-xs">
                                    <p class="text-slate-500 font-bold">Lemak Kasar</p>
                                    <p id="req-LK" class="text-sm font-bold text-slate-800">-</p>
                                </div>
                                <div class="bg-white rounded-lg p-2 border border-slate-200 shadow-xs">
                                    <p class="text-slate-500 font-bold">Kadar Abu</p>
                                    <p id="req-Abu" class="text-sm font-bold text-slate-800">-</p>
                                </div>
                                <div class="bg-white rounded-lg p-2 border border-slate-200 shadow-xs">
                                    <p class="text-slate-500 font-bold">Kalsium</p>
                                    <p id="req-Ca" class="text-sm font-bold text-slate-800">-</p>
                                </div>
                                <div class="bg-white rounded-lg p-2 border border-slate-200 shadow-xs">
                                    <p class="text-slate-500 font-bold">Fosfor</p>
                                    <p id="req-P" class="text-sm font-bold text-slate-800">-</p>
                                </div>
                                <div class="bg-white rounded-lg p-2 border border-slate-250 shadow-xs col-span-2 sm:col-span-1">
                                    <p class="text-emerald-800 font-bold">Energi TDN</p>
                                    <p id="req-TDN" class="text-sm font-bold text-emerald-700">-</p>
                                </div>
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
                            
                            <!-- Row Adder/Remover Buttons - Clean responsive layout -->
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

                        <!-- Feed Table with horizontal scroll wrapper for Mobile/Tablet -->
                        <div class="overflow-x-auto border border-slate-200 rounded-xl">
                            <table class="w-full text-left border-collapse min-w-[500px]">
                                <thead>
                                    <tr class="bg-slate-55 border-b border-slate-200 text-xs font-bold text-slate-600 uppercase">
                                        <th class="py-3 px-3 w-1/2">Nama Bahan Pakan</th>
                                        <th class="py-3 px-2 w-28 text-center">Porsi (%)</th>
                                        <th class="py-3 px-3 w-36">Harga (Rp/Kg)</th>
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
                            <h2 class="text-lg font-bold text-slate-900">Hasil Formulasi dan Biaya</h2>
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
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-3">
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
                                    <tr class="bg-slate-55 border-b border-slate-200 text-slate-600 font-bold">
                                        <th class="py-2.5 px-2 text-left">Nutrisi</th>
                                        <th class="py-2.5 px-2">Hasil</th>
                                        <th class="py-2.5 px-2">Target</th>
                                        <th class="py-2.5 px-2">Status</th>
                                    </tr>
                                </thead>
                                <tbody id="nutrient-comparison-tbody" class="divide-y divide-slate-100">
                                    <tr class="hover:bg-slate-50">
                                        <td class="py-3 px-2 text-left">
                                            <span class="font-bold text-slate-900 block">Bahan Kering (BK)</span>
                                        </td>
                                        <td id="res-BK" class="font-bold text-slate-800">0.00%</td>
                                        <td id="tar-BK" class="text-slate-500 font-medium">0.00%</td>
                                        <td class="px-2"><span id="diff-BK" class="px-2 py-1 rounded bg-slate-100 text-slate-600 font-bold border border-slate-200 text-xs block text-center">Belum Ada Target</span></td>
                                    </tr>
                                    <tr class="hover:bg-slate-50">
                                        <td class="py-3 px-2 text-left">
                                            <span class="font-bold text-slate-900 block">Protein Kasar (PK)</span>
                                        </td>
                                        <td id="res-PK" class="font-bold text-slate-800">0.00%</td>
                                        <td id="tar-PK" class="text-slate-500 font-medium">0.00%</td>
                                        <td class="px-2"><span id="diff-PK" class="px-2 py-1 rounded bg-slate-100 text-slate-600 font-bold border border-slate-200 text-xs block text-center">Belum Ada Target</span></td>
                                    </tr>
                                    <tr class="hover:bg-slate-50">
                                        <td class="py-3 px-2 text-left">
                                            <span class="font-bold text-slate-900 block">Lemak Kasar (LK)</span>
                                        </td>
                                        <td id="res-LK" class="font-bold text-slate-800">0.00%</td>
                                        <td id="tar-LK" class="text-slate-500 font-medium">0.00%</td>
                                        <td class="px-2"><span id="diff-LK" class="px-2 py-1 rounded bg-slate-100 text-slate-600 font-bold border border-slate-200 text-xs block text-center">Belum Ada Target</span></td>
                                    </tr>
                                    <tr class="hover:bg-slate-50">
                                        <td class="py-3 px-2 text-left">
                                            <span class="font-bold text-slate-900 block">Kadar Abu</span>
                                        </td>
                                        <td id="res-Abu" class="font-bold text-slate-800">0.00%</td>
                                        <td id="tar-Abu" class="text-slate-500 font-medium">0.00%</td>
                                        <td class="px-2"><span id="diff-Abu" class="px-2 py-1 rounded bg-slate-100 text-slate-600 font-bold border border-slate-200 text-xs block text-center">Belum Ada Target</span></td>
                                    </tr>
                                    <tr class="hover:bg-slate-50">
                                        <td class="py-3 px-2 text-left">
                                            <span class="font-bold text-slate-900 block">Kalsium (Ca)</span>
                                        </td>
                                        <td id="res-Ca" class="font-bold text-slate-800">0.00%</td>
                                        <td id="tar-Ca" class="text-slate-500 font-medium">0.00%</td>
                                        <td class="px-2"><span id="diff-Ca" class="px-2 py-1 rounded bg-slate-100 text-slate-600 font-bold border border-slate-200 text-xs block text-center">Belum Ada Target</span></td>
                                    </tr>
                                    <tr class="hover:bg-slate-50">
                                        <td class="py-3 px-2 text-left">
                                            <span class="font-bold text-slate-900 block">Fosfor (P)</span>
                                        </td>
                                        <td id="res-P" class="font-bold text-slate-800">0.00%</td>
                                        <td id="tar-P" class="text-slate-500 font-medium">0.00%</td>
                                        <td class="px-2"><span id="diff-P" class="px-2 py-1 rounded bg-slate-100 text-slate-600 font-bold border border-slate-200 text-xs block text-center">Belum Ada Target</span></td>
                                    </tr>
                                    <tr class="hover:bg-slate-50">
                                        <td class="py-3 px-2 text-left">
                                            <span class="font-bold text-slate-900 block">Energi (TDN)</span>
                                        </td>
                                        <td id="res-TDN" class="font-bold text-slate-800">0.00%</td>
                                        <td id="tar-TDN" class="text-slate-500 font-medium">0.00%</td>
                                        <td class="px-2"><span id="diff-TDN" class="px-2 py-1 rounded bg-slate-100 text-slate-600 font-bold border border-slate-200 text-xs block text-center">Belum Ada Target</span></td>
                                    </tr>
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
                                <td class="py-3 px-4 font-bold text-slate-900">BK (%)</td>
                                <td class="py-3 px-4 font-semibold text-slate-800">Bahan Kering (Dry Matter)</td>
                                <td class="py-3 px-4 text-slate-500 text-xs">Kandungan pakan bersih setelah kadar air dihilangkan secara keseluruhan.</td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="py-3 px-4 font-bold text-slate-900">PK (%)</td>
                                <td class="py-3 px-4 font-semibold text-slate-800">Protein Kasar (Crude Protein)</td>
                                <td class="py-3 px-4 text-slate-500 text-xs">Total protein di dalam pakan untuk membantu pertumbuhan daging dan susu.</td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="py-3 px-4 font-bold text-slate-900">LK (%)</td>
                                <td class="py-3 px-4 font-semibold text-slate-800">Lemak Kasar (Ether Extract)</td>
                                <td class="py-3 px-4 text-slate-500 text-xs">Kandungan lemak total dalam pakan sebagai sumber energi cadangan.</td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="py-3 px-4 font-bold text-slate-900">Abu (%)</td>
                                <td class="py-3 px-4 font-semibold text-slate-800">Kadar Abu (Mineral)</td>
                                <td class="py-3 px-4 text-slate-500 text-xs">Zat anorganik sisa pembakaran yang mencerminkan kadar mineral pakan.</td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="py-3 px-4 font-bold text-slate-900">Ca (%)</td>
                                <td class="py-3 px-4 font-semibold text-slate-800">Kalsium (Calcium)</td>
                                <td class="py-3 px-4 text-slate-500 text-xs">Mineral makro penting untuk kekuatan struktur tulang dan gigi ternak.</td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="py-3 px-4 font-bold text-slate-900">P (%)</td>
                                <td class="py-3 px-4 font-semibold text-slate-800">Fosfor (Phosphorus)</td>
                                <td class="py-3 px-4 text-slate-500 text-xs">Mineral makro yang membantu proses pembentukan energi di tingkat sel.</td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="py-3 px-4 font-bold text-slate-900">TDN (%)</td>
                                <td class="py-3 px-4 font-semibold text-slate-800">Total Nutrien Tercerna (TDN)</td>
                                <td class="py-3 px-4 text-slate-500 text-xs">Kombinasi total gizi pakan yang bernilai tinggi dan mudah dicerna ternak.</td>
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
                    <h2 class="text-xl font-bold text-slate-900">Kandungan Gizi Bahan Pakan Lengkap</h2>
                    <!-- Live Loading Badge -->
                    <span id="badge-api-ingredients" class="px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200 animate-pulse">Menghubungkan Database API...</span>
                </div>

                <p class="text-sm text-slate-650 bg-slate-50 p-3.5 rounded-lg border border-slate-200">
                    Tips Peternak: Tabel ini berisi standar nilai gizi bahan pakan. Anda dapat menggunakannya sebagai acuan memilih bahan pakan di kalkulator utama.
                </p>

                <div class="overflow-x-auto border border-slate-200 rounded-xl">
                    <table class="w-full text-center text-sm border-collapse min-w-[650px]">
                        <thead class="sticky top-0 bg-slate-100 border-b border-slate-200 text-slate-700 font-bold text-xs uppercase z-10">
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
                <div class="flex items-center justify-between border-b border-slate-200 pb-4 flex-wrap gap-3">
                    <h2 class="text-xl font-bold text-slate-900">Standar Minimum Kebutuhan Gizi Ternak</h2>
                    <!-- Live Loading Badge -->
                    <span id="badge-api-livestock" class="px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200 animate-pulse">Menghubungkan Database API...</span>
                </div>

                <p class="text-sm text-slate-650 bg-slate-50 p-3.5 rounded-lg border border-slate-200">
                    Tips Peternak: Setiap jenis hewan ternak memiliki standar minimal zat gizi yang berbeda-beda agar mereka tumbuh sehat dan cepat gemuk.
                </p>

                <div class="overflow-x-auto border border-slate-200 rounded-xl">
                    <table class="w-full text-center text-sm border-collapse min-w-[650px]">
                        <thead class="sticky top-0 bg-slate-100 border-b border-slate-200 text-slate-700 font-bold text-xs uppercase z-10">
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
    <footer class="border-t border-slate-200 bg-white py-6 mt-12 text-center text-slate-600">
        <div class="max-w-6xl mx-auto px-4 space-y-1">
            <p class="text-sm font-bold">Kalkulator Pakan Ternak CalKan</p>
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
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-slate-55 rounded-xl p-3 border border-slate-200">
                        <p class="text-xs font-bold text-slate-500 uppercase">Bahan Kering (BK)</p>
                        <p id="modal-BK" class="text-base font-bold text-slate-900">-</p>
                    </div>
                    <div class="bg-slate-55 rounded-xl p-3 border border-slate-200">
                        <p class="text-xs font-bold text-slate-500 uppercase">Protein Kasar (PK)</p>
                        <p id="modal-PK" class="text-base font-bold text-slate-900">-</p>
                    </div>
                    <div class="bg-slate-55 rounded-xl p-3 border border-slate-200">
                        <p class="text-xs font-bold text-slate-500 uppercase">Lemak Kasar (LK)</p>
                        <p id="modal-LK" class="text-base font-bold text-slate-900">-</p>
                    </div>
                    <div class="bg-slate-55 rounded-xl p-3 border border-slate-200">
                        <p class="text-xs font-bold text-slate-500 uppercase">Mineral / Abu</p>
                        <p id="modal-Abu" class="text-base font-bold text-slate-900">-</p>
                    </div>
                    <div class="bg-slate-55 rounded-xl p-3 border border-slate-200">
                        <p class="text-xs font-bold text-slate-500 uppercase">Kalsium (Ca)</p>
                        <p id="modal-Ca" class="text-base font-bold text-slate-900">-</p>
                    </div>
                    <div class="bg-slate-55 rounded-xl p-3 border border-slate-200">
                        <p class="text-xs font-bold text-slate-500 uppercase">Fosfor (P)</p>
                        <p id="modal-P" class="text-base font-bold text-slate-900">-</p>
                    </div>
                    <div class="col-span-2 bg-slate-55 rounded-xl p-3 border border-slate-200 text-center">
                        <p class="text-xs font-bold text-slate-500 uppercase">Energi TDN</p>
                        <p id="modal-TDN" class="text-base font-bold text-emerald-700">-</p>
                    </div>
                </div>
            </div>
            <div class="bg-slate-100 p-6 border-t border-slate-200 flex justify-end">
                <button onclick="closeModal()" class="px-5 py-2.5 rounded-xl bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-semibold text-xs transition-colors">Tutup Jendela</button>
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
                btn.classList.remove('bg-white', 'text-emerald-800', 'shadow');
                btn.classList.add('text-white', 'hover:bg-emerald-600/50');
            });

            const activeBtn = document.getElementById(`btn-tab-${tabId}`);
            activeBtn.classList.remove('text-white', 'hover:bg-emerald-600/50');
            activeBtn.classList.add('bg-white', 'text-emerald-800', 'shadow');
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
                        renderIngredientsTable();
                        updateAllSelects();
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
            dropdown.innerHTML = '<option value="">-- Pilih Ternak --</option>';
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
                container.appendChild(row);
            });
        }

        function renderIngredientsTable() {
            const container = document.getElementById('ingredients-table-body');
            container.innerHTML = '';
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
                    row.className = "hover:bg-slate-50 border-b border-slate-200";
                    row.innerHTML = `
                        <td class="py-3 px-3 flex items-center gap-2">
                            <!-- Info button - cleaned up text, no emoji -->
                            <button type="button" onclick="showIngredientDetails(${i})" class="bg-slate-100 hover:bg-emerald-100 text-slate-700 hover:text-emerald-800 px-2 py-2 rounded-xl border border-slate-300 font-bold text-xs flex items-center gap-1 transition-colors" title="Lihat detail gizi bahan ini">
                                Info
                            </button>
                            <select onchange="calculateFeed()" name="ingredient" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-sm text-slate-800 font-semibold focus:border-emerald-700 focus:outline-none">
                                <option value="">-- Pilih Bahan --</option>
                            </select>
                        </td>
                        <td class="py-3 px-2">
                            <input type="number" name="percentage" min="0" max="100" step="any" oninput="calculateFeed()" placeholder="0" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-sm text-slate-900 font-bold focus:border-emerald-700 focus:outline-none text-center">
                        </td>
                        <td class="py-3 px-3">
                            <input type="number" name="price" min="0" step="any" oninput="calculateFeed()" placeholder="0" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-sm text-slate-900 font-bold focus:border-emerald-700 focus:outline-none">
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
                alert("Pilih bahan pakan terlebih dahulu.");
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
                percentBadge.className = "px-3 py-1 rounded-lg bg-emerald-100 text-emerald-800 font-extrabold border border-emerald-300 text-base shadow-xs";
                percentBar.className = "h-full bg-emerald-600 transition-all duration-200";
                warningText.classList.add('hidden');
            } else {
                percentBadge.className = "px-3 py-1 rounded-lg bg-red-100 text-red-800 font-extrabold border border-red-300 text-base shadow-xs";
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
                breakdownContainer.innerHTML = '<p class="text-sm text-slate-500 italic text-center py-4 bg-slate-50 rounded-xl border border-slate-200">Belum ada bahan pakan yang dipilih.</p>';
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
                        diffEl.innerText = `Cukup (+${difference.toFixed(2)}%)`;
                        diffEl.className = "px-2 py-1 rounded bg-emerald-100 text-emerald-800 font-bold border border-emerald-300 text-xs block text-center shadow-xs";
                    } else {
                        diffEl.innerText = `Kurang (${difference.toFixed(2)}%)`;
                        diffEl.className = "px-2 py-1 rounded bg-red-100 text-red-800 font-bold border border-red-300 text-xs block text-center shadow-xs";
                    }
                } else {
                    diffEl.innerText = "Belum Ada Target";
                    diffEl.className = "px-2 py-1 rounded bg-slate-100 text-slate-650 font-bold border border-slate-200 text-xs block text-center shadow-xs";
                }
            }
        }
    </script>
</body>
</html>
