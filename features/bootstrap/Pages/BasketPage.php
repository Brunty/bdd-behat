<?php

namespace Pages;

use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class BasketPage extends Page
{

    protected $path = '/basket';

    public function addToBasket()
    {
        $this->pressButton('add_to_basket');
    }

    public function numberOfItems()
    {
        return $this->find('css', '#numberOfItems')->getText();
    }

    public function basketPrice()
    {
        return $this->find('css', '#basketTotalPrice')->getText();
    }
}
