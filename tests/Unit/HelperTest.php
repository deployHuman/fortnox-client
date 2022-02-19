<?php

namespace DeployHuman\tests\Unit;

use DeployHuman\fortnox\Helper;
use DeployHuman\tests\TestCase;

final class HelperTest extends TestCase
{
    /** @test */
    public function itProvidesDefaultKeyLengthWhenProvidedAValueLessThanOne(): void
    {
        $key = Helper::getRandomKey(0);

        $this->assertIsString($key, 'No string key was returned from helper.');

        // Default key length is 10, each byte holds 2 characters.
        $this->assertEquals(20, strlen($key), 'Default key length does not match expected result.');
    }
}
