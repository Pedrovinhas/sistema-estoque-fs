<?php

namespace Core\Exceptions;

use Exception;

class NotFoundException extends Exception
{
  private string $name;

  private $identifier;
  public function __construct(string $name, $identifier)
  {
    $name = strtolower($name);

    parent::__construct("Registro para {$name} não encontrado");

    $this->name = $name;
    $this->identifier = $identifier;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function getIdentifier(): string
  {
    return $this->identifier;
  }
}
