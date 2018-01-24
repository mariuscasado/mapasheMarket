<?php

namespace Mapashe\Test;

use Mapashe\PriceCalculator;
use PHPUnit\Framework\TestCase;

class CalitoTest extends TestCase
{
    /** @test */
    public function sum_calito_elements_with_discount() {
        $priceCalculator = new PriceCalculator();
        $priceCalculator->processElements('apple');
        $this->assertEquals(100, $priceCalculator->getTotal());
        $priceCalculator->processElements('cherry');
        $this->assertEquals(175, $priceCalculator->getTotal());
        $priceCalculator->processElements('cherry');
        $this->assertEquals(230, $priceCalculator->getTotal());
    }

    /** @test */
    public function sum_calito_elements_separated_by_comma() {
        $priceCalculator = new PriceCalculator();
        $priceCalculator->processElements('apple,cherry,banana');
        $this->assertEquals(325, $priceCalculator->getTotal());
    }

    /** @test */
    public function sum_calito_elements_separated_by_comma_with_discount()
    {
        $priceCalculator = new PriceCalculator();
        $priceCalculator->processElements('cherry,cherry');
        $this->assertEquals(130, $priceCalculator->getTotal());
    }

    /** @test */
    public function sum_calito_elements_with_banana_discount()
    {
        $priceCalculator = new PriceCalculator();
        $priceCalculator->processElements('cherry,cherry,banana,banana');
        $this->assertEquals(280, $priceCalculator->getTotal());
    }

    /** @test */
    public function sum_calito_elements_with_translation()
    {
        $priceCalculator = new PriceCalculator();
        $priceCalculator->processElements('apple,manzana,apfel');
        $this->assertEquals(300, $priceCalculator->getTotal());
    }

    /** @test */
    public function sum_calito_elements_with_translation_discounts_1()
    {
        $priceCalculator = new PriceCalculator();
        $priceCalculator->processElements('apfel,manzana,manzana,apple');
        $this->assertEquals(400, $priceCalculator->getTotal());
    }

    /** @test */
    public function sum_calito_elements_with_translation_discounts_2()
    {
        $priceCalculator = new PriceCalculator();
        $priceCalculator->processElements('manzana,manzana,manzana');
        $this->assertEquals(200, $priceCalculator->getTotal());
    }

    /** @test */
    public function sum_calito_elements_with_translation_discounts_3()
    {
        $priceCalculator = new PriceCalculator();
        $priceCalculator->processElements('apfel,apfel');
        $this->assertEquals(150, $priceCalculator->getTotal());
    }
}
