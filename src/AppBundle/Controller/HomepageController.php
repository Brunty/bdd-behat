<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{

    /**
     * @Route("/", name="homepage", methods={"GET"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $products = $this->get('doctrine.orm.default_entity_manager')->getRepository(Product::class)->findAll();

        // replace this example code with whatever you need
        return $this->render(
            'Homepage/index.html.twig',
            [
                'products' => $products
            ]
        );
    }
}
