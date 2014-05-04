<?php 

namespace Zavalit\DoctrineYamlFixtures\Test\Fixturing;

use Zavalit\DoctrineYamlFixtures\Fixturing\YamlFixturesLoader;
use Zavalit\DoctrineYamlFixtures\Fixturing\DBFixturesLoader;

class FixturesLoaderTest extends \PHPUnit_Framework_Testcase
{

  static protected $config;

  static function setUpBeforeClass()
  {
     self::$config = $GLOBALS['testConfigInstance'];
  }

  function testYamlLoaderStoresYamlFiles()
  {
     $yamlLoader = new YamlFixturesLoader(self::$config);
     $yamlLoader->load();

     $yaml = self::$config->getFixturesFile();

     $data = \Symfony\Component\Yaml\Yaml::parse(file_get_contents($yaml));

     $this->assertTrue(is_array($data)&&!empty($data), "stored Yaml fixtures should not be empty");
  }

  function testDBLoaderHasFixtureDatabase()
  {
      $dbLoader = new DBFixturesLoader(self::$config);
      $dbLoader->createSchema();

      $emf = self::$config->getEntityManagerForFixtures();
      if($dbs =  $emf->getConnection()->getSchemaManager()->tryMethod('listDatabases')) { 
        $this->assertTrue(in_array(self::$config->getFixturesDatabaseName(), $dbs), 'fixture databse should be there');
        $emf->getConnection()->getSchemaManager()->dropDatabase(self::$config->getFixturesDatabaseName());
     }else{
        $this->assertTrue(false, 'it should be possible to list databases');
     }
  }
  

}
