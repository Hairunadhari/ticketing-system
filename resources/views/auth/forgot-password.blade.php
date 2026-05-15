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

    /* Status / success message */
    .alert-success {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 13px;
        color: #15803d;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: flex-start;
        gap: 8px;
    }
    .alert-success i { font-size: 15px; margin-top: 1px; flex-shrink: 0; }

    /* Field */
    .field-group { margin-bottom: 1rem; }
    .field-group label {
        display: block;
        font-size: 13px;
        color: #374151;
        margin-bottom: 6px;
        font-weight: 500;
    }

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
        box-sizing: border-box;
    }
    .form-control::placeholder { color: #c0c7d4; }
    .form-control:focus {
        border-color: #2d6fd6;
        box-shadow: 0 0 0 3px rgba(45,111,214,0.1);
    }

    /* Error */
    .field-error { font-size: 12px; color: #dc2626; margin-top: 5px; }

    /* Helper text */
    .field-hint {
        font-size: 12px;
        color: #9ca3af;
        margin-top: 5px;
        line-height: 1.5;
    }

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
        margin-top: 0.25rem;
    }
    .btn-login:hover  { background: #245fba; }
    .btn-login:active { transform: scale(0.98); }

    /* Back to login link */
    .back-link {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-align: center;
        font-size: 13px;
        color: #6b7280;
        margin-top: 1.25rem;
        text-decoration: none;
        transition: color 0.15s;
    }
    .back-link i { font-size: 12px; }
    .back-link:hover { color: #2d6fd6; }

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
                <i class="fas fa-key"></i>
            </div>
            <h1>Forgot password?</h1>
            <p>We'll send a reset link to your email</p>
        </div>

        <div class="login-card">

            {{-- Success status --}}
            @if (session('status'))
                <div class="alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

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
                    <p class="field-hint">Enter the email associated with your account and we'll send you a password reset link.</p>
                </div>

                <button type="submit" class="btn-login">Send reset link</button>
            </form>

        </div>

        <a href="/login" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to sign in
        </a>

        <p class="login-footer">© {{ date('Y') }} Ticketing System · All rights reserved</p>

    </div>
</div>

@endsection
