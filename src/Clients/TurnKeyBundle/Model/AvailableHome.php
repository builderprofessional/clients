<?php
/**
 * This class represents one available home.
 *
 * @copyright 2016 Third Engine Software
 */
namespace Clients\TurnKeyBundle\Model;

use Clients\TurnKeyBundle\Model\om\BaseAvailableHome;

class AvailableHome extends BaseAvailableHome
{
  /**
   * This method will remove all data related to this available home.
   */
  public function removeAllData()
  {
    $address = $this->getAddress();
    $this->delete();
    $address->delete();
  }
}
