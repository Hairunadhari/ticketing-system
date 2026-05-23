@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Profile</h1>
    </div>

    <div class="section-body">
        @php
            $roleLabels = [
                'user'              => 'User',
                'it_helpdesk'       => 'IT Helpdesk',
                'it_infrastructure' => 'IT Infrastructure',
            ];
            $roleName = $roleLabels[Auth::user()->role->name ?? ''] ?? '-';
        @endphp

        <div class="row">

            <!-- Left: Profile Card -->
            <div class="col-12 col-md-4 col-lg-3">
                <div class="card" style="overflow: hidden;">
                    <div style="height: 100px; background: #6c63ff;"></div>
                    <div class="card-body text-center" style="padding-top: 0;">
                        <div style="margin-top: -30px; margin-bottom: 12px;">
                            <div style="
                                width: 60px; height: 60px;
                                border-radius: 50%;
                                background: #6c63ff;
                                display: inline-flex;
                                align-items: center;
                                justify-content: center;
                                font-size: 22px; font-weight: 600;
                                color: #fff;
                                border: 3px solid #fff;
                            ">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        </div>
                        <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                        <p class="text-muted mb-2" style="font-size: 13px;">
                            {{ $roleName }}
                        </p>
                        <span class="badge badge-success mb-3">Active</span>

                        <div style="border-top: 1px solid #f0f0f0; padding-top: 15px; text-align: left;">
                            <div>
                                <div class="text-muted" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <i class="fas fa-envelope mr-1" style="color: #6c63ff;"></i> Email
                                </div>
                                <div style="font-size: 13px; word-break: break-all; margin-top: 2px;">
                                    {{ Auth::user()->email }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Edit Form -->
            <div class="col-12 col-md-8 col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-user mr-2" style="color: #6c63ff; height: 70px;"></i> Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name', Auth::user()->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email', Auth::user()->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save mr-1"></i> Save Changes
                                    </button>
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary ml-2">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
