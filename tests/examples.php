<?php
require __DIR__ . '/../vendor/autoload.php';

use jswinborne\lump\Lump;
use jswinborne\lump\Factory;

$json = file_get_contents(__DIR__.'/test.json');

$booking = Lump::fromJson($json);

$result = $booking->passengers->where('gender','==','M');

print_r($result);


