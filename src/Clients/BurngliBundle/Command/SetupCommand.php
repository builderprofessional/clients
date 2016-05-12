<?php
/**
 * This class sets up the initial data for Burghli.
 *
 * @copyright 2016 Third Engine Software
 */
namespace Clients\BurngliBundle\Command;


use Clients\TurnKeyBundle\Base\Setup;
use Engine\EngineBundle\Command\EngineCommand;

use ThirdEngine\Factory\Factory;

use stdClass;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class SetupCommand extends EngineCommand
{
  protected function configure()
  {
    $this
      ->setName('burghli:setup')
      ->setDescription('Set the initial data for Burghli homes.');
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $builderSetup = Factory::createNewObject(Setup::class);
    $builderSetup->setupNewBuilder('burghli', 'Burghli Homes', '4615 N. Freeway', null, 'Houston', 'TX', '77022', '(713) 691-3948', '(713) 692-6063');

    $this->setupTeam($builderSetup);
    $this->setupFaq($builderSetup);
    $this->setupAvailableHomes($builderSetup);
  }

  protected function setupAvailableHomes(Setup $builderSetup)
  {
    $builderSetup->setupAvailableHome(
      'burghli', '2906 Paige.jpg',
      '2906 Paige', null, null, null, 4, 2, null, 1391, null, null, 'Sold',
      'This house is super energy efficient!'
    );

    $description = <<<STR
Uniquely designed, Elegant 1 Story home with brick and stone elevation. FULLY LOADED! Chef
inspired kitchen features granite countertops, 42in. designer cabinets & stainless steel
appliances. Spacious family room offers a majestic stone fireplace with matching stone
accent wall under breakfast bar. Retreat to the sprawling master suite that includes
an expansive walk-in closet, whirlpool tub with separate tile shower, double vanity
with granite countertops and oil rubbed bronze hardware. Crown Molding in common
areas. Insulated Carriage House Garage Door in Cedar color with Lasalle style windows
and wrought iron hardware includes garage door opener. High Efficiency 16 Seer HVAC
system. Spacious Secondary Bedrooms. Covered Front and Rear Porches. Fantastic
Location! Look No Further, Your Dream Home is Here!
STR;

    $builderSetup->setupAvailableHome(
      'burghli', '29735 Quinn.jpg',
      '29735 Quinn', null, null, null,
      3, 2, null, null, '1639 / 2498', '$245,000',
      'Available', $description
    );

    $builderSetup->setupAvailableHome(
      'burghli', '7918 Beckley St.jpg',
      '7918 Beckley St.', null, null, null,
      3, 2, null, 1290, null, '$163,000',
      'Available', 'To be built, construction to start 3/2016.'
    );

    $builderSetup->setupAvailableHome(
      'burghli', '7914 Beckley St.jpg',
      '7914 Beckley St.', null, null, null,
      3, 2, null, 1298, null, '$160,000',
      'Available', 'To be built, construction to start 3/2016.'
    );

    $builderSetup->setupAvailableHome(
      'burghli', '3417 Elgin.jpg',
      '3417 Elgin', null, null, null,
      3, 2, 1, 1602, null, null,
      'Sold', 'Completion date June 30th'
    );

    $builderSetup->setupAvailableHome(
      'burghli', '15531 Maple.jpg',
      '15531 Maple', null, null, null,
      3, 2, null, 1667, null, null,
      'Sold', 'Construction starts May 1st'
    );

    $description = <<<STR
Uniquely designed, Elegant 1 Story home with brick and stone elevation. FULLY LOADED!
Chef inspired kitchen features granite countertops, 42in. designer cabinets & stainless
steel appliances. Spacious family room offers a majestic stone fireplace with matching
stone accent wall under breakfast bar. Retreat to the sprawling master suite that
includes an expansive walk-in closet, whirlpool tub with separate tile shower, double
vanity with granite countertops and oil rubbed bronze hardware. Crown Molding in
common areas. Insulated Carriage House Garage Door in Cedar color with Lasalle style
windows and wrought iron hardware includes garage door opener. High Efficiency 16
Seer HVAC system. Spacious Secondary Bedrooms. Covered Front and Rear Porches.
Fantastic Location! Look No Further, Your Dream Home is Here!
STR;


    $builderSetup->setupAvailableHome(
      'burghli', '29727 Quinn.jpg',
      '29727 Quinn', null, null, null,
      3, 2, null, null, '2188 / 2922', '$275,000',
      'Available', $description
    );
  }



  protected function setupFaq(Setup $builderSetup)
  {
    $answer1 = <<<ANS
The short answer is no, We do not offer seller financing or in house financing, however,
over the years we have acquired a list of reputable lenders and mortgage brokers that
can fit almost any need. Upon request our in house experts can help guide you through
the financing process and give you advice and tips to prepare for acquiring a mortgage
loan with a lender.
ANS;

    $answer2 = <<<ANS
Even though this is not our specialty, we have done "Build on Your Lot" in the past
for clients who have fell in love with our craftsmanship. It is on a case by case
basis depending on location, and workflow at the time.
ANS;

    $answer3 = <<<ANS
Throughout the City of Houston and the surrounding areas.
ANS;

    $answer4 = <<<ANS
We build a wide range of square footage and style of homes. Whether you are looking
for your first home or upgrading into a secondary home we have a broad assortment of
homes we build. See our collections for some of the homes we build.
ANS;

    $answer5 = <<<ANS
We offer a 1-2-10 warranty. 1 year of workmanship warranty. 2 years of delivery systems
warranty (pipes, wires, ducts), and 10 year structural warranty (Roof, Frame,
Foundation). Our warranty is backed by an insurance policy so if one day we are no
longer here, your warranty still is.
ANS;

    $answer6 = <<<ANS
Just like "Build on Your Lot" it is on a case by case basis for us to build
from someone else's plans and designs.
ANS;

    $answer7 = <<<ANS
We work with a number of Down Payment Assistance programs through our list of
knowledgeable, reputable lenders.
ANS;

  $answer8 = <<<ANS
Our office hours are Monday-Friday, 8am-5pm, however, you can also schedule an
appointment with a sales associate for after hours or on the weekend to tour our homes.
ANS;

    $answer9 = <<<ANS
Gas range (where gas is available) dishwasher, range hood and garbage disposal are
included. Incentives are occasionally offered that sometimes include refrigerator
and/or washer and dryer. This is typically on an inventory home that we would
like to sell quickly. Ask your customer service rep for details.
ANS;

    $answer10 = <<<ANS
Lots come in a variety of sizes based on the location and neighborhood.
Please check our lot inventory.
ANS;

    $answer11 = <<<ANS
We have an inventory of lots to choose from. If one of our lots does not
work out for you and you wish to go with another lot, we may be able to
Build on Your Lot on a case by case basis.
ANS;

    $answer12 = <<<ANS
Typically we have models or available homes throughout the city, please
check with one of our customer service reps to get location and hours.
ANS;

    $answer13 = <<<ANS
Unfortunately, we are only offering New Construction at this time.
Remodeling is not our forte.
ANS;

    $answer14 = <<<ANS
No, however Incentives are occasionally offered that sometimes
include a gift certificate to one of our local furniture stores. This
is typically only on an inventory home that we would like to sell
quickly. Ask your customer service rep for details.
ANS;


    $builderSetup->setupFaq('burghli', 'Do you offer financing?', $answer1);
    $builderSetup->setupFaq('burghli', 'Can you build on my lot?', $answer2);
    $builderSetup->setupFaq('burghli', 'What areas are you building in?', $answer3);
    $builderSetup->setupFaq('burghli', 'What sizes of homes do you build?', $answer4);
    $builderSetup->setupFaq('burghli', 'What type of warranty do you offer?', $answer5);
    $builderSetup->setupFaq('burghli', 'Do you build only from plans you supply?', $answer6);
    $builderSetup->setupFaq('burghli', 'Do you offer down payment assistance?', $answer7);
    $builderSetup->setupFaq('burghli', 'When can we schedule an appointment?', $answer8);
    $builderSetup->setupFaq('burghli', 'Are appliances included in the home?', $answer9);
    $builderSetup->setupFaq('burghli', 'What sizes are your lots?', $answer10);
    $builderSetup->setupFaq('burghli', 'Can you help me find a lot to build on?', $answer11);
    $builderSetup->setupFaq('burghli', 'Do you have model homes I can look at?', $answer12);
    $builderSetup->setupFaq('burghli', 'Can you remodel my existing home?', $answer13);
    $builderSetup->setupFaq('burghli', 'Do you sell furnished homes?', $answer14);
  }

  protected function setupTeam(Setup $builderSetup)
  {
    $descriptions = $this->getTeamMemberDescriptions();

    $builderSetup->setupTeamMember('burghli', 'Zack', 'Burghli', 'President and CEO', $descriptions->zackBurghli, 'zack_burghli.jpg');
    $builderSetup->setupTeamMember('burghli', 'Deanna', 'Burghli', 'Director', $descriptions->deannaBurghli, 'deanna_burghli.jpg');
    $builderSetup->setupTeamMember('burghli', 'Brenda', 'Orozco', 'General Manager', $descriptions->brendaOrozco, 'brenda_orozco.jpg');
    $builderSetup->setupTeamMember('burghli', 'Jessica', 'Torres', 'Production Manager', $descriptions->jessicaTorres, 'jessica_torres.jpg');
    $builderSetup->setupTeamMember('burghli', 'Jerry', 'Brooks', 'Administrative/Customer Relations', $descriptions->jerryBrooks, 'jerry_brooks.jpg');
    $builderSetup->setupTeamMember('burghli', 'Ola', 'Burghli', 'Purchasing Director', $descriptions->olaBurghli, 'ola_burghli.jpg');
    $builderSetup->setupTeamMember('burghli', 'Monica', 'Montoya', 'CSR Specialist', $descriptions->monicaMontoya, 'monica_montoya.jpg');
    $builderSetup->setupTeamMember('burghli', 'Cesar', 'Ruiz', 'Warranty Department/CSR', $descriptions->cesarRuiz, 'cesar_ruiz.jpg');
  }

  protected function getTeamMemberDescriptions()
  {
    $teamDescriptions = new stdClass();

    $teamDescriptions->brendaOrozco = <<<DESC
Brenda Orozco has worked with Burghli Homes since 1999. Started as a receptionist and has worked in
every aspect of the company working herself all the way up to General Manager. Oversees and leads
employees to meet expectations for productivity, quality, and goal accomplishment. Brenda enjoys
spending time with her family, especially with her son, who is her pride and joy. She's a great
event coordinator. She also loves to cook, go shopping, and gardening.
DESC;

    $teamDescriptions->jessicaTorres = <<<DESC
Jessica Torres has worked with Burghli Homes since 2006. Started as an office assistant and worked
her way into sales, then construction management and now is our production manager that oversees
all of our construction managers and projects. Jessica is a fanatic of all Houston sports
teams. She enjoys kickball, Zumba and flag football. Jessica is very detail oriented and strives
for perfection.
DESC;

    $teamDescriptions->jerryBrooks = <<<DESC
Jerry Brooks has worked with Burghli Homes since 2014 in our administrative department handling
customer relations. Jerry is a very committed dad to his only son. He loves playing sports
and working out at the gym.
DESC;

    $teamDescriptions->deannaBurghli = <<<DESC
Deanna Burghli has 20 yrs of experience. One of the original founders and partners of
Burghli Homes. Head of the design team as well as marketing team. Brings life to every home
she is involved with. Enjoys spending time with her family including her 4 beautiful children
and 3 grandchildren. She lives for high adventure activities like rock climbing, hiking,
surfing, skiing and all water sports. Plays wanna-be cowgirl on the weekends with her cattle
ranching hubby that she adores dearly.
DESC;

    $teamDescriptions->zackBurghli = <<<DESC
Zack Burghli has 30+ yrs of experience. Founder and CEO of Burghli Homes. Demands all work to
be performed to very high standards. Ensures our company operates ethically and morally at
all times. Puts the well being of humanity before monetary values. When he's not building
he likes to spend time with his entire family. Dinner with the family includes at least 25
seats filled. He enjoys cooking, fishing, horseback riding, traveling, and ranching. Is
one of the greatest dads and grandpas of all time!
DESC;

    $teamDescriptions->olaBurghli = <<<DESC
Ola Burghli has been part of the Burghli Homes team since 2013 and handles vendor relations.
She partners with the production and sales departments to ensure the correct material is
ordered in a timely fashion to meet production schedules and timelines. She is a devoted
mom to her beautiful 3 children. Ola is always up for an adventure and enjoys experiencing
new things and places. She loves to cook, listen to music, and dance.
DESC;


    $teamDescriptions->monicaMontoya = <<<DESC
Monica Montoya has been part of the Burghli Homes team since 2014. Handles the intake of
all customer service calls. Ensures that all work order claims are addressed efficiently
and scheduled appropriately. Assists the sales department with daily duties. She is
the smile that greets you and brightens your day as you walk into our office. She
loves going to school to enhance her skills and knowledge. Her hobbies are dancing,
working out, and enjoys horse riding.
DESC;


    $teamDescriptions->cesarRuiz = <<<DESC
Cesar Ruiz has been part of the Burghli Homes team since 2014. Makes sure that warranty
claims are processed and scheduled with the appropriate Sub-Contractor  in a timely manner.
Cesar is a family man and spends his extra time with his beautiful wife and children.
Cesar is very active and involved in his children's lives volunteering as a soccer
coach and enjoys trail biking.
DESC;


    return $teamDescriptions;
  }
}
