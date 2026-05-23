<nav class="navbar navbar-expand-lg main-navbar">
    <ul class="navbar-nav d-flex flex-row align-items-center">
        {{-- Burger Menu --}}
        <li>
            <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
                <i class="fas fa-bars"></i>
            </a>
        </li>

        {{-- Profile di samping burger --}}
        <li class="nav-item dropdown">
            <a href="#" data-toggle="dropdown"
               class="nav-link nav-link-lg nav-link-user dropdown-toggle d-flex align-items-center">
                <img alt="image"
                     src="{{ asset('stisla/assets/img/avatar/avatar-1.png') }}"
                     class="rounded-circle mr-1"
                     style="width: 30px; height: 30px; object-fit: cover;">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-left shadow-sm">
                <a class="dropdown-item text-danger" href="/logout">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    <span>Logout</span>
                </a>
            </div>
        </li>
    </ul>
</nav>
