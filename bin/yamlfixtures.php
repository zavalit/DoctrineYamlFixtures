<?php 

require_once __DIR__ ."/../vendor/autoload.php";

if(!file_exists(__DIR__ . "/../config.php")){
      exit(PHP_EOL . "You should provide your config file at firtst! take a look on config.php.example" . PHP_EOL. PHP_EOL);
};
require_once __DIR__ . "/../config.php";

use Symfony\Component\Console\Helper\HelperSet;
use Zavalit\DoctrineYamlFixtures\ConsoleRunner,
    Zavalit\DoctrineYamlFixtures\Config,
    Zavalit\DoctrineYamlFixtures\Console\Helper\ConfigHelper;


$helperSet = new HelperSet(array(new ConfigHelper(new Config($config))));
ConsoleRunner::init($helperSet);
ConsoleRunner::run();

