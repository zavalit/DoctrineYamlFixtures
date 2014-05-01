<?php 

namespace Zavalit\DoctrineYamlFixtures\Console\Helper;

use Symfony\Component\Console\Helper\Helper;
use Doctrine\ORM\Tools\Setup,
    Doctrine\ORM\EntityManager;

class YamlMetadataEntityManager extends Helper
{

  private $_connectionParams;
  private $_yamlMetadataPath;
  private $_em;

  function __construct($connectionParams, $yamlMetadataPath)
  {
    $this->_connectionParams = $connectionParams;
    $this->_yamlMetadataPath = $yamlMetadataPath;
    $this->initEntityManager();
  }
  
  /**
    *  instantiate EntityManager with Yaml Metadata Configurartion
    */
  
  private function initEntityManager()
  {
    $config = Setup::createYAMLMetadataConfiguration(array($this->_yamlMetadataPath), true);
    $this->_em = EntityManager::create($this->_connectionParams, $config);
  }

  public function getName()
  {
    return 'em';
  }

  public function getEntityManager()
  {
    return $this->_em;
  }

  public function getYamlMetaDataPath()
  {
    return $this->_yamlMetadataPath;
  }

}
