<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\Request;

class Login extends BaseLogin
{
    public function authenticate(): ?\Filament\Http\Responses\Auth\Contracts\LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            // Fire the Lockout event manually because Filament doesn't do it by default
            $request = request();
            
            // Merge form data into request so the listener can find the email
            // Filament stores form state in $this->data, but the listener looks in request inputs
            $request->merge([
                'email' => $this->data['email'] ?? null,
                'data' => $this->data // Redundant but safe for 'data.email' check
            ]);

            event(new Lockout($request));

            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        return parent::authenticate();
    }
}
