<?php

namespace Contexts\Domain;

use AppBundle\Entity\Product;
use AppBundle\Entity\Basket;
use Behat\Behat\Context\Context;
use PHPUnit_Framework_Assert as Assert;
use Transformers\CountTransformer;

class BasketDomainContext implements Context
{

    use CountTransformer;

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

    /**
     * @Given there is a :product, which costs £:price
     */
    public function thereIsAProductWhichCosts($product, $price)
    {
        $this->products[$product] = new Product($product, $price);
    }

    /**
     * @When I add the :product to the basket
     */
    public function iAddTheProductToTheBasket($product)
    {
        $this->basket->addProduct($this->products[$product]);
    }

    /**
     * @Then the overall basket price should be £:price
     */
    public function theOverallBasketPriceShouldBe($price)
    {
        Assert::assertEquals($price, $this->basket->getTotalPrice());
    }

    /**
     * @Then I should have :count product(s) in the basket
     */
    public function iShouldHaveNProductsInTheBasket($count)
    {
        Assert::assertCount($count, $this->basket);
    }
}
