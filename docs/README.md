# Guide
Lump aims to make working with data objects in PHP quick and effortless.
For many developers working with data objects, and simple REST APIs in PHP is a daily 
process.  Although JSON is simple to parse and read, keeping track of the structure, and 
sifting through stdClasses and arrays can be tedious. Lump simplfies this by adding simple 
search features, simplifying data manipulation and serialization, and allows you to define 
the expected structure with very minimal code.

## Getting Started
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

