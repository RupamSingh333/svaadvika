<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Successfully Changed</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            width: 100%;
            background-color: #f4f6f8;
            padding: 30px 0;
        }
        .container {
            max-width: 580px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        .header {
            background-color: #12241A;
            padding: 30px;
            text-align: center;
        }
        .header img {
            max-height: 50px;
            margin-bottom: 10px;
        }
        .header h1 {
            color: #ffffff;
            font-size: 22px;
            margin: 0;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .content {
            padding: 40px 30px;
            color: #333333;
            line-height: 1.6;
        }
        .greeting {
            font-size: 18px;
            font-weight: bold;
            color: #12241A;
            margin-bottom: 15px;
        }
        .alert-box {
            background-color: #e8f5e9;
            border-left: 4px solid #2e7d32;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            color: #1b5e20;
            font-weight: 500;
        }
        .message {
            font-size: 15px;
            color: #555555;
            margin-bottom: 25px;
        }
        .btn-wrapper {
            text-align: center;
            margin: 30px 0;
        }
        .btn-login {
            background-color: #1b4d3e;
            color: #ffffff !important;
            padding: 14px 32px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            font-size: 15px;
            display: inline-block;
        }
        .warning-box {
            font-size: 13px;
            color: #721c24;
            background-color: #f8d7da;
            padding: 15px;
            border-left: 4px solid #f5c6cb;
            border-radius: 4px;
            margin-top: 25px;
        }
        .footer {
            background-color: #fafafa;
            border-top: 1px solid #eeeeee;
            padding: 20px 30px;
            text-align: center;
            font-size: 12px;
            color: #999999;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                @if($siteLogo)
                    <img src="{{ $siteLogo }}" alt="{{ $siteName }}">
                @endif
                <h1>{{ $siteName }}</h1>
            </div>

            <div class="content">
                <div class="greeting">Hello {{ $customer->first_name ?? 'Valued Customer' }},</div>
                
                <div class="alert-box">
                    Your password has been changed successfully!
                </div>

                <p class="message">
                    This notification confirms that the password for your account (<strong>{{ $customer->email }}</strong>) was recently updated.
                </p>

                <div class="btn-wrapper">
                    <a href="{{ route('login') }}" class="btn-login" target="_blank">Login to Your Account</a>
                </div>

                <div class="warning-box">
                    <strong>Security Notice:</strong> If you did not make this password change yourself, please reset your password immediately or contact our support team.
                </div>
            </div>

            <div class="footer">
                &copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.<br>
                This is an automated email, please do not reply to this message.
            </div>
        </div>
    </div>
</body>
</html>
