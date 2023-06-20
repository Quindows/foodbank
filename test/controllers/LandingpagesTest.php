<?php

require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class LandingpagesTest extends TestCase
{
    /** @dataProvider addProvider */
    public function testAdd($number1, $number2, $expected)
    {
        $landingpagesTest = new Landingpages();

        $output = $landingpagesTest->add($number1 ,$number2);

        $this->assertEquals($expected, $output);
    }

    public static function addProvider()
    {
        return [
            [40, 40, 80],
            [-20, -20, -40],
            [-10, 10, 0]
        ];
    }
}