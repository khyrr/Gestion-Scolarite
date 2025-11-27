<?php

/**
 * Application locales configuration.
 *
 * Structure:
 *  'code' => [
 *      'label' => 'Language name',
 *      'flag'  => 'flag-code' (optional, defaults to code)
 *  ]
 */

// Load locales from a dedicated JSON file (recommended):
//  - Create `resources/lang/locales.json` with structure { "fr": {"label":"Français","flag":"fr"}, ... }
// Enable which locales are visible with `AVAILABLE_LOCALE_CODES` in `.env`.
// This keeps the JSON as the canonical source of available translations while allowing
// ops to toggle which codes are enabled via env without typing non-ASCII in `.env`.

// Try JSON file first (resources/lang/locales.json)
$jsonPath = resource_path('lang/locales.json');
if (file_exists($jsonPath)) {
    $content = @file_get_contents($jsonPath);
    $decoded = $content ? json_decode($content, true) : null;
    if (is_array($decoded) && count($decoded) > 0) {
        $out = [];
        foreach ($decoded as $code => $meta) {
            if (is_array($meta)) {
                $out[$code] = [
                    'label' => $meta['label'] ?? (is_string($meta[0] ?? null) ? $meta[0] : strtoupper($code)),
                    'flag' => $meta['flag'] ?? $code,
                ];
            } else {
                $out[$code] = ['label' => (string) $meta, 'flag' => $code];
            }
        }
        // If AVAILABLE_LOCALE_CODES is set, filter to only those codes
        $codes = env('AVAILABLE_LOCALE_CODES', null);
        if ($codes) {
            $allowed = array_filter(array_map('trim', explode(',', $codes)));
            $filtered = [];
            foreach ($allowed as $c) {
                if (isset($out[$c])) $filtered[$c] = $out[$c];
            }
            if (count($filtered) > 0) return $filtered;
        }
        return $out;
    }
}

// If no JSON file, use codes-only env var (with built-in defaults)
$codes = env('AVAILABLE_LOCALE_CODES', null);
if ($codes) {
    $codes = array_filter(array_map('trim', explode(',', $codes)));

    // default native labels for core locales (keep this small; full list lives in resources/lang/locales.json)
    $defaults = [
        'fr' => ['label' => 'Français', 'flag' => 'fr'],
        'ar' => ['label' => 'العربية', 'flag' => 'sa'],
        'en' => ['label' => 'English', 'flag' => 'us'],
    ];

    $out = [];
    foreach ($codes as $code) {
        if (isset($defaults[$code])) {
            $out[$code] = $defaults[$code];
        } else {
            $out[$code] = ['label' => ucfirst($code), 'flag' => $code];
        }
    }

    return $out;
}

// Final default fallbacks
return [
    'fr' => ['label' => 'Français', 'flag' => 'fr'],
    'ar' => ['label' => 'العربية', 'flag' => 'sa'],
    'en' => ['label' => 'English', 'flag' => 'us'],
];
