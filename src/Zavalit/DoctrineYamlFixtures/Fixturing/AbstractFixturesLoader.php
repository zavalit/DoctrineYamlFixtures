<?php 

namespace Zavalit\DoctrineYamlFixtures\Fixturing;

use Zavalit\DoctrineYamlFixtures\Config;

abstract class AbstractFixturesLoader
{
  protected $config;
  
  function __construct(Config $config)
  {
      $this->config = $config;
  }
}
