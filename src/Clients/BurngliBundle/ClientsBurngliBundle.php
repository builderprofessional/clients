<?php

namespace Clients\BurngliBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ClientsBurngliBundle extends Bundle
{
  /**
   * this will allow the reverse command to tell which tables belong to this bundle
   */
  public static $defaultTablePrefix = 'burghli';

  /**
   * this will define which bundle tables without prefixes should get added to
   */
  public static $defaultBundle = false;
}
