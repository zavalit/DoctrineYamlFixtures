<?php 

$autoloader = require_once __DIR__."/../vendor/autoload.php";
$autoloader->add(__DIR__, 'Zavalit\\DoctrineYamlFixtures\\Tests');


$config['srcConnectionParams'] = 
      array('driver'=>$GLOBALS['test_db_driver'],
        'dbname'=>$GLOBALS['test_db_name'],
        'host'=>$GLOBALS['test_db_host'],
        'user'=>$GLOBALS['test_db_user'], 
        'password'=>$GLOBALS['test_db_password'],
      );


$config['destConnectionParams'] = 
      array('driver'=>$GLOBALS['test_fixtures_db_driver'],
        'dbname'=>$GLOBALS['test_fixtures_db_name'],
        'host'=>$GLOBALS['test_fixtures_db_host'],
        'user'=>$GLOBALS['test_fixtures_db_user'], 
        'password'=>$GLOBALS['test_fixtures_db_password'],
      );


$config['yamlFixturesRoot'] = sys_get_temp_dir();

$testConfigInstance = new Zavalit\DoctrineYamlFixtures\Config($config);

