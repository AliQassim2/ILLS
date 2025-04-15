<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification | Tstone</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .email-header {
            background-color: #4A6FFF;
            padding: 30px;
            text-align: center;
        }

        .email-header h1 {
            color: white;
            margin: 0;
            font-size: 28px;
        }

        .email-body {
            padding: 30px;
            color: #333;
        }

        .welcome-text {
            font-size: 18px;
            margin-bottom: 20px;
            text-align: center;
        }

        .code-container {
            background-color: #f5f7fa;
            border-radius: 6px;
            padding: 20px;
            text-align: center;
            margin: 25px 0;
        }

        .verification-code {
            font-size: 32px;
            letter-spacing: 4px;
            font-weight: bold;
            color: #333;
        }

        .instructions {
            margin-top: 25px;
            font-size: 14px;
            color: #666;
            line-height: 1.6;
        }

        .email-footer {
            padding: 20px 30px;
            text-align: center;
            color: #666;
            font-size: 12px;
            background-color: #f9fafc;
            border-top: 1px solid #e9ecef;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Welcome to Tstone</h1>
        </div>

        <div class="email-body">
            <p class="welcome-text">Thank you for creating an account with us! Please verify your email to get started.</p>

            <div class="code-container">
                <p>Your verification code is:</p>
                <div class="verification-code">{{ $key }}</div>
            </div>

            <div class="instructions">
                <p>To complete your registration:</p>
                <ol>
                    <li>Enter this code on the verification page</li>
                    <li>The code will expire in 60 minutes</li>
                    <li>If you didn't request this code, you can safely ignore this email</li>
                </ol>
            </div>
        </div>

        <div class="email-footer">
            <p>This is an automated message, please do not reply to this email.</p>
            <p>&copy; 2025 Tstone. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
