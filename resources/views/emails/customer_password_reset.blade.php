<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Request</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: none;
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
        .message {
            font-size: 15px;
            color: #555555;
            margin-bottom: 25px;
        }
        .btn-wrapper {
            text-align: center;
            margin: 30px 0;
        }
        .btn-reset {
            background-color: #1b4d3e;
            color: #ffffff !important;
            padding: 14px 32px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            font-size: 15px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }
        .note {
            font-size: 13px;
            color: #777777;
            background-color: #f9f9f9;
            padding: 15px;
            border-left: 4px solid #c89b23;
            border-radius: 4px;
            margin-top: 25px;
        }
        .link-alt {
            word-break: break-all;
            font-size: 12px;
            color: #888888;
            margin-top: 20px;
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
            <!-- Header with Brand Logo / Name -->
            <div class="header">
                @if($siteLogo)
                    <img src="{{ $siteLogo }}" alt="{{ $siteName }}">
                @endif
                <h1>{{ $siteName }}</h1>
            </div>

            <!-- Content Area -->
            <div class="content">
                <div class="greeting">Hello {{ $customer->first_name ?? 'Valued Customer' }},</div>
                
                <p class="message">
                    We received a request to reset the password for your account associated with <strong>{{ $customer->email }}</strong>.
                </p>

                <p class="message">
                    Click the button below to reset your password. This link is valid for 60 minutes.
                </p>

                <div class="btn-wrapper">
                    <a href="{{ $resetUrl }}" class="btn-reset" target="_blank">Reset Password</a>
                </div>

                <div class="note">
                    If you did not request a password reset, no further action is required and your account remains completely secure.
                </div>

                <div class="link-alt">
                    <p>If you are having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:</p>
                    <a href="{{ $resetUrl }}" style="color: #1b4d3e;">{{ $resetUrl }}</a>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                &copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.<br>
                This is an automated email, please do not reply to this message.
            </div>
        </div>
    </div>
</body>
</html>
