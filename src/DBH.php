<?php

namespace App;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\DatabaseDriver;

class DBH
{

    const
        /**
         * @var integer
         */
        EM = 1,

        /**
         * @var integer
         */
        PDO = 2;

    /**
     * @var DBH
     */
    private static $instance;
    
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @constructor
     */
    private function __construct()
    {
        $cfg = json_decode(file_get_contents(
            __DIR__ . "/../app/config/parameters.json")
        );
        /**
         * @see Setup::createAnnotationMetadataConfiguration(
         *      $path, false, null, null, false
         * )
         * @see Setup::createXMLMetadataConfiguration($path, false)
         */
        $this->em =EntityManager::create([
                "driver"   => "pdo_" . $cfg->database_driver,
                "user"     => $cfg->database_user,
                "password" => $cfg->database_password,
                "dbname"   => $cfg->database_name,
                "enum" => "string"
            ],
            Setup::createXMLMetadataConfiguration([
                __DIR__."/Entity"
            ], false)
        );
        $driver = new DatabaseDriver($this->em->getConnection()->getSchemaManager());
        $driver->setNamespace("App\\Entity\\");
        $this->em->getConfiguration()->setMetadataDriverImpl($driver);
    }

    /**
     * @return self
     */
    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * @param int $attr
     * @return \Doctrine\ORM\EntityManager|\PDO
     */
    public static function get(int $attr = self::EM)
    {
        return self::PDO == $attr
             ? self::getInstance()->em->getConnection()->getWrappedConnection()
             : self::getInstance()->em;
    }

}
