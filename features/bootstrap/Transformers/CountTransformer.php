<?php

namespace Transformers;

trait CountTransformer
{

    /**
     * @Transform :count
     */
    public function castCountToInteger($count)
    {
        return intval($count);
    }
}