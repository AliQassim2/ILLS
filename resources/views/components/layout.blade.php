<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
    <!-- icon -->
    <link rel="icon" href="{{ asset('imges/Vector.png') }} " type="image/x-icon" />
    <!-- itim font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Itim&family=Karla:ital,wght@0,200..800;1,200..800&family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- inter font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Karla:ital,wght@0,200..800;1,200..800&family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- bootstrab -->
    <link rel="stylesheet" href="{{ asset('styles/bootstrap.min.css') }}">
    <!-- main -->
    <link rel="stylesheet" href="{{ asset('styles/main.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <!--start logo -->
    <header class="d-flex justify-content-around align-items-center  ">
        <img src="{{ asset('imges/logo.png') }}" alt="Logo">
        <nav class="nav-phone   d-lg-none">
            <button onclick="list()"><i class="fa-solid fa-bars" ></i></button>
            <div class="conten position-absolute">

                <x-list classes="text-black home" url="/">Home</x-nav>

                <x-list classes="text-black rank" url="/rank">Rank</x-nav>
                <x-list classes="text-black stories" url="/stories">Stories</x-nav>
                <x-list classes="text-black about us" url="/about">About us</x-nav>
                @auth
                <x-list classes="text-black profile" url="/profile">Profile</x-nav>

                @endauth
                @guest
                <x-list classes="text-black" url="/login">login</x-nav>
                @endguest

            </div>
        </nav>
    </header>
    <nav class=" d-none  d-lg-flex justify-content-center ">
        <ul class="nav rounded-pill justify-content-center shadow ">

                        <x-list classes="text-black home" url="/">Home</x-nav>

                        <x-list classes="text-black rank" url="/rank">Rank</x-nav>
                        <x-list classes="text-black stories" url="/stories">Stories</x-nav>
                        <x-list classes="text-black about us" url="/about">About us</x-nav>
                    @auth
                        <x-list classes="text-black profile" url="/profile">Profile</x-nav>

                    @endauth
                    @guest
                        <x-list classes="text-black" url="/login">login</x-nav>
                    @endguest
        </ul>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer>

    </footer>

    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/nav.js') }}"></script>
    <script src="https://kit.fontawesome.com/2ed8d87d68.js" crossorigin="anonymous"></script>
</body>

</html>
