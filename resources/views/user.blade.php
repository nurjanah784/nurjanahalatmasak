<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Lentora</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/Avatar.png') }}">

    <!-- Flowbite -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    {{-- Link Laraval --}}
    <link href="{{ mix('resources/css/app.css') }}" rel="stylesheet">
    
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
            --text-primary: #5b4453;
            --text-secondary: #ece5e9;
            --text-muted: #eaebed;
            --border: #f5f7fa;
            --sidebar-bg: #cea8c3;
            --hover-bg: #dee7f0;
            
            /* Warna untuk gradasi sidebar */
            --pink-pekat: #ff1493;
            --hitam: #1a0f14;
            --oren-terang: #ffb347;
            --oren-gelap: #ff8c00;
        }

        body {
            background-color: var(--background);
        }

        .bg-primary {
            background-color: var(--primary) !important;
        }
        
        .bg-primary-dark {
            background-color: var(--primary-dark) !important;
        }
        
        .bg-primary-light {
            background-color: var(--primary-light) !important;
        }
        
        .bg-secondary {
            background-color: var(--secondary) !important;
        }
        
        .bg-accent {
            background-color: var(--accent) !important;
        }
        
        .bg-sidebar {
            background-color: var(--sidebar-bg) !important;
        }
        
        .bg-card {
            background-color: var(--card-bg) !important;
        }
        
        .bg-hover {
            background-color: var(--hover-bg) !important;
        }
        
        .text-primary {
            color: var(--primary) !important;
        }
        
        .text-secondary {
            color: var(--secondary) !important;
        }
        
        .text-text-primary {
            color: var(--text-primary) !important;
        }
        
        .text-text-secondary {
            color: var(--text-secondary) !important;
        }
        
        .text-text-muted {
            color: var(--text-muted) !important;
        }
        
        .border-custom {
            border-color: var(--border) !important;
        }
        
        .hover\:bg-primary:hover {
            background-color: var(--primary) !important;
        }
        
        .hover\:bg-secondary:hover {
            background-color: var(--secondary) !important;
        }
        
        .hover\:bg-hover:hover {
            background-color: var(--hover-bg) !important;
        }
        
        .hover\:text-primary:hover {
            color: var(--primary) !important;
        }
        
        .hover\:text-secondary:hover {
            color: var(--secondary) !important;
        }
        
        .text-info {
            color: var(--info) !important;
        }
        
        .bg-info {
            background-color: var(--info) !important;
        }
        
        /* ========== STYLE SIDEBAR YANG DISAMAKAN ========== */
        /* Background sidebar - PINK SOFT SOLID */
        aside, .bg-sidebar {
            background-color: #fbeaff !important;
        }
        
        /* Wrapper sidebar container */
        #logo-sidebar {
            background-color: #fbeaff !important;
        }
        
        /* Sidebar text dan ikon default */
        .sidebar-link span {
            color: #000000 !important;
            transition: color 0.3s ease;
        }
        
        .sidebar-link svg {
            color: #ff69b4 !important;
            transition: color 0.3s ease;
        }
        
        /* Efek hover dengan gradasi PINK ke HITAM */
        .sidebar-link-hover-effect:hover {
            background: linear-gradient(135deg, #ff1493 0%, #1a0f14 100%) !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-weight: 600;
        }
        
        .sidebar-link-hover-effect:hover span,
        .sidebar-link-hover-effect:hover svg {
            color: white !important;
        }
        
        /* Efek active dengan gradasi PINK lebih gelap ke HITAM */
        .sidebar-link-active-effect {
            background: linear-gradient(135deg, #d81b60 0%, #0a080a 100%) !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            border-left: 4px solid #ffb6c1;
            font-weight: 600;
        }
        
        .sidebar-link-active-effect span,
        .sidebar-link-active-effect svg {
            color: white !important;
        }
        
        /* KHUSUS LOGOUT - OREN */
        .logout-link-effect:hover {
            background: linear-gradient(135deg, #ffb347 0%, #ff8c00 100%) !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-weight: 600;
        }
        
        .logout-link-effect:hover span,
        .logout-link-effect:hover svg,
        .logout-link-effect:hover button {
            color: white !important;
        }
        
        /* Warna default logout - ikon PINK, teks HITAM */
        .logout-link-effect svg {
            color: #ff69b4 !important;
        }
        
        .logout-link-effect span,
        .logout-link-effect button {
            color: #000000 !important;
        }
        
        /* Teks logo tetap HITAM */
        .logo-text {
            color: #000000 !important;
        }
        
        /* Ikon logo (kotak-kotak) PINK */
        .logo-icon {
            background: linear-gradient(135deg, #ff69b4, #ff1493) !important;
            border-radius: 8px;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Sidebar link umum */
        .sidebar-link {
            transition: all 0.3s ease;
        }
        
        /* Hover background untuk menu biasa (tanpa class) */
        aside a:not(.sidebar-link-active-effect):hover {
            background: linear-gradient(135deg, #ff1493 0%, #1a0f14 100%) !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        aside a:not(.sidebar-link-active-effect):hover span,
        aside a:not(.sidebar-link-active-effect):hover svg {
            color: white !important;
        }
        
        /* Hover untuk logout form */
        aside form:hover {
            background: linear-gradient(135deg, #ffb347 0%, #ff8c00 100%) !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        aside form:hover span,
        aside form:hover svg,
        aside form:hover button {
            color: white !important;
        }
        
        /* ========== AKHIR STYLE SIDEBAR ========== */
        
        /* Custom styles untuk komponen lainnya */
        aside .bg-gray-50 {
            background-color: #fbeaff !important;
        }
        
        .bg-\[\#F4F4F4\] {
            background-color: #fbeaff !important;
        }
        
        .bg-\[\#EEEEEE\] {
            background-color: var(--background) !important;
        }
        
        .bg-white {
            background-color: var(--card-bg) !important;
        }
        
        .text-gray-900 {
            color: var(--text-primary) !important;
        }
        
        .text-gray-700 {
            color: var(--text-secondary) !important;
        }
        
        .text-gray-500 {
            color: var(--text-muted) !important;
        }
        
        .border-gray-200, .border-gray-300 {
            border-color: var(--border) !important;
        }
        
        .hover\:bg-gray-100:hover {
            background-color: var(--hover-bg) !important;
        }
        
        .hover\:bg-gray-50:hover {
            background-color: var(--hover-bg) !important;
        }
        
        .bg-gray-50 {
            background-color: var(--card-bg) !important;
        }
        
        /* Style untuk tombol */
        .bg-blue-700 {
            background-color: var(--primary) !important;
        }
        
        .hover\:bg-blue-800:hover {
            background-color: var(--primary-dark) !important;
        }
        
        .text-blue-600 {
            color: var(--info) !important;
        }
        
        .hover\:text-blue-700:hover {
            color: var(--secondary) !important;
        }
        
        .focus\:ring-blue-500:focus {
            --tw-ring-color: var(--primary) !important;
        }
        
        .focus\:border-blue-500:focus {
            border-color: var(--primary) !important;
        }
        
        /* Style untuk alert */
        .bg-green-50 {
            background-color: rgba(16, 185, 129, 0.1) !important;
        }
        
        .text-green-800 {
            color: var(--success) !important;
        }
        
        .bg-red-50 {
            background-color: rgba(239, 68, 68, 0.1) !important;
        }
        
        .text-red-800 {
            color: var(--danger) !important;
        }
        
        /* Style untuk modal */
        .bg-white.rounded-lg.shadow {
            background-color: var(--card-bg) !important;
        }
        
        /* Style untuk tabel */
        thead.bg-gray-50 {
            background-color: var(--primary-dark) !important;
        }
        
        thead th {
            color: var(--text-secondary) !important;
        }
        
        tbody tr.bg-white {
            background-color: var(--card-bg) !important;
        }
        
        tbody tr:hover {
            background-color: var(--hover-bg) !important;
        }
        
        /* Style untuk text */
        .text-black {
            color: var(--text-primary) !important;
        }
        
        /* Style untuk search input */
        #table-search {
            background-color: var(--card-bg);
            border-color: var(--border);
            color: var(--text-primary);
        }
        
        #table-search::placeholder {
            color: var(--text-muted);
        }
        
        /* Style untuk link di sidebar lama - overwrite */
        .hover\:bg-secondary:hover {
            background-color: var(--secondary) !important;
        }
        
        .hover\:bg-primary:hover {
            background-color: var(--primary) !important;
        }
        
        .hover\:bg-red-600:hover {
            background-color: var(--danger) !important;
        }
        
        /* Style untuk icon */
        .text-primary {
            color: var(--primary) !important;
        }
        
        .group:hover .group-hover\:text-white {
            color: white !important;
        }

        /* ===== KOLOM KANAN - HITAM SOFT CAMPUR PINK ===== */
        .bg-background {
            background-color: #1E1A23 !important;
        }
        
        .bg-secondary {
            background: linear-gradient(135deg, #4A3B44 0%, #2F2530 100%) !important;
            background-color: #3F2E38 !important;
        }
        
        .rounded-xl.bg-card {
            background-color: #2A232C !important;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.4), 0 8px 10px -6px rgba(0, 0, 0, 0.25) !important;
        }
        
        .text-2xl.font-bold.text-text-primary {
            color: #F5E6F0 !important;
        }
        
        button.bg-primary {
            background-color: #C97B9E !important;
            transition: all 0.2s ease;
        }
        button.bg-primary:hover {
            background-color: #B55D86 !important;
            transform: translateY(-1px);
        }
        
        .bg-card, .bg-card.border-custom {
            background-color: #322A36 !important;
        }
        
        #table-search {
            background-color: #322A36 !important;
            border: 1px solid #4A3A48 !important;
            color: #F0E2EA !important;
        }
        
        #table-search::placeholder {
            color: #9A8694 !important;
        }
        
        thead.bg-primary-dark {
            background: #4A3844 !important;
            background-color: #4A3844 !important;
        }
        
        thead th {
            color: #F7EAF2 !important;
            font-weight: 600 !important;
        }
        
        tbody tr.bg-card {
            background-color: #2A232C !important;
            border-bottom: 1px solid #3E2E3A !important;
        }
        
        tbody tr:hover {
            background-color: #3F2F3C !important;
        }
        
        .text-text-primary {
            color: #F0E2EA !important;
        }
        
        .text-text-muted {
            color: #B6A2AE !important;
        }
        
        .text-info {
            color: #E5A6C1 !important;
            font-weight: 500;
        }
        .text-info:hover {
            color: #F5B8D1 !important;
            text-decoration: underline;
        }
        
        .bg-card.rounded-lg.shadow {
            background-color: #2A232C !important;
        }
        
        .text-text-primary, .text-text-secondary {
            color: #F0E2EA !important;
        }
        
        button.py-2\.5.px-5.ms-3 {
            background-color: #3E2E3A !important;
            color: #F0E2EA !important;
            border-color: #56424E !important;
        }
        
        button.py-2\.5.px-5.ms-3:hover {
            background-color: #56424E !important;
            color: #FFFFFF !important;
        }
        
        button.text-white.bg-primary {
            background-color: #C97B9E !important;
        }
        
        button.text-white.bg-primary:hover {
            background-color: #B55D86 !important;
        }
        
        .fixed.top-4.right-4.z-50 {
            background-color: #2A232C !important;
            border-left: 4px solid #E5A6C1 !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            color: #F0E2EA !important;
        }
        
        .border-custom {
            border-color: #4A3A48 !important;
        }
        
        .block.mb-2.text-sm.font-medium.text-text-primary {
            color: #E5D0DC !important;
        }
        
        input.bg-card, select.bg-card {
            background-color: #3E2E3A !important;
            border-color: #56424E !important;
            color: #F0E2EA !important;
        }
        
        input.bg-card:focus, select.bg-card:focus {
            border-color: #E5A6C1 !important;
            outline: none !important;
            box-shadow: 0 0 0 3px rgba(229, 166, 193, 0.3) !important;
        }
        
        .border-b.border-custom, .border-t.border-custom {
            border-color: #4A3A48 !important;
        }
        
        .focus\:ring-primary:focus {
            --tw-ring-color: #E5A6C1 !important;
        }
        
        .focus\:border-primary:focus {
            border-color: #E5A6C1 !important;
        }
        
        .text-text-muted svg {
            color: #B6A2AE !important;
        }
        
        form button.bg-primary.text-white {
            background-color: #C97B9E !important;
        }
        form button.bg-primary.text-white:hover {
            background-color: #B55D86 !important;
        }
        
        #adduser-modal button.bg-primary {
            background-color: #C97B9E !important;
        }
        #adduser-modal button.bg-primary:hover {
            background-color: #B55D86 !important;
        }
        
        select option {
            background-color: #2A232C !important;
            color: #F0E2EA !important;
        }
        
        .bg-secondary .text-white {
            color: #FEF6FA !important;
        }
        
        thead th.text-text-secondary {
            color: #F7EAF2 !important;
        }
        
        .p-4 .text-md.font-bold.text-text-primary {
            color: #F0E2EA !important;
        }
        
        .hover\:text-secondary:hover {
            color: #E5A6C1 !important;
        }
        
        #table-search:focus {
            border-color: #E5A6C1 !important;
            outline: none !important;
            box-shadow: 0 0 0 3px rgba(229, 166, 193, 0.3) !important;
        }
    </style>
</head>
<body>
    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
        type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-text-primary rounded-lg sm:hidden hover:bg-hover focus:outline-none focus:ring-2 focus:ring-gray-200">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-9 h-9" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform bg-sidebar -translate-x-full sm:translate-x-0 shadow-xl"
        aria-label="Sidebar">
        <div class="h-full px-4 py-12 overflow-y-auto bg-sidebar">
            <!-- Logo dengan ikon kotak-kotak PINK -->
            <a href="#" class="flex items-center ps-2.5 mb-10">
                <div class="logo-icon rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </div>
                <span class="self-center text-xl font-semibold whitespace-nowrap ml-3 logo-text">PinjamPro</span>
            </a>
            <ul class="space-y-2 py-4 font-medium">
                <li>
                    <a href="{{ route('dashboard') }}" class="sidebar-link flex items-center p-2 rounded-lg group {{ request()->routeIs('dashboard') ? 'sidebar-link-active-effect' : 'sidebar-link-hover-effect' }}">
                        <svg class="flex-shrink-0 w-5 h-5 transition duration-75" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                            <path
                                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path
                                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('items') }}"
                        class="sidebar-link flex items-center p-2 rounded-lg group {{ request()->routeIs('items') ? 'sidebar-link-active-effect' : 'sidebar-link-hover-effect' }}">
                        <svg class="flex-shrink-0 w-5 h-5 transition duration-75"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 18 18">
                            <path
                                d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Inventaris</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pinjamBarang') }}"
                        class="sidebar-link flex items-center p-2 rounded-lg group {{ request()->routeIs('pinjamBarang') ? 'sidebar-link-active-effect' : 'sidebar-link-hover-effect' }}">
                        <svg class="flex-shrink-0 w-5 h-5 transition duration-75"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Peminjaman</span>
                    </a>
                </li>
                                    <li>
                        <a href="{{ route('transactions') }}"
                            class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group {{ request()->routeIs('transactions') ? 'sidebar-link-active-effect' : 'sidebar-link-hover-effect' }}">
                            <svg class="flex-shrink-0 w-5 h-5 {{ request()->routeIs('transactions') ? 'text-white' : 'text-pink-700 group-hover:text-white' }} transition duration-75"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Transaksi</span>
                        </a>
                    </li>
                <li>
                    <a href="{{ route('users') }}"
                        class="sidebar-link flex items-center p-2 rounded-lg group {{ request()->routeIs('users') ? 'sidebar-link-active-effect' : 'sidebar-link-hover-effect' }}">
                        <svg class="flex-shrink-0 w-5 h-5 transition duration-75"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">List User</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logs') }}"
                        class="sidebar-link flex items-center p-2 rounded-lg group {{ request()->routeIs('logs') ? 'sidebar-link-active-effect' : 'sidebar-link-hover-effect' }}">
                        <svg class="w-5 h-5 transition duration-75" 
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 512 512">
                            <path d="M64 480H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H288c-10.1 0-19.6-4.7-25.6-12.8L243.2 57.6C231.1 41.5 212.1 32 192 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64z"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Log Aktivitas</span>
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}"
                        class="sidebar-link flex items-center p-2 rounded-lg group logout-link-effect">
                        @csrf
                        <svg
                            class="flex-shrink-0 w-5 h-5 transition duration-75"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 512 512">
                            <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/>
                        </svg>
                        <button type="submit" class="flex-1 ms-3 text-left whitespace-nowrap">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Content -->
    <div class="sm:ml-64 bg-background h-screen pb-5">
        <div class="rounded-lg">
            <div class="flex flex-col items-start justify-start px-4 py-4 h-72 mb-4 bg-secondary">
                <p class="text-md text-white">
                    Pages / List User
                </p>
                <p class="text-lg font-bold text-white">
                    List User
                </p>
            </div>
            <div class="flex flex-col justify-around gap-4 mx-10 -mt-36 mb-4 p-8 rounded-xl bg-card">
                <div class="flex flex-col gap-3 justify-start items-start p-8 lg:p-0">
                    <h1 class="text-2xl font-bold text-text-primary">List Petugas & Admin</h1>
                    <button data-modal-target="adduser-modal" data-modal-toggle="adduser-modal" class="font-medium text-white bg-primary px-6 py-2 rounded-lg hover:bg-primary-dark" type="button">
                        Tambah User
                    </button>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="pb-4 bg-card">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-text-muted" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-text-primary border border-custom rounded-lg w-80 bg-card focus:ring-primary focus:border-primary" placeholder="Search for items">
                        </div>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right text-text-muted">
                        <thead class="text-xs text-text-secondary uppercase bg-primary-dark">
                            <tr>
                                <th scope="col" class="p-4">
                                    <p class="text-md font-bold text-text-secondary">
                                        No.
                                    </p>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Username
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Password
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Roles
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="bg-card border-b border-custom hover:bg-hover">
                                <td class="w-4 p-4">
                                    <p class="text-md font-bold text-text-primary">
                                        {{ $loop->iteration }}
                                    </p>
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-text-primary whitespace-nowrap">
                                    {{ $user->name }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-text-primary whitespace-nowrap">
                                    {{ $user->email }}
                                </th>
                                <td class="px-6 py-4 text-text-primary">
                                    {{ $user->password }}
                                </td>
                                <td class="px-6 py-4 text-text-primary">
                                    {{ $user->role }}
                                </td>
                                <td class="px-6 py-4">
                                    <button data-modal-target="default-modal-{{ $user->id }}" data-modal-toggle="default-modal-{{ $user->id }}"
                                        class="font-medium text-info hover:text-secondary hover:underline" type="button">
                                        Edit
                                    </button>
                                    <!-- Modal Per Item -->
                                    <div id="default-modal-{{ $user->id }}" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-card rounded-lg shadow">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b border-custom rounded-t">
                                                    <h3 class="text-xl font-semibold text-text-primary">
                                                        Action Data
                                                    </h3>
                                                    <button type="button"
                                                        class="text-text-muted bg-transparent hover:bg-hover hover:text-text-secondary rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                        data-modal-hide="default-modal-{{ $user->id }}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 md:p-5 space-y-4">
                                                    <p class="text-base leading-relaxed text-text-muted">
                                                        Silahkan Anda ingin melakukan Apa terhadap User ini? Hapus atau Edit Data.
                                                    </p>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="flex items-center gap-2 p-4 md:p-5 border-t border-custom rounded-b">
                                                    <button data-modal-target="editItem-modal-{{ $user->id }}" data-modal-toggle="editItem-modal-{{ $user->id }}" type="button"
                                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-text-primary focus:outline-none bg-card rounded-lg border border-custom hover:bg-hover hover:text-info focus:z-10 focus:ring-4 focus:ring-gray-100">
                                                        Edit
                                                    </button>
                                                    <!-- Modal Edit Per Item -->
                                                    <div id="editItem-modal-{{ $user->id }}" tabindex="-1" aria-hidden="true"
                                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                            <!-- Modal content -->
                                                            <div class="relative bg-card rounded-lg shadow">
                                                                <!-- Modal header -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-b border-custom rounded-t">
                                                                    <h3 class="text-xl font-semibold text-text-primary">
                                                                        Edit Users
                                                                    </h3>
                                                                    <button type="button"
                                                                        class="text-text-muted bg-transparent hover:bg-hover hover:text-text-secondary rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                                        data-modal-hide="editItem-modal-{{ $user->id }}">
                                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                            viewBox="0 0 14 14">
                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                        </svg>
                                                                        <span class="sr-only">Close modal</span>
                                                                    </button>
                                                                </div>
                                                                <!-- Modal body -->
                                                                <form action="{{ route('users.update', $user->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="p-4 md:p-5 space-y-4">
                                                                        <div class="mb-5">
                                                                            <label for="name"
                                                                                class="block mb-2 text-sm font-medium text-text-primary">
                                                                                Nama Users
                                                                            </label>
                                                                            <input type="text" id="name" name="name"
                                                                                class="bg-card border border-custom text-text-primary text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                                                                value="{{ $user->name }}" required />
                                                                        </div>
                                                                        <div class="mb-5">
                                                                            <label for="email"
                                                                                class="block mb-2 text-sm font-medium text-text-primary">
                                                                                Email
                                                                            </label>
                                                                            <input type="email" id="email" name="email"
                                                                                class="bg-card border border-custom text-text-primary text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                                                                value="{{ $user->email }}" required />
                                                                        </div>
                                                                        <div class="mb-5">
                                                                            <label for="password"
                                                                                class="block mb-2 text-sm font-medium text-text-primary">
                                                                                Password Users
                                                                            </label>
                                                                            <input type="password" id="password" name="password"
                                                                                class="bg-card border border-custom text-text-primary text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                                                                value="{{ $user->password }}" required />
                                                                        </div>
                                                                        <div class="mb-5">
                                                                            <label for="password_confirmation"
                                                                                class="block mb-2 text-sm font-medium text-text-primary">
                                                                                Confirm Password Users
                                                                            </label>
                                                                            <input type="password" id="password_confirmation" name="password_confirmation"
                                                                                class="bg-card border border-custom text-text-primary text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                                                                value="{{ $user->password }}" required />
                                                                        </div>
                                                                        <div class="mb-5">
                                                                            <label for="role"
                                                                                class="block mb-2 text-sm font-medium text-text-primary">
                                                                                Roles
                                                                            </label>
                                                                            <select id="role" name="role" class="bg-card border border-custom text-text-primary text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" required>
                                                                                <option value="" disabled selected>Pilih Roles</option>
                                                                                <option value="admin">Admin</option>
                                                                                <option value="petugas">Petugas</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Modal footer -->
                                                                    <div class="flex items-center p-4 md:p-5 border-t border-custom rounded-b">
                                                                        <button type="submit"
                                                                            class="text-white bg-primary hover:bg-primary-dark focus:ring-4 focus:outline-none focus:ring-primary font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                                                                            Submit Edit
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <form action="{{ route('users.delete', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-white bg-primary hover:bg-primary-dark focus:ring-4 focus:outline-none focus:ring-primary font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                            Hapus User  
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambah User modal -->
    <div id="adduser-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-card rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b border-custom rounded-t">
                    <h3 class="text-xl font-semibold text-text-primary">
                        Tambah User
                    </h3>
                    <button type="button" class="text-text-muted bg-transparent hover:bg-hover hover:text-text-secondary rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="adduser-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('users') }}" method="POST">
                    @csrf
                    <div class="p-4 md:p-5 space-y-4">
                        <div class="mb-5">
                            <label for="name" class="block mb-2 text-sm font-medium text-text-primary">Username</label>
                            <input type="text" name="name" id="name" class="bg-card border border-custom text-text-primary text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="John Smith" required />
                        </div>
                        <div class="mb-5">
                            <label for="email" class="block mb-2 text-sm font-medium text-text-primary">Email</label>
                            <input type="email" name="email" id="email" class="bg-card border border-custom text-text-primary text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="name@flowbite.com" required />
                        </div>
                        <div class="mb-5">
                            <label for="password" class="block mb-2 text-sm font-medium text-text-primary">Password</label>
                            <input type="password" name="password" id="password" class="bg-card border border-custom text-text-primary text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="*********" required />
                        </div>
                        <div class="mb-5">
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-text-primary">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="bg-card border border-custom text-text-primary text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="*********" required />
                        </div>
                        <div class="mb-5">
                            <label for="role" class="block mb-2 text-sm font-medium text-text-primary">Role</label>
                            <select id="role" name="role" class="bg-card border border-custom text-text-primary text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5">
                                <option value="petugas">Petugas</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-4 md:p-5 border-t border-custom rounded-b">
                        <button type="submit" class="text-white bg-primary hover:bg-primary-dark focus:ring-4 focus:outline-none focus:ring-primary font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div id="alert-3" class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-success rounded-lg" style="background-color: rgba(16, 185, 129, 0.1);" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 1 0 0 2v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium text-success">{{ session('success') }}</div>
            <button type="button" class="ms-auto bg-transparent text-success rounded-lg p-1.5 hover:bg-hover" aria-label="Close">
                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif @if (session('error'))
        <div id="alert-3" class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-danger rounded-lg" style="background-color: rgba(239, 68, 68, 0.1);" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 1 0 0 2v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Error</span>
            <div class="ms-3 text-sm font-medium text-danger">{{ session('error') }}</div>
            <button type="button" class="ms-auto bg-transparent text-danger rounded-lg p-1.5 hover:bg-hover" aria-label="Close">
                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif @if ($errors->any())
        <div id="alert-3" class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-danger rounded-lg" style="background-color: rgba(239, 68, 68, 0.1);" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 1 0 0 2v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Validation Error</span>
            <ul class="ms-3 text-sm font-medium text-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="ms-auto bg-transparent text-danger rounded-lg p-1.5 hover:bg-hover" aria-label="Close">
                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif

    <!-- Flowbite JS -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <!-- JavaScript -->
    <script>
        const searchInput = document.getElementById('table-search');
        const tableRows = document.querySelectorAll('tbody tr');

        searchInput.addEventListener('keyup', function() {
            const searchTerm = searchInput.value.toLowerCase();

            tableRows.forEach(row => {
                const productName = row.querySelector('th').textContent.toLowerCase();
                if (productName.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        function showAlert() {
            const alert = document.getElementById('alert-3');
            if (alert) {
                alert.style.display = 'flex';
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 3000);
            }
        }
  showAlert()
    </script>
</body>
</html>