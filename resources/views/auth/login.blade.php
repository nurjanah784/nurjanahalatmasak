<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PinjamPro · login peminjaman alat masak</title>
    
    <link rel="icon" type="image/png" href="{{ asset('assets/img/Avatar.png') }}">

    <!-- Flowbite CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    
    <!-- Font Awesome untuk ikon alat masak yang lebih bagus -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* ===== TEMA WARNA PREMIUM: ALAT MASAK ===== */
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
            --hover-bg: #2d343b;
        }

        /* ===== BASE ===== */
        body {
            background-color: var(--background);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        /* background section dengan tekstur alat masak */
        .bg-gray-50.dark\:bg-gray-900 {
            background-color: var(--background) !important;
            background-image: 
                radial-gradient(circle at 15% 20%, rgba(241, 99, 213, 0.06) 0px, transparent 30%),
                radial-gradient(circle at 85% 70%, rgba(212, 88, 177, 0.06) 0px, transparent 35%),
                repeating-linear-gradient(45deg, rgba(200, 140, 170, 0.02) 0px, rgba(200, 140, 170, 0.02) 2px, transparent 2px, transparent 8px);
            min-height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
        }

        /* card dengan efek seperti panel dapur */
        .dark\:bg-gray-800 {
            background-color: var(--card-bg) !important;
            border: 1px solid var(--border) !important;
            border-radius: 24px !important;
            box-shadow: 0 25px 40px -12px rgba(0,0,0,0.8), 0 4px 12px rgba(241, 99, 213, 0.2);
        }

        /* ===== TYPOGRAPHY ===== */
        h1, .dark\:text-white, label, .text-gray-900 {
            color: var(--text-secondary) !important;
        }

        h1 {
            font-size: 1.8rem;
            border-left: 5px solid var(--primary);
            padding-left: 1rem;
            margin-bottom: 0.5rem;
        }

        label {
            font-weight: 500;
            color: var(--text-primary) !important;
            letter-spacing: 0.3px;
            margin-bottom: 0.5rem;
            display: block;
        }

        /* ===== INPUT FIELD ===== */
        input {
            background-color: #3a2f36 !important;
            border: 1.5px solid #5e4753 !important;
            border-radius: 40px !important;
            color: #f5ddee !important;
            padding: 0.9rem 1.2rem !important;
            font-size: 0.95rem;
            transition: all 0.25s ease;
            width: 100%;
        }

        input:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 4px rgba(241, 99, 213, 0.25) !important;
            background-color: #42353e !important;
            outline: none;
        }

        input::placeholder {
            color: #9a7c8f !important;
            opacity: 0.7;
        }

        /* ===== TOMBOL LOGIN ===== */
        button[type="submit"] {
            background: linear-gradient(145deg, var(--primary), #cf4bb0) !important;
            border: none !important;
            border-radius: 60px !important;
            padding: 0.9rem !important;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #221f1f !important;
            box-shadow: 0 10px 20px -8px #a03f86;
            transition: 0.2s;
            width: 100%;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background: linear-gradient(145deg, #f87be0, #d963bc) !important;
            box-shadow: 0 15px 25px -8px #b14e9a;
            transform: scale(1.02);
        }

        /* ===== LINK DAFTAR ===== */
        a.font-medium {
            color: var(--info) !important;
            font-weight: 600;
            text-decoration: underline wavy var(--primary) 1.5px;
            text-underline-offset: 4px;
        }

        a.font-medium:hover {
            color: var(--primary) !important;
        }

        /* ===== LOGO ALAT MASAK YANG BAGUS ===== */
        .logo-container {
            background: rgba(76, 59, 68, 0.7);
            padding: 0.8rem 2rem;
            border-radius: 80px;
            backdrop-filter: blur(4px);
            border: 1px solid var(--border);
            box-shadow: 0 8px 20px rgba(0,0,0,0.6);
            display: inline-flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
            margin: 1rem 0 1.5rem 0;
        }

        .logo-container:hover {
            border-color: var(--primary);
            box-shadow: 0 8px 25px rgba(241, 99, 213, 0.3);
            transform: translateY(-2px);
        }

        .cookware-logo {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo-icon {
            font-size: 2.2rem;
            color: var(--primary);
            filter: drop-shadow(0 0 8px rgba(241, 99, 213, 0.5));
            animation: gentleFloat 3s ease-in-out infinite;
        }

        .logo-icon-secondary {
            font-size: 1.8rem;
            color: var(--secondary);
            margin-left: -5px;
            filter: drop-shadow(0 0 5px rgba(212, 88, 177, 0.5));
        }

        .logo-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .logo-text-main {
            color: #fad3ec;
            font-weight: 700;
            font-size: 1.8rem;
            letter-spacing: 1px;
        }

        .logo-text-sub {
            color: var(--text-primary);
            font-size: 0.8rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        @keyframes gentleFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-3px); }
        }

        /* ===== DECORATIVE COOKWARE ICONS ===== */
        .decor-icon {
            position: fixed;
            font-size: 2rem;
            color: rgba(241, 99, 213, 0.1);
            z-index: 0;
            pointer-events: none;
        }

        .decor-1 {
            top: 10%;
            left: 5%;
            transform: rotate(-15deg);
            font-size: 3rem;
        }

        .decor-2 {
            bottom: 10%;
            right: 5%;
            transform: rotate(20deg);
            font-size: 3.5rem;
        }

        .decor-3 {
            top: 40%;
            right: 10%;
            transform: rotate(45deg);
            font-size: 2.5rem;
        }

        /* ===== BADGE ALAT MASAK ===== */
        .tool-badge {
            background: var(--accent);
            color: var(--primary);
            font-size: 0.8rem;
            padding: 0.3rem 1rem;
            border-radius: 30px;
            border: 1px solid var(--primary-dark);
            margin-left: 0.7rem;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        /* ===== ALERT NOTIFICATION ===== */
        .fixed.top-4.right-4 {
            border-radius: 30px !important;
            border-left: 8px solid;
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 30px -10px black;
            padding: 1rem 1.5rem;
            max-width: 350px;
            z-index: 1000;
        }

        .bg-green-50 {
            background: rgba(36, 60, 46, 0.95) !important;
            border-left-color: var(--success) !important;
            color: #cdf5dc !important;
        }

        .bg-red-50 {
            background: rgba(71, 41, 48, 0.95) !important;
            border-left-color: var(--danger) !important;
            color: #ffd6d6 !important;
        }

        .text-green-800, .text-red-800 {
            color: inherit !important;
        }

        /* ===== FIX SCROLL ===== */
        .main-container {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .content-wrapper {
            width: 100%;
            max-width: 28rem;
            margin: 0 auto;
        }

        /* responsive untuk layar kecil */
        @media (max-width: 640px) {
            .main-container {
                padding: 1.5rem 1rem;
            }
            
            .logo-container {
                padding: 0.6rem 1.2rem;
            }
            
            .logo-text-main {
                font-size: 1.5rem;
            }
        }
    </style>

    <!-- laravel mix -->
    <link href="{{ mix('resources/css/app.css') }}" rel="stylesheet">
</head>
<body>

    <!-- decorative cookware icons -->
    <div class="decor-icon decor-1">
        <i class="fas fa-utensils"></i>
    </div>
    <div class="decor-icon decor-2">
        <i class="fas fa-kitchen-set"></i>
    </div>
    <div class="decor-icon decor-3">
        <i class="fas fa-pot-food"></i>
    </div>

    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="main-container">
            <div class="content-wrapper">

                <!-- logo alat masak yang bagus -->
                <div class="flex justify-center">
                    <a href="#" class="logo-container">
                        <div class="cookware-logo">
                            <i class="fas fa-utensil-spoon logo-icon"></i>
                            <i class="fas fa-utensils logo-icon-secondary"></i>
                        </div>
                        <div class="logo-text">
                            <span class="logo-text-main">Peminjaman</span>
                            <span class="logo-text-sub">alat masak</span>
                        </div>
                    </a>
                </div>

                <!-- card login -->
                <div class="w-full bg-white rounded-lg shadow dark:border dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-7 space-y-5 md:space-y-6 sm:p-9">
                        <div class="flex items-center justify-between flex-wrap gap-2">
                            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white flex items-center gap-2">
                                <i class="fas fa-utensil-spoon" style="color: var(--primary);"></i> 
                                login peminjaman
                            </h1>
                            <span class="tool-badge">
                                <i class="fas fa-utensils"></i> 500+ alat
                            </span>
                        </div>
                        <p class="text-sm text-gray-400 -mt-2">masuk untuk meminjam peralatan dapur berkualitas</p>

                        <form class="space-y-5 md:space-y-6" action="/login" method="POST">
                            @csrf
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-900 dark:text-white">
                                    <i class="fas fa-envelope" style="color: var(--primary); margin-right: 5px;"></i>
                                    email
                                </label>
                                <input type="email" name="email" id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="nama@email.com" required>
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-900 dark:text-white">
                                    <i class="fas fa-lock" style="color: var(--primary); margin-right: 5px;"></i>
                                    kata sandi
                                </label>
                                <input type="password" name="password" id="password" placeholder="••••••••"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                            </div>

                            <!-- CHECKBOX INGAT SAYA (TANPA LUPAPASSWORD) -->
                            <div class="flex items-center">
                                <div class="flex items-center h-5">
                                    <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500 dark:text-gray-300">ingat saya</label>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full text-white bg-primary hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-3 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <i class="fas fa-utensil-spoon" style="margin-right: 8px;"></i>
                                masuk & pinjam
                            </button>

                            <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
                                belum punya akun? 
                                <a href="/register" class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                                    daftar di sini
                                </a>
                            </p>
                        </form>

                        <!-- cookware features -->
                        <div class="grid grid-cols-3 gap-2 pt-4 border-t border-gray-700">
                            <div class="text-center">
                                <i class="fas fa-utensils text-primary" style="font-size: 1.2rem;"></i>
                                <p class="text-xs text-gray-400 mt-1">alat lengkap</p>
                            </div>
                            <div class="text-center">
                                <i class="fas fa-clock text-primary" style="font-size: 1.2rem;"></i>
                                <p class="text-xs text-gray-400 mt-1">sewa harian</p>
                            </div>
                            <div class="text-center">
                                <i class="fas fa-truck text-primary" style="font-size: 1.2rem;"></i>
                                <p class="text-xs text-gray-400 mt-1">antar jemput</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <!-- ALERT SUKSES -->
    @if (session('success'))
        <div id="alert-success" class="fixed top-5 right-5 z-50 flex items-center p-4 mb-4 text-green-800 rounded-2xl bg-green-50 shadow-2xl border-l-8 border-green-500" role="alert">
            <i class="fas fa-check-circle flex-shrink-0 w-5 h-5"></i>
            <span class="sr-only">success</span>
            <div class="ms-3 text-sm font-medium">{{ session('success') }}</div>
            <button type="button" class="ms-auto bg-green-50 text-green-500 rounded-full p-1.5 hover:bg-white/20 border-0" aria-label="Close" onclick="this.closest('[id^=alert-]').remove()">
                <i class="fas fa-times w-3 h-3"></i>
            </button>
        </div>
    @endif

    <!-- ALERT ERROR -->
    @if (session('error'))
        <div id="alert-error" class="fixed top-5 right-5 z-50 flex items-center p-4 mb-4 text-red-800 rounded-2xl bg-red-50 shadow-2xl border-l-8 border-red-500" role="alert">
            <i class="fas fa-exclamation-circle flex-shrink-0 w-5 h-5"></i>
            <span class="sr-only">error</span>
            <div class="ms-3 text-sm font-medium">{{ session('error') }}</div>
            <button type="button" class="ms-auto bg-red-50 text-red-500 rounded-full p-1.5 hover:bg-white/20 border-0" aria-label="Close" onclick="this.closest('[id^=alert-]').remove()">
                <i class="fas fa-times w-3 h-3"></i>
            </button>
        </div>
    @endif

    <!-- ALERT VALIDATION ERROR -->
    @if ($errors->any())
        <div id="alert-validation" class="fixed top-5 right-5 z-50 flex items-center p-4 mb-4 text-red-800 rounded-2xl bg-red-50 shadow-2xl border-l-8 border-warning" role="alert">
            <i class="fas fa-exclamation-triangle flex-shrink-0 w-5 h-5"></i>
            <span class="sr-only">validation error</span>
            <ul class="ms-3 text-sm font-medium list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="ms-auto bg-red-50 text-red-500 rounded-full p-1.5 hover:bg-white/20 border-0" aria-label="Close" onclick="this.closest('[id^=alert-]').remove()">
                <i class="fas fa-times w-3 h-3"></i>
            </button>
        </div>
    @endif

    <script>
        (function() {
            // auto-hide alerts after 4.5 seconds
            const alerts = document.querySelectorAll('[id^="alert-"]');
            alerts.forEach(alert => {
                setTimeout(() => {
                    if (alert && alert.parentNode) {
                        alert.style.transition = 'opacity 0.4s';
                        alert.style.opacity = '0';
                        setTimeout(() => alert.remove(), 400);
                    }
                }, 4500);
            });
        })();
    </script>

    <!-- Flowbite JS -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>