<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign in</title>
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
    <!-- css -->
    <link rel="stylesheet" href="styles/saign.css">
</head>

<body>
    <div class=" vh-100 d-flex align-items-center justify-content-center">
        <div class="login">
            <h3>sign in</h3>
            @error('unAuth')
            <p>worng email or password</p>
            @enderror
            <form action="{{ route('login') }}" method="post">
                @csrf
                <input type="hidden" name="redirect" value="{{ request('redirect', url()->previous()) }}">

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="shadow form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
                    @error('email')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="shadow form-control" id="exampleInputPassword1" name="password" required>
                    @error('password')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
    <a href="signup">dont have an account?</a>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>