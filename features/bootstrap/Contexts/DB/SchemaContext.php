<?php

namespace Contexts\DB;

use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Contexts\DB\EntityManager as ContextEntityManager;
use Doctrine\Common\Cache\ClearableCache;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Platforms\MySqlPlatform;
use Doctrine\ORM\EntityManager as DoctrineEntityManager;
use Doctrine\ORM\Tools\SchemaTool;

class SchemaContext implements KernelAwareContext
{

    use KernelDictionary;
    use ContextEntityManager;

    /**
     * @var ORMPurger
     */
    private $purger;

    /**
     * @var bool
     */
    private static $hasSchema = false;

    /**
     * @var array
     */
    protected $tags = [];

    /**
     * @var bool
     */
    protected $tagLoaded = false;

    function __construct(ORMPurger $purger = null)
    {
        $this->purger = $purger ?: new ORMPurger();
    }

    /**
     * @BeforeScenario @reset-em
     */
    public function beforeScenario(BeforeScenarioScope $scope)
    {
        $entityManager = $this->getEntityManager();
        $this->preparePurger($entityManager);
        $this->purger->purge();
        $this->resetPurger($entityManager);
    }

    private function getMetadata(DoctrineEntityManager $entityManager): array
    {
        return $entityManager->getMetadataFactory()->getAllMetadata();
    }

    /**
     * Enable/disable foreign key checks on the MySQL platform
     *
     * @param DoctrineEntityManager $entityManager
     * @param bool                  $bool
     *
     * @throws DBALException
     */
    private function setForeignKeyChecks(DoctrineEntityManager $entityManager, $bool)
    {
        $connection = $entityManager->getConnection();
        $platform = $connection->getDatabasePlatform();
        if ($platform instanceof MySqlPlatform) {
            $connection->query(sprintf('SET FOREIGN_KEY_CHECKS=%s', (int)$bool));
        }
    }

    private function preparePurger(DoctrineEntityManager $entityManager): ORMPurger
    {
        $this->setForeignKeyChecks($entityManager, false);
        if ( ! self::$hasSchema) {
            $tool = new SchemaTool($entityManager);
            $metadata = $this->getMetadata($entityManager);
            $tool->updateSchema($metadata, true);
            self::$hasSchema = true;
        }
        $this->purger->setEntityManager($entityManager);
        $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);

        return $this->purger;
    }

    private function resetPurger(DoctrineEntityManager $entityManager)
    {
        $this->setForeignKeyChecks($entityManager, true);
        /** @var ClearableCache $cacheDriver */
        $cacheDriver = $entityManager->getConfiguration()->getResultCacheImpl();
        if ($cacheDriver) {
            $cacheDriver->deleteAll();
        }
    }
}
