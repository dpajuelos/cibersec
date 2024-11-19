<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('layouts.partials.header', function ($view) {
            $notifications = Notification::where('fk_idusuario', Auth::id())->get();
            $view->with('notifications', $notifications);
        });
        View::composer('layouts.partials.header', function ($view) {
            $generalNotifications = Notification::whereNull('fk_idusuario')->get();

            $view->with('generalNotifications', $generalNotifications);
        });
    }

    public function register()
    {
        //
    }
}
