<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{

    /**
     * @Route("/product/{id}", name="product_view")
     *
     * @param         $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewProductAction($id)
    {
        $product = $this->get('doctrine.orm.default_entity_manager')->getRepository(Product::class)->find($id);

        return $this->render(
            'Product/view.html.twig',
            [
                'product' => $product
            ]
        );
    }
}
