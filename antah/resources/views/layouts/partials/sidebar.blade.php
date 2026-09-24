<!-- Sidebar Navigation -->
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion" id="sidenavAccordion">
        <!-- Menu Items -->
        <div class="sb-sidenav-menu">
            <div class="nav flex-column">
                <!-- Logo/Brand with Gradient -->
                <div class="sidebar-header px-4 py-5">
                    <div class="brand-wrapper">
                        <div class="brand-logo mb-3">
                            <div class="logo-circle">
                                <i class="fas fa-store"></i>
                            </div>
                            <div class="logo-glow"></div>
                        </div>
                        <h5 class="brand-title text-white mb-1">UKK Management</h5>
                        <p class="brand-subtitle text-white-60">Enterprise Dashboard</p>
                    </div>
                    <div class="header-divider"></div>
                </div>
                
                <!-- Navigation Menu -->
                <div class="nav-menu-container">
                    <!-- Core Section -->
                    <div class="nav-section">
                        <div class="nav-section-label">
                            <span class="label-text">MAIN</span>
                            <div class="label-line"></div>
                        </div>
                        
                        @if(Auth::guard('admin')->check())
                            <a class="nav-item {{ request()->is('admin/dashboard') || request()->is('admin/dashboard*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <div class="nav-item-icon">
                                    <div class="icon-wrapper">
                                        <i class="fas fa-tachometer-alt"></i>
                                    </div>
                                </div>
                                <span class="nav-item-text">Dashboard</span>
                                @if(request()->is('admin/dashboard') || request()->is('admin/dashboard*'))
                                <div class="nav-item-indicator">
                                    <div class="indicator-dot"></div>
                                </div>
                                @endif
                            </a>
                        @elseif(Auth::check())
                            <a class="nav-item {{ request()->is('user/dashboard') || request()->is('user/dashboard*') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">
                                <div class="nav-item-icon">
                                    <div class="icon-wrapper">
                                        <i class="fas fa-tachometer-alt"></i>
                                    </div>
                                </div>
                                <span class="nav-item-text">Dashboard</span>
                                @if(request()->is('user/dashboard') || request()->is('user/dashboard*'))
                                <div class="nav-item-indicator">
                                    <div class="indicator-dot"></div>
                                </div>
                                @endif
                            </a>
                        @endif
                    </div>

                    <!-- Data Management Section -->
                    @if(Auth::guard('admin')->check())
                    <div class="nav-section">
                        <div class="nav-section-label">
                            <span class="label-text">DATA MANAGEMENT</span>
                            <div class="label-line"></div>
                        </div>
                        
                        <a class="nav-item {{ request()->is('produk*') ? 'active' : '' }}" href="{{ route('produk.index') }}">
                            <div class="nav-item-icon">
                                <div class="icon-wrapper">
                                    <i class="fas fa-box"></i>
                                </div>
                            </div>
                            <span class="nav-item-text">Produk</span>
                            @if(request()->is('produk*'))
                            <div class="nav-item-indicator">
                                <div class="indicator-dot"></div>
                            </div>
                            @endif
                        </a>
                        
                        <a class="nav-item {{ request()->is('anggota*') ? 'active' : '' }}" href="{{ route('anggota.index') }}">
                            <div class="nav-item-icon">
                                <div class="icon-wrapper">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <span class="nav-item-text">Anggota</span>
                            @if(request()->is('anggota*'))
                            <div class="nav-item-indicator">
                                <div class="indicator-dot"></div>
                            </div>
                            @endif
                        </a>
                        
                        <a class="nav-item {{ request()->is('supplier*') ? 'active' : '' }}" href="{{ route('supplier.index') }}">
                            <div class="nav-item-icon">
                                <div class="icon-wrapper">
                                    <i class="fas fa-truck"></i>
                                </div>
                            </div>
                            <span class="nav-item-text">Supplier</span>
                            @if(request()->is('supplier*'))
                            <div class="nav-item-indicator">
                                <div class="indicator-dot"></div>
                            </div>
                            @endif
                        </a>
                    </div>
                    @endif

                    <!-- Transaksi Section -->
                    @if(Auth::guard('admin')->check() || Auth::check())
                    <div class="nav-section">
                        <div class="nav-section-label">
                            <span class="label-text">TRANSAKSI</span>
                            <div class="label-line"></div>
                        </div>
                        
                        <a class="nav-item {{ request()->is('pengiriman*') ? 'active' : '' }}" href="{{ route('pengiriman.index') }}">
                            <div class="nav-item-icon">
                                <div class="icon-wrapper">
                                    <i class="fas fa-shipping-fast"></i>
                                </div>
                            </div>
                            <span class="nav-item-text">Pengiriman</span>
                            @if(request()->is('pengiriman*'))
                            <div class="nav-item-indicator">
                                <div class="indicator-dot"></div>
                            </div>
                            @endif
                        </a>
                    </div>
                    @endif
                    
                    <!-- Additional Menu Items -->
                    @hasSection('additional-sidebar-menu')
                    <div class="nav-section">
                        <div class="nav-section-label">
                            <span class="label-text">ADDITIONAL</span>
                            <div class="label-line"></div>
                        </div>
                        @yield('additional-sidebar-menu')
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- User Profile -->
        <div class="sidebar-footer">
            <div class="user-profile">
                <div class="user-avatar">
                    <div class="avatar-circle">
                        @if(Auth::guard('admin')->check())
                            {{ strtoupper(substr(Auth::guard('admin')->user()->name ?? 'A', 0, 1)) }}
                        @elseif(Auth::check())
                            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                        @else
                            A
                        @endif
                    </div>
                    <div class="user-status"></div>
                </div>
                <div class="user-info">
                    @if(Auth::guard('admin')->check())
                        <div class="user-name">{{ Auth::guard('admin')->user()->name ?? 'Admin UKK' }}</div>
                        <div class="user-role">Administrator</div>
                    @elseif(Auth::check())
                        <div class="user-name">{{ Auth::user()->name ?? 'User' }}</div>
                        <div class="user-role">User</div>
                    @else
                        <div class="user-name">Guest</div>
                        <div class="user-role">Not Logged In</div>
                    @endif
                </div>
                <div class="user-actions">
                    @if(Auth::guard('admin')->check())
                        <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="logout-btn" title="Logout" style="background: none; border: none; color: var(--sidebar-text-secondary); cursor: pointer; padding: 0;">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    @elseif(Auth::check())
                        <form method="POST" action="{{ route('user.logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="logout-btn" title="Logout" style="background: none; border: none; color: var(--sidebar-text-secondary); cursor: pointer; padding: 0;">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</div>

<style>
:root {
    --sidebar-bg: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --sidebar-overlay: rgba(15, 23, 42, 0.85);
    --sidebar-blur: 20px;
    --sidebar-accent: #8b5cf6;
    --sidebar-accent-light: #a78bfa;
    --sidebar-text: rgba(255, 255, 255, 0.9);
    --sidebar-text-secondary: rgba(255, 255, 255, 0.7);
    --sidebar-hover: rgba(255, 255, 255, 0.1);
    --sidebar-active: rgba(255, 255, 255, 0.15);
    --sidebar-border: rgba(255, 255, 255, 0.1);
}

.sb-sidenav {
    background: var(--sidebar-bg);
    backdrop-filter: blur(var(--sidebar-blur));
    -webkit-backdrop-filter: blur(var(--sidebar-blur));
    position: relative;
    overflow: hidden;
    border: none;
}

.sb-sidenav::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: var(--sidebar-overlay);
    z-index: 1;
}

.sb-sidenav > * {
    position: relative;
    z-index: 2;
}

/* Sidebar Header */
.sidebar-header {
    position: relative;
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--sidebar-border);
    margin-bottom: 1.5rem;
}

.brand-wrapper {
    position: relative;
    z-index: 2;
}

.brand-logo {
    position: relative;
    width: 64px;
    height: 64px;
    margin: 0 auto 1rem;
}

.logo-circle {
    width: 64px;
    height: 64px;
    background: linear-gradient(135deg, #8b5cf6, #6366f1);
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    box-shadow: 0 10px 25px rgba(139, 92, 246, 0.3);
    position: relative;
    z-index: 2;
}

.logo-glow {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80px;
    height: 80px;
    background: radial-gradient(circle, rgba(139, 92, 246, 0.4) 0%, rgba(139, 92, 246, 0) 70%);
    border-radius: 50%;
    z-index: 1;
}

.brand-title {
    font-size: 1.1rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    text-align: center;
}

.brand-subtitle {
    font-size: 0.75rem;
    letter-spacing: 1px;
    text-transform: uppercase;
    opacity: 0.8;
    text-align: center;
}

.header-divider {
    height: 1px;
    background: linear-gradient(90deg, 
        transparent 0%, 
        rgba(255, 255, 255, 0.2) 50%, 
        transparent 100%);
    margin-top: 1.5rem;
}

/* Navigation Container */
.nav-menu-container {
    padding: 0 1rem;
}

/* Navigation Sections */
.nav-section {
    margin-bottom: 1.5rem;
}

.nav-section-label {
    margin-bottom: 0.75rem;
    padding: 0 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.label-text {
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--sidebar-text-secondary);
    white-space: nowrap;
}

.label-line {
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, 
        rgba(255, 255, 255, 0.2), 
        transparent);
}

/* Navigation Items */
.nav-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    color: var(--sidebar-text-secondary);
    text-decoration: none;
    border-radius: 12px;
    margin-bottom: 0.5rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.nav-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: var(--sidebar-hover);
    opacity: 0;
    transition: opacity 0.3s ease;
    border-radius: 12px;
}

.nav-item:hover {
    color: white;
    transform: translateX(8px);
}

.nav-item:hover::before {
    opacity: 1;
}

.nav-item.active {
    background: var(--sidebar-active);
    color: white;
    box-shadow: 0 4px 20px rgba(139, 92, 246, 0.25);
}

.nav-item.active::before {
    opacity: 1;
}

.nav-item.active .nav-item-icon .icon-wrapper {
    background: linear-gradient(135deg, #8b5cf6, #6366f1);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.4);
}

/* Navigation Icons */
.nav-item-icon {
    margin-right: 0.75rem;
}

.icon-wrapper {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.05);
    transition: all 0.3s ease;
}

.nav-item:hover .icon-wrapper {
    background: rgba(255, 255, 255, 0.1);
}

.nav-item-text {
    font-size: 0.875rem;
    font-weight: 500;
    flex: 1;
    transition: transform 0.3s ease;
}

.nav-item:hover .nav-item-text {
    transform: translateX(4px);
}

/* Navigation Indicator */
.nav-item-indicator {
    margin-left: auto;
}

.indicator-dot {
    width: 8px;
    height: 8px;
    background: linear-gradient(135deg, #8b5cf6, #6366f1);
    border-radius: 50%;
    box-shadow: 0 0 10px rgba(139, 92, 246, 0.5);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
        transform: scale(1);
    }
    50% {
        opacity: 0.7;
        transform: scale(1.1);
    }
}

/* Sidebar Footer */
.sidebar-footer {
    padding: 1.5rem 1rem;
    border-top: 1px solid var(--sidebar-border);
    margin-top: auto;
}

.user-profile {
    display: flex;
    align-items: center;
    padding: 0.75rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.user-profile:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.user-avatar {
    position: relative;
    margin-right: 0.75rem;
}

.avatar-circle {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #8b5cf6, #6366f1);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 1rem;
}

.user-status {
    position: absolute;
    bottom: -2px;
    right: -2px;
    width: 12px;
    height: 12px;
    background: #10b981;
    border: 2px solid var(--sidebar-overlay);
    border-radius: 50%;
}

.user-info {
    flex: 1;
}

.user-name {
    font-size: 0.875rem;
    font-weight: 600;
    color: white;
    margin-bottom: 0.125rem;
}

.user-role {
    font-size: 0.75rem;
    color: var(--sidebar-text-secondary);
}

.user-actions {
    opacity: 0.7;
    transition: opacity 0.3s ease;
}

.user-profile:hover .user-actions {
    opacity: 1;
}

.logout-btn {
    color: var(--sidebar-text-secondary);
    text-decoration: none;
    transition: color 0.3s ease;
}

.logout-btn:hover {
    color: white;
}

/* Scrollbar Styling */
.sb-sidenav-menu::-webkit-scrollbar {
    width: 4px;
}

.sb-sidenav-menu::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 2px;
}

.sb-sidenav-menu::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #8b5cf6, #6366f1);
    border-radius: 2px;
}

.sb-sidenav-menu::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #a78bfa, #818cf8);
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .sidebar-header {
        padding: 1rem;
    }
    
    .brand-logo {
        width: 48px;
        height: 48px;
    }
    
    .logo-circle {
        width: 48px;
        height: 48px;
        font-size: 1.25rem;
    }
    
    .logo-glow {
        width: 60px;
        height: 60px;
    }
    
    .nav-item {
        padding: 0.625rem 0.75rem;
    }
    
    .icon-wrapper {
        width: 32px;
        height: 32px;
    }
    
    .user-profile {
        padding: 0.5rem;
    }
    
    .avatar-circle {
        width: 36px;
        height: 36px;
        font-size: 0.875rem;
    }
}

/* Animation for sidebar entry */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.nav-section {
    animation: slideIn 0.5s ease forwards;
}

.nav-section:nth-child(1) { animation-delay: 0.1s; }
.nav-section:nth-child(2) { animation-delay: 0.2s; }
.nav-section:nth-child(3) { animation-delay: 0.3s; }
.nav-section:nth-child(4) { animation-delay: 0.4s; }

/* Glass morphism effect enhancement */
.sb-sidenav {
    background: linear-gradient(135deg, 
        rgba(102, 126, 234, 0.9) 0%, 
        rgba(118, 75, 162, 0.9) 100%);
    border-right: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 
        0 8px 32px rgba(0, 0, 0, 0.1),
        inset 1px 0 0 rgba(255, 255, 255, 0.1);
}
</style>