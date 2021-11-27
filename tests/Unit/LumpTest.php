<?php
namespace Jswinborne\Tests\Unit;

use Jswinborne\Lump\Lump;

class LumpTest extends \PHPUnit\Framework\TestCase
{
    public function testFromJson(): void
    {
        $json = file_get_contents(__DIR__ . '/../Examples/Data/booking.json');
        $this->assertInstanceOf(
            Lump::class,
            Lump::fromJson($json)
        );
    }
}