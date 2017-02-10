<?php

namespace Contexts\Domain;

use Behat\Behat\Tester\Exception\PendingException;
use AppBundle\Entity\Product;
use AppBundle\Entity\Basket;
use Behat\Behat\Context\Context;
use PHPUnit_Framework_Assert as Assert;

class BasketDomainContext implements Context
{

    /**
     * @var Basket
     */
    protected $basket;

    /**
     * @var Product[]
     */
    protected $products;

    public function __construct()
    {
        $this->basket = new Basket;
    }
}
