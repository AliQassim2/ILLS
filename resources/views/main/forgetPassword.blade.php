<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Tstone</title>
    <!-- icon -->
    <link rel="icon" href="imges/Vector.png" type="image/x-icon" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Itim&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles/saign.css">
    <style>
        :root {
            --primary-color: #4A6FFF;
            --error-color: #ff4a4a;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #F1EBDC;
        }

        .forgot-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            padding: 40px;
            max-width: 450px;
            width: 90%;
        }

        .forgot-container h3 {
            font-family: 'Itim', cursive;
            font-size: 2rem;
            color: #333;
            margin-bottom: 1.5rem;
            text-align: center;
            text-transform: capitalize;
        }

        .forgot-container p {
            text-align: center;
            color: #6c757d;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }

        .form-control {
            border: 1px solid #e2e8f0;
            padding: 12px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(74, 111, 255, 0.1);
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #4a5568;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #3a5ddd;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(74, 111, 255, 0.2);
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .back-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.95rem;
        }

        .back-link a {
            color: var(--primary-color);
            position: static;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        .btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn:hover {
            background-color: #3a5ddd;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(74, 111, 255, 0.2);
        }
    </style>
</head>

<body>
    <div class="vh-100 d-flex align-items-center justify-content-center flex-column">
        <div class="forgot-container">
            <h3>Forgot Password</h3>
            <p>Enter your email address and we'll send you a link to reset your password.</p>

            @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle me-2" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                </svg>
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle me-2" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                </svg>
                {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('password.email') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required
                        value="{{ old('email') }}" placeholder="your@email.com">
                    @error('email')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn">Send Reset Link</button>
            </form>
        </div>
        <div class="back-link">
            <a href="{{ route('login') }}">Back to login</a>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>