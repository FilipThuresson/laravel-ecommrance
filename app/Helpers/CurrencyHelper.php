<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;

class CurrencyHelper
{
    /**
     * Update the currency in the .env file and refresh config.
     *
     * @param string $newCurrency
     * @return void
     */
    public static function updateCurrency($newCurrency)
    {
        $envPath = base_path('.env');

        if (File::exists($envPath)) {
            // Read the current .env content
            $envContent = File::get($envPath);

            // Update or insert the currency setting
            $envContent = preg_replace("/^APP_CURRENCY=.*/m", "APP_CURRENCY=$newCurrency", $envContent);

            // Write the updated content back to .env
            File::put($envPath, $envContent);

            // Clear the config cache to apply changes
            Artisan::call('config:clear');
        }
    }

    /**
     * Get the current currency.
     *
     * @return string
     */
    public static function getCurrency()
    {
        return config('app.currency', 'USD');
    }

    /**
     * Set the currency dynamically (without modifying .env).
     *
     * @param string $currency
     * @return void
     */
    public static function setTemporaryCurrency($currency)
    {
        Config::set('app.currency', $currency);
    }
}
