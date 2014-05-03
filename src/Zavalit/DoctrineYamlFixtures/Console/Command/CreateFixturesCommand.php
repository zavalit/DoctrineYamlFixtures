<?php 

namespace Zavalit\DoctrineYamlFixtures\Console\Command;

use Symfony\Component\Console\Command\Command,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface;

use Zavalit\DoctrineYamlFixtures\Mapper\Map;
use Zavalit\DoctrineYamlFixtures\Mapper\MapperFactory; 

class CreateFixturesCommand extends Command 
{ 

  protected function configure()
  {
    $this->setName('zavalit:fixtures:create')
         ->setDescription('Organize the basics of your yaml fixtures')
         ->setDefinition(array(
           new InputOption('map', null, InputOption::VALUE_OPTIONAL, 
           'where is mapping shoul comming from', Map::DATABASE
           ),
           new InputOption('fixtures', null, InputOption::VALUE_OPTIONAL,
           'create fixtrues based on real data', false)
         )

       );

  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {

    $mapBase = $input->getOption('map');

    $outputData = array();
    
    $config = $this->getHelper('helper_config')->getConfig();
    $mapFactory = new MapperFactory($config);
    $mapFactory->doMapping($mapBase);
    $outputData[] = sprintf("Database mapping is created in %s", $config->getMappingPath());

    if(true === $input->getOption('fixtures')){

      $outputData[] = "Yaml Fixtures are created";
    }

   $output->writeln(implode(PHP_EOL, $outputData)); 

  }

}
