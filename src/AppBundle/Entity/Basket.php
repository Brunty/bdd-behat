<?php

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

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Product $product
     */
    public function addProduct(Product $product)
    {
        // TODO - implement this
    }

    /**
     * @return float
     */
    public function getTotalPrice()
    {
        // TODO - implement this
    }

    /**
     * @return int
     */
    public function count()
    {
        // TODO - implement this
    }
}