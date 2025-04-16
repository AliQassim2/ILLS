<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Tstone</title>
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

        .login-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            padding: 40px;
            max-width: 450px;
            width: 90%;
        }

        .login-container h3 {
            font-family: 'Itim', cursive;
            font-size: 2rem;
            color: #333;
            margin-bottom: 1.5rem;
            text-align: center;
            text-transform: capitalize;
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

        .signup-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.95rem;
        }

        .signup-link a {
            color: var(--primary-color);
            position: static;
            text-decoration: none;
            font-weight: 500;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="vh-100 d-flex align-items-center justify-content-center flex-column">
        <div class="login-container">
            <h3>Sign In</h3>

            @error('unAuth')
            <div class="alert alert-danger text-center mb-4" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle me-2" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                </svg>
                {{ $message }}
            </div>
            @enderror

            <form action="{{ route('login') }}" method="post">
                @csrf
                <input type="hidden" name="redirect" value="{{ request('redirect', url()->previous()) }}">

                <div class="mb-4">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required
                        value="{{ old('email') }}" placeholder="your@email.com">
                    @error('email')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">

                    <input type="password" class="form-control" id="password" name="password" required
                        placeholder="••••••••">
                    @error('password')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>



                <button type="submit" class="btn ">Sign In</button>
            </form>


        </div>
        <div class="signup-link">
                <div>Don't have an account? </div><a href="signup">Sign up</a>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
