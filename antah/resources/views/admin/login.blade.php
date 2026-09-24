@extends('layouts.login')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 100vh; background: #f5f5f5; font-family: 'Segoe UI', Arial, sans-serif;">
    <div style="width: 100%; max-width: 420px; padding: 20px;">
        <!-- Login Card -->
        <div style="background: white; border-radius: 16px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08); overflow: hidden; border: 1px solid rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px);">
            
            <!-- Header -->
            <div style="background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%); padding: 35px 30px; text-align: center; position: relative;">
                <div style="width: 70px; height: 70px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; border: 2px solid rgba(255, 255, 255, 0.3);">
                    <i class="fas fa-user-shield" style="font-size: 28px; color: white;"></i>
                </div>
                <h1 style="margin: 0 0 8px 0; font-size: 26px; color: white; font-weight: 600;">Admin Access</h1>
                <p style="margin: 0; color: rgba(255, 255, 255, 0.85); font-size: 14px; letter-spacing: 0.5px;">UKK Management System</p>
            </div>

            <!-- Body -->
            <div style="padding: 40px 35px;">
                @if(session('error'))
                <div style="background: linear-gradient(135deg, #fee2e2, #fecaca); color: #7f1d1d; padding: 16px; border-radius: 10px; margin-bottom: 24px; border-left: 4px solid #ef4444; display: flex; align-items: flex-start;">
                    <i class="fas fa-exclamation-circle" style="margin-right: 12px; font-size: 18px; margin-top: 2px;"></i>
                    <div style="flex: 1;">
                        <strong style="display: block; margin-bottom: 4px;">Authentication Failed</strong>
                        {{ session('error') }}
                    </div>
                </div>
                @endif

                <form method="POST" action="{{ route('login.submit') }}" id="loginForm">
                    @csrf
                    
                    <!-- Role Selection -->
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; margin-bottom: 12px; color: #374151; font-weight: 500; font-size: 15px; display: flex; align-items: center;">
                            <i class="fas fa-user-tag" style="margin-right: 10px; color: #4361ee;"></i>
                            Login sebagai
                        </label>
                        <div style="display: flex; gap: 16px;">
                            <label style="flex: 1; cursor: pointer;">
                                <input type="radio" name="role" value="admin" checked style="display: none;">
                                <div style="border: 2px solid #e5e7eb; border-radius: 12px; padding: 16px; text-align: center; transition: all 0.3s ease; background: #f9fafb;" class="role-option" data-role="admin">
                                    <i class="fas fa-user-shield" style="font-size: 24px; color: #4361ee; margin-bottom: 8px;"></i>
                                    <div style="font-weight: 600; color: #374151;">Admin</div>
                                    <div style="font-size: 12px; color: #6b7280;">Management Access</div>
                                </div>
                            </label>
                            <label style="flex: 1; cursor: pointer;">
                                <input type="radio" name="role" value="user" style="display: none;">
                                <div style="border: 2px solid #e5e7eb; border-radius: 12px; padding: 16px; text-align: center; transition: all 0.3s ease; background: #f9fafb;" class="role-option" data-role="user">
                                    <i class="fas fa-user" style="font-size: 24px; color: #10b981; margin-bottom: 8px;"></i>
                                    <div style="font-weight: 600; color: #374151;">User</div>
                                    <div style="font-size: 12px; color: #6b7280;">Regular Access</div>
                                </div>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Email Input -->
                    <div style="margin-bottom: 24px;">
                        <label for="email" style="display: block; margin-bottom: 10px; color: #374151; font-weight: 500; font-size: 15px; display: flex; align-items: center;">
                            <i class="fas fa-envelope" style="margin-right: 10px; color: #4361ee;"></i>
                            Email Address
                        </label>
                        <div style="position: relative;">
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required
                                   style="width: 100%; padding: 16px 16px 16px 48px; border: 2px solid #e5e7eb; border-radius: 12px; font-size: 15px; box-sizing: border-box; transition: all 0.3s ease; background: #f9fafb;"
                                   placeholder="admin@example.com"
                                   onfocus="this.style.borderColor='#4361ee'; this.style.boxShadow='0 0 0 4px rgba(67, 97, 238, 0.1)';"
                                   onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                            <i class="fas fa-at" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 16px;"></i>
                        </div>
                        @error('email')
                        <div style="color: #ef4444; font-size: 14px; margin-top: 8px; display: flex; align-items: center; padding-left: 8px;">
                            <i class="fas fa-exclamation-circle" style="margin-right: 8px; font-size: 14px;"></i>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div style="margin-bottom: 30px;">
                        <label for="password" style="display: block; margin-bottom: 10px; color: #374151; font-weight: 500; font-size: 15px; display: flex; align-items: center;">
                            <i class="fas fa-key" style="margin-right: 10px; color: #4361ee;"></i>
                            Password
                        </label>
                        <div style="position: relative;">
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   required
                                   style="width: 100%; padding: 16px 16px 16px 48px; border: 2px solid #e5e7eb; border-radius: 12px; font-size: 15px; box-sizing: border-box; transition: all 0.3s ease; background: #f9fafb;"
                                   placeholder="••••••••"
                                   onfocus="this.style.borderColor='#4361ee'; this.style.boxShadow='0 0 0 4px rgba(67, 97, 238, 0.1)';"
                                   onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                            <i class="fas fa-lock" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 16px;"></i>
                            <button type="button" 
                                    onclick="togglePassword()" 
                                    style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #9ca3af; cursor: pointer; font-size: 16px;">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                        <div style="color: #ef4444; font-size: 14px; margin-top: 8px; display: flex; align-items: center; padding-left: 8px;">
                            <i class="fas fa-exclamation-circle" style="margin-right: 8px; font-size: 14px;"></i>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Login Button -->
                    <button type="submit" 
                            style="width: 100%; background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%); color: white; padding: 18px; border: none; border-radius: 12px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; position: relative; overflow: hidden;">
                        <i class="fas fa-sign-in-alt" style="margin-right: 10px;"></i>
                        <span>Sign In to Dashboard</span>
                        <div style="position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent); transition: 0.5s;"></div>
                    </button>
                </form>

                <!-- Footer -->
                <div style="text-align: center; margin-top: 32px; padding-top: 24px; border-top: 1px solid #e5e7eb;">
                    <div style="margin-bottom: 16px;">
                        <p style="margin: 0; color: #6b7280; font-size: 14px;">
                            Belum punya akun? 
                            <a href="{{ route('user.register') }}" style="color: #10b981; text-decoration: none; font-weight: 500; transition: color 0.3s ease;" onmouseover="this.style.color='#059669'" onmouseout="this.style.color='#10b981'">
                                <i class="fas fa-user-plus" style="margin-right: 5px;"></i>
                                Register sebagai User
                            </a>
                        </p>
                    </div>
                    <p style="margin: 0; color: #6b7280; font-size: 14px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-shield-check" style="margin-right: 10px; color: #10b981;"></i>
                        Secure Access • Encrypted Connection
                    </p>
                    <p style="margin: 12px 0 0 0; color: #9ca3af; font-size: 12px;">
                        © {{ date('Y') }} UKK Management System • v1.0.0
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const roleOptions = document.querySelectorAll('.role-option');
    const radioButtons = document.querySelectorAll('input[name="role"]');
    
    roleOptions.forEach((option, index) => {
        option.addEventListener('click', function() {
            // Remove selected class from all
            roleOptions.forEach(opt => {
                opt.style.borderColor = '#e5e7eb';
                opt.style.background = '#f9fafb';
            });
            
            // Add selected class to clicked
            this.style.borderColor = '#4361ee';
            this.style.background = '#eff6ff';
            
            // Check the corresponding radio button
            radioButtons[index].checked = true;
        });
    });
    
    // Set initial state
    roleOptions[0].style.borderColor = '#4361ee';
    roleOptions[0].style.background = '#eff6ff';
});

function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.querySelector('#password + button i');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.className = 'fas fa-eye-slash';
    } else {
        passwordInput.type = 'password';
        eyeIcon.className = 'fas fa-eye';
    }
}

// Button hover effect
const loginButton = document.querySelector('button[type="submit"]');
if (loginButton) {
    loginButton.addEventListener('mouseenter', function() {
        const shine = this.querySelector('div');
        shine.style.left = '100%';
    });
    
    loginButton.addEventListener('mouseleave', function() {
        const shine = this.querySelector('div');
        shine.style.left = '-100%';
    });
}

// Form validation animation
const form = document.getElementById('loginForm');
const inputs = form.querySelectorAll('input[required]');

inputs.forEach(input => {
    input.addEventListener('invalid', function() {
        this.style.animation = 'shake 0.3s ease-in-out';
        setTimeout(() => {
            this.style.animation = '';
        }, 300);
    });
});
</script>

<style>
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    20%, 60% { transform: translateX(-8px); }
    40%, 80% { transform: translateX(8px); }
}

button[type="submit"]:hover div {
    left: 100%;
}

input::placeholder {
    color: #9ca3af;
    font-size: 14px;
}

/* Responsive */
@media (max-width: 480px) {
    .container {
        max-width: 90%;
        padding: 10px;
    }
    
    .card-body {
        padding: 30px 20px;
    }
    
    .card-header {
        padding: 25px 20px;
    }
}
</style>
@endsection