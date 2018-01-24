<?php

namespace Mapashe;

final class PriceCalculator
{

    const CHERRY_DISCOUNT = 20;
    const BANANA_DISCOUNT = 150;
    const APFEL_DISCOUNT = 50;
    const MANZANA_DISCOUNT = 100;

    /** @var int */
    private $total;

    /** @var array */
    private $productHistory;

    /** @var Translation  */
    private $translator;

    public function __construct()
    {
        $this->total = 0;
        $this->productHistory = [];
        $this->translator = new Translation();
    }

    public function getTotal(): int
    {
        $this->applyDiscounts();
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
        $tElem = $this->translator->translate($elem);

        $price = $this->getElemPrice($tElem);

        $this->productHistory[] = $elem;

        $this->total = $this->total + $price;
    }

    private function applyDiscounts(): void
    {
        $this->applyDiscount('cherry', self::CHERRY_DISCOUNT, 2);
        $this->applyDiscount('banana', self::BANANA_DISCOUNT, 2);
        $this->applyDiscount('manzana', self::MANZANA_DISCOUNT, 3);
        $this->applyDiscount('apfel', self::APFEL_DISCOUNT, 2);
    }

    private function applyDiscount(string $element, int $discount, $everyWhen)
    {
        $numberOfElems = count(array_filter($this->productHistory, function($f) use ($element) {
            return $f === $element;
        }));

        if ($numberOfElems < $everyWhen) {
            return;
        }

        if ($numberOfElems % $everyWhen) {
            $finalDiscount = $discount * (($numberOfElems-1)/$everyWhen);
        } else {
            $finalDiscount = $discount * ($numberOfElems/$everyWhen);
        }

        $this->total = $this->total - $finalDiscount;
    }

    private function getElemPrice(string $elem): int
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

        return $fruitPrice;
    }
}