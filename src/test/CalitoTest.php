<?php

namespace Mapashe\Test;

use Mapashe\PriceCalculator;
use PHPUnit\Framework\TestCase;

class CalitoTest extends TestCase
{
    /** @test */
    public function sum_calito_elements() {
        $priceCalculator = new PriceCalculator();
        $priceCalculator->sumElement('apple');
        $this->assertEquals(100, $priceCalculator->getTotal());
        $priceCalculator->sumElement('cherry');
        $this->assertEquals(175, $priceCalculator->getTotal());
        $priceCalculator->sumElement('cherry');
        $this->assertEquals(250, $priceCalculator->getTotal());
    }
}
