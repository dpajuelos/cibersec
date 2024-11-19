<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\EloquentUserProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Auth::provider('usuarios', function ($app, array $config) {
            return new EloquentUserProvider($app['hash'], User::class);
        });
    }
}