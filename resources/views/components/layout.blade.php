<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
    <!-- icon -->
    <link rel="icon" href="imges/Vector.png" type="image/x-icon" />
    <!-- itim font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Itim&family=Karla:ital,wght@0,200..800;1,200..800&family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- inter font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Karla:ital,wght@0,200..800;1,200..800&family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- bootstrab -->
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <!-- main -->
    <link rel="stylesheet" href="styles/main.css">
</head>

<body>
    <!--start logo -->
    <header class="d-flex justify-content-center ">
        <img src="imges/logo.png" alt="logo">
    </header>
    <nav class="d-flex justify-content-center">
        <ul class="nav rounded-pill justify-content-center shadow">
            <li class="nav-item">
                <a class="nav-link text-black" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black" href="track">Track</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black" href="test">Test</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link active" href="about">About us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black" href="profile">Profile</a>
            </li>
        </ul>
    </nav>
    <main>
        {{ $slot }}
    </main>

    <footer>

    </footer>

    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>

</html>