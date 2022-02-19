<?php

namespace DeployHuman\fortnox;

class Helper
{
    /**
     * Returns a random string of a specified byte size,
     * note that 1 byte contains 2 characters.
     * 
     * @param int $length in bytes
     * @return string $key
     */
    public static function getRandomKey(int $length): string
    {
        if ($length < 1) $length = 10;

        return bin2hex(random_bytes($length));
    }
}
