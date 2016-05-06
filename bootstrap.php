<?php
/**
 * Created by PhpStorm.
 * User: Roman
 * Date: 26.04.2016
 * Time: 22:46
 */
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode);

// database configuration parameters
$options = [
    'driver'   => 'pdo_mysql',
    'host'     => '127.0.0.1',
    'dbname'   => 'lectern',
    'user'     => 'tester',
    'password' => '12345'
];

$em = EntityManager::create($options, $config);