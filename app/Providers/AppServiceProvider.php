<?php

namespace App\Providers;

use App\Services\Settings\SettingsManager;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SettingsManager::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view): void {
            if (! Schema::hasTable('settings')) {
                $view->with('siteSettings', []);
                $view->with('brandSettings', []);
                $view->with('socialSettings', []);
                $view->with('seoDefaults', []);

                return;
            }

            $settings = app(SettingsManager::class);

            $view->with('siteSettings', $settings->all());
            $view->with('brandSettings', $settings->group('general'));
            $view->with('socialSettings', $settings->group('social'));
            $view->with('seoDefaults', $settings->group('seo'));
        });
    }
}
