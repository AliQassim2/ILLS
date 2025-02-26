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
            <h3>sign up</h3>
            <form method="POST" action="">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Name</label>
                    <input type="text" class="shadow form-control" id="exampleInputEmail1" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail12" class="form-label">Email address</label>
                    <input type="email" class="shadow form-control" id="exampleInputEmail12" aria-describedby="emailHelp" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail13" class="form-label">Phone number</label>
                    <input type="text" class="shadow form-control" id="exampleInputEmail13" aria-describedby="emailHelp" name="phone" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="shadow form-control" id="exampleInputPassword1" name="pass" required>
                </div>
                <div class="mb-5">
                    <label for="exampleInputPassword1" class="form-label">Repeat Password</label>
                    <input type="password" class="shadow form-control" id="exampleInputPassword1" name="Cpass" required>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
