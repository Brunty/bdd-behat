<?php

namespace Transformers;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManager;

trait ProductFromDatabaseTransformer
{

    /**
     * @Transform :product
     *
     * @param $name
     *
     * @return Product
     * @throws \Exception
     */
    public function castProductNameToProductEntity(string $name): Product
    {
        /** @var EntityManager $em */
        $em = $this->getEntityManager();
        $repo = $em->getRepository(Product::class);

        $product = $repo->findOneBy(
            [
                'name' => $name
            ]
        );

        if ( ! $product) {
            throw new \Exception(sprintf('Cannot find product with name %s', $name));
        }

        return $product;
    }
}
