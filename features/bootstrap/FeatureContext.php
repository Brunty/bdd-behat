<?php

use Behat\Behat\Context\SnippetAcceptingContext;
use Transformers\CountTransformer;

class FeatureContext implements SnippetAcceptingContext
{
    use CountTransformer;

    public function __construct()
    {
    }
}
