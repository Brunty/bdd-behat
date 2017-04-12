<?php

namespace Contexts\WebUi;

use AppBundle\Entity\Product;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Contexts\DB\EntityManager;
use Pages\BasketPage;
use Pages\ProductPage;
use Transformers\PriceTransformer;
use Transformers\ProductFromDatabaseTransformer;
use PHPUnit\Framework\Assert;

class BasketWebUiContext extends MinkContext implements KernelAwareContext, SnippetAcceptingContext
{
    use KernelDictionary;
    use ProductFromDatabaseTransformer;
    use PriceTransformer;
    use EntityManager;

    /**
     * @var ProductPage
     */
    private $productPage;
    /**
     * @var BasketPage
     */
    private $basketPage;

    public function __construct(ProductPage $productPage, BasketPage $basketPage)
    {
        $this->productPage = $productPage;
        $this->basketPage = $basketPage;
    }
    /**
     * @Given there is a :productName, which costs £:price
     */
    public function thereIsAProductWhichCosts($productName, $price)
    {
        // now we're using alice, this step doesn't need to do anything...
    }

    /**
     * @When I add the :product to the basket
     */
    public function iAddTheProductToTheBasket(Product $product)
    {
        $this->productPage->open(['id' => $product->getId()]);
        $this->productPage->addToBasket();
    }

    /**
     * @Then I should have :number product(s) in the basket
     */
    public function iShouldHaveNProductsInTheBasket($number)
    {
        Assert::assertEquals($number, $this->basketPage->numberOfItems());
    }

    /**
     * @Then the overall basket price should be £:price
     */
    public function theOverallBasketPriceShouldBe($price)
    {
        Assert::assertEquals($price, $this->basketPage->basketPrice());
    }
}
