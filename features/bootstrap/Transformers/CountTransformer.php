<?php

namespace Transformers;

trait CountTransformer
{

    /**
     * @Transform :count
     */
    public function castCountToInteger(string $count): int
    {
        return intval($count);
    }
}
