<?php 

namespace Zavalit\DoctrineYamlFixtures\Mapper;

abstract class AbstractMapper
{
  protected $factory;

  function __construct(MapperFactory $factory)
  {
     $this->factory = $factory;
  }

}
