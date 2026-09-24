@extends('layouts.app')

@section('title', 'Pengaturan Aplikasi')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Pengaturan Aplikasi</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola pengaturan umum aplikasi</p>
    </div>

    <form action="{{ route('pengaturan.update') }}" method="POST" class="space-y-6">
        @csrf

        <!-- General Settings -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Pengaturan Umum</h2>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label for="app_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nama Aplikasi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="app_name" 
                           name="app_name" 
                           value="{{ session('app_name', config('app.name', 'Data Siswa')) }}" 
                           required
                           class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Nama yang ditampilkan di aplikasi</p>
                </div>

                <div>
                    <label for="app_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Deskripsi Aplikasi
                    </label>
                    <textarea id="app_description" 
                              name="app_description" 
                              rows="3"
                              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none">{{ session('app_description', 'Sistem Manajemen Data Siswa') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Deskripsi singkat tentang aplikasi</p>
                </div>
            </div>
        </div>

        <!-- Display Settings -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Pengaturan Tampilan</h2>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label for="items_per_page" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Item Per Halaman <span class="text-red-500">*</span>
                    </label>
                    <select id="items_per_page" 
                            name="items_per_page" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="5" {{ session('items_per_page', 10) == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ session('items_per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ session('items_per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ session('items_per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ session('items_per_page', 10) == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Jumlah item yang ditampilkan per halaman</p>
                </div>
            </div>
        </div>

        <!-- Theme Settings -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Pengaturan Tema</h2>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-4">
                        Pilih Tema
                    </label>
                    <div class="grid grid-cols-3 gap-4">
                        <button type="button" onclick="setTheme('light')" class="theme-option p-4 border-2 rounded-lg transition-all duration-200 hover:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 border-gray-300 dark:border-gray-600" data-theme="light">
                            <div class="flex flex-col items-center space-y-2">
                                <div class="w-full h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded border border-gray-300 relative overflow-hidden">
                                    <div class="absolute inset-0 bg-white/50 backdrop-blur-sm"></div>
                                    <div class="absolute top-2 left-2 w-2 h-2 bg-blue-500 rounded-full"></div>
                                    <div class="absolute top-2 right-2 w-2 h-2 bg-green-500 rounded-full"></div>
                                    <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 w-8 h-1 bg-gray-300 rounded"></div>
                                </div>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Light</span>
                            </div>
                        </button>
                        <button type="button" onclick="setTheme('dark')" class="theme-option p-4 border-2 rounded-lg transition-all duration-200 hover:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 border-gray-300 dark:border-gray-600" data-theme="dark">
                            <div class="flex flex-col items-center space-y-2">
                                <div class="w-full h-16 bg-gradient-to-br from-gray-800 to-gray-900 rounded border border-gray-700 relative overflow-hidden">
                                    <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>
                                    <div class="absolute top-2 left-2 w-2 h-2 bg-blue-400 rounded-full"></div>
                                    <div class="absolute top-2 right-2 w-2 h-2 bg-green-400 rounded-full"></div>
                                    <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 w-8 h-1 bg-gray-600 rounded"></div>
                                </div>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Dark</span>
                            </div>
                        </button>
                        <button type="button" onclick="setTheme('system')" class="theme-option p-4 border-2 rounded-lg transition-all duration-200 hover:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 border-gray-300 dark:border-gray-600" data-theme="system">
                            <div class="flex flex-col items-center space-y-2">
                                <div class="w-full h-16 rounded border border-gray-400 dark:border-gray-500 relative overflow-hidden">
                                    <!-- Background dengan gradient split -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-gray-100 via-gray-200 to-gray-800"></div>
                                    <!-- Blur overlay untuk efek glassmorphism -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-white/40 via-white/20 to-black/30 backdrop-blur-md"></div>
                                    <!-- Glass effect dengan multiple layers -->
                                    <div class="absolute top-0 left-0 w-1/2 h-full bg-white/30 backdrop-blur-sm border-r border-white/20"></div>
                                    <div class="absolute top-0 right-0 w-1/2 h-full bg-black/20 backdrop-blur-sm border-l border-white/10"></div>
                                    <!-- Decorative elements -->
                                    <div class="absolute top-2 left-2 w-2 h-2 bg-blue-500/80 backdrop-blur-sm rounded-full shadow-lg"></div>
                                    <div class="absolute top-2 right-2 w-2 h-2 bg-green-500/80 backdrop-blur-sm rounded-full shadow-lg"></div>
                                    <div class="absolute bottom-2 left-1/4 w-6 h-1 bg-white/40 backdrop-blur-sm rounded"></div>
                                    <div class="absolute bottom-2 right-1/4 w-6 h-1 bg-gray-700/60 backdrop-blur-sm rounded"></div>
                                    <!-- Shine effect -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-transparent via-white/10 to-transparent"></div>
                                </div>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">System</span>
                            </div>
                        </button>
                    </div>
                    <p class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                        Pilih tema yang ingin digunakan. Tema akan disimpan otomatis.
                    </p>
                </div>
            </div>
        </div>

        <!-- Notification Settings -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Notifikasi</h2>
            </div>
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <label for="enable_notifications" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Aktifkan Notifikasi
                        </label>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Terima notifikasi untuk aktivitas penting</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" 
                               id="enable_notifications" 
                               name="enable_notifications" 
                               value="1"
                               {{ session('enable_notifications', true) ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </label>
                </div>
            </div>
        </div>

        <!-- System Info -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Informasi Sistem</h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Versi Aplikasi</span>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">1.0.0</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Framework</span>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">Laravel {{ app()->version() }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600 dark:text-gray-400">PHP Version</span>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ PHP_VERSION }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Database</span>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">SQLite</span>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('siswas.index') }}" class="px-6 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-200">
                Batal
            </a>
            <button type="submit" class="px-6 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm transition-colors duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Simpan Pengaturan
            </button>
        </div>
    </form>
</div>

<script>
    // Apply theme
    function applyTheme(theme) {
        const root = document.documentElement;
        
        if (theme === 'system') {
            const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            root.classList.remove('light', 'dark');
            root.classList.add(systemTheme);
        } else {
            root.classList.remove('light', 'dark');
            root.classList.add(theme);
        }
    }

    // Set theme
    function setTheme(theme) {
        localStorage.setItem('theme', theme);
        applyTheme(theme);
        updateThemeButtons(theme);
    }

    // Update theme button states
    function updateThemeButtons(activeTheme) {
        document.querySelectorAll('.theme-option').forEach(btn => {
            const btnTheme = btn.getAttribute('data-theme');
            if (btnTheme === activeTheme) {
                btn.classList.add('border-blue-500', 'ring-2', 'ring-blue-500');
                btn.classList.remove('border-gray-300', 'dark:border-gray-600');
            } else {
                btn.classList.remove('border-blue-500', 'ring-2', 'ring-blue-500');
                btn.classList.add('border-gray-300', 'dark:border-gray-600');
            }
        });
    }

    // Load saved theme
    function loadTheme() {
        const theme = localStorage.getItem('theme') || 'system';
        applyTheme(theme);
        updateThemeButtons(theme);
    }

    // Listen for system theme changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
        const savedTheme = localStorage.getItem('theme') || 'system';
        if (savedTheme === 'system') {
            applyTheme('system');
            updateThemeButtons('system');
        }
    });

    // Initialize theme on page load
    document.addEventListener('DOMContentLoaded', loadTheme);
</script>
@endsection

