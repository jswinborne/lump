<?php
require __DIR__ . '/../../vendor/autoload.php';

use Jswinborne\Lump\Lump;

$json = file_get_contents(__DIR__ . '/Data/booking.json');

$booking = Lump::create()->json($json);
print_r($booking);




