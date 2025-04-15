<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a2d9d5b6b4.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 bg-dark text-white min-vh-100 p-3">
                <h4 class="mb-4">Dashboard</h4>
                <ul class="nav flex-column">




                    @if (Auth::user()->role == 0)
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{ route('dashboard.users') }}">
                            <i class="fas fa-users me-2"></i> Users
                        </a>
                    </li>
                    @endif
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{ route('dashboard.stories') }}">
                            <i class="fas fa-book me-2"></i> Stories
                        </a>
                    </li>
                    <li class="nav-item mt-4">
                        <a href="{{ url('/') }}" class="btn btn-outline-light w-100">
                            <i class="fas fa-home me-2"></i> Go to Home
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 p-4">
                @yield('content') <!-- This is where child views will inject content -->
            </div>
        </div>
    </div>
</body>

</html>