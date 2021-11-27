<?php
namespace Jswinborne\Tests\Examples\Models;

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
 * @property Itinerary $itinerary
 */
class Booking extends Lump
{
    protected static $dates = ['createdAt'];

    /**
     * @param $data
     * @return Collection
     */
    protected static function hydratePassengers($data) {
        return Factory::createCollection($data, Passenger::class);
    }

    /**
     * @param $data
     * @return Itinerary
     * @throws \Exception
     */
    protected static function hydrateItinerary($data) {
        return Factory::create(Itinerary::class, $data);
    }
}