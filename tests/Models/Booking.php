<?php
namespace Jswinborne\Tests\Models;

use Jswinborne\Lump\Collection;
use Jswinborne\Lump\Lump;
use Jswinborne\Lump\Factory;

/**
 * Class Booking
 * @package Jswinborne\Tests\Models
 * @property string $recordLocator
 * @property string $officeId
 * @property \DateTime $createdAt
 * @property Collection<Passenger> $passengers
 */
class Booking extends Lump
{
    protected static $dates = ['createdAt'];

    protected static function hydratePassengers($data) {
        return Collection::hydrate(Passenger::class, $data);
    }

    protected static function hydrateItinerary($data) {
        return Factory::create(Itinerary::class, $data);
    }
}