<?php
/**
 * This class defines the TurnKey bundle and sets the database table prefix.
 */
namespace Clients\TurnKeyBundle;


use Symfony\Component\HttpKernel\Bundle\Bundle;


class ClientsTurnKeyBundle extends Bundle
{
  /**
   * this will allow the reverse command to tell which tables belong to this bundle
   */
  public static $defaultTablePrefix = 'turnkey';

  /**
   * this will define which bundle tables without prefixes should get added to
   */
  public static $defaultBundle = false;
}
