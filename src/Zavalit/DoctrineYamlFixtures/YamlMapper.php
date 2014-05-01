<?php 

namespace Zavalit\DoctrineYamlFixtures;

use Doctrine\ORM\Configuration;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class YamlMapper
{

  protected $connectionParmas;

  function __construct($connectionParams, $yamlPath=null, $proxyPath=null)
  {
    $this->connectionParams = $connectionParams;
    $this->yamlPath = $yamlPath;
    $this->proxyPath = $proxyPath;
  }

  function __invoke()
  {

    $config = Setup::createYAMLMetadataConfiguration(array($this->yamlPath), true);
    $em = EntityManager::create($this->connectionParams, $config);

     return $em;
     
  }


}
