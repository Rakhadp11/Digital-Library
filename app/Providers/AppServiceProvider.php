<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Notification;
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
        View::composer('*', function ($view) {
            if (Auth::check()) { // Memeriksa apakah pengguna telah login
                $notifications = Notification::where('user_id', Auth::id()) // Filter berdasarkan user_id
                    ->where('read', false)
                    ->get();
                $view->with('notifications', $notifications);
            } else {
                $view->with('notifications', collect()); // Mengirimkan koleksi kosong jika pengguna belum login
            }
        });
    }
}
