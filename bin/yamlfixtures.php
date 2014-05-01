<?php 

require_once __DIR__ ."/../vendor/autoload.php";
require_once __DIR__ . "/../config.php";

use Symfony\Component\Console\Helper\HelperSet;
use Zavalit\DoctrineYamlFixtures\ConsoleRunner,
    Zavalit\DoctrineYamlFixtures\Console\Helper\YamlMetadataEntityManager;

$helperSet = new HelperSet(array(new YamlMetadataEntityManager($dbConfig, $yamlMetadataPath)));
ConsoleRunner::init($helperSet);
ConsoleRunner::run();

