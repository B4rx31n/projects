<!-- Top Navigation -->
<nav class="sb-topnav navbar navbar-expand navbar-dark">
    <!-- Navbar Brand -->
    <a class="navbar-brand ps-3" href="{{ url('/') }}">
        <i class="fas fa-store me-2"></i>
        UKK Application
    </a>
    
    <!-- Sidebar Toggle -->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>
    
    <!-- Navbar Search -->
    <div class="navbar-search d-none d-md-flex ms-auto me-0 me-md-3">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Cari..." />
            <button class="btn" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    
    <!-- Navbar User -->
    @if(Auth::guard('admin')->check())
    <div class="navbar-user ms-auto ms-md-0 me-3 me-lg-4">
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                <div class="user-profile-avatar">
                    <div class="avatar-initials">AU</div>
                    <div class="avatar-badge"></div>
                </div>
                <span class="user-name d-none d-md-inline">Admin UKK</span>
                <i class="fas fa-chevron-down dropdown-arrow"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li class="dropdown-header">
                    <div class="user-profile-info">
                        <div class="user-profile-avatar-lg">
                            <div class="avatar-initials-lg">AU</div>
                        </div>
                        <div class="user-profile-details">
                            <h6>{{ Auth::guard('admin')->user()->name }}</h6>
                            <p>admin@ukk.com</p>
                            <span class="user-role">Role {{ Auth::guard('admin')->user()->role }}</span>
                        </div>
                    </div>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user-circle me-3"></i>
                        <span>Profil Saya</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-cog me-3"></i>
                        <span>Pengaturan</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-history me-3"></i>
                        <span>Log Aktivitas</span>
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger" style="border: none; background: none; width: 100%; text-align: left;">
                            <i class="fas fa-sign-out-alt me-3"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    @elseif(Auth::check())
    <div class="navbar-user ms-auto ms-md-0 me-3 me-lg-4">
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                <div class="user-profile-avatar">
                    <div class="avatar-initials">U</div>
                    <div class="avatar-badge"></div>
                </div>
                <span class="user-name d-none d-md-inline">{{ Auth::user()->name }}</span>
                <i class="fas fa-chevron-down dropdown-arrow"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li class="dropdown-header">
                    <div class="user-profile-info">
                        <div class="user-profile-avatar-lg">
                            <div class="avatar-initials-lg">U</div>
                        </div>
                        <div class="user-profile-details">
                            <h6>{{ Auth::user()->name }}</h6>
                            <p>{{ Auth::user()->email }}</p>
                            <span class="user-role">User</span>
                        </div>
                    </div>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="{{ route('user.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-3"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('user.logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger" style="border: none; background: none; width: 100%; text-align: left;">
                            <i class="fas fa-sign-out-alt me-3"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    @else
    <div class="navbar-user ms-auto ms-md-0 me-3 me-lg-4 d-flex flex-column">
        <a href="{{ route('user.login') }}" class="btn btn-outline-primary mb-1">Login</a>
        <a href="{{ route('user.register') }}" class="btn btn-primary">Register</a>
    </div>
    @endif
</nav>

<!-- Styles -->
<style>
.sb-topnav {
    background: linear-gradient(135deg, 
        rgba(99, 102, 241, 0.95) 0%,
        rgba(139, 92, 246, 0.95) 100%);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-bottom: none;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 0.5rem 0;
    position: sticky;
    top: 0;
    z-index: 1030;
}

/* Brand */
.navbar-brand {
    font-weight: 700;
    font-size: 1.3rem;
    color: white !important;
    display: flex;
    align-items: center;
    letter-spacing: 0.5px;
}

.navbar-brand i {
    font-size: 1.6rem;
    opacity: 0.9;
}

/* Sidebar Toggle */
#sidebarToggle {
    color: white;
    font-size: 1.25rem;
    padding: 0.5rem 0.75rem;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

#sidebarToggle:hover {
    background: rgba(255, 255, 255, 0.2);
}

/* Search */
.navbar-search .input-group {
    border-radius: 8px;
    overflow: hidden;
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.25);
    transition: all 0.3s;
}

.navbar-search .input-group:focus-within {
    background: rgba(255, 255, 255, 0.25);
    border-color: rgba(255, 255, 255, 0.4);
}

.navbar-search .form-control {
    background: transparent;
    border: none;
    color: white;
    padding: 0.6rem 1rem;
    width: 250px;
    font-size: 0.9rem;
}

.navbar-search .form-control::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

.navbar-search .form-control:focus {
    background: transparent;
    color: white;
    box-shadow: none;
}

.navbar-search .btn {
    background: rgba(255, 255, 255, 0.15);
    border: none;
    color: white;
    padding: 0.6rem 1rem;
    transition: all 0.3s;
}

.navbar-search .btn:hover {
    background: rgba(255, 255, 255, 0.25);
}

/* User Profile (GABUNGAN: Avatar + Nama + Arrow) */
.nav-link.dropdown-toggle {
    padding: 0.5rem 0.75rem;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
    color: white;
    text-decoration: none;
    gap: 0.75rem;
}

.nav-link.dropdown-toggle:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.3);
}

.user-profile-avatar {
    position: relative;
    width: 36px;
    height: 36px;
    flex-shrink: 0;
}

.avatar-initials {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: linear-gradient(135deg, #ffffff, #f3f4f6);
    color: #6366f1;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 0.95rem;
    border: 2px solid white;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.avatar-badge {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 10px;
    height: 10px;
    background: #10b981;
    border-radius: 50%;
    border: 2px solid #6366f1;
}

.user-name {
    font-weight: 500;
    font-size: 0.95rem;
    color: white;
}

.dropdown-arrow {
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.7);
    transition: transform 0.3s;
}

.dropdown.show .dropdown-arrow {
    transform: rotate(180deg);
}

/* Dropdown Menu */
.dropdown-menu {
    border: none;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    background: white;
    margin-top: 8px;
    min-width: 280px;
    padding: 0;
    overflow: hidden;
}

.dropdown-header {
    padding: 1.5rem;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    margin: 0;
}

.user-profile-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.user-profile-avatar-lg {
    width: 48px;
    height: 48px;
    flex-shrink: 0;
}

.avatar-initials-lg {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: white;
    color: #6366f1;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.1rem;
    border: 3px solid rgba(255, 255, 255, 0.5);
}

.user-profile-details {
    flex: 1;
    color: white;
}

.user-profile-details h6 {
    font-weight: 600;
    margin-bottom: 0.25rem;
    font-size: 1rem;
}

.user-profile-details p {
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.85rem;
    margin-bottom: 0.5rem;
}

.user-role {
    display: inline-block;
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 0.2rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
}

/* Dropdown Items */
.dropdown-divider {
    margin: 0;
    border-color: #f1f5f9;
}

.dropdown-item {
    padding: 0.875rem 1.5rem;
    color: #475569;
    font-weight: 500;
    display: flex;
    align-items: center;
    transition: all 0.2s ease;
}

.dropdown-item i {
    width: 20px;
    color: #64748b;
    font-size: 1rem;
}

.dropdown-item:hover {
    background: #f8fafc;
    color: #6366f1;
}

.dropdown-item:hover i {
    color: #6366f1;
}

.dropdown-item.text-danger {
    color: #ef4444 !important;
}

.dropdown-item.text-danger i {
    color: #ef4444;
}

.dropdown-item.text-danger:hover {
    background: #fef2f2;
    color: #dc2626 !important;
}

.dropdown-item.text-danger:hover i {
    color: #dc2626;
}

/* Responsive */
@media (max-width: 768px) {
    .navbar-search {
        order: 3;
        width: 100%;
        margin: 1rem 0;
        padding: 0 1rem;
    }
    
    .navbar-search .input-group {
        width: 100%;
    }
    
    .navbar-search .form-control {
        width: 100%;
    }
    
    .user-name {
        display: none !important;
    }
    
    .nav-link.dropdown-toggle {
        padding: 0.5rem;
        gap: 0;
    }
    
    .user-profile-avatar {
        width: 32px;
        height: 32px;
    }
    
    .avatar-initials {
        font-size: 0.85rem;
    }
}

@media (max-width: 576px) {
    .dropdown-menu {
        min-width: 250px;
        position: fixed !important;
        right: 1rem !important;
        left: auto !important;
    }
}
</style>