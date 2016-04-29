<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Basket;
use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BasketController extends Controller
{

    /**
     * @Route("/basket", name="basket_add", methods={"POST"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addToBasketAction(Request $request)
    {
        $productId = $request->get('product_id');
        $product = $this->get('doctrine.orm.default_entity_manager')->getRepository(Product::class)->find($productId);

        if ( ! $product) {
            throw new NotFoundHttpException('Product could not be found');
        }

        $sessionId = $this->get('session')->getId();

        $basketRepo = $this->getBasketRepo();
        $basket = $basketRepo->findOneBy(['session' => $sessionId]);

        if ( ! $basket) {
            $basket = new Basket($sessionId);
        }

        $basket->addProduct($product);

        $em = $this->getEntityManager();
        $em->persist($basket);
        $em->flush();

        return $this->redirectToRoute('basket_view');
    }

    /**
     * @Route("/basket", name="basket_view", methods={"GET"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewBasketAction()
    {
        $basketRepo = $this->getBasketRepo();

        $basket = $basketRepo->findOneBy(['session' => $this->get('session')->getId()]);

        return $this->render(
            'Basket/view.html.twig',
            [
                'basket' => $basket
            ]
        );
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    private function getBasketRepo()
    {
        return $this->getEntityManager()->getRepository(Basket::class);
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    private function getEntityManager()
    {
        return $this->get('doctrine.orm.default_entity_manager');
    }
}
