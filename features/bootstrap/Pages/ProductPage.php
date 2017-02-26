<?php

namespace Pages;

use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class ProductPage extends Page
{
    protected $path = '/product/{id}';

    public function addToBasket()
    {
        $this->pressButton('add_to_basket');
    }
}
