<?php

namespace Contexts\DB;

use Behat\Symfony2Extension\Context\KernelAwareContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Contexts\DB\EntityManager as ContextEntityManager;
use Doctrine\Common\Cache\ClearableCache;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\DBAL\Platforms\MySqlPlatform;
use Doctrine\ORM\EntityManager as DoctrineEntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Behat\Behat\Hook\Scope\ScenarioScope;

class SchemaContext implements KernelAwareContext
{

    use KernelDictionary;
    use ContextEntityManager;

    private $purger;
    private static $hasSchema = false;

    protected $tags = [];
    protected $tagLoaded = false;

    /**
     * @BeforeScenario
     */
    public function storeTags($event)
    {
        if (false === $this->tagLoaded) {
            if ($event instanceof ScenarioScope) {
                if (null !== $feature = $event->getFeature()) {
                    $this->tags = array_merge($this->tags, $feature->getTags());
                }
                if (null !== $scenario = $event->getScenario()) {
                    $this->tags = array_merge($this->tags, $scenario->getTags());
                }
            }
            $this->tagLoaded = true;
        }
    }

    protected function hasTag($name)
    {
        return in_array($name, $this->tags);
    }

    protected function hasTags(array $names)
    {
        foreach ($names as $name) {
            if ( ! (0 === strpos($name, '~')) !== $this->hasTag(str_replace('~', '', $name))) {
                return false;
            }
        }

        return true;
    }

    protected function getTagContent($name)
    {
        $content = [];

        foreach ($this->tags as $tag) {
            $matches = [];
            if (preg_match(sprintf('/^%s\((.*)\)$/', $name), $tag, $matches)) {
                $content[] = end($matches);
            }
        }

        return $content;
    }

    protected function getTags()
    {
        return $this->tags;
    }

    function __construct(ORMPurger $purger = null)
    {
        $this->purger = $purger ?: new ORMPurger();
    }

    /**
     * @BeforeScenario
     */
    public function beforeScenario($event)
    {
        $this->storeTags($event);
        if ($this->hasTags(['reset-em'])) {
            $entityManager = $this->getEntityManager();
            $this->preparePurger($entityManager);
            $this->purger->purge();
            $this->resetPurger($entityManager);
        }
    }

    protected function getMetadata(DoctrineEntityManager $entityManager)
    {
        return $entityManager->getMetadataFactory()->getAllMetadata();
    }

    /**
     * Enable/disable foreign key checks on the MySQL platform
     *
     * @param DoctrineEntityManager $entityManager
     * @param bool                  $bool
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    private function setForeignKeyChecks(DoctrineEntityManager $entityManager, $bool)
    {
        $connection = $entityManager->getConnection();
        $platform = $connection->getDatabasePlatform();
        if ($platform instanceof MySqlPlatform) {
            $connection->query(sprintf('SET FOREIGN_KEY_CHECKS=%s', (int)$bool));
        }
    }

    /**
     * @param $entityManager
     *
     * @return array
     */
    private function preparePurger(DoctrineEntityManager $entityManager)
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