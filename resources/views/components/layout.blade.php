<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
    <!-- icon -->
    <link rel="icon" href="{{ asset('imges/Vector.png') }}" type="image/x-icon" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Itim&family=Karla:wght@200;300;400;500;600;700;800&family=Red+Hat+Display:wght@300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('styles/bootstrap.min.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('styles/main.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="d-flex flex-column justify-content-between height" >
    <!-- Header Section -->
    <header class="d-flex  logo-container justify-content-md-center justify-content-between align-items-center px-3 px-md-5">
        <a href="/"><img src="{{ asset('imges/logo.png') }}" alt="Logo" class="logo"></a>

        <!-- Mobile Navigation Toggle -->
        <div class="d-lg-none nav-phone">
            <button id="navToggle" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Mobile Navigation Menu -->
            <ul class="conten position-absolute" id="mobileNav">
                <li><a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a></li>
                <li><a href="/rank?sort=score&page=1" class="nav-link {{ Request::is('rank*') ? 'active' : '' }}">Rank</a></li>
                <li><a href="/stories" class="nav-link {{ Request::is('stories') ? 'active' : '' }}">Stories</a></li>
                <li><a href="/about" class="nav-link {{ Request::is('about') ? 'active' : '' }}">About us</a></li>
                @auth
                <li><a href="/profile" class="nav-link {{ Request::is('profile') ? 'active' : '' }}">Profile</a></li>
                @if (Auth::user()->role==0 || Auth::user()->role==2)
                <li><a href="{{ Auth::user()->role == 2 ? route('dashboard.stories') : route('dashboard.users') }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">Dashboard</a></li>
                @endif
                @else
                <li><a href="/login" class="nav-link {{ Request::is('login') ? 'active' : '' }}">Login</a></li>
                @endauth
            </ul>
        </div>
    </header>

    <!-- Desktop Navigation -->
    <nav class="d-none d-lg-flex justify-content-center py-3">
        <ul class="nav rounded-pill justify-content-center shadow">
            <x-list classes="text-black {{ Request::is('/') ? 'active' : '' }}" url="/">Home</x-list>
            <x-list classes="text-black {{ Request::is('rank*') ? 'active' : '' }}" url="/rank?sort=score&page=1">Rank</x-list>
            <x-list classes="text-black {{ Request::is('stories') ? 'active' : '' }}" url="/stories">Stories</x-list>
            <x-list classes="text-black {{ Request::is('about') ? 'active' : '' }}" url="/about">About us</x-list>
            @auth
            <x-list classes="text-black {{ Request::is('profile') ? 'active' : '' }}" url="/profile">Profile</x-list>
            @if (Auth::user()->role==0 || Auth::user()->role==2)
            <x-list classes="text-black {{ Request::is('dashboard*') ? 'active' : '' }}" url="{{ Auth::user()->role == 2 ? route('dashboard.stories') : route('dashboard.users') }}">Dashboard</x-list>
            @endif
            @else
            <x-list classes="text-black {{ Request::is('login') ? 'active' : '' }}" url="/login">Login</x-list>
            @endauth
        </ul>
    </nav>

    <main class="hightmain">
        {{ $slot }}
    </main>

    <footer class="py-3 mt-4 text-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="">
                    <p class="mb-0"><i class="bi bi-envelope me-1"></i> tstone20252024@gmail.com</p>
                </div>
                <div class="">
                    <img src="{{ asset('imges/logo.png') }}" alt="Logo" style="max-width: 100px;">
                </div>

            </div>
            <p class="mt-2 mb-0">&copy; {{ date('Y') }} TStone</p>
        </div>
    </footer>

    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="https://kit.fontawesome.com/2ed8d87d68.js" crossorigin="anonymous"></script>
    <script>
        // Mobile navigation functionality
        document.addEventListener('DOMContentLoaded', function() {
            const navToggle = document.getElementById('navToggle');
            const mobileNav = document.getElementById('mobileNav');

            // Toggle mobile navigation
            navToggle.addEventListener('click', function() {
                if (mobileNav.style.display === 'block') {
                    mobileNav.style.display = 'none';
                } else {
                    mobileNav.style.display = 'block';
                }
            });

            // Close mobile nav when clicking outside
            document.addEventListener('click', function(event) {
                const isClickInsideNav = mobileNav.contains(event.target);
                const isClickOnToggle = navToggle.contains(event.target);

                if (!isClickInsideNav && !isClickOnToggle && mobileNav.style.display === 'block') {
                    mobileNav.style.display = 'none';
                }
            });

            // Close mobile nav when window is resized to desktop size
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992 && mobileNav.style.display === 'block') {
                    mobileNav.style.display = 'none';
                }
            });

            // Add active class to current page in navigation
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(link => {
                const linkPath = new URL(link.href, window.location.origin).pathname;

                if (currentPath === linkPath ||
                    (currentPath.includes('/rank') && linkPath.includes('/rank')) ||
                    (currentPath.includes('/dashboard') && linkPath.includes('/dashboard'))) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>
