<?php 

namespace Zavalit\DoctrineYamlFixtures\Mapper;

use Zavalit\DoctrineYamlFixtures\Config;
use Zavalit\DoctrineYamlFixtures\Mapper\MapperInterface;
use Zavalit\DoctrineYamlFixtures\Mapper\Map;

class MapperFactory
{
  private $_config;
  private $_mappers = array(
    Map::DATABASE=>'Zavalit\DoctrineYamlFixtures\Mapper\DatabaseMapper');

  function __construct(Config $config)
  {
     $this->_config = $config;
  }

  function doMapping($mapBase)
  {
    $mapperClass = $this->_mappers[$mapBase];
    $mapper = new $mapperClass($this);

    if(!$mapper instanceof MapperInterface){
      throw new \Exception(sprintf("Mapper %s should implement MapperInterface", $mapperClass));
    }  

    $mapper->map();

  }

  function getConfig()
  {
     return $this->_config;
  }


}
