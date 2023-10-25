<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Connection;
use App\Models\Setting;
use App\Models\Notification;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share([
            'settings' => $this->getSettings(),
        ]);

        Paginator::useBootstrap();
    }

    private function getSettings() {
        if ( env('DB_USERNAME') === null ) {
            return Setting::make();
        }

        if ( !Schema::hasTable('settings') ) {
            return Setting::make();
        }

        return Setting::first() ?? Setting::make();
    }
}
