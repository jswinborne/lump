<?php
namespace Jswinborne\Tests\Models;

use Jswinborne\Lump\Collection;
use Jswinborne\Lump\Lump;

/**
 * Class Itinerary
 * @package Jswinborne\Tests\Models
 *
 * @property Collection<Fare> $fares
 * @property Collection<Segment> $segments
 */
class Itinerary extends Lump
{
    protected static function hydrateFares($data)
    {
        return Collection::hydrate(Fare::class, $data);
    }

    protected static function hydrateSegments($data)
    {
        return Collection::hydrate(Segment::class, $data);
    }
}