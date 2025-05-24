<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

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
        // Artisan komutları çalışırken (örneğin migrate) atla
        if (app()->runningInConsole()) {
            return;
        }

        try {
            if (Schema::hasTable('settings')) {
                $timeout = Setting::where('key', 'session_timeout')->value('value');
                if ($timeout) {
                    config(['session.lifetime' => (int) $timeout]);
                }
            }
        } catch (\Exception $e) {
            // İstersen log kaydı bırakabilirsin:
            // logger()->error('Session timeout ayarı okunamadı: ' . $e->getMessage());
        }
    }
}
