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
        $this->products[] = $product;
        $this->productsPrice += $product->getPrice();
    }

    /**
     * @return float
     */
    public function getTotalPrice()
    {
        $productsPrice = $this->productsPrice;
        $delivery = $productsPrice > 100 ? 0 : 10;

        return $productsPrice + $delivery;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->products);
    }
}