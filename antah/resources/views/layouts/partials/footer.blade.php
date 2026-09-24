<!-- Footer -->
<footer class="app-footer">
    <div class="footer-container">
        <!-- Footer Content -->
        <div class="footer-content">
            <!-- Brand Section -->
            <div class="brand-section">
                <div class="brand">
                    <i class="fas fa-store"></i>
                    <h3>UKK Management</h3>
                </div>
                <p class="tagline">Sistem Manajemen UKK Terintegrasi</p>
            </div>
            
            <!-- Links Section -->
            <div class="links-section">
                <div class="link-group">
                    <h4>Navigasi</h4>
                    <a href="{{ url('/') }}">Dashboard</a>
                    <a href="{{ url('/produk') }}">Produk</a>
                    <a href="{{ url('/anggota') }}">Anggota</a>
                    <a href="{{ url('/supplier') }}">Supplier</a>
                </div>
                
                <div class="link-group">
                    <h4>Dukungan</h4>
                    <a href="#"><i class="fas fa-question-circle"></i> Bantuan</a>
                    <a href="#"><i class="fas fa-book"></i> Dokumentasi</a>
                    <a href="#"><i class="fas fa-phone"></i> Kontak</a>
                </div>
            </div>
        </div>
        
        <!-- Divider -->
        <div class="footer-divider"></div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="copyright">
                <p>&copy; {{ date('Y') }} UKK Management System</p>
                <span class="separator">•</span>
                <p>v2.1.4 • {{ date('d M Y') }}</p>
            </div>
            
            <div class="footer-links">
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
                <a href="#">Cookies</a>
            </div>
        </div>
    </div>
</footer>

<!-- Styles -->
<style>
.app-footer {
    background: #f8f9fa;
    border-top: 1px solid #dee2e6;
    padding: 2rem 0;
    margin-top: 3rem;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

/* Footer Content */
.footer-content {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 2rem;
    margin-bottom: 2rem;
}

/* Brand Section */
.brand-section {
    flex: 1;
    min-width: 250px;
}

.brand {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.5rem;
}

.brand i {
    font-size: 1.5rem;
    color: #3b82f6;
}

.brand h3 {
    font-size: 1.25rem;
    color: #1e293b;
    margin: 0;
}

.tagline {
    color: #64748b;
    font-size: 0.9rem;
    margin: 0;
}

/* Links Section */
.links-section {
    flex: 2;
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
}

.link-group {
    flex: 1;
    min-width: 150px;
}

.link-group h4 {
    color: #1e293b;
    font-size: 1rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.link-group a {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #64748b;
    text-decoration: none;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    transition: color 0.2s;
}

.link-group a:hover {
    color: #3b82f6;
}

/* Divider */
.footer-divider {
    height: 1px;
    background: #e2e8f0;
    margin: 1.5rem 0;
}

/* Footer Bottom */
.footer-bottom {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

.copyright {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.copyright p {
    color: #64748b;
    font-size: 0.9rem;
    margin: 0;
}

.separator {
    color: #94a3b8;
}

.footer-links {
    display: flex;
    gap: 1.5rem;
}

.footer-links a {
    color: #64748b;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.2s;
}

.footer-links a:hover {
    color: #3b82f6;
}

/* Responsive */
@media (max-width: 768px) {
    .footer-content {
        flex-direction: column;
        gap: 1.5rem;
    }
    
    .links-section {
        gap: 1.5rem;
    }
    
    .footer-bottom {
        flex-direction: column;
        text-align: center;
        gap: 0.75rem;
    }
    
    .copyright {
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .link-group {
        min-width: 100%;
    }
}
</style>