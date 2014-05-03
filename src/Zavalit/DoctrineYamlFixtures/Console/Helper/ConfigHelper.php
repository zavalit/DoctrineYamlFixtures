<?php 

namespace Zavalit\DoctrineYamlFixtures\Console\Helper;

use Symfony\Component\Console\Helper\Helper;
use Zavalit\DoctrineYamlFixtures\Config;

class ConfigHelper extends Helper
{
  private $_config;

  function __construct(Config $config)
  {
      $this->_config = $config;
  }
  
  public function getName()
  {
    return 'helper_config';
  }

  public function getConfig()
  {
     return $this->_config;
  }

}
