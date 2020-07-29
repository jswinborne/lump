<?php
require __DIR__ . '/../vendor/autoload.php';

$json = '[
    {
        "type": "cat",
        "color": "brown"
    },
    {
        "type": "dog",
        "color": "red"
    }
]';
$collection = \Jswinborne\Lump\Collection::hydrateFromJson($json);

print_r($collection);