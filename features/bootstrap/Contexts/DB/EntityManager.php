<?php

namespace Contexts\DB;

use Doctrine\ORM\EntityManager as DoctrineEntityManager;

trait EntityManager
{

    /**
     * @return DoctrineEntityManager
     */
    private function getEntityManager()
    {
        return $this->getContainer()->get('doctrine.orm.entity_manager');
    }
}