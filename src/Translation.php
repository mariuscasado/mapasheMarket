<?php

namespace Mapashe;

final class Translation
{
    public function translate(string $word): string
    {
        $appleNames = [PriceCalculator::APFLE_ELEM['name'], PriceCalculator::MANZANA_ELEM['name']];
        if (in_array($word, $appleNames)) {

            return PriceCalculator::APPLE_ELEM['name'];
        }

        return $word;
    }
}