<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::component('components.ui.form.input', 'form.input');
        Blade::component('components.ui.form.textarea', 'form.textarea');
        Blade::component('components.ui.form.select', 'form.select');
        Blade::component('components.ui.form.checkbox', 'form.checkbox');
        Blade::component('components.ui.form.radio', 'form.radio');
    }
}
