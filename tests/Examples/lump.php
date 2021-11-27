<?php
require __DIR__ . '/../../vendor/autoload.php';

use Jswinborne\Lump\Lump;
use Jswinborne\Tests\Examples\Models\Booking;

$json = file_get_contents(__DIR__ . '/Data/booking.json');
$booking = Booking::fromJson($json);

//accessing properties
echo "Record: {$booking->recordLocator}\n";

//updating a property
$booking->recordLocator = 'XYZ987';
echo "Record: {$booking->recordLocator}\n";

//adding a new property
$booking->customId = 9087;
echo "Custom ID: {$booking->customId}\n";

//auto date object ( DateTime or Carbon if available )
echo 'createdAt: '. $booking->createdAt .' instanceof ' . get_class($booking->createdAt) . "\n";

//collection
echo 'passengers is instanceof ' . get_class($booking->passengers) . "\n";
echo $booking->passengers->count() . " passengers\n";

//get the first male passenger ( more on this in the collection examples )
echo "first male passenger\n";
print_r($booking->passengers->where('gender','=','M')->first());

//serialize to JSON
echo "json: \n";
echo $booking->toJson() . "\n";

//serialize and unserialize
echo "serialize: \n";
$serialized = serialize($booking);
echo $serialized . "\n";
echo "unserialize: \n";
print_r(unserialize($serialized));



