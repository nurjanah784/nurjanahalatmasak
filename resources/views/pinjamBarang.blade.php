<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Barang - Lentora</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/Avatar.png') }}">

    <!-- Flowbite -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    {{-- Link Laravel --}}
    <link href="{{ mix('resources/css/app.css') }}" rel="stylesheet">
    
    <!-- CSRF Token for AJAX -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
            --info: #3b82f6;
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
        
        .late-badge {
            background-color: #e65f4c;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            margin-left: 8px;
        }

        /* Button Styles yang diperbaiki */
        .btn-detail, .btn-return, .btn-delete {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .btn-detail {
            background-color: var(--info);
            color: white;
        }
        
        .btn-detail:hover {
            background-color: #2563eb;
            transform: translateY(-1px);
        }
        
        .btn-return {
            background-color: var(--primary);
            color: white;
        }
        
        .btn-return:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
        }
        
        .btn-delete {
            background-color: var(--danger);
            color: white;
        }
        
        .btn-delete:hover {
            background-color: #c82333;
            transform: translateY(-1px);
        }
        
        .status-borrowed {
            color: var(--warning);
        }
        
        .status-returned {
            color: var(--success);
        }

        /* Modal styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .modal-overlay.active {
            display: flex;
        }
        .modal-container {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalFadeIn 0.3s ease;
        }
        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Success Notification */
        .success-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            z-index: 1100;
            animation: slideInRight 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
        .success-notification svg {
            width: 24px;
            height: 24px;
        }
        
        /* Modal Konfirmasi Peminjaman */
        .confirm-modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .confirm-modal-overlay.active {
            display: flex;
        }
        .confirm-modal-container {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 450px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalFadeIn 0.3s ease;
        }
        
        /* Loading spinner */
        .loading-spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid #fff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 0.6s linear infinite;
            margin-right: 8px;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Flex wrapper untuk aksi */
        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        /* Style untuk modal return - teks gelap biar kelihatan */
        .return-modal-content label,
        .return-modal-content select,
        .return-modal-content option {
            color: #1f2937 !important;
        }

        .denda-info-box {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .denda-info-box p {
            color: #92400e !important;
            font-size: 14px;
            margin: 4px 0;
        }

        .denda-info-box .denda-nominal {
            font-weight: bold;
            color: #dc2626 !important;
        }

        /* Teks hitam pada tombol tutup di modal detail */
        .modal-container .close-modal-btn {
            color: #000000 !important;
            font-weight: 500;
        }
        .modal-container .close-modal-btn:hover {
            color: #333333 !important;
        }
        /* Pastikan teks dalam detail content juga nyaman */
        #detailContent p, #detailContent strong {
            color: #1f2937 !important;
        }
        
        /* Style untuk input date */
        input[type="date"] {
            color-scheme: dark;
        }
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            cursor: pointer;
        }

        /* Style untuk Detail Peminjaman seperti Detail Transaksi */
        .detail-transaksi-style {
            font-family: system-ui, -apple-system, sans-serif;
            color: #1f2937;
        }
        .detail-transaksi-style .detail-header {
            border-bottom: 2px solid #e5e7eb;
            margin-bottom: 20px;
            padding-bottom: 8px;
        }
        .detail-transaksi-style .detail-header h4 {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
        }
        .detail-transaksi-style .detail-grid {
            display: grid;
            grid-template-columns: 140px 1fr;
            gap: 12px 8px;
            font-size: 14px;
        }
        .detail-transaksi-style .detail-label {
            font-weight: 600;
            color: #374151;
        }
        .detail-transaksi-style .detail-value {
            color: #111827;
        }
        .detail-transaksi-style .status-borrowed-detail {
            color: #f59e0b;
            font-weight: 500;
        }
        .detail-transaksi-style .status-returned-detail {
            color: #10b981;
            font-weight: 500;
        }
        .detail-transaksi-style .penalty-amount {
            color: #dc2626;
            font-weight: 600;
        }
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
                    <li><a href="{{ route('pinjamBarang') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-active-effect"><svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75" fill="currentColor" viewBox="0 0 20 20"><path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/></svg><span class="flex-1 ms-3 whitespace-nowrap">Peminjaman</span></a></li>
                    <li><a href="{{ route('transactions') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 24 24"><path d="M4 3h16a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm1 2v14h14V5H5zm2 2h10v2H7V7zm0 4h10v2H7v-2zm0 4h7v2H7v-2z"/></svg><span class="flex-1 ms-3 whitespace-nowrap">Transaksi</span></a></li>
                    <li><a href="{{ route('users') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 20 18"><path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/></svg><span class="flex-1 ms-3 whitespace-nowrap">List User</span></a></li>
                    <li><a href="{{ route('logs') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 512 512"><path d="M64 480H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H288c-10.1 0-19.6-4.7-25.6-12.8L243.2 57.6C231.1 41.5 212.1 32 192 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64z"/></svg><span class="flex-1 ms-3 whitespace-nowrap">Log Aktivitas</span></a></li>
                    <li><form method="POST" action="{{ route('logout') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group logout-link-effect">@csrf<svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg><button type="submit" class="flex-1 ms-3 text-left whitespace-nowrap">Logout</button></form></li>
                </ul>
            @elseif (auth()->user()->role === 'petugas')
                <ul class="space-y-2 py-4 font-medium">
                    <li><a href="{{ route('dashboard') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 22 21"><path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/><path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/></svg><span class="ms-3">Dashboard</span></a></li>
                    <li><a href="{{ route('items') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 18 18"><path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/></svg><span class="flex-1 ms-3 whitespace-nowrap">Inventaris</span></a></li>
                    <li><a href="{{ route('pinjamBarang') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-active-effect"><svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75" fill="currentColor" viewBox="0 0 20 20"><path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/></svg><span class="flex-1 ms-3 whitespace-nowrap">Peminjaman</span></a></li>
                    <li><a href="{{ route('transactions') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 24 24"><path d="M4 3h16a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm1 2v14h14V5H5zm2 2h10v2H7V7zm0 4h10v2H7v-2zm0 4h7v2H7v-2z"/></svg><span class="flex-1 ms-3 whitespace-nowrap">Transaksi</span></a></li>
                    <li><a href="{{ route('logs') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 512 512"><path d="M64 480H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H288c-10.1 0-19.6-4.7-25.6-12.8L243.2 57.6C231.1 41.5 212.1 32 192 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64z"/></svg><span class="flex-1 ms-3 whitespace-nowrap">Log Aktivitas</span></a></li>
                    <li><form method="POST" action="{{ route('logout') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group logout-link-effect">@csrf<svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg><button type="submit" class="flex-1 ms-3 text-left whitespace-nowrap">Logout</button></form></li>
                </ul>
            @elseif (auth()->user()->role === 'user')
                <ul class="space-y-2 py-4 font-medium">
                    <li><a href="{{ route('dashboard') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 22 21"><path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/><path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/></svg><span class="ms-3">Dashboard</span></a></li>
                    <li><a href="{{ route('pinjamBarang') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-active-effect"><svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75" fill="currentColor" viewBox="0 0 20 20"><path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/></svg><span class="flex-1 ms-3 whitespace-nowrap">Peminjaman</span></a></li>
                    <li><a href="{{ route('logs') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 512 512"><path d="M64 480H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H288c-10.1 0-19.6-4.7-25.6-12.8L243.2 57.6C231.1 41.5 212.1 32 192 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64z"/></svg><span class="flex-1 ms-3 whitespace-nowrap">Log Aktivitas</span></a></li>
                    <li><form method="POST" action="{{ route('logout') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group logout-link-effect">@csrf<svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" fill="currentColor" viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg><button type="submit" class="flex-1 ms-3 text-left whitespace-nowrap">Logout</button></form></li>
                </ul>
            @endif
        </div>
    </aside>

    <!-- Content -->
    <div class="sm:ml-64 pb-5" style="background-color: var(--background);">
        <div class="rounded-lg">
            <div class="flex flex-col items-start justify-start px-4 py-4 h-72 mb-4" style="background-color: #363131;">
                <p class="text-md text-white">Pages / Peminjaman Barang</p>
                <p class="text-lg font-bold text-white">Peminjaman Barang</p>
            </div>
            
            <!-- List Peminjaman -->
            <div class="flex flex-col justify-around gap-4 mx-10 -mt-36 mb-4 p-8 rounded-xl" style="background-color: var(--card-bg); border: 1px solid var(--border);">
                <div class="flex flex-col gap-6 justify-start items-start p-8 lg:p-0">
                    <h1 class="text-2xl font-bold" style="color: var(--text-primary);">List Peminjaman</h1>
                </div>
                
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="pb-4" style="background-color: var(--card-bg);">
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4" style="color: var(--text-muted);" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/></svg>
                            </div>
                            <input type="text" id="table-search" class="block pt-2 ps-10 text-sm rounded-lg w-80 focus:ring-2 focus:border-transparent" style="background-color: var(--background); border: 1px solid var(--border); color: var(--text-primary);" placeholder="Cari barang...">
                        </div>
                    </div>
                    
                    <table class="w-full text-sm text-left rtl:text-right" style="color: var(--text-secondary);">
                        <thead class="text-xs uppercase" style="background-color: var(--accent);">
                            <tr>
                                <th class="p-4"><p class="text-md font-bold" style="color: white;">No.</p></th>
                                @if(in_array(auth()->user()->role, ['admin', 'petugas']))
                                    <th class="px-6 py-3" style="color: white;">Peminjam</th>
                                @endif
                                <th class="px-6 py-3" style="color: white;">Nama Barang</th>
                                <th class="px-6 py-3" style="color: white;">Jumlah</th>
                                <th class="px-6 py-3" style="color: white;">Status</th>
                                <th class="px-6 py-3" style="color: white;">Tanggal Pinjam</th>
                                <th class="px-6 py-3" style="color: white;">Batas Kembali</th>
                                <th class="px-6 py-3" style="color: white;">Tgl Kembali</th>
                                <th class="px-6 py-3" style="color: white;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loans as $loan)
                            @php
                                $isLate = false;
                                $lateDays = 0;
                                if ($loan->status == 'borrowed' && $loan->return_due_date) {
                                    $dueDate = \Carbon\Carbon::parse($loan->return_due_date);
                                    $now = \Carbon\Carbon::now();
                                    if ($now->greaterThan($dueDate)) {
                                        $isLate = true;
                                        $lateDays = $dueDate->diffInDays($now);
                                    }
                                }
                            @endphp
                            <tr class="border-b transition-colors" style="background-color: var(--card-bg); border-color: var(--border);" id="loan-row-{{ $loan->id }}">
                                <td class="w-4 p-4">{{ $loop->iteration }}</td>
                                @if(in_array(auth()->user()->role, ['admin', 'petugas']))
                                    <td class="px-6 py-4 font-medium" style="color: var(--text-primary);">
                                        {{ $loan->user ? $loan->user->name : 'Tidak diketahui' }}
                                    </td>
                                @endif
                                <th class="px-6 py-4 font-medium whitespace-nowrap" style="color: var(--text-primary);">{{ $loan->item->name }}</th>
                                <td class="px-6 py-4">{{ $loan->amount }}</td>
                                <td class="px-6 py-4" id="status-cell-{{ $loan->id }}">
                                    @if($loan->status == 'borrowed')
                                        <span class="status-borrowed">Dipinjam</span>
                                        @if($isLate)
                                            <span class="late-badge">Terlambat {{ $lateDays }} hari</span>
                                        @endif
                                    @else
                                        <span class="status-returned">Dikembalikan</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($loan->borrow_date)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    @if($loan->return_due_date)
                                        <span class="{{ $isLate ? 'text-red-400' : '' }}">{{ \Carbon\Carbon::parse($loan->return_due_date)->format('d/m/Y') }}</span>
                                    @else
                                        <span style="color: var(--text-muted);">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4" id="return-date-cell-{{ $loan->id }}">
                                    @if($loan->return_date)
                                        {{ \Carbon\Carbon::parse($loan->return_date)->format('d/m/Y') }}
                                    @else
                                        <span style="color: var(--text-muted);">Belum</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4" id="action-cell-{{ $loan->id }}">
                                    <div class="action-buttons">
                                        <button onclick="showDetail({{ $loan->id }})" class="btn-detail">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Detail
                                        </button>
                                        
                                        @if ($loan->status == 'borrowed')
                                            @if(in_array(auth()->user()->role, ['admin', 'petugas']))
                                                <button data-modal-target="return-modal-{{ $loan->id }}" data-modal-toggle="return-modal-{{ $loan->id }}" class="btn-return">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                                    </svg>
                                                    Kembalikan
                                                </button>
                                            @endif
                                        @elseif ($loan->status == 'returned')
                                            <button onclick="deleteLoan({{ $loan->id }})" class="btn-delete">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Hapus
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Form Peminjaman untuk User -->
            @if(auth()->user()->role === 'user')
            <div class="flex flex-col justify-around gap-4 mx-10 mb-4 p-8 rounded-xl" style="background-color: var(--card-bg); border: 1px solid var(--border);">
                <h1 class="text-2xl font-bold" style="color: var(--primary);">Tambah Peminjaman</h1>
                <form id="borrowForm" action="{{ route('items.borrow') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-2">Pilih Barang</label>
                        <select name="item_id" id="item_id" class="w-full p-2 rounded-lg" style="background-color: var(--background); border: 1px solid var(--border); color: var(--text-primary);" required>
                            <option value="">Pilih Barang</option>
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}" data-stock="{{ $item->stock }}">{{ $item->name }} (Stok: {{ $item->stock }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Jumlah</label>
                        <input type="number" name="amount" id="amount" class="w-full p-2 rounded-lg" style="background-color: var(--background); border: 1px solid var(--border); color: var(--text-primary);" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Keterangan</label>
                        <input type="text" name="description" id="description" class="w-full p-2 rounded-lg" style="background-color: var(--background); border: 1px solid var(--border); color: var(--text-primary);" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Batas Tanggal Kembali</label>
                        <input type="date" name="return_due_date" id="return_due_date" 
                               class="w-full p-2 rounded-lg" 
                               style="background-color: var(--background); border: 1px solid var(--border); color: var(--text-primary);" 
                               min="{{ now()->addDay()->format('Y-m-d') }}"
                               value="{{ now()->addDays(7)->format('Y-m-d') }}"
                               required>
                        <p class="text-xs mt-1" style="color: var(--text-muted);">Minimal 1 hari dari sekarang (default 7 hari)</p>
                    </div>
                    <input type="hidden" name="user" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="borrow_date" value="{{ now()->format('Y-m-d') }}">
                    <button type="submit" class="text-white font-medium rounded-lg text-sm px-5 py-2.5" style="background-color: var(--secondary);">Pinjam</button>
                </form>
            </div>
            @endif
        </div>
    </div>

    <!-- Audio Element untuk Sound Effect -->
    <audio id="successSound" src="{{ asset('assets/sound/sound1.wav') }}" preload="auto"></audio>

    <!-- Modal Konfirmasi Peminjaman -->
    <div id="confirmBorrowModal" class="confirm-modal-overlay">
        <div class="confirm-modal-container">
            <div class="bg-white rounded-lg w-full max-w-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">📋 Konfirmasi Peminjaman</h3>
                    <button onclick="closeConfirmBorrowModal()" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
                </div>
                <div id="confirmBorrowContent" class="text-gray-700"></div>
                <div class="flex justify-end gap-3 mt-6">
                    <button onclick="closeConfirmBorrowModal()" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Batal</button>
                    <button id="confirmBorrowBtn" class="px-4 py-2 text-white rounded-lg flex items-center" style="background-color: var(--primary);">✅ Ya, Pinjam!</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail dengan teks tombol tutup hitam -->
    <div id="detailModal" class="modal-overlay">
        <div class="modal-container">
            <div class="bg-white rounded-lg w-full max-w-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Detail Peminjaman</h3>
                    <button onclick="closeDetailModal()" class="text-gray-800 hover:text-gray-900 text-2xl close-modal-btn">&times;</button>
                </div>
                <div id="detailContent"></div>
                <div class="flex justify-end mt-4">
                    <button onclick="closeDetailModal()" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 text-gray-800 close-modal-btn">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Return untuk setiap peminjaman (dengan denda baru: ringan 50k, berat 95k) -->
    @foreach ($loans as $loan)
    <div id="return-modal-{{ $loan->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-xl shadow-lg return-modal-content">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Konfirmasi Pengembalian
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="return-modal-{{ $loan->id }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <form action="{{ route('items.return', $loan->id) }}" method="POST" class="p-4 md:p-5 return-form" data-loan-id="{{ $loan->id }}" data-ajax="true">
                    @csrf
                    @method('PUT')
                    
                    <!-- Info Denda dengan nominal baru: Rusak Ringan 50.000, Rusak Berat 95.000 -->
                    <div class="denda-info-box mb-4">
                        <p class="font-semibold">⚠️ Informasi Denda:</p>
                        <p>• Rusak Ringan : <span class="denda-nominal">Rp 50.000</span></p>
                        <p>• Rusak Berat  : <span class="denda-nominal">Rp 95.000</span></p>
                        <p>• Hilang       : <span class="denda-nominal">Harga Barang (2x lipat)</span></p>
                    </div>
                    
                    <div class="mb-5">
                        <label class="block text-gray-800 font-semibold mb-2">Kondisi Barang</label>
                        <select name="condition" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 condition-select text-gray-800" required>
                            <option value="good">✅ Baik (Tanpa Denda)</option>
                            <option value="light_damage">⚠️ Rusak Ringan (Denda Rp 50.000)</option>
                            <option value="heavy_damage">❌ Rusak Berat (Denda Rp 95.000)</option>
                            <option value="lost">💔 Hilang (Denda Harga Barang x2)</option>
                        </select>
                    </div>
                    
                    <div class="mb-5 payment_method_container" style="display: none;">
                        <label class="block text-gray-800 font-semibold mb-2">Metode Pembayaran Denda</label>
                        <select name="payment_method" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 text-gray-800">
                            <option value="cash">💵 Tunai</option>
                            <option value="transfer">🏦 Transfer Bank</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="w-full text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all hover:opacity-90" style="background-color: var(--primary);">
                        ✅ Konfirmasi Kembali
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script>
        // ======================== KONFIRMASI PEMINJAMAN ========================
        let pendingBorrowData = null;
        
        // Sound effect
        const successSound = document.getElementById('successSound');
        
        function playSuccessSound() {
            if (successSound) {
                successSound.currentTime = 0;
                successSound.play().catch(error => {
                    console.log('Audio playback failed:', error);
                });
            }
        }
        
        // Notifikasi sukses
        function showSuccessNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'success-notification';
            notification.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>${message || '✅ Berhasil meminjam barang!'}</span>
            `;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }
        
        // INTERCEPT form submission
        const borrowForm = document.getElementById('borrowForm');
        if (borrowForm) {
            borrowForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const itemSelect = document.getElementById('item_id');
                const amountInput = document.getElementById('amount');
                const descriptionInput = document.getElementById('description');
                const returnDueDateInput = document.getElementById('return_due_date');
                
                if (!itemSelect.value) {
                    alert('Silakan pilih barang terlebih dahulu');
                    return;
                }
                
                if (!amountInput.value || amountInput.value <= 0) {
                    alert('Silakan masukkan jumlah yang valid');
                    return;
                }
                
                if (!descriptionInput.value.trim()) {
                    alert('Silakan isi keterangan');
                    return;
                }
                
                if (!returnDueDateInput.value) {
                    alert('Silakan pilih batas tanggal kembali');
                    return;
                }
                
                const selectedOption = itemSelect.options[itemSelect.selectedIndex];
                const stock = parseInt(selectedOption.dataset.stock);
                const requestedAmount = parseInt(amountInput.value);
                
                if (requestedAmount > stock) {
                    alert(`Stok tidak mencukupi! Stok tersedia: ${stock}`);
                    return;
                }
                
                pendingBorrowData = {
                    item_id: itemSelect.value,
                    item_name: selectedOption.text.split(' (Stok:')[0],
                    amount: requestedAmount,
                    description: descriptionInput.value.trim(),
                    return_due_date: returnDueDateInput.value
                };
                
                const formattedReturnDate = new Date(returnDueDateInput.value).toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                
                const confirmHtml = `
                    <div class="space-y-3">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="font-semibold text-gray-800 mb-2">📦 Detail Peminjaman:</p>
                            <p><strong>Barang:</strong> ${pendingBorrowData.item_name}</p>
                            <p><strong>Jumlah:</strong> ${pendingBorrowData.amount} unit</p>
                            <p><strong>Keterangan:</strong> ${pendingBorrowData.description}</p>
                            <p><strong>Tanggal Pinjam:</strong> ${new Date().toLocaleDateString('id-ID')}</p>
                            <p><strong>Batas Kembali:</strong> ${formattedReturnDate}</p>
                        </div>
                        <div class="bg-yellow-50 p-3 rounded-lg border border-yellow-200">
                            <p class="text-sm text-yellow-800">⚠️ <strong>Perhatian:</strong></p>
                            <p class="text-sm text-yellow-700">Pastikan data yang diisi sudah benar. Barang harus dikembalikan tepat waktu.</p>
                        </div>
                    </div>
                `;
                
                document.getElementById('confirmBorrowContent').innerHTML = confirmHtml;
                document.getElementById('confirmBorrowModal').classList.add('active');
            });
        }
        
        // Tombol konfirmasi
        const confirmBtn = document.getElementById('confirmBorrowBtn');
        if (confirmBtn) {
            confirmBtn.addEventListener('click', function() {
                if (!pendingBorrowData) return;
                
                // MAININ SUARA!
                playSuccessSound();
                
                const originalText = confirmBtn.innerHTML;
                confirmBtn.innerHTML = '<span class="loading-spinner"></span> Memproses...';
                confirmBtn.disabled = true;
                
                const form = document.getElementById('borrowForm');
                const formData = new FormData(form);
                
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    confirmBtn.innerHTML = originalText;
                    confirmBtn.disabled = false;
                    
                    if (data.success) {
                        closeConfirmBorrowModal();
                        showSuccessNotification(data.message || '✅ Berhasil meminjam barang!');
                        form.reset();
                        
                        // Reset default value
                        document.getElementById('return_due_date').value = '{{ now()->addDays(7)->format("Y-m-d") }}';
                        
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        alert(data.message || 'Gagal meminjam barang');
                    }
                })
                .catch(error => {
                    confirmBtn.innerHTML = originalText;
                    confirmBtn.disabled = false;
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memproses peminjaman');
                });
                
                pendingBorrowData = null;
            });
        }
        
        function closeConfirmBorrowModal() {
            document.getElementById('confirmBorrowModal').classList.remove('active');
            pendingBorrowData = null;
        }
        
        const confirmModal = document.getElementById('confirmBorrowModal');
        if (confirmModal) {
            confirmModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeConfirmBorrowModal();
                }
            });
        }
        
        // ======================== SEARCH ========================
        var searchInput = document.getElementById('table-search');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                var searchTerm = this.value.toLowerCase();
                var rows = document.querySelectorAll('tbody tr');
                for (var i = 0; i < rows.length; i++) {
                    var nameCell = rows[i].querySelector('th');
                    var name = nameCell ? nameCell.textContent.toLowerCase() : '';
                    rows[i].style.display = name.includes(searchTerm) ? '' : 'none';
                }
            });
        }
        
        // ======================== DETAIL (Tema seperti Detail Transaksi) ========================
        function showDetail(id) {
            fetch(`/loans/${id}`)
                .then(response => response.json())
                .then(data => {
                    const statusText = data.status === 'borrowed' ? 'Dipinjam' : 'Dikembalikan';
                    const statusClass = data.status === 'borrowed' ? 'status-borrowed-detail' : 'status-returned-detail';
                    
                    const html = `
                        <div class="detail-transaksi-style">
                            <div class="detail-header">
                                <h4>📋 Detail Peminjaman</h4>
                            </div>
                            <div class="detail-grid">
                                <div class="detail-label">Peminjam:</div>
                                <div class="detail-value">${data.borrower_name || 'Tidak diketahui'}</div>
                                
                                <div class="detail-label">Barang:</div>
                                <div class="detail-value">${data.item_name}</div>
                                
                                <div class="detail-label">Jumlah:</div>
                                <div class="detail-value">${data.amount}</div>
                                
                                <div class="detail-label">Status:</div>
                                <div class="${statusClass}">${statusText}</div>
                                
                                <div class="detail-label">Tanggal Pinjam:</div>
                                <div class="detail-value">${data.borrow_date}</div>
                                
                                <div class="detail-label">Batas Kembali:</div>
                                <div class="detail-value">${data.return_due_date || '-'}</div>
                                
                                <div class="detail-label">Tanggal Kembali:</div>
                                <div class="detail-value">${data.return_date || 'Belum'}</div>
                                
                                <div class="detail-label">Keterangan:</div>
                                <div class="detail-value">${data.description || '-'}</div>
                                ${data.condition ? `
                                <div class="detail-label">Kondisi:</div>
                                <div class="detail-value">${data.condition_text}</div>
                                ` : ''}
                                ${data.penalty_amount > 0 ? `
                                <div class="detail-label">Denda:</div>
                                <div class="detail-value penalty-amount">Rp ${data.penalty_amount.toLocaleString('id-ID')}</div>
                                ` : ''}
                            </div>
                        </div>
                    `;
                    document.getElementById('detailContent').innerHTML = html;
                    document.getElementById('detailModal').classList.add('active');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal mengambil detail peminjaman');
                });
        }
        
        function closeDetailModal() {
            document.getElementById('detailModal').classList.remove('active');
        }
        
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDetailModal();
            }
        });
        
        // ======================== DELETE ========================
        function deleteLoan(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data peminjaman ini? Tindakan ini tidak dapat dibatalkan.')) {
                fetch(`/loans/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const row = document.getElementById(`loan-row-${id}`);
                        if (row) {
                            row.remove();
                        }
                        alert('Data peminjaman berhasil dihapus');
                    } else {
                        alert('Gagal menghapus data: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus data');
                });
            }
        }
        
        // ======================== RETURN dengan denda baru 50k & 95k ========================
        document.querySelectorAll('.condition-select').forEach(select => {
            select.addEventListener('change', function() {
                const container = this.closest('form').querySelector('.payment_method_container');
                if (this.value !== 'good') {
                    container.style.display = 'block';
                } else {
                    container.style.display = 'none';
                }
            });
        });

        document.querySelectorAll('.return-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const loanId = this.dataset.loanId;
                const actionUrl = this.action;
                
                fetch(actionUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (data.has_penalty && data.receipt) {
                            let receiptMsg = '==================================\n';
                            receiptMsg += '         STRUK PEMBAYARAN         \n';
                            receiptMsg += '==================================\n';
                            receiptMsg += `No. Transaksi : ${data.receipt.transaction_number}\n`;
                            receiptMsg += `Tanggal       : ${data.receipt.date}\n`;
                            receiptMsg += `Petugas       : ${data.receipt.officer}\n`;
                            receiptMsg += `Peminjam      : ${data.receipt.borrower}\n`;
                            receiptMsg += `Barang        : ${data.receipt.item_name}\n`;
                            receiptMsg += `Jumlah        : ${data.receipt.amount}\n`;
                            receiptMsg += `Kondisi       : ${data.receipt.condition_text}\n`;
                            receiptMsg += `Denda         : Rp ${data.receipt.penalty.toLocaleString('id-ID')}\n`;
                            receiptMsg += `Metode Bayar  : ${data.receipt.payment_method === 'cash' ? 'Tunai' : 'Transfer Bank'}\n`;
                            receiptMsg += '==================================\n';
                            receiptMsg += data.message;
                            alert(receiptMsg);
                        } else {
                            alert(data.message);
                        }
                        
                        const row = document.getElementById(`loan-row-${loanId}`);
                        const statusCell = document.getElementById(`status-cell-${loanId}`);
                        const returnDateCell = document.getElementById(`return-date-cell-${loanId}`);
                        const actionCell = document.getElementById(`action-cell-${loanId}`);
                        
                        if (statusCell) {
                            statusCell.innerHTML = '<span class="status-returned">Dikembalikan</span>';
                        }
                        
                        if (returnDateCell) {
                            const today = new Date();
                            const formattedDate = today.toLocaleDateString('id-ID');
                            returnDateCell.innerHTML = formattedDate;
                        }
                        
                        if (actionCell) {
                            actionCell.innerHTML = `
                                <div class="action-buttons">
                                    <button onclick="showDetail(${loanId})" class="btn-detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Detail
                                    </button>
                                    <button onclick="deleteLoan(${loanId})" class="btn-delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            `;
                        }
                        
                        const modal = document.getElementById(`return-modal-${loanId}`);
                        if (modal) {
                            const closeButton = modal.querySelector('[data-modal-toggle]');
                            if (closeButton) closeButton.click();
                        }
                    } else {
                        alert(data.message || 'Terjadi kesalahan saat mengembalikan barang');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memproses pengembalian');
                });
            });
        });
    </script>
</body>
</html>