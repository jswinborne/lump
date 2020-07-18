<?php
require __DIR__ . '/../vendor/autoload.php';

use jswinborne\lump\Lump;
use jswinborne\lump\LumpFactory;

$json = file_get_contents(__DIR__.'/test.json');

$lump = Lump::fromJson($json);

$result = $lump->passengers->where('gender','==','M');

print_r($result);


