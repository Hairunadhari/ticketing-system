@extends('layouts.master')

@section('content')
<style>
    body, #app { min-height: 100vh; }

    .login-center {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        background: #f4f6fb;
    }

    .login-box { width: 100%; max-width: 400px; }

    /* Icon badge */
    .login-icon-wrap {
        width: 56px; height: 56px;
        background: #ebf2fd;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1rem;
    }
    .login-icon-wrap i { font-size: 26px; color: #2d6fd6; }

    .login-heading {
        text-align: center;
        margin-bottom: 1.75rem;
    }
    .login-heading h1 {
        font-size: 22px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 4px;
    }
    .login-heading p {
        font-size: 14px;
        color: #6b7280;
        margin: 0;
    }

    /* Card */
    .login-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 1.75rem;
    }

    /* Field */
    .field-group { margin-bottom: 1rem; }
    .field-group label {
        display: block;
        font-size: 13px;
        color: #374151;
        margin-bottom: 6px;
        font-weight: 500;
    }
    .field-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 6px;
    }
    .field-row label { margin-bottom: 0; }
    .forgot-link { font-size: 12px; color: #2d6fd6; text-decoration: none; }
    .forgot-link:hover { text-decoration: underline; }

    /* Input */
    .input-icon-wrap { position: relative; }
    .input-icon-wrap i {
        position: absolute;
        left: 11px; top: 50%;
        transform: translateY(-50%);
        font-size: 16px;
        color: #9ca3af;
        pointer-events: none;
    }
    .input-icon-wrap .form-control { padding-left: 36px; }
    .form-control {
        width: 100%;
        padding: 9px 12px;
        font-size: 14px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        color: #111827;
        background: #fff;
        transition: border-color 0.15s, box-shadow 0.15s;
        outline: none;
    }
    .form-control::placeholder { color: #c0c7d4; }
    .form-control:focus {
        border-color: #2d6fd6;
        box-shadow: 0 0 0 3px rgba(45,111,214,0.1);
    }

    /* Error */
    .field-error { font-size: 12px; color: #dc2626; margin-top: 5px; }

    /* Remember */
    .remember-row {
        display: flex; align-items: center;
        gap: 8px; margin-bottom: 1.4rem;
    }
    .remember-row label { font-size: 13px; color: #6b7280; cursor: pointer; margin: 0; }
    .remember-row input[type="checkbox"] { width: 15px; height: 15px; cursor: pointer; accent-color: #2d6fd6; }

    /* Primary button */
    .btn-login {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        font-weight: 600;
        background: #2d6fd6;
        color: #fff;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: background 0.15s, transform 0.1s;
        letter-spacing: 0.2px;
    }
    .btn-login:hover  { background: #245fba; }
    .btn-login:active { transform: scale(0.98); }

    /* Divider */
    .or-divider {
        display: flex; align-items: center;
        gap: 10px; margin: 1.25rem 0;
    }
    .or-line { flex: 1; height: 1px; background: #e5e7eb; }
    .or-text  { font-size: 12px; color: #9ca3af; }

    /* Google button */
    .btn-google {
        width: 100%;
        padding: 9px;
        font-size: 13px;
        font-weight: 500;
        color: #374151;
        background: #fff;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        gap: 8px;
        transition: background 0.15s;
    }
    .btn-google:hover { background: #f9fafb; }

    /* Register link */
    .register-prompt {
        text-align: center;
        font-size: 13px;
        color: #6b7280;
        margin-top: 1.25rem;
    }
    .register-prompt a {
        color: #2d6fd6;
        font-weight: 600;
        text-decoration: none;
    }
    .register-prompt a:hover { text-decoration: underline; }

    /* Footer */
    .login-footer {
        text-align: center;
        font-size: 12px;
        color: #9ca3af;
        margin-top: 0.75rem;
    }
</style>

<div class="login-center">
    <div class="login-box">

        <div class="login-heading">
            <div class="login-icon-wrap">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <h1>Welcome back</h1>
            <p>Sign in to your ticketing workspace</p>
        </div>

        <div class="login-card">

            <form method="POST" action="/login/create" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="field-group">
                    <label for="email">Email address</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-envelope"></i>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="you@company.com"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            required
                        >
                    </div>
                    @error('email')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field-group">
                    <div class="field-row">
                        <label for="password">Password</label>
                    </div>
                    <div class="input-icon-wrap">
                        <i class="fas fa-lock"></i>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="••••••••"
                            autocomplete="current-password"
                            required
                        >
                    </div>
                    @error('password')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="remember-row">
                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Remember me for 30 days</label>
                </div>

                <button type="submit" class="btn-login">Sign in</button>
            </form>
        </div>

        {{-- Register prompt --}}
        <p class="register-prompt">
            Don't have an account? <a href="{{ route('register.index') }}">Register Now</a>
        </p>

        <p class="login-footer">© {{ date('Y') }} Ticketing System · All rights reserved</p>

    </div>
</div>

@endsection
