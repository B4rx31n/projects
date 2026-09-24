<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gate untuk admin
        Gate::define('admin-only', function ($user) {
            return $user->role === 'admin';
        });

        // Gate untuk pelapor (siswa, ortu, masyarakat)
        Gate::define('pelapor', function ($user) {
            return in_array($user->role, ['siswa', 'ortu', 'masyarakat']);
        });

        // Gate untuk siswa saja
        Gate::define('siswa-only', function ($user) {
            return $user->role === 'siswa';
        });

        // Gate untuk ortu saja
        Gate::define('ortu-only', function ($user) {
            return $user->role === 'ortu';
        });

        // Gate untuk masyarakat saja
        Gate::define('masyarakat-only', function ($user) {
            return $user->role === 'masyarakat';
        });
    }
}