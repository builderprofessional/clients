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

use DateTime;
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
    $this->setupTestimonials($builderSetup);
    $this->setupBuildProcess($builderSetup);
    $this->setupCommunities($builderSetup);
  }

  protected function setupCommunities(Setup $builderSetup)
  {
    $builderSetup->setupCommunity('burghli', 'Fifth Ward', '29.77287086009354', '-95.32880902290344');
    $builderSetup->setupCommunity('burghli', 'Towne Park Village', '29.86863341269248', '-95.29142439365387');
    $builderSetup->setupCommunity('burghli', 'Galveston County', '29.287596650313482', '-94.83703995589167');
    $builderSetup->setupCommunity('burghli', 'Acres Homes', '29.862678854483473', '-95.4275894165039');
    $builderSetup->setupCommunity('burghli', 'Third Ward', '29.72898010501013', '-95.35658866167068');
    $builderSetup->setupCommunity('burghli', 'Near Northside', '29.80084211351509', '-95.35240173339844');
    $builderSetup->setupCommunity('burghli', 'Trinity Gardens', '29.831858339280018', '-95.31652450561523');
    $builderSetup->setupCommunity('burghli', 'Magnolia', '30.12649554806559', '-95.78499913215637');
    $builderSetup->setupCommunity('burghli', 'Sunnyside District', '29.67604721173953', '-95.3752326965332');
    $builderSetup->setupCommunity('burghli', 'Santa Fe', '29.380978428336014', '-95.11894226074219');
    $builderSetup->setupCommunity('burghli', 'Tomball', '30.09969248873229', '-95.62976628541946');
  }

  protected function setupBuildProcess(Setup $builderSetup)
  {
    $initialMeetingText = <<<STR
This meeting is an opportunity to meet the construction manager and have your questions
answered. The construction manager will go over the plans and selections and set a time line
of expectations for the construction process.
STR;

    $foundationText = <<<STR
After the lot gets scraped, the form gets set. Underground plumbing and electrical are placed
at this time. After plumbing and electrical pass inspection by city official, the
foundation contractor excavates footings and beams. Then, the reinforcing steel gets placed
and inspected. Once it passes inspection, the concrete is poured. During this
process, several Quality Inspections will be conducted by your Construction Manager.
STR;

    $frameText = <<<STR
Upon completion of rough framing and prior to the installation of your mechanicals, your
Construction Manager will complete the Frame Inspection. During this time he will
confirm that your home is constructed with the specific options that you have selected as
well as confirming the quality of the construction of your home. The Construction Manager
will also inspect several key areas of the framing of your home such as room dimensions,
window dimensions, elevations, and bearing points. Then the Local Building Official will
inspect the framing to make sure everything is done according to plans,
specifications, and code.
STR;

    $roughMechanicalsText = <<<STR
Now that your home is constructed, it is time to install the contents of your home. Over the
next several days you will see your home transform from an empty shell to something very
special. This is when everything that is going to be covered up with insulation and drywall
is installed. While on the outside it looks like nothing is going on, inside is
where all the activity is. First your rough plumbing will be installed including your
tubs and showers. You will also see all of your water supply lines and drains run
in your walls and ceilings. Once the plumbing is complete, the heating and cooling contractor
will be in to install all of the duct work necessary to move fresh air in and old air out of each
room in your house. After the heating and cooling contractor is complete you will notice all
of the electrical wires, switch boxes, light openings, and phone/cable locations
installed in your new home.
<br /><br />
Once all of your rough mechanicals are installed, several inspections will be conducted by
the local building department to ensure that the mechanical components along with the
construction of your home comply with any and all municipal building codes.
<br /><br />
Upon the approval of all necessary inspections, your Construction Coordinator will complete
a Rough Mechanical Inspection to verify that all of components of the mechanical system
are installed to plans specifications as well as confirm that those items specific to your
home are installed prior to the installation of Insulation and Drywall.
STR;

  $insulationText = <<<STR
The home is coming to life. The first thing to happens is the insulation will be installed
in your exterior walls and in your attic. Once we have insulated the home properly you will
see several days of drywall installation take place.
STR;

    $drywallText = <<<STR
First the drywall will be hung on the walls and ceilings of your home. Typically this is a
two day process. After the drywall is installed, there will be several days of taping and
finishing the drywall. On or around the time that the drywall work has begun in your new home,
you will also see the exterior begin to take life. The exterior features such as brick and siding
will be installed.
<br /><br />
During this phase of construction your Construction Coordinator will be confirming the quality
 of the drywall installation as well as the exterior features of your new home.
STR;

    $finishesText = <<<STR
Now that the drywall is complete, things begin moving very quickly. Almost every day there
will be something new going on in your home. First the interior trim consisting of your
interior doors, base moldings, and cabinets will be installed. The next step will be paint.
But just before paint your Construction Coordinator will conduct another Inspection. The
Construction Manager will confirm the quality of the interior trim and drywall prior to
painting the interior of your home.
<br /><br />
During this phase of construction you will also see the remaining items on the exterior
of your home take shape like the driveway, sidewalks, porch posts, garage doors, and exterior
painting. Because your home is being built in an ever changing climate, these items may be
completed at different stages of construction depending on the weather and time of year.
<br /><br />
Once we have ensured that the trim and drywall are ready for paint, all the fun will begin
on the interior of your home. The interior of your home will be painted, hard surface
flooring will be installed, and countertops will go in. Once this is all done, your
final mechanicals will be installed. This will consist of your plumbing fixtures, light
fixtures, plugs & switches, and floor registers.
<br /><br />
As soon as your interior finishes are in, your house will be cleaned, carpet will be
installed and your Construction Manager will conduct one more Quality inspection. At the
Completed Home Inspection, your Construction Coordinator will ensure the home is ready
for the new homeowner to move in.
STR;

  $orientationText = <<<STR
Now that your new homes has passed all the required municipal inspections, received a
Certificate of Occupancy, and the Construction Coordinator has completed their final
Quality Inspection, you and the Construction Manager will complete a very detailed walk
through of your new home. During this meeting, you will not only inspect the entire
home but you will be educated on all the inter-workings of your new home.
STR;


    $builderSetup->setupProcess('burghli', 'Preconstruction Meeting', $initialMeetingText, 'initial_meeting.jpg');
    $builderSetup->setupProcess('burghli', 'Foundation: 7-14 Days', $foundationText, 'foundation.jpg');
    $builderSetup->setupProcess('burghli', 'Rough Framing: 10-14 Days', $frameText, 'framing.jpg');
    $builderSetup->setupProcess('burghli', 'Rough Mechanicals', $roughMechanicalsText, 'rough_mechanicals.jpg');
    $builderSetup->setupProcess('burghli', 'Wall Cover', $insulationText, 'insulation.jpg');
    $builderSetup->setupProcess('burghli', null, $drywallText, 'drywall.jpg');
    $builderSetup->setupProcess('burghli', 'Interior & Exterior Finishes', $finishesText, 'finishes.jpg');
    $builderSetup->setupProcess('burghli', 'New Home Orientation Walk', $orientationText, 'orientation.jpg');
  }

  protected function setupTestimonials(Setup $builderSetup)
  {
    $abrownDescription = <<<STR
We have had the pleasure of meeting Burghli Homes whom are remarkable people. We were
given step-by- step of what to expect of our home and everything was done in a timely manner.
Because we live next door, we were fortunate in seeing the entire process of the crew at work.
I’d like to give recognition to Mr. Jesse Aldrite for a job well done and his concern for others;
he indeed cares a great deal about his work.
STR;

    $alottDescription = <<<STR
In reference of Jessie, my builder, I must say he’s very hard working. He went from bottom to
top to finish his work. It was a struggle, but he made it. I want to say thanks to all. I’m
satisfied with my house and am thankful to the City of Houston, Burghli Homes and the staff who
worked here.
STR;

    $mclenonDescription = <<<STR
I am pleased to write this letter of recommendation in regards to Cesar Ruiz. The home
building process has been a great experience. I am thankful for the hard work and am very
pleased with the timely manner of the home being built. Cesar has made this a very smooth
process, even when there was bad weather. Seeing the hard work, responsibility and
dedication, I am pleased to say it has been a pleasure to see someone with a strong work ethic
that has a great attitude toward an ability to handle an ever-changing work load.
STR;

    $jacksonDescription = <<<STR
I would like to send my gratitude and appreciation for the excellent services that Burghli
Homes has provided. Rolando kept me informed on every detail of building my home, whether
big or small. The work performed was astonishing. I would definitely recommend your service
to anyone I know. I want to personally thank you for all your hard work and dedication. I can’t
express enough how I’m amazed at such a good job you’ve done. Thank you once again. I love
my home!
STR;

    $hamptonDescription = <<<STR
I am truly grateful for the blessing you guys have bestowed upon me. It’s much more than a
house to me. It’s a safe and secure place where I am free to live and do the things that bring me
happiness and peace. This entire process has been a very pleasant experience. The staff of
Burhgli Homes did a fantastic job of walking me through the process and being there to assist
me every step of the way. The representatives were willing to meet me halfway when I didn’t
have transportation to get to their office to sign documents. They were always courteous and
never made it seem as though I was a burden when I called. The staff went above and beyond
to make sure all my needs were met and all of my questions were answered. Thank you,
Burghli, for building a beautiful house, but for more importantly, building me a home. I can’t
wait to get back to the things that bring warmth to my heart, like baking a cake or hosting a
holiday dinner for my family. Thank you, Burghli Homes, for all that you’ve done.
STR;

    $campbellDescription = <<<STR
I write this letter in recommendation of Mr. Rolando Guillen of Burghli Homes as a general
contractor. I had the pleasure of working with Mr. Guillen on the renovation of my new home. I
can recommend him highly and without reservation. Throughout the course of the renovation,
Mr. Guillen was a consummate professional. He was accurate in his initial assessment of the
scale and cost of our project. He was absolutely clear in his record keeping and time log. He
chose and managed the sub-contractors well. Our job was done with care precision. He is a
gifted woodcrafter and the custom cabinetry he designed and executed are lovely. In addition,
he is extremely clean and tidy in the workplace. He and his assistant never left the worksite in
disarray. They vacuumed all drywall dust daily. Mr. Guillen took special care to prevent any of
the job dust from trailing throughout the house. The only complexity in working with Mr.
Guillen is that, as he himself will tell you, good work takes time to complete. Patience is
required when you work with a perfectionist. Although our project took time to complete, I
think we have a wonderful outcome and a work of art.
STR;

    $collinsDescription = <<<STR
I would like to express my thanks to the City of Houston for my new home. Special thanks to
contractor Bryan Mouton and Superintendent Christina Rodriguez for their professional
assistance in helping me through the building process of my new home. They were very helpful
in answering any questions I had and clarifying anything I did not understand. I am so
appreciative of the two of them. Also, special thanks to each crew member that had a part in
the building of my hoe. They did a tremendous job and I am so grateful to them. I love my new
home and will abide by all the rules that apply. I am anxiously awaiting my move in so that I
may enjoy the comfort and beauty of my home.
STR;

    $grundyDescription = <<<STR
I would like to express my gratitude to the special people who are working to help me with my
dream come true house. All of my life, while raising children, I have looked and dreamed of
owning a better house than the one which was torn down. My old house was very messed up
from the effect of many hurricanes. Somehow I believed that it was possible, but I had no idea
how to accomplish such an event. Through God’s grace, mercy and favor, I was led to apply to
the Disaster Recovery Program in Houston, TX where the people have great integrity. Thank you
so much for helping me get into my dream home. We love it. I am having a very pleasant
experience in building my new home. I am writing this to tell you how much my family and I are
enjoying watching it being built. I am looking forward to walking on the beautiful carpet,
looking through the beautiful windows, and looking up at the extraordinary high ceilings.
STR;


    $abrownDate = new DateTime('2015-08-30');
    $builderSetup->setupTestimonial('burghli', '905 Prosper', null, $abrownDate, 'A. Brown and S.Zeung', $abrownDescription);
    $builderSetup->setupTestimonial('burghli', '938 Marcolin', null, null, 'A. Lott', $alottDescription);
    $builderSetup->setupTestimonial('burghli', '989 Marjorie', null, null, 'C. Mclenon and Family', $mclenonDescription);
    $builderSetup->setupTestimonial('burghli', '1704 Capron', null, null, 'J. Jackson', $jacksonDescription);
    $builderSetup->setupTestimonial('burghli', '4830 Winfree', null, null, 'E. Hampton', $hamptonDescription);
    $builderSetup->setupTestimonial('burghli', '5003 Lyons', null, null, 'V. Campbell', $campbellDescription);
    $builderSetup->setupTestimonial('burghli', '5022 Idaho', null, null, 'J. Collins', $collinsDescription);
    $builderSetup->setupTestimonial('burghli', '8409 Burg', null, null, 'B. Grundy', $grundyDescription);
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
