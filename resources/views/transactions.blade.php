<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi - Lentora</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/Avatar.png') }}">

    <!-- Flowbite -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    {{-- Link Laravel --}}
    <link href="{{ mix('resources/css/app.css') }}" rel="stylesheet">

    <!-- html2canvas untuk cetak struk -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        :root {
            --primary: #e074ae;
            --primary-dark: #623d51;
            --primary-light: #d867b6;
            --secondary: #ea84b9;
            --accent: #362b35;
            --success: #10b981;
            --danger: #e65f4c;
            --danger-dark: #e66346;
            --warning: #f59e0b;
            --info: #e783cb;
            --background: #382d36;
            --card-bg: #533a47;
            --text-primary: #f4edf1;
            --text-secondary: #ede4ea;
            --text-muted: #b7a564;
            --border: #323840;
            --hover-bg: #4a3a44;
            
            --sidebar-bg: #cea8c3;
            --pink-pekat: #ff1493;
            --hitam: #1a0f14;
            --oren-terang: #ffb347;
            --oren-gelap: #ff8c00;
        }

        body {
            background-color: var(--background);
            color: var(--text-primary);
            font-family: system-ui, -apple-system, sans-serif;
        }

        .bg-sidebar { background-color: var(--sidebar-bg) !important; }
        
        .sidebar-link-hover-effect:hover {
            background: linear-gradient(135deg, #ff1493 0%, #1a0f14 100%) !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-weight: 600;
        }
        
        .sidebar-link-hover-effect:hover span,
        .sidebar-link-hover-effect:hover svg { color: white !important; }
        
        .sidebar-link-active-effect {
            background: linear-gradient(135deg, #d81b60 0%, #0a080a 100%) !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            border-left: 4px solid #ffb6c1;
            font-weight: 600;
        }
        
        .sidebar-link-active-effect span,
        .sidebar-link-active-effect svg { color: white !important; }
        
        .logout-link-effect:hover {
            background: linear-gradient(135deg, #ffb347 0%, #ff8c00 100%) !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-weight: 600;
        }
        
        .logout-link-effect:hover span,
        .logout-link-effect:hover svg,
        .logout-link-effect:hover button { color: white !important; }
        
        #logo-sidebar { background-color: var(--sidebar-bg) !important; }
        
        .sidebar-link span { color: #000000 !important; transition: color 0.3s ease; }
        .sidebar-link svg { color: #ff69b4 !important; transition: color 0.3s ease; }
        .logout-link-effect svg { color: #ff69b4 !important; }
        .logout-link-effect span,
        .logout-link-effect button { color: #000000 !important; }

        /* Status Badge */
        .badge-paid {
            background-color: #10b981;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
        }
        
        .badge-unpaid {
            background-color: #e65f4c;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
        }

        /* Receipt styling */
        .receipt {
            font-family: 'Courier New', monospace;
            background: white;
            color: black;
            padding: 20px;
            width: 350px;
            margin: 0 auto;
            font-size: 12px;
            line-height: 1.4;
        }
        .receipt h3, .receipt h4 { text-align: center; margin: 5px 0; }
        .receipt .divider { border-top: 1px dashed #000; margin: 8px 0; }
        .receipt .row { display: flex; justify-content: space-between; margin: 4px 0; }
        .receipt .total { font-weight: bold; border-top: 1px solid #000; margin-top: 5px; padding-top: 5px; }
        .receipt .footer { text-align: center; margin-top: 10px; font-size: 10px; }
    </style>
</head>
<body class="bg-background">
    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
        type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-9 h-9" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <!-- Sidebar -->
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform bg-sidebar -translate-x-full sm:translate-x-0 shadow-xl" aria-label="Sidebar">
        <div class="h-full flex flex-col justify-normal px-4 py-12 overflow-y-auto bg-sidebar">
            <a href="#" class="flex items-center ps-2.5 mb-10">
                <div class="w-8 h-8 bg-gradient-to-r from-pink-500 to-pink-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </div>
                <span class="self-center text-xl font-semibold whitespace-nowrap ml-3 text-pink-800">PinjamAlatMasak</span>
            </a>
            
            @if (auth()->user()->role === 'admin')
                <ul class="space-y-2 py-4 font-medium">
                    <li><a href="{{ route('dashboard') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 22 21"><path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/><path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/></svg><span class="ms-3">Dashboard</span></a></li>
                    <li><a href="{{ route('items') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 18 18"><path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/></svg><span class="flex-1 ms-3 whitespace-nowrap">Inventaris</span></a></li>
                    <li><a href="{{ route('pinjamBarang') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 20 20"><path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/></svg><span class="flex-1 ms-3 whitespace-nowrap">Peminjaman</span></a></li>
                    <li><a href="{{ route('transactions') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-active-effect"><svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75" fill="currentColor" viewBox="0 0 24 24"><path d="M4 3h16a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm1 2v14h14V5H5zm2 2h10v2H7V7zm0 4h10v2H7v-2zm0 4h7v2H7v-2z"/></svg><span class="flex-1 ms-3 whitespace-nowrap">Transaksi</span></a></li>
                    <li><a href="{{ route('users') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 20 18"><path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/></svg><span class="flex-1 ms-3 whitespace-nowrap">List User</span></a></li>
                    <li><a href="{{ route('logs') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 512 512"><path d="M64 480H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H288c-10.1 0-19.6-4.7-25.6-12.8L243.2 57.6C231.1 41.5 212.1 32 192 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64z"/></svg><span class="flex-1 ms-3 whitespace-nowrap">Log Aktivitas</span></a></li>
                    <li><form method="POST" action="{{ route('logout') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group logout-link-effect">@csrf<svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg><button type="submit" class="flex-1 ms-3 text-left whitespace-nowrap">Logout</button></form></li>
                </ul>
            @elseif (auth()->user()->role === 'petugas')
                <ul class="space-y-2 py-4 font-medium">
                    <li><a href="{{ route('dashboard') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 22 21"><path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/><path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/></svg><span class="ms-3">Dashboard</span></a></li>
                    <li><a href="{{ route('items') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 18 18"><path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/></svg><span class="flex-1 ms-3 whitespace-nowrap">Inventaris</span></a></li>
                    <li><a href="{{ route('pinjamBarang') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 20 20"><path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/></svg><span class="flex-1 ms-3 whitespace-nowrap">Peminjaman</span></a></li>
                    <li><a href="{{ route('transactions') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-active-effect"><svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75" fill="currentColor" viewBox="0 0 24 24"><path d="M4 3h16a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm1 2v14h14V5H5zm2 2h10v2H7V7zm0 4h10v2H7v-2zm0 4h7v2H7v-2z"/></svg><span class="flex-1 ms-3 whitespace-nowrap">Transaksi</span></a></li>
                    <li><a href="{{ route('logs') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 512 512"><path d="M64 480H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H288c-10.1 0-19.6-4.7-25.6-12.8L243.2 57.6C231.1 41.5 212.1 32 192 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64z"/></svg><span class="flex-1 ms-3 whitespace-nowrap">Log Aktivitas</span></a></li>
                    <li><form method="POST" action="{{ route('logout') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group logout-link-effect">@csrf<svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg><button type="submit" class="flex-1 ms-3 text-left whitespace-nowrap">Logout</button></form></li>
                </ul>
            @endif
        </div>
    </aside>

    <!-- Content -->
    <div class="sm:ml-64 pb-5" style="background-color: var(--background);">
        <div class="rounded-lg">
            <div class="flex flex-col items-start justify-start px-4 py-4 h-52 mb-4" style="background-color: #363131;">
                <p class="text-md text-white">Pages / Transaksi</p>
                <p class="text-lg font-bold text-white">Manajemen Transaksi</p>
            </div>
            
            <div class="flex flex-col justify-around gap-4 mx-10 -mt-32 mb-4 p-8 rounded-xl" style="background-color: var(--card-bg); border: 1px solid var(--border);">
                <div class="flex flex-col gap-6 justify-start items-start p-8 lg:p-0">
                    <h1 class="text-2xl font-bold" style="color: var(--text-primary);">Daftar Transaksi</h1>
                </div>
                
                <!-- Tabel Transaksi -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right" style="color: var(--text-secondary);">
                       <thead class="text-xs uppercase" style="background-color: var(--accent);">
                            <tr>
                                <th class="p-4"><p class="text-md font-bold" style="color: white;">No.</p></th>
                                <th class="px-6 py-3" style="color: white;">Kode Transaksi</th>
                                <th class="px-6 py-3" style="color: white;">Peminjam</th>
                                <th class="px-6 py-3" style="color: white;">Barang</th>
                                <th class="px-6 py-3" style="color: white;">Jumlah</th>
                                <th class="px-6 py-3" style="color: white;">Harga Barang</th>
                                <th class="px-6 py-3" style="color: white;">Denda</th>
                                <th class="px-6 py-3" style="color: white;">Total</th>
                                <th class="px-6 py-3" style="color: white;">Status</th>
                                <th class="px-6 py-3" style="color: white;">Tanggal</th>
                                <th class="px-6 py-3" style="color: white;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse ($transactions as $transaction)
                           @php
                               // Perbaikan perhitungan total: Harga Barang * Jumlah + Denda
                               $hargaSatuan = $transaction->loan->item->price ?? 0;
                               $jumlahBarang = $transaction->loan->amount ?? 1;
                               $totalHargaBarang = $hargaSatuan * $jumlahBarang;
                               $totalBayar = $totalHargaBarang + ($transaction->penalty_amount ?? 0);
                           @endphp
                           <tr class="border-b transition-colors" style="background-color: var(--card-bg); border-color: var(--border);">
                               <td class="w-4 p-4">{{ $loop->iteration }}</td>
                               <td class="px-6 py-4 font-mono text-sm">{{ $transaction->transaction_code }}</td>
                               <td class="px-6 py-4">{{ $transaction->user->name ?? 'Tidak diketahui' }}</td>
                               <td class="px-6 py-4">{{ $transaction->loan->item->name ?? '-' }}</td>
                               <td class="px-6 py-4">{{ $jumlahBarang }}</td>
                               <td class="px-6 py-4">Rp {{ number_format($hargaSatuan, 0, ',', '.') }}</td>
                               <td class="px-6 py-4">Rp {{ number_format($transaction->penalty_amount ?? 0, 0, ',', '.') }}</td>
                               <td class="px-6 py-4 font-bold">Rp {{ number_format($totalBayar, 0, ',', '.') }}</td>
                               <td class="px-6 py-4">
                                   @if($transaction->status == 'paid')
                                       <span class="badge-paid">Lunas</span>
                                   @else
                                       <span class="badge-unpaid">Belum Lunas</span>
                                   @endif
                               </td>
                               <td class="px-6 py-4">{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                               <td class="px-6 py-4">
                                   <button onclick="showDetail({{ $transaction->id }})" class="text-white font-medium rounded-lg text-sm px-3 py-1.5" style="background-color: var(--info);">Detail</button>
                                   @if($transaction->status == 'unpaid')
                                   <button onclick="payTransaction({{ $transaction->id }}, {{ $totalBayar }})" class="text-white font-medium rounded-lg text-sm px-3 py-1.5 ml-2" style="background-color: var(--success);">Bayar</button>
                                   @endif
                                   <button onclick="printStruk({{ $transaction->id }})" class="text-white font-medium rounded-lg text-sm px-3 py-1.5 ml-2" style="background-color: var(--primary);">Cetak</button>
                               </td>
                           </tr>
                           @empty
                           <tr><td colspan="11" class="text-center py-8" style="color: var(--text-muted);">Belum ada data transaksi</td></tr>
                           @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">{{ $transactions->links() }}</div>
            </div>
        </div>
    </div>

   <!-- Modal Detail -->
<div id="detailModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 transform transition-all">
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Detail Transaksi
            </h3>
            <button onclick="closeModal('detailModal')" class="text-gray-600 hover:text-gray-900 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div id="detailContent" class="space-y-3 text-gray-700"></div>
        <div class="flex justify-end mt-6">
            <button onclick="closeModal('detailModal')" class="px-5 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg transition font-medium shadow-sm">Tutup</button>
        </div>
    </div>
</div>

    <!-- MODAL BAYAR -->
<div id="paymentModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 transform transition-all">
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Konfirmasi Pembayaran
            </h3>
            <button onclick="closeModal('paymentModal')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <div class="bg-yellow-50 rounded-xl p-4 mb-4 border-l-4 border-yellow-500">
            <p class="font-semibold text-yellow-800 mb-2">⚠️ Informasi Denda:</p>
            <p class="text-sm text-yellow-700">• Rusak Ringan : <span class="font-bold text-red-600">Rp 50.000</span></p>
            <p class="text-sm text-yellow-700">• Rusak Berat : <span class="font-bold text-red-600">Rp 95.000</span></p>
            <p class="text-sm text-yellow-700">• Hilang : <span class="font-bold text-red-600">Harga Barang (2x lipat)</span></p>
        </div>

        <div class="bg-pink-50 rounded-xl p-4 mb-4 text-center">
            <p class="text-sm text-gray-600">Total Denda yang Harus Dibayar</p>
            <p class="text-2xl font-bold text-red-600" id="totalDenda">Rp 0</p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-800 font-semibold mb-2">🏦 Pilih Metode Pembayaran</label>
            <select id="paymentMethod" class="w-full p-3 border border-gray-300 rounded-xl focus:ring-pink-500 focus:border-pink-500 text-gray-800 bg-white font-medium">
                <option value="cash" class="text-gray-800">💵 Cash / Tunai</option>
                <option value="transfer" class="text-gray-800">🏦 Transfer Bank</option>
            </select>
        </div>

        <div class="flex justify-end gap-3 mt-4">
            <button onclick="closeModal('paymentModal')" class="px-5 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg transition font-semibold text-gray-800">Tutup</button>
            <button onclick="confirmPayment()" class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition font-semibold shadow-md">Konfirmasi & Bayar</button>
        </div>
    </div>
</div>

    <!-- Modal Struk -->
    <div id="receiptModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 transform transition-all">
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Struk Pembayaran
                </h3>
                <button onclick="closeModal('receiptModal')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div id="receiptContent" class="bg-gray-50 rounded-xl p-4"></div>
            <div class="flex justify-end gap-3 mt-6">
                <button onclick="closeModal('receiptModal')" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg transition font-medium">Tutup</button>
                <button onclick="printReceiptNow()" class="px-5 py-2 bg-pink-600 hover:bg-pink-700 text-white rounded-lg transition font-medium shadow-md flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak Struk
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script>
        var currentTransactionId = null;
        var currentPenalty = 0;

        function showModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.getElementById(id).classList.add('flex');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.getElementById(id).classList.remove('flex');
        }

         async function showDetail(id) {
            try {
                let res = await fetch('/transactions/' + id);
                let data = await res.json();
                let totalHargaItem = (data.item_price || 0) * (data.amount || 0);
                let totalBayar = totalHargaItem + (data.penalty_amount || 0);
                let html = `
                    <div class="space-y-3">
                        <div class="flex justify-between border-b pb-2"><span class="font-semibold">Kode Transaksi:</span><span class="font-mono">${data.transaction_code}</span></div>
                        <div class="flex justify-between border-b pb-2"><span class="font-semibold">Peminjam:</span><span>${data.user_name}</span></div>
                        <div class="flex justify-between border-b pb-2"><span class="font-semibold">Barang:</span><span>${data.item_name}</span></div>
                        <div class="flex justify-between border-b pb-2"><span class="font-semibold">Jumlah:</span><span>${data.amount}</span></div>
                        <div class="flex justify-between border-b pb-2"><span class="font-semibold">Harga Satuan:</span><span>Rp ${(data.item_price || 0).toLocaleString('id-ID')}</span></div>
                        <div class="flex justify-between border-b pb-2"><span class="font-semibold">Total Harga Barang:</span><span>Rp ${totalHargaItem.toLocaleString('id-ID')}</span></div>
                        <div class="flex justify-between border-b pb-2"><span class="font-semibold">Kondisi:</span><span>${data.condition_text}</span></div>
                        <div class="flex justify-between border-b pb-2"><span class="font-semibold">Denda:</span><span class="text-red-600 font-bold">Rp ${(data.penalty_amount || 0).toLocaleString('id-ID')}</span></div>
                        <div class="flex justify-between border-b pb-2"><span class="font-semibold">Total Dibayar:</span><span class="text-green-600 font-bold">Rp ${totalBayar.toLocaleString('id-ID')}</span></div>
                        <div class="flex justify-between pt-2"><span class="font-semibold">Status:</span><span class="px-3 py-1 rounded-full text-xs font-bold ${data.status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'}">${data.status === 'paid' ? 'LUNAS' : 'BELUM LUNAS'}</span></div>
                    </div>
                `;
                document.getElementById('detailContent').innerHTML = html;
                showModal('detailModal');
            } catch(e) {
                alert('Gagal ambil detail');
            }
        }
        function payTransaction(id, penalty) {
            currentTransactionId = id;
            currentPenalty = penalty;
            document.getElementById('totalDenda').innerHTML = 'Rp ' + penalty.toLocaleString('id-ID');
            showModal('paymentModal');
        }

        async function confirmPayment() {
            let method = document.getElementById('paymentMethod').value;
            let token = document.querySelector('input[name="_token"]') ? document.querySelector('input[name="_token"]').value : '{{ csrf_token() }}';
            
            try {
                let res = await fetch('/transactions/' + currentTransactionId + '/pay', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
                    body: JSON.stringify({ payment_method: method })
                });
                let result = await res.json();
                if (result.success) {
                    closeModal('paymentModal');
                    showReceiptModal(result.receipt);
                    setTimeout(() => location.reload(), 3000);
                } else {
                    alert(result.message || 'Gagal');
                }
            } catch(e) {
                alert('Error: ' + e.message);
            }
        }

        async function printStruk(id) {
            try {
                let res = await fetch('/transactions/' + id + '/receipt');
                let data = await res.json();
                showReceiptModal(data.receipt);
            } catch(e) {
                alert('Gagal cetak struk');
            }
        }

        function showReceiptModal(data) {
    let totalHargaBarang = (data.item_price || 0) * (data.amount || 0);
    let totalBayar = totalHargaBarang + (data.penalty || 0);
    
    let html = `
        <div class="receipt text-center font-mono text-sm">
            <div class="border-b pb-2 mb-2">
                <h3 class="font-bold text-base">PINJAM ALAT MASAK</h3>
                <p class="text-xs">Jl. Contoh No. 123, Kota Contoh</p>
                <p class="text-xs">Telp: 0812-3456-7890</p>
            </div>
            <h4 class="font-bold mb-2">STRUK PEMBAYARAN</h4>
            <div class="text-left space-y-1 text-xs">
                <div class="flex justify-between"><span>No. Transaksi:</span><span>${data.transaction_number}</span></div>
                <div class="flex justify-between"><span>Tanggal:</span><span>${data.date}</span></div>
                <div class="flex justify-between"><span>Petugas:</span><span>${data.officer}</span></div>
                <div class="border-t border-dashed my-2"></div>
                <div class="flex justify-between"><span>Peminjam:</span><span>${data.borrower}</span></div>
                <div class="flex justify-between"><span>Barang:</span><span>${data.item_name}</span></div>
                <div class="flex justify-between"><span>Jumlah:</span><span>${data.amount}</span></div>
                <div class="flex justify-between"><span>Harga/@:</span><span>Rp ${(data.item_price || 0).toLocaleString('id-ID')}</span></div>
                <div class="flex justify-between"><span>Total Harga:</span><span>Rp ${totalHargaBarang.toLocaleString('id-ID')}</span></div>
                <div class="flex justify-between"><span>Kondisi:</span><span>${data.condition_text}</span></div>
                <div class="border-t border-dashed my-2"></div>
                <div class="flex justify-between"><span>Denda:</span><span>Rp ${(data.penalty || 0).toLocaleString('id-ID')}</span></div>
                <div class="flex justify-between"><span>Metode:</span><span>${data.payment_method === 'cash' ? 'Tunai' : 'Transfer'}</span></div>
                <div class="border-t border-solid my-2"></div>
                <div class="flex justify-between font-bold"><span>TOTAL BAYAR:</span><span>Rp ${totalBayar.toLocaleString('id-ID')}</span></div>
                <div class="border-t border-dashed my-2"></div>
                <p class="text-center text-xs">Terima kasih telah membayar</p>
                <p class="text-center text-xs">Barang harus dikembalikan tepat waktu ❤️</p>
            </div>
        </div>
    `;
    document.getElementById('receiptContent').innerHTML = html;
    showModal('receiptModal');
}

        function printReceiptNow() {
            let content = document.getElementById('receiptContent').innerHTML;
            let win = window.open('', '_blank');
            win.document.write('<html><head><title>Struk Transaksi</title>');
            win.document.write('<style>body{font-family:monospace;margin:0;padding:20px;display:flex;justify-content:center;}.receipt{width:350px;margin:auto;}</style>');
            win.document.write('</head><body>' + content + '</body></html>');
            win.document.close();
            win.print();
        }
    </script>
</body>
</html>