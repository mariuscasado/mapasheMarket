<?php

namespace Mapashe;

final class Translation
{
    public function translate(string $word): string
    {
        if (in_array($word, ['manzana','apfel'])) {

            return 'apple';
        }

        return $word;
    }
}