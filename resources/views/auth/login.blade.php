<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login - Ticketing System</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            height: 100vh;
            width: 100vw;
            overflow-x: hidden;
            background: #f5f5f5;
            position: relative;
        }

        /* glow background */
        body::before,
        body::after {
            content: "";
            position: absolute;
            width: 500px;
            height: 500px;
            filter: blur(60px);
            z-index: 0;
        }

        body::before {
            background: radial-gradient(circle, rgba(91,163,245,0.25), transparent 60%);
            top: -200px;
            left: -200px;
        }

        body::after {
            background: radial-gradient(circle, rgba(56,200,150,0.18), transparent 60%);
            bottom: -200px;
            right: -200px;
        }

        /* WRAPPER */
        .login-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            /* gap: 40px; */
            min-height: 100vh;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        /* LEFT PANEL */
        .login-left {
            flex: 1;
            max-width: 550px;
            height: 80vh;
            background: linear-gradient(135deg, #1689e2 0%, #2c61fe 60%);
            padding: 50px;
            border-top-left-radius: 18px;
            border-bottom-left-radius: 18px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 38, 161, 0.7), rgba(10,15,30,0.9));
        }

        .brand-mark {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, #5ba3f5, #38c896);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .left-headline {
            position: relative;
            z-index: 2;
        }

        .left-headline h1 {
            font-size: 32px;
            font-family: 'Syne', sans-serif;
        }

        .left-headline span {
            background: linear-gradient(90deg, #5ba3f5, #38c896);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .left-headline p {
            margin-top: 10px;
            color: rgba(255,255,255,0.7);
            max-width: 280px;
        }

        /* RIGHT PANEL */
        .login-right {
            width: 380px;
            height: 80vh;
            background: rgba(248,249,252,0.95);
            backdrop-filter: blur(20px);
            padding: 50px 40px;
            border-top-right-radius: 18px;
            border-bottom-right-radius: 18px;
            box-shadow: 0 30px 80px rgba(0,0,0,0.25);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-right h2 {
            font-family: 'Syne', sans-serif;
            font-size: 26px;
            color: #0d1b4b;
        }

        .sub {
            color: #7a8599;
            margin-bottom: 25px;
            font-size: 13px;
        }

        .field-group {
            margin-bottom: 15px;
        }

        .field-group label {
            font-size: 11px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
        }

        .input-wrap input {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            border: 1px solid rgba(0,0,0,0.08);
            background: white;
            outline: none;
            transition: 0.25s;
        }

        .input-wrap input:focus {
            border-color: #5ba3f5;
            box-shadow: 0 10px 25px rgba(91,163,245,0.15);
        }

        .remember-row {
            display: flex;
            justify-content: space-between;
            margin: 15px 0 20px;
            font-size: 13px;
        }

        .forgot-link {
            color: #5ba3f5;
            text-decoration: none;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            color: white;
            background: linear-gradient(135deg, #5ba3f5, #38c896);
            cursor: pointer;
            transition: 0.25s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 20px 0;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .divider-text {
            font-size: 11px;
            color: #9ca3af;
        }

        .sso-btn {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            background: white;
            cursor: pointer;
        }

        .footer-note {
            margin-top: 20px;
            text-align: center;
            font-size: 11px;
            color: #9ca3af;
        }

        /* =========================
           🔥 RESPONSIVE FIX FULL
        ========================= */

        /* TABLET */
        @media (max-width: 1024px) {
            .login-left {
                max-width: 45%;
            }

            .login-right {
                width: 340px;
            }
        }

        /* MOBILE */
        @media (max-width: 768px) {

            .login-wrapper {
                flex-direction: column;
                justify-content: center;
            }

            .login-left {
                display: none;
            }

            .login-right {
                width: 100%;
                max-width: 420px;
                padding: 40px 30px;
                margin: auto;
            }
        }

        /* SMALL MOBILE */
        @media (max-width: 480px) {
            .login-right {
                width: 92%;
                padding: 30px 20px;
            }

            .login-right h2 {
                font-size: 22px;
            }
        }

    </style>
</head>

<body>

<div class="login-wrapper">

    <!-- LEFT -->
    <div class="login-left">
        <div class="brand-mark">
            <div class="brand-icon">T</div>
            <div>TicketDesk</div>
        </div>

        <div class="left-headline">
            <h1>Manage tickets <span>effortlessly</span></h1>
            <p>Modern system for tracking and resolving support requests.</p>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="login-right">

        <h2>Welcome back</h2>
        <p class="sub">Sign in to continue</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="field-group">
                <label>Email</label>
                <div class="input-wrap">
                    <input type="text" name="username" placeholder="you@company.com">
                </div>
            </div>

            <div class="field-group">
                <label>Password</label>
                <div class="input-wrap">
                    <input type="password" name="password" placeholder="••••••••">
                </div>
            </div>

            <div class="remember-row">
                <label><input type="checkbox"> Remember</label>
                <a href="#" class="forgot-link">Forgot?</a>
            </div>

            <button class="btn-login">Sign In</button>
        </form>

        <div class="divider">
            <div class="divider-line"></div>
            <span class="divider-text">OR</span>
            <div class="divider-line"></div>
        </div>

        <button class="sso-btn">Continue with Google</button>

        <div class="footer-note">
            © {{ date('Y') }} TicketDesk
        </div>

    </div>

</div>

</body>
</html>
