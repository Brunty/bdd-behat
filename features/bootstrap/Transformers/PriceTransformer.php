<?php

namespace Transformers;

trait PriceTransformer
{

    /**
     * @Transform :price
     */
    public function castPriceToFloat($price)
    {
        return floatval($price);
    }
}