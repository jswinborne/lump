<?php
require __DIR__ . '/../vendor/autoload.php';

use Jswinborne\Lump\Lump;
use Jswinborne\Lump\Factory;

$json = file_get_contents(__DIR__.'/test.json');

$booking = Lump::fromJson($json);

print_r($booking);


