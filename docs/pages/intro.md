## Installation
To get started, you must be using PHP 7.2 or greater.

Install Lump using composer:
```bash
composer install jswinborne/lump
```
There are no external dependencies, but we do suggest using nesbot/carbon for dates.  If not installed,
Lump will default to using DateTime objects instead.

## How it Works
At its simplest you can create a new Lump object as a replacement for the stdClass, from a JSON string.

To create an object you can use:
```php
$data = Lump::fromJson('{
    "firstName":"John",
    "lastName":"Doe",
    "gender":"M",
    "dob":"1967-10-10"
}');
```

Or if you have a collection of objects you could use:
```php
Collection::fromJson($json);
```
