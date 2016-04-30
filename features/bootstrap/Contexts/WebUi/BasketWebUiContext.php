<?php

namespace Contexts\WebUi;

use AppBundle\Entity\Product;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Contexts\DB\EntityManager;
use Transformers\PriceTransformer;
use Transformers\ProductFromDatabaseTransformer;

class BasketWebUiContext extends MinkContext implements KernelAwareContext, SnippetAcceptingContext
{
    use KernelDictionary;
    use ProductFromDatabaseTransformer;
    use PriceTransformer;
    use EntityManager;

    /**
     * @Given there is a :productName, which costs £:price
     */
    public function thereIsAWhichCostsPs($productName, $price)
    {
        $product = new Product($productName, $price);
        $em = $this->getEntityManager();
        $em->persist($product);
        $em->flush();
    }

    /**
     * @When I add the :product to the basket
     */
    public function iAddTheToTheBasket(Product $product)
    {
        $this->visit(sprintf('/product/%s', $product->getId()));
        $this->pressButton('Add to basket');
    }

    /**
     * @Then I should have :number product(s) in the basket
     */
    public function iShouldHaveProductInTheBasket($number)
    {
        $this->assertElementContains('#numberOfItems', $number);
    }

    /**
     * @Then the overall basket price should be £:price
     */
    public function theOverallBasketPriceShouldBePs($price)
    {
        $this->assertElementContains('#basketTotalPrice', $price);
    }
}
