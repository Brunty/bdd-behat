<?php

namespace Contexts\Domain;

use Behat\Behat\Tester\Exception\PendingException;
use AppBundle\Entity\Product;
use AppBundle\Entity\Basket;
use Behat\Behat\Context\SnippetAcceptingContext;
use PHPUnit_Framework_Assert as Assert;
use Transformers\CountTransformer;
use Transformers\PriceTransformer;

class BasketDomainContext implements SnippetAcceptingContext
{

    use PriceTransformer;
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
    public function thereIsAWhichCostsPs($product, $price)
    {
        $this->products[$product] = new Product($product, $price);
    }

    /**
     * @When I add the :product to the basket
     */
    public function iAddTheToTheBasket($product)
    {
        $this->basket->addProduct($this->products[$product]);
    }

    /**
     * @Then I should have :count product(s) in the basket
     */
    public function iShouldHaveProductInTheBasket($count)
    {
        Assert::assertCount($count, $this->basket);
    }

    /**
     * @Then the overall basket price should be £:price
     */
    public function theOverallBasketPriceShouldBePs($price)
    {
        Assert::assertEquals($price, $this->basket->getTotalPrice());
    }
}
