<?php 

namespace Zavalit\DoctrineYamlFixtures\Fixturing;

use Zavalit\DoctrineYamlFixtures\Fixturing\FixturesLoaderInterface;
use Zavalit\DoctrineYamlFixtures\Fixturing\AbstractFixturesLoader;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;

class YamlFixturesLoader extends AbstractFixturesLoader implements FixturesLoaderInterface
{

  public function load()
  {

    $finder = new Finder();
    $finder->files()->in($this->config->getMappingPath());

    $data = array();

    foreach($finder as $fileInfo){
 
      $fileContent = file_get_contents($fileInfo->getRealPath());
      $entityMap = Yaml::parse($fileContent);

      $entityMapValues = array_values($entityMap);
      $entityData = $entityMapValues[0];
      
      $data[$entityData['table']] = $this->loadTableData($entityMapValues);
    }

    $yaml = Yaml::dump($data, 2, 2);
    $destYamlPath = $this->config->getFixturesFile();


    if(!file_put_contents($destYamlPath, $yaml)){

      throw new \Exception(sprintf("Error to store YAML Fixtrue data in %s", $destYamlPath));
    }

  }

  function loadTableData($entityMapValues)
  {
   
   return null; 
  
  }

}
