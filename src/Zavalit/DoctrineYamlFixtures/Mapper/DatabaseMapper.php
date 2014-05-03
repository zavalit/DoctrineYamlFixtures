<?php 

namespace Zavalit\DoctrineYamlFixtures\Mapper;

use Zavalit\DoctrineYamlFixtures\Mapper\AbstractMapper;
use Zavalit\DoctrineYamlFixtures\Mapper\MapperInterface;

use Doctrine\ORM\Tools\DisconnectedClassMetadataFactory,
    Doctrine\ORM\Tools\Export\ClassMetadataExporter;



class DatabaseMapper extends AbstractMapper implements MapperInterface
{

  public function map()
  {
    $em = $this->factory->getConfig()->getEntityManagerWithDatabaseDriver();
    $mappingPath = $this->factory->getConfig()->getMappingPath();

    $cmf = new DisconnectedClassMetadataFactory();
    $cmf->setEntityManager($em);
    $metadata = $cmf->getAllMetadata();

    $cme = new ClassMetadataExporter();
    $exporter = $cme->getExporter('yml', $mappingPath);
    $exporter->setMetadata($metadata);
    $exporter->export();

  }

}

