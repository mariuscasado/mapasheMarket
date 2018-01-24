<?php

namespace Mapashe;

final class PriceCalculator
{
    const CHERRY_ELEM = [
        'name' => 'cherry',
        'price' => 75,
        'discount' => 20
    ];
    const APPLE_ELEM = [
        'name' => 'apple',
        'price' => 100
    ];

    const BANANA_ELEM = [
        'name' => 'banana',
        'price' => 150,
        'discount' => 150
    ];

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
        $this->applyDiscount(self::CHERRY_ELEM['name'], self::CHERRY_ELEM['discount'], 2);
        $this->applyDiscount(self::BANANA_ELEM['name'], self::BANANA_ELEM['discount'], 2);
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
            case self::BANANA_ELEM['name']:
                $fruitPrice = self::BANANA_ELEM['price'];
                break;
            case self::APPLE_ELEM['name']:
                $fruitPrice = self::APPLE_ELEM['price'];
                break;
            case self::CHERRY_ELEM['name']:
                $fruitPrice = self::CHERRY_ELEM['price'];
                break;
            default:
                $fruitPrice = 0;
                break;
        }

        return $fruitPrice;
    }
}