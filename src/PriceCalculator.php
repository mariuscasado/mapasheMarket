<?php


namespace Mapashe;


final class PriceCalculator
{
    /** @var int */
    private $total;

    public function __construct()
    {
        $this->total = 0;
    }


    public function getTotal(): int
    {
        return $this->total;
    }

    public function sumElement(string $fruit)
    {
        switch($fruit) {
            case 'banana':
                $fruitPrice = 150;
                break;
            case 'apple':
                $fruitPrice = 100;
                break;
            case 'cherry':
                $fruitPrice = 75;
                break;
            default:
                $fruitPrice = 0;
                break;
        }

        $this->total = $this->total + $fruitPrice;
    }
}