<?php
/**
 * This class represents one member in a turn key site.
 *
 * @copyright 2016 Third Engine Software
 */
namespace Clients\TurnKeyBundle\Model;


use Engine\DemographicBundle\Model\EmployeeQuery;
use Engine\DemographicBundle\Model\PersonQuery;

use Clients\TurnKeyBundle\Model\om\BaseTeamMember;


class TeamMember extends BaseTeamMember
{
  /**
   * This method will remove all data for a team member.
   */
  public function removeAllData()
  {
    $employee = $this->getEmployee();
    $person = $employee->getPerson();

    $this->delete();
    $employee->delete();
    $person->delete();
  }
}
