<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Lentora (Alat Masak Realistis)</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/Avatar.png') }}">

    <!-- Flowbite -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    {{-- Link Laravel --}}
    <link href="{{ mix('resources/css/app.css') }}" rel="stylesheet">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        :root {
            --primary: #f163d5;
            --primary-dark: #4f3945;
            --primary-light: #473a34;
            --secondary: #d458b1;
            --accent: #36322b;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #e783cb;
            --background: #2d3238;
            --card-bg: #4c3b44;
            --text-primary: #b5749d;
            --text-secondary: #e8a8cf;
            --text-muted: #2b2f47;
            --border: #323840;
            
            --sidebar-bg: #cea8c3;
            --pink-pekat: #ff1493;
            --hitam: #1a0f14;
            --oren-terang: #ffb347;
            --oren-gelap: #ff8c00;
        }

        body {
            background-color: var(--background);
            color: var(--text-primary);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        .video-container-top {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 40px -12px rgba(0, 0, 0, 0.25);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            margin-bottom: 24px;
        }
        
        .video-container-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 45px -12px rgba(0, 0, 0, 0.35);
        }
        
        .video-container-top video {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 24px;
        }
        
        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.1) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 24px;
            cursor: pointer;
        }
        
        .video-container-top:hover .video-overlay {
            opacity: 1;
        }
        
        .play-icon {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            transition: transform 0.3s ease;
        }
        
        .video-container-top:hover .play-icon {
            transform: scale(1.1);
        }
        
        .sound-control {
            position: absolute;
            bottom: 16px;
            right: 16px;
            z-index: 20;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .sound-control:hover {
            background: rgba(0, 0, 0, 0.9);
            transform: scale(1.1);
        }
        
        .sound-control svg {
            width: 20px;
            height: 20px;
            color: white;
        }

        .grafik-section {
            margin-top: 40px;
            margin-bottom: 20px;
        }
        
        .grafik-card {
            background: var(--card-bg);
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 20px 25px -5px rgba(225, 110, 197, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
            height: 420px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid var(--border);
        }

        .grafik-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 30px -5px rgba(23, 23, 33, 0.1);
        }

        .grafik-wrapper {
            height: 280px;
            width: 100%;
            position: relative;
            margin-top: 10px;
        }

        .grafik-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .grafik-title::before {
            content: '';
            width: 8px;
            height: 8px;
            background: var(--primary);
            border-radius: 50%;
            display: inline-block;
        }

        .grafik-subtitle {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-bottom: 20px;
            padding-left: 16px;
        }

        .grafik-total {
            font-size: 0.875rem;
            color: var(--text-secondary);
            text-align: center;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid var(--border);
        }
        
        .grafik-total span {
            font-weight: 600;
            color: var(--primary);
            background: rgba(61, 45, 54, 0.1);
            padding: 4px 12px;
            border-radius: 20px;
            margin-left: 8px;
        }

        .bg-sidebar {
            background-color: var(--sidebar-bg) !important;
        }

        aside {
            background: var(--sidebar-bg) !important;
            border-right: 1px solid var(--border);
        }

        .sidebar-link-hover-effect:hover {
            background: linear-gradient(135deg, #ff1493 0%, #1a0f14 100%) !important;
            color: white !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-weight: 600;
        }

        .sidebar-link-active-effect {
            background: linear-gradient(135deg, #d81b60 0%, #0a080a 100%) !important;
            color: white !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            border-left: 4px solid #ffb6c1;
            font-weight: 600;
        }

        .logout-link-effect:hover {
            background: linear-gradient(135deg, #ffb347 0%, #ff8c00 100%) !important;
            color: white !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-weight: 600;
        }

        .stat-card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 20px;
            padding: 24px;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 10px 15px -3px rgba(186, 180, 184, 0.2);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(210, 210, 215, 0.3);
        }

        .stat-card .stat-icon {
            background: rgba(132, 9, 87, 0.2);
            border-radius: 16px;
            padding: 12px;
            backdrop-filter: blur(4px);
        }

        .action-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 32px;
            transition: all 0.3s ease;
            cursor: pointer;
            padding: 40px 32px;
            box-shadow: 0 4px 6px -1px rgba(10, 10, 10, 0.05);
        }

        .action-card:hover {
            transform: translateY(-8px);
            border-color: var(--primary-light);
            box-shadow: 0 20px 25px -5px rgba(49, 29, 229, 0.1);
        }

        .action-card .icon-wrapper {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
            border-radius: 28px;
            padding: 20px;
            box-shadow: 0 10px 15px -3px rgba(232, 128, 236, 0.3);
            transition: all 0.3s ease;
        }

        .action-card:hover .icon-wrapper {
            transform: scale(1.1) rotate(3deg);
        }

        .welcome-card {
            background: var(--card-bg);
            border-radius: 32px;
            box-shadow: 0 25px 30px -5px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
        }

        .welcome-card h1 {
            color: var(--text-primary);
            font-size: 2rem;
            font-weight: 700;
        }
    </style>
</head>

<body class="bg-[#f8fafc]">
    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
        type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-9 h-9" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <!-- Sidebar -->
    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform bg-sidebar -translate-x-full sm:translate-x-0 shadow-xl"
        aria-label="Sidebar">
        <div class="h-full flex flex-col justify-normal px-4 py-12 overflow-y-auto bg-sidebar">
            <a href="#" class="flex items-center ps-2.5 mb-10">
                <div class="w-8 h-8 bg-gradient-to-r from-pink-500 to-pink-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </div>
                <span class="self-center text-xl font-semibold whitespace-nowrap ml-3 text-pink-800">PinjamAlatMasak</span>
            </a>
            
            <!-- MENU SESUAI ROLE -->
            @if (auth()->user()->role === 'admin')
                <ul class="space-y-2 py-4 font-medium">
                    <li><a href="{{ route('dashboard') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-active-effect"><svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21"><path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" /><path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" /></svg><span class="ms-3">Dashboard</span></a></li>
                    <li><a href="{{ route('items') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18"><path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" /></svg><span class="flex-1 ms-3 whitespace-nowrap">Inventaris</span></a></li>
                    <li><a href="{{ route('pinjamBarang') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" /></svg><span class="flex-1 ms-3 whitespace-nowrap">Peminjaman</span></a></li>
                    <li><a href="{{ route('transactions') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" /></svg><span class="flex-1 ms-3 whitespace-nowrap">Transaksi</span></a></li>
                    <li><a href="{{ route('users') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18"><path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" /></svg><span class="flex-1 ms-3 whitespace-nowrap">List User</span></a></li>
                    <li><a href="{{ route('logs') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 512 512"><path d="M64 480H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H288c-10.1 0-19.6-4.7-25.6-12.8L243.2 57.6C231.1 41.5 212.1 32 192 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64z"/></svg><span class="flex-1 ms-3 whitespace-nowrap">Log Aktivitas</span></a></li>
                    <li><form method="POST" action="{{ route('logout') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group logout-link-effect">@csrf<svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg><button type="submit" class="flex-1 ms-3 text-left whitespace-nowrap">Logout</button></form></li>
                </ul>
            @elseif (auth()->user()->role === 'petugas')
                <ul class="space-y-2 py-4 font-medium">
                    <li><a href="{{ route('dashboard') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-active-effect"><svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21"><path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" /><path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" /></svg><span class="ms-3">Dashboard</span></a></li>
                    <li><a href="{{ route('items') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18"><path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" /></svg><span class="flex-1 ms-3 whitespace-nowrap">Inventaris</span></a></li>
                    <li><a href="{{ route('pinjamBarang') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" /></svg><span class="flex-1 ms-3 whitespace-nowrap">Peminjaman</span></a></li>
                    <li><a href="{{ route('transactions') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" /></svg><span class="flex-1 ms-3 whitespace-nowrap">Transaksi</span></a></li>
                    <li><a href="{{ route('logs') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 512 512"><path d="M64 480H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H288c-10.1 0-19.6-4.7-25.6-12.8L243.2 57.6C231.1 41.5 212.1 32 192 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64z"/></svg><span class="flex-1 ms-3 whitespace-nowrap">Log Aktivitas</span></a></li>
                    <li><form method="POST" action="{{ route('logout') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group logout-link-effect">@csrf<svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg><button type="submit" class="flex-1 ms-3 text-left whitespace-nowrap">Logout</button></form></li>
                </ul>
            @elseif (auth()->user()->role === 'user')
                <ul class="space-y-2 py-4 font-medium">
                    <li><a href="{{ route('dashboard') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-active-effect"><svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21"><path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" /><path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" /></svg><span class="ms-3">Dashboard</span></a></li>
                    <li><a href="{{ route('pinjamBarang') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" /></svg><span class="flex-1 ms-3 whitespace-nowrap">Peminjaman</span></a></li>
                    <li><a href="{{ route('logs') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group sidebar-link-hover-effect"><svg class="w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 512 512"><path d="M64 480H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H288c-10.1 0-19.6-4.7-25.6-12.8L243.2 57.6C231.1 41.5 212.1 32 192 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64z"/></svg><span class="flex-1 ms-3 whitespace-nowrap">Log Aktivitas</span></a></li>
                    <li><form method="POST" action="{{ route('logout') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group logout-link-effect">@csrf<svg class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg><button type="submit" class="flex-1 ms-3 text-left whitespace-nowrap">Logout</button></form></li>
                </ul>
            @endif
        </div>
    </aside>

    <!-- Content -->
    <div class="sm:ml-64 bg-gray-800 pb-5">
        <div class="rounded-lg">
            <div class="flex flex-col items-start justify-start px-4 py-4 h-72 mb-4" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
                <p class="text-md text-indigo-200">Pages / Home</p>
                <p class="text-lg font-bold text-white">Home</p>
            </div>
            
            <!-- VIDEO ALAT MASAK -->
            <div class="mx-10 -mt-36 mb-4">
                <div class="video-container-top">
                    <video id="cookingVideo" loop>
                        <source src="{{ asset('video/video alat masak.mp4') }}" type="video/mp4">
                        Browser Anda tidak mendukung video tag.
                    </video>
                    <div class="video-overlay" id="videoOverlay">
                        <div class="play-icon">
                            <svg class="w-8 h-8 text-pink-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="sound-control" id="soundControl">
                        <svg id="soundIcon" fill="currentColor" viewBox="0 0 24 24" width="20" height="20">
                            <path d="M3 9v6h4l5 5V4L7 9H3z M16.5 12c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Welcome Card -->
            <div class="welcome-card flex flex-col lg:flex-row items-center justify-between gap-7 mx-10 mb-4 p-8">
                <div class="flex flex-col gap-6 justify-start items-start flex-1">
                    <h1 class="text-3xl font-bold text-gray-100">Welcome, {{ auth()->user()->name }}! 👋</h1>
                    <p class="text-lg text-gray-300">
                        PinjamPro helps you manage your inventory seamlessly, from tracking to updating stock items with ease and elegance.
                    </p>
                    <button onclick="toggleItemsTable()" 
                        class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white font-bold px-8 py-3 rounded-xl hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                        Lihat Semua Barang
                    </button>
                </div>
            </div>
            
            <!-- Tabel Stok Barang -->
            <div id="itemsTable" class="hidden mt-8 mx-10">
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800">📋 Daftar Stok Barang</h3>
                        <button onclick="toggleItemsTable()" class="text-gray-400 hover:text-gray-600 transition-colors p-2 hover:bg-gray-100 rounded-full">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kondisi</th></tr></thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($items as $item)
                                <tr class="hover:bg-gray-50 transition-colors"><td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $loop->iteration }}</td><td class="px-6 py-4"><div class="font-medium text-gray-800">{{ $item->name }}</div></td><td class="px-6 py-4 whitespace-nowrap"><span class="px-3 py-1.5 text-xs font-semibold rounded-full {{ $item->stock > 10 ? 'bg-green-100 text-green-700' : ($item->stock > 5 ? 'bg-yellow-100 text-yellow-700' : ($item->stock > 0 ? 'bg-orange-100 text-orange-700' : 'bg-red-100 text-red-700')) }}">{{ $item->stock }} pcs</span></td><td class="px-6 py-4 whitespace-nowrap">@if($item->kondisi == 'baik')<span class="px-3 py-1.5 text-xs rounded-full bg-green-100 text-green-700 border border-green-200">✅ Baik</span>@elseif($item->kondisi == 'rusak')<span class="px-3 py-1.5 text-xs rounded-full bg-red-100 text-red-700 border border-red-200">❌ Rusak</span>@elseif($item->kondisi == 'perbaikan')<span class="px-3 py-1.5 text-xs rounded-full bg-yellow-100 text-yellow-700 border border-yellow-200">🔧 Perbaikan</span>@else<span class="px-3 py-1.5 text-xs rounded-full bg-gray-100 text-gray-700 border border-gray-200">{{ $item->kondisi ?? '-' }}</span>@endif</tr>
                                @empty
                                <tr><td colspan="4" class="px-6 py-12 text-center text-gray-500"><svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg><p class="text-lg font-medium text-gray-600">Belum ada data barang</p><p class="text-sm text-gray-400 mt-1">Admin perlu menambahkan barang terlebih dahulu.</p></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($items->count() > 0)<div class="mt-8 pt-6 border-t border-gray-100"><div class="grid grid-cols-2 gap-4"><div class="text-center p-4 bg-green-50 rounded-xl"><p class="text-sm text-gray-600 mb-1">Barang Baik</p><p class="text-2xl font-bold text-green-600">{{ $items->where('kondisi', 'baik')->count() }}</p></div><div class="text-center p-4 bg-indigo-50 rounded-xl"><p class="text-sm text-gray-600 mb-1">Total Stok</p><p class="text-2xl font-bold text-indigo-600">{{ $items->sum('stock') }}</p></div></div></div>@endif
                </div>
            </div>

            <!-- Stat Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-{{ auth()->user()->role === 'user' ? '2' : '3' }} gap-6 mb-4 mx-10">
                @if (auth()->user()->role === 'admin' || auth()->user()->role === 'petugas')
                    <div class="stat-card"><div class="flex items-center justify-between"><div><p class="text-sm font-medium text-indigo-100">Seluruh Barang</p><p class="text-3xl font-bold text-white mt-2">{{ $items->count() }}</p></div><div class="stat-icon"><svg width="32" height="32" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.0627 0C2.73571 0 0 2.75099 0 6.07673V35.9233C0 39.249 2.73571 42 6.0627 42H35.9373C39.2643 42 42 39.249 42 35.9233V6.07673C42 2.75099 39.2643 0 35.9373 0H6.0627ZM6.0627 4.20288H14.6973V18.9068C14.7125 20.7659 16.9592 21.6894 18.2783 20.3788L21.0103 17.6685L23.7217 20.3788C25.0408 21.6894 27.2875 20.7659 27.3027 18.9068V4.20288H35.9373C36.9942 4.20288 37.7996 5.02024 37.7996 6.07673V35.9233C37.7996 36.9798 36.9942 37.8012 35.9373 37.8012H6.0627C5.00578 37.8012 4.20451 36.9798 4.20451 35.9233V6.07673C4.20451 5.02024 5.00578 4.20288 6.0627 4.20288ZM18.8977 4.20288H23.1023V13.8387L22.4829 13.2196C21.6636 12.4055 20.3405 12.4055 19.5212 13.2196L18.8977 13.8387L18.8977 4.20288Z" fill="white"/></svg></div></div></div>
                @endif
                <div class="stat-card"><div class="flex items-center justify-between"><div><p class="text-sm font-medium text-indigo-100">Barang Dipinjam</p><p class="text-3xl font-bold text-white mt-2">{{ $borrowItems }}</p></div><div class="stat-icon"><svg width="32" height="32" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.0627 0C2.73571 0 0 2.75099 0 6.07673V35.9233C0 39.249 2.73571 42 6.0627 42H35.9373C39.2643 42 42 39.249 42 35.9233V6.07673C42 2.75099 39.2643 0 35.9373 0H6.0627ZM6.0627 4.20288H14.6973V18.9068C14.7125 20.7659 16.9592 21.6894 18.2783 20.3788L21.0103 17.6685L23.7217 20.3788C25.0408 21.6894 27.2875 20.7659 27.3027 18.9068V4.20288H35.9373C36.9942 4.20288 37.7996 5.02024 37.7996 6.07673V35.9233C37.7996 36.9798 36.9942 37.8012 35.9373 37.8012H6.0627C5.00578 37.8012 4.20451 36.9798 4.20451 35.9233V6.07673C4.20451 5.02024 5.00578 4.20288 6.0627 4.20288ZM18.8977 4.20288H23.1023V13.8387L22.4829 13.2196C21.6636 12.4055 20.3405 12.4055 19.5212 13.2196L18.8977 13.8387L18.8977 4.20288Z" fill="white"/></svg></div></div></div>
                <div class="stat-card"><div class="flex items-center justify-between"><div><p class="text-sm font-medium text-indigo-100">Barang Dikembalikan</p><p class="text-3xl font-bold text-white mt-2">{{ $returnItems }}</p></div><div class="stat-icon"><svg width="32" height="32" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.0627 0C2.73571 0 0 2.75099 0 6.07673V35.9233C0 39.249 2.73571 42 6.0627 42H35.9373C39.2643 42 42 39.249 42 35.9233V6.07673C42 2.75099 39.2643 0 35.9373 0H6.0627ZM6.0627 4.20288H14.6973V18.9068C14.7125 20.7659 16.9592 21.6894 18.2783 20.3788L21.0103 17.6685L23.7217 20.3788C25.0408 21.6894 27.2875 20.7659 27.3027 18.9068V4.20288H35.9373C36.9942 4.20288 37.7996 5.02024 37.7996 6.07673V35.9233C37.7996 36.9798 36.9942 37.8012 35.9373 37.8012H6.0627C5.00578 37.8012 4.20451 36.9798 4.20451 35.9233V6.07673C4.20451 5.02024 5.00578 4.20288 6.0627 4.20288ZM18.8977 4.20288H23.1023V13.8387L22.4829 13.2196C21.6636 12.4055 20.3405 12.4055 19.5212 13.2196L18.8977 13.8387L18.8977 4.20288Z" fill="white"/></svg></div></div></div>
            </div>

            <!-- Action Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-4 mx-10">
                <div class="action-card flex flex-col items-center justify-center"><div class="icon-wrapper mb-6"><svg width="48" height="48" viewBox="0 0 62 62" fill="none" xmlns="http://www.w3.org/2000/svg"><path class="fill-white" d="M58.8829 31.009C58.061 31.009 57.2727 31.3355 56.6915 31.9167C56.1103 32.4979 55.7838 33.2862 55.7838 34.1081V52.7027C55.7838 53.5246 55.4573 54.3129 54.8761 54.8941C54.2949 55.4753 53.5067 55.8018 52.6847 55.8018H9.2973C8.47537 55.8018 7.6871 55.4753 7.10591 54.8941C6.52472 54.3129 6.1982 53.5246 6.1982 52.7027V9.31527C6.1982 8.49334 6.52472 7.70507 7.10591 7.12388C7.6871 6.54269 8.47537 6.21617 9.2973 6.21617H27.8919C28.7138 6.21617 29.5021 5.88966 30.0833 5.30847C30.6645 4.72727 30.991 3.939 30.991 3.11707C30.991 2.29514 30.6645 1.50687 30.0833 0.925675C29.5021 0.344481 28.7138 0.0179696 27.8919 0.0179696H9.2973C6.83151 0.0179696 4.4667 0.997505 2.72312 2.74109C0.979535 4.48467 0 6.84948 0 9.31527V52.7027C0 55.1685 0.979535 57.5333 2.72312 59.2769C4.4667 61.0205 6.83151 62 9.2973 62H52.6847C55.1505 62 57.5153 61.0205 59.2589 59.2769C61.0025 57.5333 61.982 55.1685 61.982 52.7027V34.1081C61.982 33.2862 61.6555 32.4979 61.0743 31.9167C60.4931 31.3355 59.7049 31.009 58.8829 31.009ZM12.3964 33.3643V46.5045C12.3964 47.3264 12.7229 48.1147 13.3041 48.6959C13.8853 49.2771 14.6736 49.6036 15.4955 49.6036H28.6357C29.0436 49.606 29.4479 49.5278 29.8255 49.3736C30.203 49.2193 30.5465 48.9921 30.8361 48.7049L52.2818 27.2281L61.0833 18.6126C61.3738 18.3245 61.6043 17.9817 61.7617 17.6041C61.919 17.2264 62 16.8213 62 16.4122C62 16.0031 61.919 15.598 61.7617 15.2204C61.6043 14.8427 61.3738 14.5 61.0833 14.2119L47.9431 0.916709C47.655 0.626235 47.3122 0.39568 46.9346 0.238342C46.5569 0.0810051 46.1519 0 45.7427 0C45.3336 0 44.9286 0.0810051 44.5509 0.238342C44.1732 0.39568 43.8305 0.626235 43.5424 0.916709L34.8029 9.68717L13.2951 31.1639C13.0079 31.4535 12.7807 31.797 12.6264 32.1745C12.4722 32.5521 12.394 32.9564 12.3964 33.3643ZM45.7427 7.4868L54.5132 16.2573L50.1125 20.658L41.342 11.8875L45.7427 7.4868ZM18.5946 34.6349L36.9723 16.2573L45.7427 25.0277L27.3651 43.4054H18.5946V34.6349Z"/></svg></div><h2 class="text-2xl font-semibold mb-3 text-gray-800">Peminjaman</h2><a href="{{ route('pinjamBarang') }}" class="text-indigo-600 font-bold text-lg hover:text-indigo-700 transition-colors">Klik Disini →</a></div>
                <div class="action-card flex flex-col items-center justify-center"><div class="icon-wrapper mb-6"><svg width="48" height="48" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg"><path class="fill-white" d="M6.0627 0C2.73571 0 0 2.75099 0 6.07673V35.9233C0 39.249 2.73571 42 6.0627 42H35.9373C39.2643 42 42 39.249 42 35.9233V6.07673C42 2.75099 39.2643 0 35.9373 0H6.0627ZM6.0627 4.20288H14.6973V18.9068C14.7125 20.7659 16.9592 21.6894 18.2783 20.3788L21.0103 17.6685L23.7217 20.3788C25.0408 21.6894 27.2875 20.7659 27.3027 18.9068V4.20288H35.9373C36.9942 4.20288 37.7996 5.02024 37.7996 6.07673V35.9233C37.7996 36.9798 36.9942 37.8012 35.9373 37.8012H6.0627C5.00578 37.8012 4.20451 36.9798 4.20451 35.9233V6.07673C4.20451 5.02024 5.00578 4.20288 6.0627 4.20288ZM18.8977 4.20288H23.1023V13.8387L22.4829 13.2196C21.6636 12.4055 20.3405 12.4055 19.5212 13.2196L18.8977 13.8387L18.8977 4.20288Z"/></svg></div><h2 class="text-2xl font-semibold mb-3 text-gray-800">Kembalikan</h2><a href="{{ route('pinjamBarang') }}" class="text-indigo-600 font-bold text-lg hover:text-indigo-700 transition-colors">Klik Disini →</a></div>
            </div>

            <!-- GRAFIK MINGGUAN DINAMIS -->
            <div class="mx-10 grafik-section">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="grafik-card">
                        <div class="grafik-title">📊 Peminjaman Mingguan</div>
                        <div class="grafik-subtitle">Total barang yang dipinjam per minggu (4 minggu terakhir)</div>
                        <div class="grafik-wrapper"><canvas id="borrowChart"></canvas></div>
                        <div class="grafik-total">Total peminjaman: <span id="totalBorrow">{{ $weeklyBorrowData['total'] ?? 0 }}</span> barang</div>
                    </div>
                    <div class="grafik-card">
                        <div class="grafik-title">📈 Pengembalian Mingguan</div>
                        <div class="grafik-subtitle">Total barang yang dikembalikan per minggu (4 minggu terakhir)</div>
                        <div class="grafik-wrapper"><canvas id="returnChart"></canvas></div>
                        <div class="grafik-total">Total pengembalian: <span id="totalReturn">{{ $weeklyReturnData['total'] ?? 0 }}</span> barang</div>
                    </div>
                </div>
                <p class="text-center text-sm text-gray-400 mt-4">* Data statistik peminjaman dan pengembalian 4 minggu terakhir</p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    @if (session('success'))
        <div id="alert-3" class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 1 0 0 2v4h1a1 1 0 0 1 0 2Z"/></svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">{{ session('success') }}</div>
            <button type="button" class="ms-auto bg-green-50 text-green-500 rounded-lg p-1.5 hover:bg-green-100" aria-label="Close"><svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg></button>
        </div>
    @endif 

<script>
    // Video Player Functionality
    const video = document.getElementById('cookingVideo');
    const videoOverlay = document.getElementById('videoOverlay');
    const soundControl = document.getElementById('soundControl');
    let isPlaying = false;
    
    // Set video to muted initially (to allow autoplay)
    video.muted = true;
    
    // Try to play video automatically
    video.play().then(() => {
        isPlaying = true;
        videoOverlay.style.opacity = '0';
        videoOverlay.style.pointerEvents = 'none';
    }).catch(error => {
        console.log('Autoplay prevented:', error);
        isPlaying = false;
        videoOverlay.style.opacity = '1';
        videoOverlay.style.pointerEvents = 'auto';
    });
    
    // Toggle play/pause on overlay click
    function toggleVideoPlay() {
        if (isPlaying) {
            video.pause();
            isPlaying = false;
            videoOverlay.style.opacity = '1';
            videoOverlay.style.pointerEvents = 'auto';
        } else {
            video.play();
            isPlaying = true;
            videoOverlay.style.opacity = '0';
            videoOverlay.style.pointerEvents = 'none';
        }
    }
    
    // Make overlay clickable
    videoOverlay.onclick = toggleVideoPlay;
    
    // Sound control functionality
    let isMuted = true; // Start muted
    const soundIcon = document.getElementById('soundIcon');
    
    soundControl.onclick = function(e) {
        e.stopPropagation();
        if (isMuted) {
            video.muted = false;
            isMuted = false;
            // Change icon to sound on
            soundIcon.innerHTML = '<path d="M3 9v6h4l5 5V4L7 9H3z M16.5 12c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>';
        } else {
            video.muted = true;
            isMuted = true;
            // Change icon to sound off
            soundIcon.innerHTML = '<path d="M3 9v6h4l5 5V4L7 9H3z M16.5 12c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>';
        }
    };
    
// Grafik Batang Sederhana
document.addEventListener('DOMContentLoaded', function() {
    console.log('Dashboard loaded - Simple charts');
    
    // Data dari Laravel
    const weeklyBorrowValues = {!! json_encode($weeklyBorrowData['values'] ?? [12, 8, 15, 10]) !!};
    const weeklyReturnValues = {!! json_encode($weeklyReturnData['values'] ?? [10, 7, 12, 9]) !!};
    
    // Grafik Peminjaman
    const borrowCtx = document.getElementById('borrowChart').getContext('2d');
    new Chart(borrowCtx, {
        type: 'bar',
        data: {
            labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
            datasets: [{
                label: 'Peminjaman',
                data: weeklyBorrowValues,
                backgroundColor: '#f163d5',
                borderColor: '#d458b1',
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.raw + ' barang';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 5
                    },
                    title: {
                        display: true,
                        text: 'Jumlah'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Periode'
                    }
                }
            }
        }
    });
    
    // Grafik Pengembalian
    const returnCtx = document.getElementById('returnChart').getContext('2d');
    new Chart(returnCtx, {
        type: 'bar',
        data: {
            labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
            datasets: [{
                label: 'Pengembalian',
                data: weeklyReturnValues,
                backgroundColor: '#10b981',
                borderColor: '#059669',
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.raw + ' barang';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 5
                    },
                    title: {
                        display: true,
                        text: 'Jumlah'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Periode'
                    }
                }
            }
        }
    });
});

function toggleItemsTable() {
    var itemsTable = document.getElementById('itemsTable');
    if (itemsTable) {
        itemsTable.classList.toggle('hidden');
    }
}
</script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>