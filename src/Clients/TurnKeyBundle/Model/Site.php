<?php
/**
 * This represents one turn key site.
 *
 * @copyright 2016 Third Engine Software
 */
namespace Clients\TurnKeyBundle\Model;


use Clients\TurnKeyBundle\Model\om\BaseSite;

use Engine\DemographicBundle\Model\EmployeeQuery;
use Engine\DemographicBundle\Model\PersonQuery;

use ThirdEngine\Factory\Factory;


class Site extends BaseSite
{
  /**
   * This method will remove all related data and then delete the site record also. This is
   * generally done to re-run the setup process.
   */
  public function removeAllData()
  {
    foreach ($this->getTeamMembers() as $teamMember)
    {
      $teamMember->removeAllData();
    }

    foreach ($this->getBuildProcesses() as $buildStep)
    {
      $buildStep->delete();
    }

    foreach ($this->getFaqs() as $faq)
    {
      $faq->delete();
    }

    $client = $this->getClient();
    $company = $client->getCompany();
    $address = $company->getAddress();

    foreach ($client->getCompany()->getPhones() as $phone)
    {
      $phone->delete();
    }

    foreach ($this->getAvailableHomes() as $home)
    {
      $home->removeAllData();
    }

    $this->delete();
    $client->delete();

    $company->delete();
    $address->delete();
  }
}
