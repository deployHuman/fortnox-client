<?php

namespace DeployHuman\fortnox;


class Helper
{


    /**
     * Returns a random string of a specified byte size
     * 
     * @param int $length in bytes
     * @return string $key
     */
    public static function getRandomKey(int $length): string
    {
        if ($length < 1) {
            $length = 10;
        }
        $key = bin2hex(random_bytes($length));
        return $key;
    }
}
