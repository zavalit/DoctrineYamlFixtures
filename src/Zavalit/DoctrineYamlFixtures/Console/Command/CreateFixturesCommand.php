<?php 

namespace Zavalit\DoctrineYamlFixtures\Console\Command;

use Symfony\Component\Console\Command\Command,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Output\OutputInterface;

use Doctrine\ORM\Mapping\Driver\DatabaseDriver,
    Doctrine\ORM\Tools\DisconnectedClassMetadataFactory,
    Doctrine\ORM\Tools\Export\ClassMetadataExporter;

class CreateFixturesCommand extends Command 
{ 

  protected function configure()
  {
     $this->setName('zavalit:fixtures:create');
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $em = $this->getHelper('em')->getEntityManager();
    $yamlMetadataPath = $this->getHelper('em')->getYamlMetaDataPath();
    $em->getConfiguration()->setMetadataDriverImpl(
      new DatabaseDriver(
        $em->getConnection()->getSchemaManager()
      )  
    );

    $cmf = new DisconnectedClassMetadataFactory();
    $cmf->setEntityManager($em);
    $metadata = $cmf->getAllMetadata();

    $cme = new ClassMetadataExporter();
    $exporter = $cme->getExporter('yml', $yamlMetadataPath);
    $exporter->setMetadata($metadata);
    $exporter->export();

  }
}
