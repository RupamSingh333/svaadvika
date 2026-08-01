<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to {{ $siteName }}</title>
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
            font-size: 20px;
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
        .btn-shop {
            background-color: #1b4d3e;
            color: #ffffff !important;
            padding: 14px 32px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            font-size: 15px;
            display: inline-block;
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
                <div class="greeting">Welcome to {{ $siteName }}, {{ $customer->first_name }}! 🎉</div>
                
                <p class="message">
                    Thank you for creating an account with us. We're thrilled to have you join our community!
                </p>

                <p class="message">
                    Your account is registered under <strong>{{ $customer->email }}</strong>. You can now browse our collections, place orders, and track your history anytime.
                </p>

                <div class="btn-wrapper">
                    <a href="{{ route('frontend.products') }}" class="btn-shop" target="_blank">Explore Products</a>
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
