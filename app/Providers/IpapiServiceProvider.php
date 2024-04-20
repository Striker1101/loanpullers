<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class IpapiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Use HTTP Client to fetch data from the API
        $client = new \GuzzleHttp\Client();
        $response = $client->get('https://ipapi.co/json/');
        $ipData = json_decode($response->getBody(), true);

        // Share the IP data with all views
        View::share('ipData', $ipData);
    }
}
