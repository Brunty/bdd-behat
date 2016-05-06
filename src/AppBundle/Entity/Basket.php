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
     * @var int
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="\AppBundle\Entity\Product")
     * @var Product[]|ArrayCollection
     */
    protected $products = [];

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

    public function __construct($session)
    {
        $this->session = $session;
        $this->products = new ArrayCollection;
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
        $price = 0;
        foreach ($this->products as $product) {
            $price += $product->getPrice();
        }

        $delivery = ($price > 100) ? 0 : 10;

        return $price + $delivery;
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
