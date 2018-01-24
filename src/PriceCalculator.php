<?php

namespace Mapashe;

final class PriceCalculator
{

    const CHERRY_DISCOUNT = 20;

    /** @var int */
    private $total;

    /** @var array */
    private $productHistory;

    public function __construct()
    {
        $this->total = 0;
        $this->productHistory = [];
    }

    public function getTotal(): int
    {
        $this->applyDiscount();
        return $this->total;
    }

    public function processElements(string $elements)
    {
        if (strpos($elements, ',') !== FALSE) {
            $elementsArr = explode(',', $elements);
            foreach($elementsArr as $element) {
                $this->sumElement($element);
            }
        } else {
            $this->sumElement($elements);
        }
    }

    public function sumElement(string $elem)
    {
        switch(trim($elem)) {
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

        $this->productHistory[] = $elem;

        $this->total = $this->total + $fruitPrice;
    }

    private function applyDiscount(): void
    {
        $numberOfCherries = count(array_filter($this->productHistory, function($f) {
                return $f === 'cherry';
            }));

        if ($numberOfCherries < 2) {
            return;
        }

        if ($numberOfCherries % 2) {
            $discount = self::CHERRY_DISCOUNT * (($numberOfCherries-1)/2);
        } else {
            $discount = self::CHERRY_DISCOUNT * ($numberOfCherries/2);
        }

        $this->total = $this->total - $discount;
    }
}