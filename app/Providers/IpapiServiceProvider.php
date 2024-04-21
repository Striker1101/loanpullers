<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

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
        // Check if the IP data is already cached
        if (Cache::has('ipData')) {
            // Retrieve the cached IP data
            $ipData = Cache::get('ipData');
        } else {
            // Use HTTP Client to fetch data from the API
            $client = new \GuzzleHttp\Client();

            try {
                // Make the API request
                $response = $client->get('https://ipapi.co/json/');
                $ipData = json_decode($response->getBody(), true);

                // Cache the IP data for future use
                Cache::put('ipData', $ipData, now()->addHours(24)); // Cache for 24 hours
            } catch (\Exception $e) {
                // Handle exceptions, such as network errors
                // For simplicity, you can log the error and set $ipData to an empty array
                \Log::error('Failed to fetch IP data: ' . $e->getMessage());
                $ipData = [];
            }
        }

        // Share the IP data with all views
        View::share('ipData', $ipData);
    }

}
