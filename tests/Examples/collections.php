<?php
require __DIR__ . '/../../vendor/autoload.php';

use Jswinborne\Lump\Collection;


$json = file_get_contents(__DIR__ . '/Data/colors.json');
$collection = Collection::fromJson($json);

print_r($collection);