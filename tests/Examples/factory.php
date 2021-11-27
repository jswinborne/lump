<?php
require __DIR__ . '/../../vendor/autoload.php';


use Jswinborne\Lump\Factory;
use Jswinborne\Tests\Examples\Models\Booking;
use Jswinborne\Tests\Examples\Models\Itinerary;

class_alias(Booking::class, 'Booky');
echo Booky::hydratePassengers();

$booking = new Booky();
print_r($booking);
exit;

Factory::addAlias('Booking', Booking::class);
Factory::addAlias('Itinerary', Itinerary::class);

$booking = Factory::createBooking()->json();
print_r($booking);