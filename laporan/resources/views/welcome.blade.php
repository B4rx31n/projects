<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laporan Sekolah - Sampaikan Aspirasi Anda</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
            <style>
            .hero-section {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 80px 0;
                position: relative;
                overflow: hidden;
            }
            .feature-card {
                transition: transform 0.3s;
                border: none;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }
            .feature-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 5px 20px rgba(0,0,0,0.15);
            }
            .btn-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border: none;
                padding: 12px 30px;
                font-weight: 600;
            }
            .btn-primary:hover {
                background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            }
            .wave-wrap {
                position: absolute;
                left: 0;
                right: 0;
                bottom: -1px;
                height: 120px;
                pointer-events: none;
            }
            .wave {
                position: absolute;
                width: 200%;
                height: 100%;
                left: 0;
                top: 0;
                animation: waveMove 18s linear infinite;
            }
            .wave.wave-2 {
                animation-duration: 26s;
                opacity: 0.45;
                top: 8px;
            }
            @keyframes waveMove {
                0% { transform: translateX(0); }
                100% { transform: translateX(-50%); }
            }
            
            /* Scroll Animation Styles */
            .scroll-animate {
                opacity: 0;
                transform: translateY(30px);
                transition: opacity 0.6s ease-out, transform 0.6s ease-out;
            }
            
            .scroll-animate.animated {
                opacity: 1;
                transform: translateY(0);
            }
            
            .scroll-animate-delay-1 {
                transition-delay: 0.1s;
            }
            
            .scroll-animate-delay-2 {
                transition-delay: 0.2s;
            }
            
            .scroll-animate-delay-3 {
                transition-delay: 0.3s;
            }
            
            .scroll-animate-delay-4 {
                transition-delay: 0.4s;
            }
            </style>
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold" href="/">
                    <i class="bi bi-megaphone"></i> Laporan Sekolah
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reports.create') }}">Buat Laporan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reports.public') }}">Lihat Laporan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login.form') }}">Login Admin</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container text-center">
                <h1 class="display-4 fw-bold mb-4">Sampaikan Aspirasi Anda untuk Sekolah</h1>
                <p class="lead mb-4">Platform anonim untuk siswa, masyarakat, dan sekolah menyampaikan laporan, saran, dan masukan</p>
                <a href="{{ route('reports.create') }}" class="btn btn-light btn-lg">
                    <i class="bi bi-plus-circle"></i> Buat Laporan Sekarang
                </a>
            </div>
            <div class="wave-wrap">
                <svg class="wave" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M0,60 C150,120 350,0 600,60 C850,120 1050,20 1200,70 L1200,120 L0,120 Z" fill="rgba(255,255,255,0.65)"></path>
                </svg>
                <svg class="wave wave-2" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M0,40 C200,90 400,0 650,50 C900,100 1100,10 1200,60 L1200,120 L0,120 Z" fill="rgba(255,255,255,0.45)"></path>
                </svg>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-5">
            <div class="container">
                <h2 class="text-center mb-5 scroll-animate">Mengapa Menggunakan Platform Ini?</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card feature-card h-100 p-4 scroll-animate scroll-animate-delay-1">
                            <div class="text-center mb-3">
                                <i class="bi bi-shield-check text-primary" style="font-size: 3rem;"></i>
                            </div>
                            <h4 class="text-center mb-3">100% Anonim</h4>
                            <p class="text-center text-muted">Identitas Anda akan tetap terjaga. Sampaikan laporan tanpa khawatir.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card feature-card h-100 p-4 scroll-animate scroll-animate-delay-2">
                            <div class="text-center mb-3">
                                <i class="bi bi-people text-primary" style="font-size: 3rem;"></i>
                            </div>
                            <h4 class="text-center mb-3">Untuk Semua</h4>
                            <p class="text-center text-muted">Siswa, masyarakat, dan sekolah dapat menggunakan platform ini.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card feature-card h-100 p-4 scroll-animate scroll-animate-delay-3">
                            <div class="text-center mb-3">
                                <i class="bi bi-chat-dots text-primary" style="font-size: 3rem;"></i>
                            </div>
                            <h4 class="text-center mb-3">Dapat Tanggapan</h4>
                            <p class="text-center text-muted">Admin akan menanggapi setiap laporan yang masuk.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works -->
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5 scroll-animate">Cara Kerja</h2>
                <div class="row g-4">
                    <div class="col-md-3 text-center scroll-animate scroll-animate-delay-1">
                        <div class="mb-3">
                            <span class="badge bg-primary rounded-circle p-3" style="font-size: 1.5rem;">1</span>
                        </div>
                        <h5>Buat Laporan</h5>
                        <p class="text-muted">Tulis laporan Anda tentang sekolah, fasilitas, atau hal lainnya.</p>
                    </div>
                    <div class="col-md-3 text-center scroll-animate scroll-animate-delay-2">
                        <div class="mb-3">
                            <span class="badge bg-primary rounded-circle p-3" style="font-size: 1.5rem;">2</span>
                        </div>
                        <h5>Kirim Secara Anonim</h5>
                        <p class="text-muted">Laporan Anda akan dikirim tanpa menyertakan identitas.</p>
                    </div>
                    <div class="col-md-3 text-center scroll-animate scroll-animate-delay-3">
                        <div class="mb-3">
                            <span class="badge bg-primary rounded-circle p-3" style="font-size: 1.5rem;">3</span>
                        </div>
                        <h5>Admin Meninjau</h5>
                        <p class="text-muted">Admin akan membaca dan meninjau laporan Anda.</p>
                    </div>
                    <div class="col-md-3 text-center scroll-animate scroll-animate-delay-4">
                        <div class="mb-3">
                            <span class="badge bg-primary rounded-circle p-3" style="font-size: 1.5rem;">4</span>
                        </div>
                        <h5>Dapat Tanggapan</h5>
                        <p class="text-muted">Admin akan memberikan tanggapan terhadap laporan Anda.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-5">
            <div class="container text-center">
                <h2 class="mb-4 scroll-animate">Siap Menyampaikan Laporan?</h2>
                <p class="lead text-muted mb-4 scroll-animate scroll-animate-delay-1">Bergabunglah dengan komunitas yang peduli terhadap kemajuan sekolah</p>
                <a href="{{ route('reports.create') }}" class="btn btn-primary btn-lg scroll-animate scroll-animate-delay-2">
                    <i class="bi bi-pencil-square"></i> Buat Laporan Sekarang
                </a>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-dark text-white py-4">
            <div class="container text-center">
                <p class="mb-0">&copy; 2024 Laporan Sekolah. Platform untuk menyampaikan aspirasi.</p>
        </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Scroll Animation Script
            document.addEventListener('DOMContentLoaded', function() {
                const animatedElements = document.querySelectorAll('.scroll-animate');
                
                // Function to check if element is in viewport
                function isInViewport(element) {
                    const rect = element.getBoundingClientRect();
                    return (
                        rect.top >= 0 &&
                        rect.left >= 0 &&
                        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
                    );
                }
                
                // Function to check if element is partially visible
                function isPartiallyVisible(element) {
                    const rect = element.getBoundingClientRect();
                    return (
                        rect.top < window.innerHeight &&
                        rect.bottom >= 0
                    );
                }
                
                // Function to animate elements
                function animateOnScroll() {
                    animatedElements.forEach(element => {
                        if (isPartiallyVisible(element) && !element.classList.contains('animated')) {
                            element.classList.add('animated');
                        }
                    });
                }
                
                // Run on scroll and on load
                window.addEventListener('scroll', animateOnScroll);
                animateOnScroll(); // Run once on page load
            });
        </script>
    </body>
</html>
