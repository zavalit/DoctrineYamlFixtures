<?php 

namespace Zavalit\DoctrineYamlFixtures\Tests\Console\Command;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Console\Helper\HelperSet;
use Zavalit\DoctrineYamlFixtures\ConsoleRunner,
    Zavalit\DoctrineYamlFixtures\Console\Command\CreateFixturesCommand,
    Zavalit\DoctrineYamlFixtures\Console\Helper\YamlMetadataEntityManager;


class CreateYamlFixturesTest extends \PHPUnit_Framework_Testcase
{
  protected $command;

  function setUp()
  {
    $connectionParams = 
      array('driver'=>$GLOBALS['test_db_driver'],
        'dbname'=>$GLOBALS['test_db_name'],
        'host'=>$GLOBALS['test_db_host'],
        'user'=>$GLOBALS['test_db_user'], 
        'password'=>$GLOBALS['test_db_password'],
      );

    $yamlMetadataPath = $GLOBALS['test_yaml_metadata_path'];

    $helperSet = new HelperSet(array(new YamlMetadataEntityManager($connectionParams, $yamlMetadataPath)));
     
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

  function testCommandHasHelperWithEntityManager()
  {

    $helper = $this->command->getHelper('em');
    $this->assertTrue($helper->getEntityManager() instanceof \Doctrine\ORM\EntityManager);

  }

  function testCommandCreateYamlMapping()
  {
    $em = $this->command
      ->getHelper('em')
      ->getEntityManager();
    
    $path = $this->command->getHelper('em')->getYamlMetaDataPath();

    $commandTester = new CommandTester($this->command);
    $commandTester->execute(array('command'=>$this->command->getName()));
    
    $this->assertTrue(file_exists($path. '/Tags.dcm.yml'));



  }



}
