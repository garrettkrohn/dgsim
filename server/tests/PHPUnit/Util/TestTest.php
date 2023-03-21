<?php

namespace App\Tests\PHPUnit\Util;

use PHPUnit\Util\Test;
use PHPUnit\Framework\TestCase;

class TestTest extends TestCase
{
    public function test()
    {
        $x = 0;
        $y = 0;
        
        self::assertEquals($x, $y);
    }
}
