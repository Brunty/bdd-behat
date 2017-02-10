<?php

declare(strict_types = 1);

namespace AppBundle\Entity;

class Basket implements \Countable
{

    const DELIVERY_COST_OVER_100 = 0;
    const DELIVERY_COST_BELOW_100 = 10;

    /**
     * @var int
     */
    private $id;

    /**
     * @var Product[]
     */
    protected $products = [];

    /**
     * @var float
     */
    protected $productsPrice = 0.0;

    public function getId(): int
    {
        return $this->id;
    }

    public function addProduct(Product $product)
    {
        // TODO - implement this
    }

    public function getTotalPrice(): float
    {
        // TODO - implement this
    }

    public function count(): int
    {
        // TODO - implement this
    }
}
