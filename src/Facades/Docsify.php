<?php

namespace JannisMilz\Docsify\Facades;

use Illuminate\Support\Facades\Facade;

class Docsify extends Facade
{
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor()
  {
    return 'Docsify';
  }
}
