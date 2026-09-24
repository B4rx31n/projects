<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - SmekdaHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-blue: #1e40af;
            --secondary-blue: #3b82f6;
            --accent-blue: #0ea5e9;
            --light-blue: #60a5fa;
            --dark-blue: #1e3a8a;
            --gradient-bg: linear-gradient(135deg, #1e3a8a 0%, #1e40af 30%, #3b82f6 70%, #60a5fa 100%);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--gradient-bg);
            min-height: 100vh;
            color: white;
            position: relative;
            overflow-x: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 90% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
            z-index: -1;
            animation: pulseBackground 20s infinite alternate;
        }
        
        .floating-element {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            filter: blur(60px);
            z-index: -1;
            animation: float 25s infinite linear;
        }
        
        .floating-1 {
            width: 400px;
            height: 400px;
            top: -200px;
            right: -200px;
            animation-delay: 0s;
        }
        
        .floating-2 {
            width: 300px;
            height: 300px;
            bottom: -150px;
            left: -150px;
            animation-delay: 5s;
            animation-direction: reverse;
        }
        
        .floating-3 {
            width: 200px;
            height: 200px;
            top: 30%;
            left: 10%;
            animation-delay: 10s;
        }
        
        .container-main {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
            z-index: 1;
        }
        
        .hero-content {
            max-width: 800px;
            text-align: center;
            animation: fadeInUp 1s ease-out;
        }
        
        .logo-container {
            margin-bottom: 2.5rem;
        }
        
        .logo-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 25px;
            margin-bottom: 1.5rem;
            border: 3px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(5px);
            animation: pulseLogo 3s infinite ease-in-out;
        }
        
        .logo-icon i {
            font-size: 3.5rem;
            color: white;
        }
        
        .main-title {
            font-weight: 900;
            font-size: 4rem;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #e0f2fe 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            letter-spacing: 1px;
        }
        
        .subtitle {
            font-size: 1.5rem;
            font-weight: 300;
            margin-bottom: 3rem;
            color: rgba(255, 255, 255, 0.9);
            letter-spacing: 3px;
            text-transform: uppercase;
            position: relative;
            display: inline-block;
            padding-bottom: 1rem;
        }
        
        .subtitle::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--accent-blue), transparent);
            border-radius: 2px;
        }
        
        .tagline {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 3.5rem;
            line-height: 1.6;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            font-weight: 300;
        }
        
        .action-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }
        
        .btn-hero {
            min-width: 200px;
            padding: 1.2rem 2.5rem;
            border-radius: 15px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            position: relative;
            overflow: hidden;
            border: none;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }
        
        .btn-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }
        
        .btn-hero:hover::before {
            left: 100%;
        }
        
        .btn-hero-primary {
            background: linear-gradient(135deg, var(--secondary-blue) 0%, var(--accent-blue) 100%);
            color: white;
        }
        
        .btn-hero-primary:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, var(--accent-blue) 0%, var(--secondary-blue) 100%);
        }
        
        .btn-hero-outline {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(5px);
        }
        
        .btn-hero-outline:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 4rem;
            margin-bottom: 3rem;
        }
        
        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            text-align: center;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: var(--accent-blue);
            margin-bottom: 1.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }
        
        .feature-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: white;
        }
        
        .feature-desc {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
            line-height: 1.6;
        }
        
        .admin-access {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .admin-link {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .admin-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .footer-note {
            margin-top: 3rem;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
            font-weight: 300;
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }
            100% {
                transform: translateY(-50px) rotate(360deg);
            }
        }
        
        @keyframes pulseBackground {
            0% {
                opacity: 0.7;
            }
            100% {
                opacity: 1;
            }
        }
        
        @keyframes pulseLogo {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.1);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 0 20px rgba(255, 255, 255, 0);
            }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .main-title {
                font-size: 2.5rem;
            }
            
            .subtitle {
                font-size: 1.2rem;
                letter-spacing: 2px;
            }
            
            .logo-icon {
                width: 80px;
                height: 80px;
            }
            
            .logo-icon i {
                font-size: 2.5rem;
            }
            
            .btn-hero {
                min-width: 160px;
                padding: 1rem 1.5rem;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }
        
        @media (max-width: 480px) {
            .main-title {
                font-size: 2rem;
            }
            
            .subtitle {
                font-size: 1rem;
            }
            
            .tagline {
                font-size: 1rem;
            }
            
            .feature-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Background Elements -->
    <div class="floating-element floating-1"></div>
    <div class="floating-element floating-2"></div>
    <div class="floating-element floating-3"></div>
    
    <div class="container-main">
        <div class="hero-content">
            <!-- Logo -->
            <div class="logo-container">
                <div class="logo-icon">
                    <i class="bi bi-megaphone-fill"></i>
                </div>
            </div>
            
            <!-- Title -->
            <h1 class="main-title">SMEKDA HUB</h1>
            <div class="subtitle">Sistem Informasi Pelaporan Sekolah</div>
            
            <!-- Tagline -->
            <p class="tagline">
                Wadah kolaborasi untuk melaporkan, berdiskusi, dan membangun lingkungan sekolah yang lebih baik bersama-sama.
            </p>
            
            <!-- Action Buttons -->
            <div class="action-buttons">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-hero btn-hero-primary">
                            <i class="bi bi-speedometer2"></i>
                            Buka Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-hero btn-hero-primary">
                            <i class="bi bi-person-fill"></i>
                            Masuk ke Akun
                        </a>
                        
                        <a href="{{ route('register') }}" class="btn-hero btn-hero-outline">
                            <i class="bi bi-pencil-square"></i>
                            Daftar Sekarang
                        </a>
                    @endauth
                @endif
            </div>
            
            <!-- Features -->
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h3 class="feature-title">Aman & Terpercaya</h3>
                    <p class="feature-desc">
                        Sistem pelaporan yang menjaga kerahasiaan identitas dengan enkripsi tingkat tinggi.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <h3 class="feature-title">Forum Diskusi</h3>
                    <p class="feature-desc">
                        Ruang diskusi anonim untuk berbagi ide dan solusi bersama komunitas sekolah.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <h3 class="feature-title">Real-time Tracking</h3>
                    <p class="feature-desc">
                        Pantau status laporan Anda secara real-time dengan notifikasi otomatis.
                    </p>
                </div>
            </div>
            
            <!-- Admin Access -->
            @guest
            <div class="admin-access">
                <a href="{{ route('login') }}" class="admin-link">
                    <i class="bi bi-shield-lock-fill"></i>
                    Area Petugas & Admin
                </a>
            </div>
            @endguest
            
            <!-- Footer Note -->
            <div class="footer-note">
                <i class="bi bi-c-circle me-1"></i> 2024 SmekdaHub. Semua hak dilindungi.
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add parallax effect to floating elements
            const floatingElements = document.querySelectorAll('.floating-element');
            
            window.addEventListener('mousemove', function(e) {
                const x = e.clientX / window.innerWidth;
                const y = e.clientY / window.innerHeight;
                
                floatingElements.forEach((element, index) => {
                    const speed = 0.05 + (index * 0.02);
                    const xMove = (x - 0.5) * 100 * speed;
                    const yMove = (y - 0.5) * 100 * speed;
                    
                    element.style.transform = `translate(${xMove}px, ${yMove}px)`;
                });
            });
            
            // Add click animation to buttons
            const buttons = document.querySelectorAll('.btn-hero, .admin-link');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    // Create ripple effect
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        border-radius: 50%;
                        background: rgba(255, 255, 255, 0.3);
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        width: ${size}px;
                        height: ${size}px;
                        top: ${y}px;
                        left: ${x}px;
                        pointer-events: none;
                    `;
                    
                    this.appendChild(ripple);
                    
                    // Remove ripple after animation
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
            
            // Add CSS for ripple animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
            
            // Add typing effect to tagline
            const tagline = document.querySelector('.tagline');
            if (tagline) {
                const text = tagline.textContent;
                tagline.textContent = '';
                
                let i = 0;
                function typeWriter() {
                    if (i < text.length) {
                        tagline.textContent += text.charAt(i);
                        i++;
                        setTimeout(typeWriter, 30);
                    }
                }
                
                // Start typing after 1 second
                setTimeout(typeWriter, 1000);
            }
            
            // Add scroll animation to features
            const featureCards = document.querySelectorAll('.feature-card');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = 1;
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 200);
                    }
                });
            }, { threshold: 0.1 });
            
            featureCards.forEach(card => {
                card.style.opacity = 0;
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                observer.observe(card);
            });
        });
    </script>
</body>
</html>