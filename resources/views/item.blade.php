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
            --primary: #30222d;
            --primary-dark: #4f3945;
            --primary-light: #473a34;
            --secondary: #984b82;
            --accent: #36322b;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #e783cb;
            --background: #2d3238;
            --card-bg: #4c3b44;
            --text-primary: #32252d;
            --text-secondary: #3f2f3a;
            --text-muted: #2d2f3d;
            --border: #323840;
            --sidebar-bg: #cea8c3;
            --hover-bg: #2d343b;
            
            /* Warna untuk gradasi 2 warna: PINK ke HITAM */
            --pink-pekat: #ff1493;
            --hitam: #1a0f14;
            
            /* Warna OREN khusus logout */
            --oren-terang: #ffb347;
            --oren-gelap: #ff8c00;
        }

        body {
            background-color: var(--background);
            color: var(--text-primary);
        }

        /* Sidebar styling */
        #logo-sidebar {
            background-color: var(--sidebar-bg) !important;
        }

        #logo-sidebar .bg-gray-50 {
            background-color: var(--sidebar-bg) !important;
        }

        /* Camera logo */
        .camera-logo {
            background-color: var(--secondary) !important;
            transition: all 0.3s ease;
        }

        .group:hover .camera-logo {
            background-color: var(--primary-dark) !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Teks logo */
        .self-center.text-xl.font-semibold {
            color: var(--text-primary) !important;
        }

        /* Menu items */
        .sidebar-link {
            transition: all 0.3s ease;
        }

        .sidebar-link:hover {
            background: linear-gradient(135deg, #ff1493 0%, #1a0f14 100%) !important;
            color: white !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-weight: 600;
        }

        .sidebar-link:hover svg {
            color: white !important;
        }

        .sidebar-link:hover span {
            color: white !important;
        }

        /* Active menu - dengan teks dan ikon PUTIH */
        .sidebar-link-active {
            background: linear-gradient(135deg, #d81b60 0%, #0a080a 100%) !important;
            color: white !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            border-left: 4px solid #ffb6c1;
            font-weight: 600;
        }

        /* Memastikan semua elemen dalam active menu berwarna putih */
        .sidebar-link-active svg,
        .sidebar-link-active span,
        .sidebar-link-active .ms-3,
        .sidebar-link-active .flex-1,
        .sidebar-link-active .whitespace-nowrap {
            color: white !important;
        }

        /* Saat active menu di-hover tetap putih */
        .sidebar-link-active:hover {
            background: linear-gradient(135deg, #d81b60 0%, #0a080a 100%) !important;
            color: white !important;
        }

        .sidebar-link-active:hover svg,
        .sidebar-link-active:hover span {
            color: white !important;
        }

        /* Logout khusus */
        .logout-link:hover {
            background: linear-gradient(135deg, #ffb347 0%, #ff8c00 100%) !important;
            color: white !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-weight: 600;
        }

        .logout-link:hover svg,
        .logout-link:hover button,
        .logout-link:hover span {
            color: white !important;
        }

        /* Warna ikon default (non-active) */
        .sidebar-link svg {
            color: var(--secondary) !important;
            transition: color 0.3s ease;
        }

        .logout-link svg {
            color: var(--secondary) !important;
        }

        /* Warna teks default (non-active) */
        .sidebar-link span,
        .sidebar-link button {
            color: var(--text-primary) !important;
            transition: color 0.3s ease;
        }

        .logout-link span,
        .logout-link button {
            color: var(--text-primary) !important;
        }

        /* Header */
        .bg-secondary {
            background-color: var(--secondary) !important;
        }

        /* Card */
        .bg-white {
            background-color: var(--card-bg) !important;
            border: 1px solid var(--border);
        }

        /* Text colors */
        h1, h2, h3, h4, h5, h6, p, span, div {
            color: var(--text-primary);
        }

        .text-gray-900, .text-black, .text-gray-700 {
            color: var(--text-primary) !important;
        }

        .text-gray-500 {
            color: var(--text-secondary) !important;
        }

        .text-blue-600 {
            color: var(--primary) !important;
        }

        .text-blue-600:hover {
            color: var(--primary-dark) !important;
        }

        /* Buttons */
        .bg-primary {
            background-color: var(--primary) !important;
        }

        .bg-primary:hover {
            background-color: var(--primary-dark) !important;
        }

        .bg-blue-700 {
            background-color: var(--primary) !important;
        }

        .bg-blue-700:hover {
            background-color: var(--primary-dark) !important;
        }

        .hover\:bg-blue-800:hover {
            background-color: var(--primary-dark) !important;
        }

        .focus\:ring-blue-500:focus {
            --tw-ring-color: var(--secondary) !important;
        }

        .focus\:border-blue-500:focus {
            border-color: var(--secondary) !important;
        }

        /* Table */
        .bg-gray-50 {
            background-color: var(--accent) !important;
        }

        thead th {
            color: var(--text-primary) !important;
        }

        tbody tr {
            background-color: var(--card-bg) !important;
            border-color: var(--border) !important;
        }

        .hover\:bg-gray-50:hover {
            background-color: var(--background) !important;
        }

        /* Border */
        .border-gray-200, .border-gray-300 {
            border-color: var(--border) !important;
        }

        /* Status badges */
        .bg-green-100 {
            background-color: rgba(16, 185, 129, 0.2) !important;
        }
        .text-green-800 {
            color: var(--success) !important;
        }

        .bg-red-100 {
            background-color: rgba(239, 68, 68, 0.2) !important;
        }
        .text-red-800 {
            color: var(--danger) !important;
        }

        .bg-yellow-100 {
            background-color: rgba(245, 158, 11, 0.2) !important;
        }
        .text-yellow-800 {
            color: var(--warning) !important;
        }

        .bg-gray-100 {
            background-color: var(--accent) !important;
        }
        .text-gray-800 {
            color: var(--text-primary) !important;
        }

        /* Modal */
        .bg-white.rounded-lg.shadow {
            background-color: var(--card-bg) !important;
            border: 1px solid var(--border);
        }

        .text-gray-900.dark\:text-white {
            color: var(--text-primary) !important;
        }

        .text-gray-400 {
            color: var(--text-muted) !important;
        }

        .hover\:bg-gray-200:hover {
            background-color: var(--accent) !important;
        }

        .hover\:text-gray-900:hover {
            color: var(--text-primary) !important;
        }

        /* Form inputs */
        input, select, textarea {
            background-color: var(--background) !important;
            border: 1px solid var(--border) !important;
            color: var(--text-primary) !important;
        }

        input:focus, select:focus, textarea:focus {
            --tw-ring-color: var(--secondary) !important;
            border-color: var(--secondary) !important;
        }

        .bg-gray-50 {
            background-color: var(--background) !important;
        }

        /* Alert */
        .bg-green-50 {
            background-color: rgba(16, 185, 129, 0.1) !important;
            border: 1px solid var(--success);
        }
        .text-green-500 {
            color: var(--success) !important;
        }

        .bg-red-50 {
            background-color: rgba(239, 68, 68, 0.1) !important;
            border: 1px solid var(--danger);
        }
        .text-red-500 {
            color: var(--danger) !important;
        }

        /* Placeholder */
        ::placeholder {
            color: var(--text-muted) !important;
            opacity: 1;
        }

        /* Search input */
        #table-search {
            background-color: var(--background) !important;
            border-color: var(--border) !important;
            color: var(--text-primary) !important;
        }

        /* Focus ring */
        .focus\:ring-blue-500:focus {
            --tw-ring-color: var(--secondary) !important;
        }

        /* Text white untuk header */
        .text-white {
            color: white !important;
        }

        /* ========== TAMBAHAN CSS UNTUK WARNA KONTEN KANAN SESUAI GAMBAR ========== */
        
        /* Header atas - warna ungu gelap seperti gambar */
        .bg-primary {
            background: linear-gradient(135deg, #8b3e72 0%, #6b2e57 100%) !important;
        }
        
        /* Card background - putih/krem seperti gambar */
        .bg-card {
            background-color: #fef9f0 !important;
        }
        
        /* Judul List Inventaris - warna gelap */
        .bg-card h1 {
            color: #2c2418 !important;
        }
        
        /* Tombol Tambah Barang - warna ungu */
        .bg-card button.bg-primary {
            background-color: #6b2e57 !important;
        }
        .bg-card button.bg-primary:hover {
            background-color: #8b3e72 !important;
        }
        
        /* Table - background putih */
        table {
            background-color: #ffffff !important;
        }
        
        /* Table header - abu-abu muda */
        thead tr {
            background-color: #e9e0d5 !important;
        }
        thead th {
            color: #2c2418 !important;
        }
        
        /* Table body */
        tbody tr {
            background-color: #ffffff !important;
            border-bottom-color: #ede5db !important;
        }
        tbody td, tbody th {
            color: #4a3b2c !important;
        }
        
        /* Search input - background putih */
        #table-search {
            background-color: #ffffff !important;
            border-color: #e0d5c8 !important;
            color: #2c2418 !important;
        }
        #table-search::placeholder {
            color: #b8ab9a !important;
        }
        
        /* Icon search - warna abu-abu */
        .absolute svg {
            color: #b8ab9a !important;
        }
        
        /* Badge status - seperti gambar */
        .bg-green-100 {
            background-color: #d4edda !important;
        }
        .text-green-800 {
            color: #155724 !important;
        }
        .bg-red-100 {
            background-color: #f8d7da !important;
        }
        .text-red-800 {
            color: #721c24 !important;
        }
        .bg-yellow-100 {
            background-color: #fff3cd !important;
        }
        .text-yellow-800 {
            color: #856404 !important;
        }
        
        /* Tombol Edit - warna ungu */
        .text-blue-600 {
            color: #8b3e72 !important;
        }
        .text-blue-600:hover {
            color: #5a2a46 !important;
        }
        
        /* Modal background - putih */
        .bg-card.rounded-lg.shadow {
            background-color: #ffffff !important;
        }
        
        /* Teks dalam modal - warna gelap */
        .bg-card .text-white,
        .bg-card h3,
        .bg-card p,
        .bg-card label {
            color: #2c2418 !important;
        }
        
        /* Input dalam modal - background putih */
        .bg-card input,
        .bg-card select {
            background-color: #ffffff !important;
            border-color: #e0d5c8 !important;
            color: #2c2418 !important;
        }
        
        /* Teks di header atas tetap putih */
        .bg-primary .text-white {
            color: white !important;
        }
        
        /* Tombol Submit Edit dan Tambah */
        .btn-primary {
            background-color: #6b2e57 !important;
        }
        .btn-primary:hover {
            background-color: #8b3e72 !important;
        }
        
        /* Tombol Hapus */
        .btn-danger {
            background-color: #dc3545 !important;
        }
        
        /* Teks di dalam card yang tadinya putih diubah jadi gelap */
        .bg-card .text-white:not(.bg-primary .text-white) {
            color: #2c2418 !important;
        }
        
        /* Nomor dan teks tabel */
        .bg-card .text-md.font-bold.text-white,
        tbody .text-white,
        tbody th.text-white,
        tbody td.text-white {
            color: #2c2418 !important;
        }
        
        /* Header tabel text */
        thead th .text-white,
        thead .text-white {
            color: #2c2418 !important;
        }
        
        /* Button di dalam modal */
        .bg-card button.text-white {
            color: white !important;
        }
        
        /* Styling untuk gambar item */
        .item-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e0d5c8;
        }
        
        .item-image-placeholder {
            width: 50px;
            height: 50px;
            background-color: #f0e8e0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e0d5c8;
        }
        
        .item-image-placeholder svg {
            width: 24px;
            height: 24px;
            color: #b8ab9a;
        }
    </style>
</head>

<body class="bg-background">
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

    <!-- Sidebar dengan BACKGROUND PINK SOLID -->
    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform bg-sidebar -translate-x-full sm:translate-x-0 shadow-xl"
        aria-label="Sidebar">
        <div class="h-full flex flex-col justify-normal px-4 py-12 overflow-y-auto bg-sidebar">
            <!-- Logo -->
            <a href="#" class="flex items-center ps-2.5 mb-10">
                <div class="w-8 h-8 bg-gradient-to-r from-pink-500 to-pink-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </div>
                <span class="self-center text-xl font-semibold whitespace-nowrap ml-3 text-pink-800">PinjamAlatMasak</span>
            </a>
            
            <!-- MENU UNTUK ADMIN (LENGKAP DENGAN LIST USER) -->
            @if (auth()->user()->role === 'admin')
                <ul class="space-y-2 py-4 font-medium">
                    <li>
                        <a href="{{ route('dashboard') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group {{ request()->routeIs('dashboard') ? 'sidebar-link-active-effect' : 'sidebar-link-hover-effect' }}">
                            <svg class="flex-shrink-0 w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-pink-700 group-hover:text-white' }} transition duration-75" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                                <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('items') }}"
                            class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group {{ request()->routeIs('items') ? 'sidebar-link-active-effect' : 'sidebar-link-hover-effect' }}">
                            <svg class="flex-shrink-0 w-5 h-5 {{ request()->routeIs('items') ? 'text-white' : 'text-pink-700 group-hover:text-white' }} transition duration-75"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 18 18">
                                <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Inventaris</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pinjamBarang') }}"
                            class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group {{ request()->routeIs('pinjamBarang') ? 'sidebar-link-active-effect' : 'sidebar-link-hover-effect' }}">
                            <svg class="flex-shrink-0 w-5 h-5 {{ request()->routeIs('pinjamBarang') ? 'text-white' : 'text-pink-700 group-hover:text-white' }} transition duration-75"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
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
                            class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group {{ request()->routeIs('users') ? 'sidebar-link-active-effect' : 'sidebar-link-hover-effect' }}">
                            <svg class="flex-shrink-0 w-5 h-5 {{ request()->routeIs('users') ? 'text-white' : 'text-pink-700 group-hover:text-white' }} transition duration-75"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 18">
                                <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">List User</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logs') }}"
                            class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group {{ request()->routeIs('logs') ? 'sidebar-link-active-effect' : 'sidebar-link-hover-effect' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('logs') ? 'text-white' : 'text-pink-700 group-hover:text-white' }} transition duration-75"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 512 512">
                                <path d="M64 480H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H288c-10.1 0-19.6-4.7-25.6-12.8L243.2 57.6C231.1 41.5 212.1 32 192 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64z"/>
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Log Aktivitas</span>
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}"
                            class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group logout-link-effect">
                            @csrf
                            <svg
                                class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 512 512">
                                <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/>
                            </svg>
                            <button type="submit" class="flex-1 ms-3 text-left whitespace-nowrap">Logout</button>
                        </form>
                    </li>
                </ul>
            
            <!-- MENU UNTUK PETUGAS (TANPA LIST USER) -->
            @elseif (auth()->user()->role === 'petugas')
                <ul class="space-y-2 py-4 font-medium">
                    <li>
                        <a href="{{ route('dashboard') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group {{ request()->routeIs('dashboard') ? 'sidebar-link-active-effect' : 'sidebar-link-hover-effect' }}">
                            <svg class="flex-shrink-0 w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-pink-700 group-hover:text-white' }} transition duration-75" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                                <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('items') }}"
                            class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group {{ request()->routeIs('items') ? 'sidebar-link-active-effect' : 'sidebar-link-hover-effect' }}">
                            <svg class="flex-shrink-0 w-5 h-5 {{ request()->routeIs('items') ? 'text-white' : 'text-pink-700 group-hover:text-white' }} transition duration-75"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 18 18">
                                <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Inventaris</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pinjamBarang') }}"
                            class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group {{ request()->routeIs('pinjamBarang') ? 'sidebar-link-active-effect' : 'sidebar-link-hover-effect' }}">
                            <svg class="flex-shrink-0 w-5 h-5 {{ request()->routeIs('pinjamBarang') ? 'text-white' : 'text-pink-700 group-hover:text-white' }} transition duration-75"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
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
                        <a href="{{ route('logs') }}"
                            class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group {{ request()->routeIs('logs') ? 'sidebar-link-active-effect' : 'sidebar-link-hover-effect' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('logs') ? 'text-white' : 'text-pink-700 group-hover:text-white' }} transition duration-75"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 512 512">
                                <path d="M64 480H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H288c-10.1 0-19.6-4.7-25.6-12.8L243.2 57.6C231.1 41.5 212.1 32 192 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64z"/>
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Log Aktivitas</span>
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}"
                            class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group logout-link-effect">
                            @csrf
                            <svg
                                class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 512 512">
                                <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/>
                            </svg>
                            <button type="submit" class="flex-1 ms-3 text-left whitespace-nowrap">Logout</button>
                        </form>
                    </li>
                </ul>
            
            <!-- MENU UNTUK USER -->
            @elseif (auth()->user()->role === 'user')
                <ul class="space-y-2 py-4 font-medium">
                    <li>
                        <a href="{{ route('dashboard') }}" class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group {{ request()->routeIs('dashboard') ? 'sidebar-link-active-effect' : 'sidebar-link-hover-effect' }}">
                            <svg class="flex-shrink-0 w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-pink-700 group-hover:text-white' }} transition duration-75" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                                <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pinjamBarang') }}"
                            class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group {{ request()->routeIs('pinjamBarang') ? 'sidebar-link-active-effect' : 'sidebar-link-hover-effect' }}">
                            <svg class="flex-shrink-0 w-5 h-5 {{ request()->routeIs('pinjamBarang') ? 'text-white' : 'text-pink-700 group-hover:text-white' }} transition duration-75"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Peminjaman</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logs') }}"
                            class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group {{ request()->routeIs('logs') ? 'sidebar-link-active-effect' : 'sidebar-link-hover-effect' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('logs') ? 'text-white' : 'text-pink-700 group-hover:text-white' }} transition duration-75"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 512 512">
                                <path d="M64 480H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H288c-10.1 0-19.6-4.7-25.6-12.8L243.2 57.6C231.1 41.5 212.1 32 192 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64z"/>
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Log Aktivitas</span>
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}"
                            class="sidebar-link flex items-center p-2 text-gray-700 rounded-lg group logout-link-effect">
                            @csrf
                            <svg
                                class="flex-shrink-0 w-5 h-5 text-pink-700 group-hover:text-white transition duration-75"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 512 512">
                                <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/>
                            </svg>
                            <button type="submit" class="flex-1 ms-3 text-left whitespace-nowrap">Logout</button>
                        </form>
                    </li>
                </ul>
            @endif
        </div>
    </aside>

    <!-- Content (sama seperti sebelumnya, tidak berubah) -->
    <div class="sm:ml-64 bg-background min-h-screen pb-5">
        <div class="rounded-lg">
            <div class="flex flex-col items-start justify-start px-4 py-4 h-72 mb-4 bg-primary">
                <p class="text-md text-white">
                    Pages / Inventaris
                </p>
                <p class="text-lg font-bold text-white">
                    Inventaris
                </p>
            </div>
            <div class="flex flex-col justify-around gap-4 mx-10 -mt-36 mb-4 p-8 rounded-xl bg-card">
                <div class="flex flex-col gap-6 justify-start items-start p-8 lg:p-0">
                    <h1 class="text-2xl font-bold">List Inventaris</h1>
                    <button data-modal-target="addItem-modal" data-modal-toggle="addItem-modal"
                        class="font-medium bg-primary text-white px-9 py-2 rounded-lg hover:underline" type="button">
                        Tambah Barang
                    </button>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="pb-4 bg-card">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" id="table-search" class="block pt-2 ps-10 text-sm border border-custom rounded-lg w-80 bg-card focus:ring-primary focus:border-primary" placeholder="Search for items">
                        </div>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right">
                        <thead class="text-xs uppercase table-header">
                            <tr>
                                <th scope="col" class="p-4">
                                    <p class="text-md font-bold">
                                        No.
                                    </p>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Gambar
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama Barang
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Deskripsi Barang
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Stock
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Kondisi
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            \\
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr class="border-b border-custom table-row">
                                <td class="w-4 p-4">
                                    <p class="text-md font-bold">
                                        {{ $loop->iteration }}
                                    </p>
                                
                                <td class="px-6 py-4">
                                    @php
                                        // Cari gambar berdasarkan nama barang
                                        $imageName = strtolower(str_replace(' ', '_', $item->name)) . '.jpg';
                                        $imagePath = public_path('assets/img/' . $imageName);
                                        $imageUrl = asset('assets/img/' . $imageName);
                                    @endphp
                                    @if(file_exists($imagePath))
                                        <img src="{{ $imageUrl }}" alt="{{ $item->name }}" class="item-image">
                                    @elseif($item->foto)
                                        <img src="{{ asset($item->foto) }}" alt="{{ $item->name }}" class="item-image">
                                    @else
                                        <div class="item-image-placeholder">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{ $item->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->description }}
                                
                                <td class="px-6 py-4">
                                    {{ $item->stock }}
                                
                                <td class="px-6 py-4">
                                    @if($item->kondisi == 'baik')
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Baik</span>
                                    @elseif($item->kondisi == 'rusak')
                                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">Rusak</span>
                                    @elseif($item->kondisi == 'perbaikan')
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">Perbaikan</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">{{ $item->kondisi }}</span>
                                    @endif
                                
                                <td class="px-6 py-4">
                                    <button data-modal-target="default-modal-{{ $item->id }}" data-modal-toggle="default-modal-{{ $item->id }}"
                                        class="font-medium text-blue-600 hover:underline" type="button">
                                        Edit
                                    </button>
                                    <!-- Modal Per Item (sama seperti sebelumnya) -->
                                    <div id="default-modal-{{ $item->id }}" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-card rounded-lg shadow border border-custom">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b border-custom rounded-t">
                                                    <h3 class="text-xl font-semibold">
                                                        Action Data
                                                    </h3>
                                                    <button type="button"
                                                        class="text-gray-400 bg-transparent hover-bg rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                        data-modal-hide="default-modal-{{ $item->id }}">
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
                                                    <p class="text-base leading-relaxed">
                                                        Silahkan Anda ingin melakukan Apa terhadap Data ini? Hapus atau Edit Data.
                                                    </p>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="flex items-center gap-2 p-4 md:p-5 border-t border-custom rounded-b">
                                                    <button data-modal-target="editItem-modal-{{ $item->id }}" data-modal-toggle="editItem-modal-{{ $item->id }}" type="button"
                                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-white focus:outline-none bg-card rounded-lg border border-custom hover-bg focus:z-10 focus:ring-4 focus:ring-gray-100">
                                                        Edit Barang
                                                    </button>
                                                    <!-- Modal Edit Per Item -->
                                                    <div id="editItem-modal-{{ $item->id }}" tabindex="-1" aria-hidden="true"
                                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                            <!-- Modal content -->
                                                            <div class="relative bg-card rounded-lg shadow border border-custom">
                                                                <!-- Modal header -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-b border-custom rounded-t">
                                                                    <h3 class="text-xl font-semibold">
                                                                        Edit Barang
                                                                    </h3>
                                                                    <button type="button"
                                                                        class="text-gray-400 bg-transparent hover-bg rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                                        data-modal-hide="editItem-modal-{{ $item->id }}">
                                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                            viewBox="0 0 14 14">
                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                        </svg>
                                                                        <span class="sr-only">Close modal</span>
                                                                    </button>
                                                                </div>
                                                                <!-- Modal body -->
                                                                <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="p-4 md:p-5 space-y-4">
                                                                        <div class="mb-5">
                                                                            <label for="name-{{ $item->id }}"
                                                                                class="block mb-2 text-sm font-medium">
                                                                                Nama Barang
                                                                            </label>
                                                                            <input type="text" id="name-{{ $item->id }}" name="name"
                                                                                class="bg-card border border-custom text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                                                                value="{{ $item->name }}" required />
                                                                        </div>
                                                                        <div class="mb-5">
                                                                            <label for="description-{{ $item->id }}"
                                                                                class="block mb-2 text-sm font-medium">Deskripsi Barang
                                                                            </label>
                                                                            <input type="text" id="description-{{ $item->id }}" name="description"
                                                                                class="bg-card border border-custom text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                                                                value="{{ $item->description }}" required />
                                                                        </div>
                                                                        <div class="mb-5">
                                                                            <label for="stock-{{ $item->id }}"
                                                                                class="block mb-2 text-sm font-medium">Stock Barang
                                                                            </label>
                                                                            <input type="text" id="stock-{{ $item->id }}" name="stock"
                                                                                class="bg-card border border-custom text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                                                                value="{{ $item->stock }}" required />
                                                                        </div>
                                                                        <div class="mb-5">
                                                                            <label for="kondisi-{{ $item->id }}" class="block mb-2 text-sm font-medium">
                                                                                Kondisi Barang
                                                                            </label>
                                                                            <select id="kondisi-{{ $item->id }}" name="kondisi"
                                                                                class="bg-card border border-custom text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                                                                required>
                                                                                <option value="">Pilih Kondisi</option>
                                                                                <option value="baik" {{ $item->kondisi == 'baik' ? 'selected' : '' }}>Baik</option>
                                                                                <option value="rusak" {{ $item->kondisi == 'rusak' ? 'selected' : '' }}>Rusak</option>
                                                                                <option value="perbaikan" {{ $item->kondisi == 'perbaikan' ? 'selected' : '' }}>Sedang Diperbaiki</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-5">
                                                                            <label for="image-{{ $item->id }}" class="block mb-2 text-sm font-medium">
                                                                                Gambar Barang
                                                                            </label>
                                                                            <input type="file" id="image-{{ $item->id }}" name="image" accept="image/*"
                                                                                class="bg-card border border-custom text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5">
                                                                            @if($item->foto)
                                                                                <p class="text-xs text-gray-500 mt-1">Gambar saat ini: {{ basename($item->foto) }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                    
                                                                    <!-- Modal footer -->
                                                                    <div class="flex items-center p-4 md:p-5 border-t border-custom rounded-b">
                                                                        <button type="submit"
                                                                            class="btn-primary focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                                                                            Submit Edit
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <form action="{{ route('items.delete', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn-danger focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                            Hapus Barang
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                

                              
                            @endforeach
                        </tbody>
                      
                </div>
            </div>
        </div>
    </div>

    <!-- TambahBarang modal (sama seperti sebelumnya) -->
    <div id="addItem-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-card rounded-lg shadow border border-custom">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b border-custom rounded-t">
                    <h3 class="text-xl font-semibold">
                        Tambah Barang
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover-bg rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="addItem-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="{{ route('items') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <div class="mb-5">
                            <label for="name"
                                class="block mb-2 text-sm font-medium">
                                Nama Barang
                            </label>
                            <input type="text" id="name" name="name"
                                class="bg-card border border-custom text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                placeholder="Laptop" required />
                        </div>
                        <div class="mb-5">
                            <label for="description"
                                class="block mb-2 text-sm font-medium">
                                Deskripsi Barang
                            </label>
                            <input type="text" id="description" name="description"
                                class="bg-card border border-custom text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                required />
                        </div>
                        <div class="mb-5">
                            <label for="stock"
                                class="block mb-2 text-sm font-medium">
                                Stock Barang
                            </label>
                            <input type="text" id="stock" name="stock"
                                class="bg-card border border-custom text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                required />
                        </div>
                        <div class="mb-5">
                            <label for="kondisi" class="block mb-2 text-sm font-medium">
                                Kondisi Barang
                            </label>
                            <select id="kondisi" name="kondisi"
                                class="bg-card border border-custom text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                required>
                                <option value="">Pilih Kondisi</option>
                                <option value="baik">Baik</option>
                                <option value="rusak">Rusak</option>
                                <option value="perbaikan">Sedang Diperbaiki</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="image" class="block mb-2 text-sm font-medium">
                                Gambar Barang
                            </label>
                            <input type="file" id="image" name="image" accept="image/*"
                                class="bg-card border border-custom text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Kosongkan jika tidak ingin menambah gambar.</p>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-custom rounded-b">
                        <button type="submit"
                            class="btn-primary focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Alert messages (sama seperti sebelumnya) -->
    @if (session('success'))
        <div id="alert-3" class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-white rounded-lg bg-success" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 1 0 0 2v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">{{ session('success') }}</div>
            <button type="button" class="ms-auto bg-success text-white rounded-lg p-1.5 hover:bg-opacity-80" aria-label="Close">
                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif
    
    @if (session('error'))
        <div id="alert-3" class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-white rounded-lg bg-danger" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 1 0 0 2v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Error</span>
            <div class="ms-3 text-sm font-medium">{{ session('error') }}</div>
            <button type="button" class="ms-auto bg-danger text-white rounded-lg p-1.5 hover:bg-opacity-80" aria-label="Close">
                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif
    
    @if ($errors->any())
        <div id="alert-3" class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-white rounded-lg bg-warning" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 1 0 0 2v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Validation Error</span>
            <ul class="ms-3 text-sm font-medium">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="ms-auto bg-warning text-white rounded-lg p-1.5 hover:bg-opacity-80" aria-label="Close">
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
        // Ambil input search dan table body
        const searchInput = document.getElementById('table-search');
        const tableRows = document.querySelectorAll('tbody tr');

        // Fungsi pencarian berdasarkan kolom "Product name"
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchTerm = searchInput.value.toLowerCase();

                tableRows.forEach(row => {
                    const productName = row.querySelector('th')?.textContent.toLowerCase() || '';
                    if (productName.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }

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