<?php

use jswinborne\lump\Lump;

require __DIR__ . '/../vendor/autoload.php';

$collection = new \jswinborne\lump\Collection([
    new Lump(["title"=>'fishy']),
    new Lump(["title"=>'perchy']),
    new Lump(["title"=>'wally']),
    new Lump(["title"=>'pikey']),
]);

$lump = $collection->where('title',"==", 'wally');

print_r($lump);