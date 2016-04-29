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
     * @var string
     */
    protected $session;

    /**
     * @var float
     */
    protected $productsPrice = 0.0;

    public function __construct($session)
    {
        $this->session = $session;
    }

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

    }

    /**
     * @return Product[]
     */
    public function getProducts()
    {

    }

    /**
     * @return float
     */
    public function getTotalPrice()
    {

    }

    /**
     * @return int
     */
    public function count()
    {

    }

    /**
     * @return float
     */
    public function getProductsPrice()
    {

    }

    /**
     * @param float $productsPrice
     */
    public function setProductsPrice($productsPrice)
    {

    }

    /**
     * @param string $sessionId
     */
    public function setSession($sessionId)
    {
        $this->session = $sessionId;
    }

    /**
     * @return string
     */
    public function getSession()
    {
        return $this->session;
    }
}