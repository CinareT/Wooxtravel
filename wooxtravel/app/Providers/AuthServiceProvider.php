<?php

namespace App\Providers;
use Illuminate\Support\Facades\Auth;
use App\CustomUserProvider;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        Auth::extend('custom-guard', function ($app, $name, array $config) {
            // Kullanıcı sağlayıcısını oluştur

            // Oturum nesnesini oluştur
            $session = $app['session'];

            // İstek nesnesini oluştur
            $request = $app->refresh('request', $this->app);

            // Oturum denetleyicisini oluştur ve döndür
            return new \Illuminate\Auth\SessionGuard($name, $session, $request);
        });
    }
}
