<?php

namespace App\Base62Converter;

class Base62Converter
{
    private static $alphabet = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    private static $base = 62;

    public function encodeToBase62(int $base10Number): string
    {
        $result = '';
        while ($base10Number > 0) {
            $result = self::$alphabet[$base10Number % self::$base] . $result;
            $base10Number = floor($base10Number / self::$base);
        }

        return $result ?: '0';
    }
}
