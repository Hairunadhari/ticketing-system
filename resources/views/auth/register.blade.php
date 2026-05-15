@extends('layouts.master')

@section('content')
<style>
    body,
    #app {
        min-height: 100vh;
    }

    .register-center {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        background: #f4f6fb;
    }

    .register-box {
        width: 100%;
        max-width: 440px;
    }

    /* Icon badge */
    .register-icon-wrap {
        width: 56px;
        height: 56px;
        background: #ebf2fd;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .register-icon-wrap i {
        font-size: 26px;
        color: #2d6fd6;
    }

    .register-heading {
        text-align: center;
        margin-bottom: 1.75rem;
    }

    .register-heading h1 {
        font-size: 22px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 4px;
    }

    .register-heading p {
        font-size: 14px;
        color: #6b7280;
        margin: 0;
    }

    /* Card */
    .register-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 1.75rem;
    }

    /* Field */
    .field-group {
        margin-bottom: 1rem;
    }

    .field-group label {
        display: block;
        font-size: 13px;
        color: #374151;
        font-weight: 500;
        margin-bottom: 6px;
    }

    /* Input */
    .input-icon-wrap {
        position: relative;
    }

    .input-icon-wrap > i:first-child {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 16px;
        color: #9ca3af;
        pointer-events: none;
        z-index: 1;
    }

    .input-icon-wrap .icon-right {
        position: absolute;
        right: 11px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 14px;
        color: #9ca3af;
        pointer-events: none;
        z-index: 1;
    }

    .input-icon-wrap .form-control {
        padding-left: 36px;
    }

    .form-control {
        width: 100%;
        /* padding: 9px 15px; */
        font-size: 14px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        color: #111827;
        background: #fff;
        transition: border-color 0.15s, box-shadow 0.15s;
        outline: none;
        box-sizing: border-box;
    }

    .form-control::placeholder {
        color: #c0c7d4;
    }

    .form-control:focus {
        border-color: #2d6fd6;
        box-shadow: 0 0 0 3px rgba(45, 111, 214, 0.1);
    }

    /* Select */
    select.form-control {
        appearance: none;
        -webkit-appearance: none;
        padding-right: 36px;
        cursor: pointer;
    }

    select.form-control:focus {
        border-color: #2d6fd6;
        box-shadow: 0 0 0 3px rgba(45, 111, 214, 0.1);
    }

    /* Error */
    .field-error {
        font-size: 12px;
        color: #dc2626;
        margin-top: 5px;
    }

    /* Invalid state */
    .form-control.is-invalid {
        border-color: #dc2626;
    }

    /* Submit button */
    .btn-register {
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

    .btn-register:hover {
        background: #245fba;
    }

    .btn-register:active {
        transform: scale(0.98);
    }

    /* Footer links */
    .register-footer-link {
        text-align: center;
        font-size: 13px;
        color: #6b7280;
        margin-top: 1.25rem;
    }

    .register-footer-link a {
        color: #2d6fd6;
        text-decoration: none;
        font-weight: 500;
    }

    .register-footer-link a:hover {
        text-decoration: underline;
    }

    .register-copy {
        text-align: center;
        font-size: 12px;
        color: #9ca3af;
        margin-top: 0.5rem;
    }

    /* Responsive: stack grid on small screens */
    @media (max-width: 480px) {
        .field-row-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="register-center">
    <div class="register-box">

        <div class="register-heading">
            <div class="register-icon-wrap">
                <i class="fas fa-user-plus"></i>
            </div>
            <h1>Create an account</h1>
            <p>Join your ticketing workspace today</p>
        </div>

        <div class="register-card">
            <form method="POST" action="/register/create" enctype="multipart/form-data">
                @csrf
                @method('post')
                {{-- Full Name --}}
                <div class="field-group">
                    <label for="full_name">Full Name</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-user"></i>
                        <input type="text" id="full_name" name="full_name"
                            class="form-control @error('full_name') is-invalid @enderror"
                            placeholder="Your name"
                            value="{{ old('full_name') }}" required>
                    </div>
                    @error('full_name')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="field-group">
                    <label for="email">Email address</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Your email"
                            value="{{ old('email') }}" autocomplete="email" required>
                    </div>
                    @error('email')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="field-group">
                    <label for="password">Password</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="••••••••"
                            autocomplete="new-password" required>
                    </div>
                    @error('password')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="field-group">
                    <label for="password_confirmation">Confirm password</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control"
                            placeholder="••••••••"
                            autocomplete="new-password" required>
                    </div>
                </div>

                {{-- Role --}}
                <div class="field-group">
                    <label for="role">Role</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-id-badge"></i>
                        <select id="role" name="role_id"
                            class="form-control @error('role') is-invalid @enderror" required>
                            <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select your role</option>
                            <option value="1"        {{ old('role') == '1'        ? 'selected' : '' }}>User</option>
                            <option value="2" {{ old('role') == '2' ? 'selected' : '' }}>IT Helpdesk</option>
                            <option value="3"    {{ old('role') == '3'    ? 'selected' : '' }}>IT Infra</option>
                        </select>
                        <i class="fas fa-chevron-down icon-right"></i>
                    </div>
                    @error('role')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-register">Create account</button>
            </form>
        </div>

        <p class="register-footer-link">
            Already have an account? <a href="/login">Sign in</a>
        </p>
        <p class="register-copy">© {{ date('Y') }} Ticketing System · All rights reserved</p>

    </div>
</div>
@endsection