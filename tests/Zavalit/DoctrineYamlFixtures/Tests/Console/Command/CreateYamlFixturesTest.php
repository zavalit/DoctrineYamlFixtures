<?php 

namespace Zavalit\DoctrineYamlFixtures\Tests\Console\Command;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Console\Helper\HelperSet;
use Zavalit\DoctrineYamlFixtures\ConsoleRunner,
    Zavalit\DoctrineYamlFixtures\Config,
    Zavalit\DoctrineYamlFixtures\Console\Command\CreateFixturesCommand,
    Zavalit\DoctrineYamlFixtures\Console\Helper\ConfigHelper;


class CreateYamlFixturesTest extends \PHPUnit_Framework_Testcase
{
  protected $command;

  function setUp()
  {
    $config['connectionParams'] = array('driver'=>'pdo_sqlite');
    $config['yamlFixturesRoot'] = 1;

    $helperSet = new HelperSet(array(new ConfigHelper(new Config($config))));
     
    ConsoleRunner::init($helperSet);
    $this->command = ConsoleRunner::$console->find('zavalit:fixtures:create');
  }

  function tearDown()
  {
     $this->command = null;
  }

  function testCommandExists()
  {
    $this->assertTrue($this->command instanceof CreateFixturesCommand);
  }

  function testCommandHasHelperWithConfig()
  {
    $helper = $this->command->getHelper('helper_config');
    $this->assertTrue($helper->getConfig() instanceof Config);
  }


}
