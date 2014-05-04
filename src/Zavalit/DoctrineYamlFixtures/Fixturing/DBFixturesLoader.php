<?php 

namespace Zavalit\DoctrineYamlFixtures\Fixturing;

use Zavalit\DoctrineYamlFixtures\Fixturing\FixturesLoaderInterface;
use Zavalit\DoctrineYamlFixtures\Fixturing\AbstractFixturesLoader;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;

class DBFixturesLoader extends AbstractFixturesLoader implements FixturesLoaderInterface
{

  public function load()
  {
    $this->createSchema();
    $this->loadFixturesData();
  }

  function createSchema()
  {
     $emf = $this->config->getEntityManagerForFixtures();
   
     if(!$emf->getConnection()->getSchemaManager()->tryMethod('listDatabases')){
       $dbname = $this->config->getFixturesDatabaseName();
       $conn = $this->config->getConnectionForFixturesWithoutDatabase();
       $conn->getSchemaManager()->createDatabase($dbname);
     } 
  }

  function loadFixturesData()
  {
  
  
  }

}
