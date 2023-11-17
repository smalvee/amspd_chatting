<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;



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
         // Custom @admin directive
         Blade::directive('superadmin', function () {
            return "<?php if (auth()->check() && auth()->user()->access('Super Admin')): ?>";
        });

        // Custom @endsuperadmin directive
        Blade::directive('endsuperadmin', function () {
            return "<?php endif; ?>";
        });

        // Custom @admin directive
         Blade::directive('admin', function () {
            return "<?php if (auth()->check() && auth()->user()->access('Admin')): ?>";
        });

        // Custom @endadmin directive
        Blade::directive('endadmin', function () {
            return "<?php endif; ?>";
        });

        // Custom @user directive
         Blade::directive('user', function () {
            return "<?php if (auth()->check() && auth()->user()->access('User')): ?>";
        });

        // Custom @enduser directive
        Blade::directive('enduser', function () {
            return "<?php endif; ?>";
        });
    }
}
