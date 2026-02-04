<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordComplexity implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $minLength = setting('password_min_length', 8);
        $requireUppercase = setting('password_require_uppercase', true);
        $requireLowercase = setting('password_require_lowercase', true);
        $requireNumbers = setting('password_require_numbers', true);
        $requireSymbols = setting('password_require_symbols', false);

        // Check minimum length
        if (strlen($value) < $minLength) {
            $fail("The {$attribute} must be at least {$minLength} characters long.");
            return;
        }

        // Check uppercase requirement
        if ($requireUppercase && !preg_match('/[A-Z]/', $value)) {
            $fail("The {$attribute} must contain at least one uppercase letter.");
            return;
        }

        // Check lowercase requirement  
        if ($requireLowercase && !preg_match('/[a-z]/', $value)) {
            $fail("The {$attribute} must contain at least one lowercase letter.");
            return;
        }

        // Check numbers requirement
        if ($requireNumbers && !preg_match('/\d/', $value)) {
            $fail("The {$attribute} must contain at least one number.");
            return;
        }

        // Check symbols requirement
        if ($requireSymbols && !preg_match('/[^A-Za-z0-9]/', $value)) {
            $fail("The {$attribute} must contain at least one special character.");
            return;
        }
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        $requirements = [];
        
        $minLength = setting('password_min_length', 8);
        $requirements[] = "at least {$minLength} characters";
        
        if (setting('password_require_uppercase', true)) {
            $requirements[] = 'one uppercase letter';
        }
        
        if (setting('password_require_lowercase', true)) {
            $requirements[] = 'one lowercase letter';
        }
        
        if (setting('password_require_numbers', true)) {
            $requirements[] = 'one number';
        }
        
        if (setting('password_require_symbols', false)) {
            $requirements[] = 'one special character';
        }

        return 'The password must contain ' . implode(', ', $requirements) . '.';
    }
}