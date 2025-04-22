<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Email Verification | Tstone</title>
  <!-- Favicon -->
  <link rel="icon" href="/images/Vector.png" type="image/x-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Itim&display=swap" rel="stylesheet">

  <!-- Bootstrap -->
  <link href="/styles/bootstrap.min.css" rel="stylesheet">

  <!-- Custom Styles -->
  <style>
    :root {
      --primary: #4A6FFF;
      --light-bg: #F1EBDC;
      --gray-text: #6c757d;
      --border: #e2e8f0;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--light-bg);
      margin: 0;
      padding: 0;
    }

    .verification-card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
      padding: 2rem;
    }

    .verification-card h3 {
      font-family: 'Itim', cursive;
      text-align: center;
      margin-bottom: 1.5rem;
      color: #333;
    }

    .verification-card p {
      text-align: center;
      color: var(--gray-text);
      margin-bottom: 1.5rem;
      font-size: 0.95rem;
    }

    .form-control {
      text-align: center;
      letter-spacing: 2px;
      font-size: 1.25rem;
      border-color: var(--border);
    }

    .form-control:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(74, 111, 255, 0.1);
    }

    .timer {
      font-size: 0.9rem;
      color: var(--gray-text);
      text-align: center;
    }

    .btn-primary {
      background: var(--primary);
      border: none;
      font-weight: 600;
    }

    .btn-primary:hover {
      background: darken(var(--primary), 10%);
    }

    .link-disabled {
      color: var(--gray-text) !important;
      pointer-events: none;
    }
  </style>
</head>

<body class="d-flex vh-100 justify-content-center align-items-center">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-6 col-lg-5">
        @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle me-2" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
          </svg>
          {{ session('message') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="verification-card">
          <h3>Verify Your Email</h3>
          <p>We've sent a verification code to your email. Enter it below to confirm your account.</p>

          @if($errors->any())
          <div class="alert alert-danger" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle me-2" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
              <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
            </svg>
            {{ $errors->first() }}
          </div>
          @endif

          <form method="POST" action="/verify-email">
            @csrf
            <div class="mb-4">
              <label for="key" class="form-label">Verification Code</label>
              <input id="key" name="key" type="text" maxlength="6" class="form-control shadow" placeholder="000000" required autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary w-100 mb-3">Verify Email</button>

            <div class="text-center mb-3">
              <a id="resendBtn" href="{{ route('verify-email.resend') }}" class="link-primary" role="button">Resend code</a>
            </div>

            <div id="timer" class="timer d-none">
              You can request a new code in <span id="countdown">60</span> seconds
            </div>
          </form>

          <div class="text-center mt-4">
            <form action="{{ route('logout') }}" method="post">
              @csrf
              <button type="submit" class="btn btn-outline-secondary">Back to Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="/js/bootstrap.bundle.min.js"></script>
  <script>
    const resendBtn = document.getElementById('resendBtn');
    const timerDiv = document.getElementById('timer');
    const countdown = document.getElementById('countdown');
    let timerInterval;

    let timeLeft = parseInt(sessionStorage.getItem('verificationTimer') || '0', 10);
    if (timeLeft > 0) startTimer(timeLeft);

    resendBtn.addEventListener('click', function(e) {
      if (!timerDiv.classList.contains('d-none')) e.preventDefault();
      else startTimer(60);
    });

    function startTimer(sec) {
      timeLeft = sec;
      timerDiv.classList.remove('d-none');
      resendBtn.classList.add('link-disabled');
      countdown.textContent = timeLeft;
      sessionStorage.setItem('verificationTimer', timeLeft);

      clearInterval(timerInterval);
      timerInterval = setInterval(() => {
        timeLeft--;
        countdown.textContent = timeLeft;
        sessionStorage.setItem('verificationTimer', timeLeft);

        if (timeLeft <= 0) {
          clearInterval(timerInterval);
          timerDiv.classList.add('d-none');
          resendBtn.classList.remove('link-disabled');
          sessionStorage.removeItem('verificationTimer');
        }
      }, 1000);
    }
  </script>
</body>

</html>
