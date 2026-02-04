<?php

if (!function_exists('setting')) {
    /**
     * Get or set a setting value
     *
     * @param string|null $key
     * @param mixed $default
     * @return mixed|\App\Services\SettingsService
     */
    function setting(string $key = null, $default = null)
    {
        $service = app(\App\Services\SettingsService::class);
        
        if ($key === null) {
            return $service;
        }
        
        return $service->get($key, $default);
    }
}