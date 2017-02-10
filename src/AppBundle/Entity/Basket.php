<?php

declare(strict_types = 1);

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    public function __construct(string $session)
    {
        $this->session = $session;
        $this->products = new ArrayCollection;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
        $this->productsPrice += $product->getPrice();
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function getTotalPrice(): float
    {
        $delivery = ($this->productsPrice > 100) ? 0 : 10;

        return $this->productsPrice + $delivery;
    }

    public function count(): int
    {
        return count($this->products);
    }

    public function getProductsPrice(): float
    {
        return $this->productsPrice;
    }

    public function setProductsPrice(float $productsPrice)
    {
        $this->productsPrice = $productsPrice;
    }

    public function setSession(string $session)
    {
        $this->session = $session;
    }

    public function getSession(): string
    {
        return $this->session;
    }
}
