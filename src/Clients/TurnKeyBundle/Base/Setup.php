<?php
/**
 * This class will help set up new sites.
 *
 * @copyright 2016 Third Engine Software
 */
namespace Clients\TurnKeyBundle\Base;


use Clients\TurnKeyBundle\Model\AvailableHome;
use Clients\TurnKeyBundle\Model\BuildProcess;
use Clients\TurnKeyBundle\Model\Faq;
use Clients\TurnKeyBundle\Model\SiteQuery;
use Clients\TurnKeyBundle\Model\Site;
use Clients\TurnKeyBundle\Model\TeamMember;
use Clients\TurnKeyBundle\Model\Testimonial;

use Engine\BillingBundle\Model\Client;
use Engine\DemographicBundle\Model\Address;
use Engine\DemographicBundle\Model\Company;
use Engine\DemographicBundle\Model\Employee;
use Engine\DemographicBundle\Model\Person;
use Engine\DemographicBundle\Model\PhonePeer;

use ThirdEngine\Factory\Factory;

use DateTime;



class Setup
{
  protected $teamMemberPosition = 1;
  protected $faqPosition = 1;
  protected $availableHomePosition = 1;
  protected $testimonialPosition = 1;
  protected $buildProcessPosition = 1;


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
   * This method will setup a new build process step.
   *
   * @param string $builderCode
   * @param string $title
   * @param string $process
   * @param string $image
   */
  public function setupProcess($builderCode, $title, $process, $image)
  {
    $site = Factory::createNewQueryObject(SiteQuery::class)->findOneByCode($builderCode);

    $step = Factory::createNewObject(BuildProcess::class);
    $step->setSiteId($site->getSiteId());
    $step->setTitle($title);
    $step->setProcess($process);
    $step->setImage($image);
    $step->setSortOrder($this->buildProcessPosition);
    $step->save();

    ++$this->buildProcessPosition;
  }

  /**
   * This method will add a new testimonial.
   *
   * @param string $builderCode
   * @param string $title
   * @param string $image
   * @param DateTime $givenDate
   * @param string $signature
   * @param string $mainText
   */
  public function setupTestimonial($builderCode, $title, $image, DateTime $givenDate = null, $signature, $mainText)
  {
    $site = Factory::createNewQueryObject(SiteQuery::class)->findOneByCode($builderCode);

    $testimonial = Factory::createNewObject(Testimonial::class);

    $testimonial->setSiteId($site->getSiteId());
    $testimonial->setTitle($title);
    $testimonial->setImage($image);
    $testimonial->setGivenDate($givenDate);
    $testimonial->setSignature($signature);
    $testimonial->setMainText($mainText);
    $testimonial->setSortOrder($this->testimonialPosition);
    $testimonial->save();

    ++$this->testimonialPosition;
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

  /**
   * This method will add a new available home.
   *
   * @param string $builderCode
   * @param string $image
   * @param string $address1
   * @param string $city
   * @param string $state
   * @param string $zipCode
   * @param int $bedroomCount
   * @param int $fullBathroomCount
   * @param int $halfBathroomCount
   * @param int $squareFeet
   * @param string $description
   */
  public function setupAvailableHome($builderCode, $image, $address1, $city, $state, $zipCode, $bedroomCount, $fullBathroomCount, $halfBathroomCount, $squareFeet, $size, $price, $status, $description)
  {
    $site = Factory::createNewQueryObject(SiteQuery::class)->findOneByCode($builderCode);

    $address = Factory::createNewObject(Address::class);
    $address->setAddress($address1);
    $address->setCity($city);
    $address->setState($state);
    $address->setZipCode($zipCode);
    $address->save();

    $availableHome = Factory::createNewObject(AvailableHome::class);
    $availableHome->setSiteId($site->getSiteId());
    $availableHome->setImage($image);
    $availableHome->setDemographicAddressId($address->getAddressId());
    $availableHome->setBedroomCount($bedroomCount);
    $availableHome->setFullBathroomCount($fullBathroomCount);
    $availableHome->setHalfBathroomCount($halfBathroomCount);
    $availableHome->setSquareFeet($squareFeet);
    $availableHome->setSize($size);
    $availableHome->setStatus($status);
    $availableHome->setPrice($price);
    $availableHome->setDescription($description);
    $availableHome->setSortOrder($this->availableHomePosition);
    $availableHome->save();

    ++$this->availableHomePosition;
  }
}