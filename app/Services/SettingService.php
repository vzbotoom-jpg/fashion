<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingService
{
    protected $cacheKey = 'app_settings';

    public function get($key, $default = null)
    {
        $settings = $this->getAllSettings();
        return $settings[$key] ?? $default;
    }

    public function set($key, $value)
    {
        Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
        
        $this->clearCache();
        return true;
    }

    public function getGroup($group)
    {
        $settings = $this->getAllSettings();
        return array_filter($settings, function($setting) use ($group) {
            return $setting['group'] ?? null === $group;
        });
    }

    public function getGeneralSettings()
    {
        $keys = [
            'store_name',
            'store_email',
            'store_phone',
            'store_address',
            'store_description',
            'timezone',
            'currency',
        ];

        $settings = $this->getAllSettings();
        return array_intersect_key($settings, array_flip($keys));
    }

    public function getPaymentSettings()
    {
        $keys = [
            'payment_methods',
            'bank_transfer_account',
            'bank_transfer_number',
            'bank_transfer_name',
            'midtrans_server_key',
            'midtrans_client_key',
            'midtrans_enabled',
        ];

        $settings = $this->getAllSettings();
        return array_intersect_key($settings, array_flip($keys));
    }

    public function getShippingSettings()
    {
        $keys = [
            'shipping_methods',
            'shipping_cost_standard',
            'shipping_cost_express',
            'shipping_cost_same_day',
            'free_shipping_threshold',
            'shipping_zone',
        ];

        $settings = $this->getAllSettings();
        return array_intersect_key($settings, array_flip($keys));
    }

    public function getAllSettings()
    {
        return Cache::remember($this->cacheKey, 3600, function () {
            return Setting::all()->pluck('value', 'key')->toArray();
        });
    }

    public function clearCache()
    {
        Cache::forget($this->cacheKey);
    }

    public function setMultiple($settings)
    {
        foreach ($settings as $key => $value) {
            $this->set($key, $value);
        }
        return true;
    }
}