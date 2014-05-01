<?php 

namespace Zavalit\DoctrineYamlFixtures;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;
use Zavalit\DoctrineYamlFixtures\Console\Command\CreateFixturesCommand;
use Zavalit\DoctrineYamlFixtures\Version;

class ConsoleRunner
{

  static public $console = null;

  static public function init(HelperSet $helperSet)
  { 
    if (null === self::$console) {
        $console = new Application('Doctrine Yaml Fixtures Interface', Version::VERSION);
        $console->setHelperSet($helperSet);
        self::addConsoleCommands($console);
        self::$console = $console;
    }

  }

  static function run()
  {

    if(null === self::$console){
       throw new \Exception("ConsoleRunner should be instatiate at first");
    }

    self::$console->run();
  
  }

  static private function addConsoleCommands(Application $console)
  {

    $console->addCommands(
      array(
        new CreateFixturesCommand()
     )
    );

  }




}
