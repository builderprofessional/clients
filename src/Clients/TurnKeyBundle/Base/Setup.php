<?php
/**
 * This class will help set up new sites.
 *
 * @copyright 2016 Third Engine Software
 */
namespace Clients\TurnKeyBundle\Base;


use Clients\TurnKeyBundle\Model\Faq;
use Clients\TurnKeyBundle\Model\SiteQuery;
use Clients\TurnKeyBundle\Model\Site;
use Clients\TurnKeyBundle\Model\TeamMember;

use Engine\BillingBundle\Model\Client;
use Engine\DemographicBundle\Model\Address;
use Engine\DemographicBundle\Model\Company;
use Engine\DemographicBundle\Model\Employee;
use Engine\DemographicBundle\Model\Person;
use Engine\DemographicBundle\Model\PhonePeer;

use ThirdEngine\Factory\Factory;


class Setup
{
  protected $teamMemberPosition = 1;
  protected $faqPosition = 1;


  /**
   * This method will setup a new builder.
   *
   * @param string $builderCode
   * @param string $builderCompanyName
   * @param string $address1
   * @param string $address2
   * @param string $city
   * @param string $state
   * @param string $zipCode
   * @param string $office
   * @param string $phone
   */
  public function setupNewBuilder($builderCode, $builderCompanyName, $address1, $address2, $city, $state, $zipCode, $office, $fax)
  {
    $company = Factory::createNewObject(Company::class);
    $company->setName($builderCompanyName);
    $company->save();

    $client = Factory::createNewObject(Client::class);
    $client->setActive(1);
    $client->setDemographicCompanyId($company->getCompanyId());
    $client->save();

    $address = Factory::createNewObject(Address::class);
    $address->setAddress($address1);
    $address->setAddress2($address2);
    $address->setCity($city);
    $address->setState($state);
    $address->setZipCode($zipCode);
    $address->save();

    $company->setAddressId($address->getAddressId());
    $company->save();

    $phonePeer = Factory::createNewObject(PhonePeer::class);
    $phonePeer->addPhone($office, 'Office', $company->getCompanyId(), null);
    $phonePeer->addPhone($fax, 'Fax', $company->getCompanyId(), null);

    $site = Factory::createNewObject(Site::class);
    $site->setBillingClientId($client->getClientId());
    $site->setCode($builderCode);
    $site->save();
  }

  /**
   * This method will add a new team member.
   *
   * @param string $builderCode
   * @param string $firstName
   * @param string $lastName
   * @param string $title
   * @param string $description
   * @param string $image
   */
  public function setupTeamMember($builderCode, $firstName, $lastName, $title, $description, $image)
  {
    $site = Factory::createNewQueryObject(SiteQuery::class)->findOneByCode($builderCode);

    $person = Factory::createNewObject(Person::class);
    $person->setFirstName($firstName);
    $person->setLastName($lastName);
    $person->save();

    $employee = Factory::createNewObject(Employee::class);
    $employee->setPersonId($person->getPersonId());
    $employee->setCompanyId($site->getClient()->getCompany()->getCompanyId());
    $employee->setJobTitle($title);
    $employee->save();

    $teamMember = Factory::createNewObject(TeamMember::class);
    $teamMember->setDemographicEmployeeId($employee->getEmployeeId());
    $teamMember->setDescription($description);
    $teamMember->setImageFileName($image);
    $teamMember->setSiteId($site->getSiteId());
    $teamMember->setSortOrder($this->teamMemberPosition);
    $teamMember->save();

    ++$this->teamMemberPosition;
  }

  /**
   * This method will add another FAQ question.
   *
   * @param string $builderCode
   * @param string $question
   * @param string $answer
   */
  public function setupFaq($builderCode, $question, $answer)
  {
    $site = Factory::createNewQueryObject(SiteQuery::class)->findOneByCode($builderCode);

    $faq = Factory::createNewObject(Faq::class);
    $faq->setSiteId($site->getSiteId());
    $faq->setQuestion($question);
    $faq->setAnswer($answer);
    $faq->setSortOrder($this->faqPosition);
    $faq->save();

    ++$this->faqPosition;
  }
}