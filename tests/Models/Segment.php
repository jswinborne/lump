<?php
namespace Jswinborne\Tests\Models;

use Jswinborne\Lump\Lump;

/**
 * Class Segment
 * @package jswinborne\tests\Models
 *
 * @property int $flightNumber
 * @property string $carrier
 * @property string $departureAirport
 * @property \DateTime $departureDate
 * @property string $arrivalAirport
 * @property \DateTime $arrivalDate
 */
class Segment extends Lump
{
    protected static $dates = ['departureDate', 'arrivalDate'];
}