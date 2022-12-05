<?php

namespace DeployHuman\fortnox;

class Helper
{
    /**
     * Returns a random string of a specified byte size,
     * note that 1 byte contains 2 characters.
     *
     * @param  int  $length in bytes
     * @return string $key
     */
    public static function getRandomKey(int $length): string
    {
        if ($length < 1) {
            $length = 10;
        }

        return bin2hex(random_bytes($length));
    }

    /**
     * To get a parent class name from current namespace.
     * Instead of using `dirname()` as it works differentyl on different OS.
     *
     * @param  string  $Namespace
     * @return string
     */
    public static function getParentPath(string $Namespace): string
    {
        $classPath = explode('\\', $Namespace);
        array_pop($classPath);

        return implode('\\', $classPath);
    }
}
