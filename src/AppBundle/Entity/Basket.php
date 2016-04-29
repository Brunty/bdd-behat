<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Basket implements \Countable
{

    const DELIVERY_COST_OVER_100 = 0;
    const DELIVERY_COST_BELOW_100 = 10;

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="string")
     * @ORM\GeneratedValue(strategy="UUID")
     * @var string
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="\AppBundle\Entity\Product")
     * @var Product[]|ArrayCollection
     */
    protected $products;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $session;

    /**
     * @ORM\Column(type="float")
     * @var float
     */
    protected $productsPrice = 0.0;

    /**
     * @param string $session
     */
    public function __construct($session)
    {
        $this->session = $session;
        $this->products = new ArrayCollection;
    }

    /**
     * @return string
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
     * @return Product[]|ArrayCollection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return float
     */
    public function getTotalPrice()
    {
        $delivery = ($this->productsPrice > 100) ? 0 : 10;

        return $this->productsPrice + $delivery;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->products);
    }

    /**
     * @return float
     */
    public function getProductsPrice()
    {
        return $this->productsPrice;
    }

    /**
     * @param float $productsPrice
     */
    public function setProductsPrice($productsPrice)
    {
        $this->productsPrice = $productsPrice;
    }

    /**
     * @param string $session
     */
    public function setSession($session)
    {
        $this->session = $session;
    }

    /**
     * @return string
     */
    public function getSession()
    {
        return $this->session;
    }
}