<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends Controller
{

    /**
     * @Route("/product/{id}", name="product_view")
     * @ParamConverter("product", class="AppBundle\Entity\Product")
     * @param Product $product
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewProductAction(Product $product)
    {
        return $this->render(
            'Product/view.html.twig',
            [
                'product' => $product
            ]
        );
    }
}
