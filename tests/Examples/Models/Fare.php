<?php
namespace Jswinborne\Tests\Examples\Models;

use Jswinborne\Lump\Lump;

/**
 * Class Fare
 * @package jswinborne\tests\Models
 *
 * @property string $type
 * @property float $baseFare
 * @property float $taxes
 * @property string $currency
 * @property-read float $totalPrice;
 */
class Fare extends Lump
{
    protected static $dates = ['expirationDate'];

    public function setBaseFareProperty($value) {
        return round($value, 2);
    }

    public function setTaxesProperty($value) {
        return round($value, 2);
    }

    public function getTotalPriceProperty() {
        return $this->baseFare + $this->taxes;
    }
}