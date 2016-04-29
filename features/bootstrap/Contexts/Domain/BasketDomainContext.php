<?php

namespace Contexts\Domain;

use AppBundle\Entity\Product;
use AppBundle\Entity\Basket;
use Behat\Behat\Context\SnippetAcceptingContext;
use PHPUnit_Framework_Assert as Assert;

class BasketDomainContext implements SnippetAcceptingContext
{

    const SESSION_ID = 'ThisIsASessionID';

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
        $this->basket = new Basket(self::SESSION_ID);
    }
}
