<?php

use Jswinborne\Tests\Models\Booking;

require __DIR__ . '/../vendor/autoload.php';


$json = file_get_contents(__DIR__.'/test.json');

$booking = Booking::fromJson($json);

//print_r($booking);

$passenger = $booking->passengers;

print_r($passenger->sortBy('firstName'));