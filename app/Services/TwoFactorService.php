<?php

namespace App\Services;

class TwoFactorService
{
    // Time step for TOTP (seconds)
    public const STEP = 30;

    // Number of digits for OTP
    public const DIGITS = 6;

    /**
     * Generate a base32 secret. (Not cryptographically perfect but sufficient for seeding.)
     */
    public static function generateSecret(int $length = 16): string
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567'; // RFC4648 base32 alphabet
        $secret = '';
        for ($i = 0; $i < $length; $i++) {
            $secret .= $chars[random_int(0, strlen($chars) - 1)];
        }
        return $secret;
    }

    /**
     * Decode base32 to binary string
     */
    public static function base32Decode(string $b32): string
    {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $b32 = strtoupper($b32);
        $l = strlen($b32);
        $n = 0;
        $j = 0;
        $binary = '';

        for ($i = 0; $i < $l; $i++) {
            $n = $n << 5; // Move buffer left by 5 to make room
            $n = $n + strpos($alphabet, $b32[$i]);
            $j += 5; // Keep track of number of bits in buffer

            if ($j >= 8) {
                $j -= 8;
                $binary .= chr(($n & (0xFF << $j)) >> $j);
            }
        }

        return $binary;
    }

    /**
     * Generate a TOTP code for a secret at the current time.
     */
    public static function generateCode(string $secret, int $time = null): string
    {
        $time = $time ?? time();
        $counter = floor($time / self::STEP);
        $key = self::base32Decode($secret);

        // pack counter into binary (8 byte big endian)
        $counterBin = pack('N*', 0) . pack('N*', $counter & 0xffffffff);

        $hash = hash_hmac('sha1', $counterBin, $key, true);

        $offset = ord(substr($hash, -1)) & 0x0F;
        $binary = (ord($hash[$offset]) & 0x7f) << 24 |
                  (ord($hash[$offset + 1]) & 0xff) << 16 |
                  (ord($hash[$offset + 2]) & 0xff) << 8 |
                  (ord($hash[$offset + 3]) & 0xff);

        $otp = $binary % pow(10, self::DIGITS);

        return str_pad((string)$otp, self::DIGITS, '0', STR_PAD_LEFT);
    }

    /**
     * Verify a provided code against a secret, allowing a small window
     * of +/- 1 time step.
     */
    public static function verifyCode(string $secret, string $code, int $window = 1): bool
    {
        $time = time();
        for ($i = -$window; $i <= $window; $i++) {
            if (hash_equals(self::generateCode($secret, $time + ($i * self::STEP)), $code)) {
                return true;
            }
        }
        return false;
    }
}
