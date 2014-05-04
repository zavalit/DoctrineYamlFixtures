<?php 

namespace Zavalit\DoctrineYamlFixtures\Tests\Mapper;

use Zavalit\DoctrineYamlFixtures\Config,
    Zavalit\DoctrineYamlFixtures\Mapper,    
    Zavalit\DoctrineYamlFixtures\Mapper\DatabaseMapper;

class MapperTest extends \PHPUnit_Framework_Testcase
{

  private $_factory;
  private $_config;

  function setUp()
  {
    $c = $GLOBALS['testConfigInstance'];
    $this->_factory = new Mapper\MapperFactory($c);
 
  }

  function tearDown()
  {
    $this->_factory = null;
  
  }

  function testMapperFactoryHasConfig()
  {
     $this->assertTrue($this->_factory->getConfig() instanceof Config);
  }

  function testDatabaseMapperCreatesYamlMapping()
  { 

    $dir = $this->_factory->getConfig()->getMappingPath();
    system("rm -rf ".escapeshellarg($dir));

    $dbMapper = new DatabaseMapper($this->_factory);
    $dbMapper->map();

    $files = scandir($dir);

    $file =  $dir ."/". $files[2];
    $data = \Symfony\Component\Yaml\Yaml::parse(file_get_contents($file));

    $mapping = array_pop($data);

    $this->assertEquals($mapping['type'], 'entity');
  
    #system("rm -rf ".escapeshellarg($dir));

  }

  function testDatabaseMapperWillBeCalledForDatabaseMap()
  {
    $this->markTestSkipped('buggy mock'); 
    $dbMapperMock = $this
      ->getMockBuilder("\Zavalit\DoctrineYamlFixtures\Mapper\DatabaseMapper")
      ->setMethods(array('map'))
      ->setConstructorArgs(array($this->_factory))
      ->getMock();

    $dbMapperMock->expects($this->once())
      ->method('map')->with(); 

    $this->_factory->doMapping(Mapper\Map::DATABASE);
  
  }

}
