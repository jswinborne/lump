<?php

namespace Jswinborne\Tests\Models;

use Jswinborne\Lump\Lump;

/**
 * Class Passenger
 * @package Jswinborne\Tests\Models
 *
 * @property string $firstName
 * @property string $lastName
 * @property string $gender
 * @property \DateTime $dob
 * @property string $type
 * @property-read string $fullName
 */
class Passenger extends Lump
{
    protected static $dates = ['dob'];

    protected function getFullNameProperty()
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}